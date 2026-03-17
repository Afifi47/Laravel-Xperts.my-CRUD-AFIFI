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

If you want live frontend updates while developing, use:

```bash
npm run dev
```

## 6. Start the Backend

Run the backend from inside `mini-crm/`.

Use this command:

```bash
php -S 127.0.0.1:8000 -t public
```

Visit `http://127.0.0.1:8000`.

## 7. Start the Frontend

Open a second terminal in `mini-crm/` and run:

```bash
npm run dev
```

This starts the Vite frontend dev server for live asset updates while the Laravel backend is running.

If you do not need live frontend updates, you can skip this step and just use the built assets from:

```bash
npm run build
```

Default login:

- Email: `admin@admin.com`
- Password: `password`

## 8. API Check

Use either Postman or curl:

```bash
curl -H "Accept: application/json" http://127.0.0.1:8000/api/companies/1
```

The repository also includes `postman_collection.json`.

## 9. Run Tests

```bash
php artisan test
```

## Troubleshooting

- If `php artisan serve` fails to bind or resolve `localhost`, use `php -S 127.0.0.1:8000 -t public` instead.
- If logos are not visible, rerun `php artisan storage:link`.
- If the database fails to connect, re-check the `.env` credentials.
- If styles are missing, run `npm run build` again or keep `npm run dev` running in a second terminal.
