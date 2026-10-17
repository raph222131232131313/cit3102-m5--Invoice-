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
| GET | `/api/invoices` | Attempts to fetch invoices without authentication (returns 401) | No |
| GET | `/api/invoices` | Lists invoices with filters (`invoice_number`, `client_name`, `status`, `total_amount`, `tax_amount`) | Yes |
| POST | `/api/invoices` | Creates a new invoice | Yes |
| POST | `/api/invoices` | Attempts to create an invoice with invalid/missing fields (returns 422) | Yes |
| GET | `/api/invoices/{invoice}` | Shows details of a single invoice | Yes |
| GET | `/api/invoices/{invoice}` | Attempts to show a non-existent invoice (returns 404) | Yes |
| PUT | `/api/invoices/{invoice}` | Updates an existing invoice | Yes |
| DELETE | `/api/invoices/{invoice}` | Deletes an invoice (returns 204) | Yes |

### Filter examples:

```
GET /api/invoices
GET /api/invoices?status=Pending
GET /api/invoices?status=Pending&client_name=Juan
## Proof that it runs
```

### 1. Register User (201)
![1 Register User](img1.png)

### 2. User Login (200)
![2 User Login](img2.png)

### 3. Get Invoice [Unauthenticated] (401)
![3 Invoice Unauthenticated](img3.png)

### 4. Get Invoice (Authenticated) (200)
![4 Invoice Authenticated](img4.png)

### 5. Create Invoice (201)
![5 Create Invoice](img5.png)

### 6. Create Invoice (Not Authorized / Missing Fields) (422)
![6 Create Invoice Error](img6.png)

### 7. Get Single Invoice (200)
![7 Get Single Invoice](img7.png)

### 8. Get Non-Existent Invoice (404)
![8 Get Non-Existent Invoice](img8.png)

### 9. Update Invoice (200)
![9 Update Invoice](img9.png)

### 10. Delete Invoice (204)
![10 Delete Invoice](img10.png)
