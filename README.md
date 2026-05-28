# SchoolERP Finance Practical

Laravel 11 school finance system for the LeadNexa practical task. It integrates the supplied `public/style.css`, `public/script.js`, and admin-template visual language with dynamic Laravel CRUD, reporting, PDF, and Excel exports.

## Features

- School Admin login/logout
- Income CRUD with automatic receipt number
- Fee receipt PDF after income entry
- Expense CRUD
- Payroll CRUD with `Net Salary = Salary + Bonus - Deduction`
- Dynamic dashboard cards for total income, expenses, payroll, and net profit/loss
- Financial report with monthly or date-range filters
- Financial summary PDF and Excel-compatible `.xls` export
- Laravel Sanctum Bearer-token REST API endpoints under `/api`

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

The current `.env` is configured for SQLite. For MySQL, update `DB_CONNECTION`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`, then run the same migration command.

## Login

- Email: `admin@school.test`
- Password: `password`

## Important URLs

- Dashboard: `/`
- Income: `/incomes`
- Expenses: `/expenses`
- Payroll: `/payrolls`
- Reports: `/reports`
- Report PDF: `/reports/pdf`
- Report Excel: `/reports/excel`

## REST APIs

Use `POST /api/login` first. The response returns `access_token`; send it as:

```text
Authorization: Bearer YOUR_TOKEN
```

- `GET /api/dashboard`
- `GET /api/reports?from=2026-05-01&to=2026-05-31`
- `GET|POST /api/incomes`
- `GET|PUT|DELETE /api/incomes/{id}`
- `GET|POST /api/expenses`
- `GET|PUT|DELETE /api/expenses/{id}`
- `GET|POST /api/payrolls`
- `GET|PUT|DELETE /api/payrolls/{id}`
- `POST /api/logout`

## Deliverables

- SQL seed/schema file: `docs/database.sql`
- Postman collection: `docs/SchoolERP.postman_collection.json`
- AI prompts used: `docs/ai-prompts.md`

## Verification

```bash
php artisan test
```
