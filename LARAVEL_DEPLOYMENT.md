# Web Haven Academy — Laravel

This repository runs the application from the Laravel project root.

## Production document root

Point the domain/subdomain document root to:

`public/`

Do not point the web server directly at `legacy/`.

The `legacy/` directory contains the previous CodeIgniter/OpenCart application for migration reference only and is not part of the Laravel runtime.

## Existing database

The Laravel application intentionally keeps the existing `bh_*` database tables. No new application database is required for this migration.

## cPanel deployment

1. Clone/check out the `laravel-migration` branch.
2. Run `composer install --no-dev --optimize-autoloader`.
3. Copy `.env.example` to `.env` and set the existing database credentials.
4. Generate an application key if one is not already configured.
5. Point the domain document root to `public/`.
6. Ensure `storage/` and `bootstrap/cache/` are writable.
7. Run `php artisan optimize`.
8. Run `php artisan storage:link` if public storage links are required.

Do not run destructive database migrations against the existing `bh_*` schema unless a specific migration has been reviewed first.
