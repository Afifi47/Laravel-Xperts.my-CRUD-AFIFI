# 🚀 Complete Setup Guide — Mini-CRM Laravel Project

Follow these steps **in order** to get the project running from scratch.

---

## Prerequisites

Install these before starting:

| Tool | Version | Install |
|------|---------|---------|
| PHP | 8.2+ | https://php.net/downloads |
| Composer | Latest | https://getcomposer.org |
| Node.js | 18+ | https://nodejs.org |
| MySQL | 8.0+ | https://dev.mysql.com/downloads |
| Git | Any | https://git-scm.com |

---

## Step 1 — Create a New Laravel Project

```bash
composer create-project laravel/laravel mini-crm
cd mini-crm
```

---

## Step 2 — Install Laravel Breeze (Auth + UI)

Breeze gives you login, logout, and a basic Tailwind CSS layout.

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run build
```

### Disable Registration (Required by Assessment)

Open `routes/auth.php` and DELETE or comment out these two lines:

```php
// DELETE THESE:
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);
```

Also remove the "Register" link from `resources/views/layouts/navigation.blade.php`.

---

## Step 3 — Configure the Database

### Create the database (MySQL):

```sql
CREATE DATABASE mini_crm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Edit `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_crm
DB_USERNAME=root
DB_PASSWORD=your_password_here

APP_NAME="Mini CRM"
APP_URL=http://localhost:8000
```

> **SQLite alternative** (simpler for local dev):
> ```dotenv
> DB_CONNECTION=sqlite
> # Then create the file:
> touch database/database.sqlite
> ```

---

## Step 4 — Copy Project Files

Copy all files from this repository into your Laravel project, respecting
the directory structure. Each file goes to its matching path:

```
app/Models/Company.php                          → app/Models/Company.php
app/Models/Employee.php                         → app/Models/Employee.php
app/Http/Controllers/CompanyController.php      → app/Http/Controllers/CompanyController.php
app/Http/Controllers/EmployeeController.php     → app/Http/Controllers/EmployeeController.php
app/Http/Controllers/Api/CompanyController.php  → app/Http/Controllers/Api/CompanyController.php
app/Http/Requests/StoreCompanyRequest.php       → app/Http/Requests/StoreCompanyRequest.php
app/Http/Requests/UpdateCompanyRequest.php      → app/Http/Requests/UpdateCompanyRequest.php
app/Http/Requests/StoreEmployeeRequest.php      → app/Http/Requests/StoreEmployeeRequest.php
app/Http/Requests/UpdateEmployeeRequest.php     → app/Http/Requests/UpdateEmployeeRequest.php
app/Http/Resources/CompanyResource.php          → app/Http/Resources/CompanyResource.php
app/Http/Resources/EmployeeResource.php         → app/Http/Resources/EmployeeResource.php
database/migrations/*                           → database/migrations/
database/seeders/*                              → database/seeders/
routes/web.php                                  → routes/web.php (REPLACE)
routes/api.php                                  → routes/api.php (REPLACE)
resources/views/companies/*                     → resources/views/companies/
resources/views/employees/*                     → resources/views/employees/
```

---

## Step 5 — Run Migrations and Seed

```bash
# Create all tables + seed the admin user
php artisan migrate --seed
```

This creates:
- `users` table with admin@admin.com / password
- `companies` table
- `employees` table
- Sample data (3 companies, 3 employees)

---

## Step 6 — Link Storage for Logo Access

Company logos are stored in `storage/app/public/logos/`.
This command creates a symlink from `public/storage` → `storage/app/public`
so uploaded logos are accessible via URL.

```bash
php artisan storage:link
```

---

## Step 7 — Start the Server

```bash
php artisan serve
```

Open http://localhost:8000 in your browser.

**Login with:**
- Email: `admin@admin.com`
- Password: `password`

---

## Step 8 — Test the API with Postman

1. Open Postman
2. Import `postman_collection.json` (File → Import)
3. The collection has a `base_url` variable set to `http://localhost:8000`
4. Run the **"Get Single Company with Employees"** request

### Manual test via curl:

```bash
# Get company #1 with employees and employee_count
curl -H "Accept: application/json" http://localhost:8000/api/companies/1

# Get all companies (paginated)
curl -H "Accept: application/json" http://localhost:8000/api/companies
```

---

## Step 9 — Push to GitHub

```bash
git init
git add .
git commit -m "Initial commit: Mini-CRM Laravel assessment"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/mini-crm.git
git push -u origin main
```

---

## Troubleshooting

### "Class not found" errors
```bash
composer dump-autoload
```

### Storage/logo images not showing
```bash
php artisan storage:link
# Make sure APP_URL in .env matches your actual URL
```

### CSRF token mismatch
- Ensure all forms include `@csrf`
- Clear config cache: `php artisan config:clear`

### Pagination styles missing
Add to `app/Providers/AppServiceProvider.php`:
```php
use Illuminate\Pagination\Paginator;

public function boot(): void
{
    Paginator::useTailwind(); // Use Tailwind CSS pagination
}
```

### Logo validation failing (min 100×100)
- The `dimensions` rule requires the GD or Imagick PHP extension
- Enable in php.ini: `extension=gd` or `extension=imagick`

---

## Security Checklist

| ✅ | Feature | How |
|----|---------|-----|
| ✅ | Auth protection | `auth` middleware on all web routes |
| ✅ | CSRF protection | `@csrf` on all forms |
| ✅ | XSS prevention | Blade `{{ }}` auto-escapes output |
| ✅ | SQL injection prevention | Eloquent ORM + parameterized queries |
| ✅ | Mass assignment protection | `$fillable` on all models |
| ✅ | File upload validation | Type, size, dimensions checked |
| ✅ | Safe file storage | Files in `storage/app/public`, not web root |
| ✅ | Password hashing | `Hash::make()` via bcrypt |
| ✅ | Registration disabled | Routes removed from auth.php |
| ✅ | Input validation | Form Request classes for all inputs |

---

## Assessment Checklist

- [x] Basic Laravel Authentication (login only)
- [x] Database Seeds → admin@admin.com / password
- [x] Companies CRUD (Create, Read, Update, Delete)
- [x] Employees CRUD
- [x] Companies table: name (required), email, logo (min 100×100), website
- [x] Employees table: first_name (required), last_name (required), company_id (FK), email, phone
- [x] Database Migrations
- [x] Eloquent relationships (Company hasMany Employees)
- [x] Logo stored in storage/app/public
- [x] Logo accessible from public URL
- [x] Laravel validation via Request classes
- [x] Pagination (10 per page)
- [x] Resource Controllers (index, create, store, show, edit, update, destroy)
- [x] Auth starter kit (Breeze)
- [x] Registration disabled
- [x] API routes + Web routes
- [x] API endpoint: GET /api/companies/{id} returns company + employees + employee_count
- [x] Postman collection included
- [x] README.md included
