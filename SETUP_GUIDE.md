# Setup Guide

This guide is for running the submitted project locally.

## Prerequisites

- PHP 8.2 or newer
- Composer
- Node.js 18 or newer
- MySQL 8+ or another Laravel-supported database

## 1. Open the Project

The Laravel app is inside `mini-crm/`.

```bash
cd mini-crm
```

## 2. Install Dependencies

```bash
composer install
npm install
```

## 3. Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Set the database values in `.env`, for example:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_crm
DB_USERNAME=root
DB_PASSWORD=your_password
APP_URL=http://127.0.0.1:8000
```

## 4. Prepare the Database

```bash
php artisan migrate --seed
php artisan storage:link
```

This creates:

- the admin user
- the companies table
- the employees table
- demo company and employee records

## 5. Build Frontend Assets

```bash
npm run build
```

For development you can also use:

```bash
npm run dev
```

## 6. Start the App

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000`.

Default login:

- Email: `admin@admin.com`
- Password: `password`

## 7. API Check

Use either Postman or curl:

```bash
curl -H "Accept: application/json" http://127.0.0.1:8000/api/companies/1
```

The repository also includes `postman_collection.json`.

## 8. Run Tests

```bash
php artisan test
```

## Troubleshooting

- If logos are not visible, rerun `php artisan storage:link`.
- If the database fails to connect, re-check the `.env` credentials.
- If styles are missing, run `npm run build` again.
