# EPICURE PIZZA & FAST FOOD

Laravel + MySQL source package for a shared-hosting restaurant ordering and operations application. It does not use Node as a production server, a hosted backend, or a payment gateway.

## Current implementation status

Implemented in this source tree: public home and menu pages; customer registration and shared role-select login; server-checked role middleware; session cart with server-side price/availability checks; transactional order creation and item snapshots; customer-owned order detail and history; status transition checks and history; reservation requests and admin review; admin/staff order queue; category and product creation; customer activation controls; private payment evidence uploads and admin manual review; audit records; basic database-backed operational summaries; initial owner setup gated by a temporary environment secret; responsive Blade/CSS interface.

This package is an implementation baseline, **not yet verified as production-complete**. Before live use, the outstanding work includes: Admin/Staff account management and granular permission configuration; product/category editing and safe deactivation workflows; account profile/security and verified password-reset flows; editable restaurant contact, hours, policies and payment instructions; contact form; reservation-hours/capacity validation; report date filters and safe CSV exports; two-factor authentication; protected backup/export and tested restoration workflow; broader feature/security tests; mail setup; and deployment verification on the actual PK Hosting account. Payment receipts require independent verification by the restaurant. No payment gateway is present.

No real address, telephone, hours, bank/wallet account, menu, product photography, business registration, or SMTP credentials were supplied, so they are not invented here. Product imagery is optional; the interface uses a branded placeholder until the owner uploads assets.

## Requirements

- PHP 8.3+ and the Laravel 13 required extensions, including PDO MySQL, OpenSSL, Fileinfo, Mbstring, Ctype, XML and cURL.
- MySQL supported by Laravel 13.
- Composer on a deployment/build machine. Node is not required by this project; styles are already plain CSS.
- HTTPS for production and writable `storage` and `bootstrap/cache` directories.

Check the hosting plan's PHP version/extensions, ability to run Composer or accept a prebuilt `vendor` package, document-root controls, MySQL limits, and cron availability with PK Hosting before deployment. Laravel 13 requires PHP 8.3; do not deploy if the plan does not meet that requirement.

## Local installation

```sh
composer install
cp .env.example .env
php artisan key:generate
# Set MySQL credentials in .env and ensure APP_DEBUG=false
php artisan migrate
php artisan serve
```

Create the first owner with a long random temporary `EPICURE_SETUP_SECRET` (at least 32 characters) configured only in the server environment. Visit `/owner-setup` over HTTPS, create the owner, then remove the secret from the environment and clear Laravel's cached configuration. The route returns 404 after a Super Admin exists. No owner password or setup secret is seeded or committed.

## PK Hosting deployment outline

1. Confirm PHP 8.3+ and required extensions on the actual account. Create a MySQL database and least-privilege database user in the hosting panel.
2. On a trusted build machine, install production dependencies with `composer install --no-dev --prefer-dist --optimize-autoloader`. Keep `.env`, private uploads, logs, and database exports out of GitHub.
3. Upload the project and `vendor` outside the public document root where possible. Point the domain document root to this project's `public` directory. If the panel cannot point there, ask the host for a secure Laravel shared-hosting layout; do not move application source, `.env`, storage, or vendor into a publicly served directory.
4. Set production environment values privately (`APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://...`, MySQL credentials, secure sessions). Generate `APP_KEY` once and retain it securely. Configure SMTP only after real SMTP credentials are supplied.
5. Ensure `storage` and `bootstrap/cache` are writable by the PHP account. Run `php artisan storage:link` for public product images, then `php artisan migrate --force` from the application root only after a database backup. Private payment evidence remains on the non-public local disk. Do not run the development test suite against production data.
6. Enable hosting SSL, then verify the home/menu, registration/login, all four role boundaries, order placement and tracking, private evidence download access, reservation review, and server logs.
7. PK Hosting was stated by the requester to retain daily backups for one day. Treat those as short-term recovery only. Maintain independent encrypted backups in a separate location and periodically test restoration on a separate database. This code does not automate off-site backups.

If SSH/Composer is unavailable, build the release on a trusted computer and upload the complete production dependency tree through the hosting-supported method. Do not commit `vendor` by default and do not upload `.env` to GitHub.

## GitHub

Create a private GitHub repository, review `git status`, confirm `.env`, `vendor`, uploaded evidence, and logs are ignored, then commit and push the source. Configure production secrets only in the hosting account. Never paste database or setup secrets into repository files or issues.

## Tests and verification

Feature tests are included for public menu access, role boundaries, and role selection during login. Run `composer test` only after adding that script, or use `vendor/bin/phpunit`. Additional critical order, upload ownership, reservation and status-transition tests still need to be added. This delivery environment had no PHP or Composer executable and could not retrieve dependencies, so migrations, Blade rendering, and tests have **not** been run here. No deployment or live account has been verified.
