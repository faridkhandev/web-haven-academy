# Laravel Migration Plan

## Current application

This repository is a CodeIgniter 3 application. The legacy application contains:
- `application/controllers` and nested student controllers
- `application/models`
- `application/views`
- `application/migrations` (8 legacy migrations)
- custom libraries/helpers/core classes
- a separate `weblogin` application with its own MVC structure
- legacy session-based student authentication

## Target

Migrate incrementally to Laravel 13 while keeping the existing MySQL database and URLs stable during the transition. Laravel 13 requires PHP 8.3+ and is the current major release. The migration should use Laravel's `routes/web.php`, controllers, Eloquent/query builder, Blade views, middleware and environment-based configuration.

## Phase 1 — foundation

1. Create an isolated Laravel application under the `laravel/` directory.
2. Keep the legacy CodeIgniter application untouched while Laravel modules are ported.
3. Connect Laravel to the existing MySQL database using environment variables.
4. Add a Laravel student model targeting the existing `bh_student` table.
5. Port student login and student welcome routes/controllers.
6. Replace the legacy MD5 password check with a compatibility check and re-hash successful logins using Laravel's password hashing.
7. Preserve the existing student session semantics initially; later migrate to Laravel authentication middleware.

## Phase 2 — student module

Port these controllers/views in this order:
- Dashboard
- Profile
- Password
- Ourcourse / Course
- Payment
- Passbook
- Refer
- Sellpoint / Sellpointlist
- Medium
- Withdrawal / Joinpoint
- Logout

## Phase 3 — public site

Port:
- Frontend
- About
- Courses
- Coursedetails
- Contact
- Register
- Forgot / Resetpassword
- Privacy
- Termsconditions
- Creatorzone / Facilities / Page / Block

## Phase 4 — admin

Port the webadmin controllers/views and replace the custom admin session flow with Laravel authentication, authorization and policies.

## Database strategy

Do **not** rewrite the production schema blindly. The existing database uses the `bh_` prefix and contains tables referenced directly by the application. First map the current schema, then add Laravel migrations only for controlled schema changes. Existing tables can be used directly by Eloquent during the transition.

## Security blockers

- Database credentials were committed in `weblogin/config.php`. These credentials must be rotated and moved to server environment variables before production deployment.
- The current student login uses MD5. Do not keep MD5 for new passwords; use Laravel's password hashing and re-hash legacy passwords after a successful compatibility login.
- Existing SQL contains string interpolation in several places. Ported code must use Eloquent/query-builder bindings instead.
- Existing sessions should be replaced progressively with Laravel session/auth middleware.

## First converted module

The first Laravel conversion in this branch is the student login/welcome flow. It intentionally targets the existing database so the migration can be tested without changing production data.
