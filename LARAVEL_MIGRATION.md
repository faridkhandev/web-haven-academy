# Laravel Migration

The active application in this branch is now a **Laravel 13 application at the repository root**.

## Structure

- `app/` — Laravel controllers, models, middleware and providers
- `bootstrap/` — Laravel application bootstrap
- `config/` — Laravel configuration
- `database/` — Laravel database area
- `public/` — web document root, assets and uploads
- `resources/views/` — Blade templates and shared layouts
- `routes/web.php` — application routes
- `storage/` — Laravel runtime storage
- `legacy/` — isolated CodeIgniter/OpenCart-era source kept only as migration reference

There is no active `laravel/` sub-application. The Laravel application itself is the repository root.

## Database

The migration continues to use the existing MySQL database and existing `bh_*` tables. No replacement database is required.

## Converted areas

Student login, welcome, dashboard, profile, password, courses/session work, passbook, withdrawal, refer, payment-related history, medium, join point and logout are implemented with Laravel controllers and Blade views.

Public home, courses, registration, password reset, about, contact, privacy, terms and creator-zone are implemented.

Admin dashboard, login, users, students, referrals, finance, withdrawals, courses, sessions, permissions, settings, attendance, reports, point buy/sell, user finance and profile are implemented.

## Authentication

Student and admin portal routes use Laravel middleware aliases:

- `student.auth`
- `admin.auth`

Legacy password compatibility remains only where required for existing accounts; successful legacy passwords are upgraded to Laravel hashing.

## cPanel deployment

The cPanel document root should point to:

`/path/to/repository/public`

The server must use PHP 8.3+ and run Composer dependencies from the repository root.

Do not commit production `.env` values. Existing legacy database/SMTP credentials must be rotated before production use.
