<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // GET /api/invoices (kasama ang whitelist at numeric filtering)
    public function index(Request $request)
    {
        $query = Invoice::query();

        // Step 4: Whitelist array ng allowed string filter fields
        $allowedFilters = ['status', 'client_name', 'invoice_number'];

        foreach ($request->only($allowedFilters) as $key => $value) {
            if ($value) {
                $query->where($key, $value);
            }
        }

        // Numeric filtering
        if ($request->has('min_amount')) {
            $query->where('total_amount', '>=', $request->query('min_amount'));
        }

        if ($request->has('max_amount')) {
            $query->where('total_amount', '<=', $request->query('max_amount'));
        }

        return response()->json($query->get(), 200);
    }

    // POST /api/invoices
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|unique:invoices',
            'client_name'    => 'required|string',
            'status'         => 'required|string',
            'total_amount'   => 'required|numeric',
            'tax_amount'     => 'required|numeric',
        ]);

        $invoice = Invoice::create($validated);

        return response()->json($invoice, 201);
    }

    // GET /api/invoices/{id}
    public function show(string $id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }

        return response()->json($invoice, 200);
    }

    // PUT/PATCH /api/invoices/{id}
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }

        $validated = $request->validate([
            'invoice_number' => 'sometimes|string|unique:invoices,invoice_number,' . $id,
            'client_name'    => 'sometimes|string',
            'status'         => 'sometimes|string',
            'total_amount'   => 'sometimes|numeric',
            'tax_amount'     => 'sometimes|numeric',
        ]);

        $invoice->update($validated);

        return response()->json($invoice, 200);
    }

    // DELETE /api/invoices/{id}
    public function destroy(string $id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }

        $invoice->delete();

        // Inayos pabalik sa 204 No Content para sa Step 6 requirement
        return response()->json(null, 204);
    }
}