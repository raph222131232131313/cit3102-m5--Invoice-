Markdown# Invoice API

**Name** Apellanes, Juan Raphael S.
**Course:** CIT3102 · Module 5, Build Your Own API

**Section:** IT2E

**Partners:** Solo

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

## Setup

Follow these steps to run the project from a fresh clone.

1. Clone the repository and go into the folder.
   ```bash
   git clone https://github.com/<your-username>/cit3102-m5-hunter.git
   cd cit3102-m5-hunter
   ```
2. Install the PHP packages (this recreates the `vendor/` folder).
   ```bash
   composer install
   ```
3. Create your own `.env` file and generate the app key.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   On Windows Command Prompt, use `copy .env.example .env` instead of `cp`.
4. Create the SQLite database file.
   ```bash
   touch database/database.sqlite
   ```
   On Windows Command Prompt, use `type nul > database\database.sqlite`.
5. Create the tables.
   ```bash
   php artisan migrate
   ```
6. Start the server.
   ```bash
   php artisan serve
   ```
   The API is now at `http://127.0.0.1:8000/api`.
7. In Bruno, send every request with the header `Accept: application/json`.


## Routes

| Verb | Path | What it does | Needs token? |
|---|---|---|---|
| POST | `/api/register` | Creates a new user and returns a token | No |
| POST | `/api/login` | Logs in and returns a token | No |
| POST | `/api/logout` | Deletes the current token | Yes |
| GET | `/api/me` | Returns the logged-in user | Yes |
| GET | `/api/invoices` | Lists invoices. Filters: `invoice_number`, `client_name`, `status`, `total_amount`, `tax_amount` | Yes |
| POST | `/api/invoices` | Creates an invoice | Yes |
| GET | `/api/invoices/{invoice}` | Shows one invoice | Yes |
| PUT | `/api/invoices/{invoice}` | Updates an invoice | Yes |
| DELETE | `/api/invoices/{invoice}` | Deletes an invoice | Yes |


Filter examples:

GET /api/invoices
GET /api/invoices?status=Pending
GET /api/invoices?status=Pending&client_name=Juan
