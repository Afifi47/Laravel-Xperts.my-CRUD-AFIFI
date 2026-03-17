# Mini-CRM — Laravel Admin Panel

A Mini-CRM admin panel built with Laravel to manage **Companies** and **Employees**. Built for the FNXPERTS SDN. BHD. Web Developer Assessment.

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 11 (PHP 8.2+) |
| Auth | Laravel Breeze (Blade) |
| Database | MySQL / SQLite |
| Storage | Laravel Storage (public disk) |
| API | Laravel API Resources |
| Testing | Postman / PHPUnit |

---

## Quick Start

```bash
# 1. Clone the repository
git clone https://github.com/YOUR_USERNAME/mini-crm.git
cd mini-crm

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies & build assets
npm install && npm run build

# 4. Copy environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Configure your .env (DB credentials, etc.)
# Edit .env: DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 7. Run migrations + seed initial admin user
php artisan migrate --seed

# 8. Link storage (for company logo access)
php artisan storage:link

# 9. Start the development server
php artisan serve
```

Visit: http://localhost:8000

**Default Admin Login:**
- Email: `admin@admin.com`
- Password: `password`

---

## Features

- ✅ Admin authentication (login/logout only — registration disabled)
- ✅ Companies CRUD with logo upload (min 100×100px)
- ✅ Employees CRUD linked to Companies
- ✅ Pagination (10 entries per page)
- ✅ Laravel Form Request validation
- ✅ Resource Controllers
- ✅ REST API endpoint: `/api/companies/{id}` with employee list & count
- ✅ Secure logo storage via `storage/app/public`

---

## API Usage

### Get a Company with Employees

```
GET /api/companies/{id}
Accept: application/json
```

**Example Response:**
```json
{
  "id": 1,
  "name": "Acme Corp",
  "email": "contact@acme.com",
  "website": "https://acme.com",
  "logo": "http://localhost/storage/logos/acme.png",
  "employee_count": 5,
  "employees": [
    {
      "id": 1,
      "first_name": "John",
      "last_name": "Doe",
      "email": "john@acme.com",
      "phone": "0123456789"
    }
  ]
}
```

Test with Postman: Import the collection from `postman_collection.json` in this repo.

---

## Security Measures

- All routes (except API) are protected by `auth` middleware
- Passwords hashed via `bcrypt`
- CSRF protection on all web forms
- File uploads validated for image type, min dimensions (100×100)
- SQL injection protection via Eloquent ORM
- XSS protection via Blade `{{ }}` escaping
- Registration route removed/disabled

---

## Database Schema

### companies
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| name | varchar(255) | Required |
| email | varchar(255) | Nullable, unique |
| logo | varchar(255) | Nullable, path |
| website | varchar(255) | Nullable |
| timestamps | — | created_at, updated_at |

### employees
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| first_name | varchar(255) | Required |
| last_name | varchar(255) | Required |
| company_id | bigint | FK → companies.id |
| email | varchar(255) | Nullable |
| phone | varchar(50) | Nullable |
| timestamps | — | created_at, updated_at |

---

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── CompanyController.php
│   │   ├── EmployeeController.php
│   │   └── Api/CompanyController.php
│   ├── Requests/
│   │   ├── StoreCompanyRequest.php
│   │   ├── UpdateCompanyRequest.php
│   │   ├── StoreEmployeeRequest.php
│   │   └── UpdateEmployeeRequest.php
│   └── Resources/
│       ├── CompanyResource.php
│       └── EmployeeResource.php
├── Models/
│   ├── Company.php
│   └── Employee.php
database/
├── migrations/
│   ├── create_companies_table.php
│   └── create_employees_table.php
└── seeders/
    ├── DatabaseSeeder.php
    └── AdminUserSeeder.php
resources/views/
├── companies/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
└── employees/
    ├── index.blade.php
    ├── create.blade.php
    ├── edit.blade.php
    └── show.blade.php
routes/
├── web.php
└── api.php
```
