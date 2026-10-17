Markdown# Invoice API

**Course:** CIT3102 · Module 5, Build Your Own API

**Section:** IT2E

**Partners:** Juan Raphael

**Resource:** Invoice (an invoice resource for tracking billing records)

A REST API built with Laravel, SQLite and Laravel Sanctum. It manages **invoices** with full CRUD, query-string filtering, and token authentication.

| Field | Type |
|---|---|
| invoice_number | string |
| client_name | string |
| status | string (Pending, Paid, Overdue, Cancelled) |
| total_amount | decimal / numeric |
| tax_amount | decimal / numeric |

---

## Setup

Follow these steps to run the project from a fresh clone.

1. **Clone the repository and go into the folder.**
   ```bash
   git clone [https://github.com/raph222131232131313/cit3102-m5--Invoice-.git](https://github.com/raph222131232131313/cit3102-m5--Invoice-.git)
   cd cit3102-m5--Invoice-
Install the PHP packages (this recreates the vendor/ folder).Bashcomposer install
Create your own .env file and generate the app key.Bashcp .env.example .env
php artisan key:generate
On Windows Command Prompt, use copy .env.example .env instead of cp.Create the SQLite database file.Bashtouch database/database.sqlite
On Windows Command Prompt, use type nul > database\database.sqlite.Create the tables.Bashphp artisan migrate
Start the local development server.Bashphp artisan serve
RoutesVerbPathWhat it doesNeeds token?POST/api/registerCreates a new user and returns a tokenNoPOST/api/loginLogs in and returns a tokenNoPOST/api/logoutDeletes the current tokenYesGET/api/meReturns the logged-in userYesGET/api/invoicesLists invoices. Filters: invoice_number, client_name, status, total_amount, tax_amountYesPOST/api/invoicesCreates an invoiceYesGET/api/invoices/{invoice}Shows one invoiceYesPUT/api/invoices/{invoice}Updates an invoiceYesDELETE/api/invoices/{invoice}Deletes an invoiceYesFilter examples:HTTPGET /api/invoices
GET /api/invoices?status=Pending
GET /api/invoices?status=Pending&client_name=Juan
Proof that it runs1. Register (201)2. Login (200)3. List invoices with no token (401)4. List invoices authenticated (200)5. Create invoice valid (201)6. Create invoice validation error (422)7. Show invoice (200)8. Show non-existent invoice (404)9. Update invoice (200)10. Delete invoice (204)Reflection: Why does DELETE return 204 and not 200?The HTTP 204 No Content status code indicates that the server successfully processed the request and deleted the resource, but there is no entity-body or data left to send back. Since deleting an invoice completely removes it from the database, returning 204 No Content is the standard RESTful response to inform the client that the action succeeded without returning unnecessary data payload.
