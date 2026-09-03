# Turtle Maarks — new frontend integrated into Laravel

The old frontend is fully removed and replaced with the 2026 design.

## Removed
- `resources/views/{site,frontend,auth,customer,partials}` (old), `layouts/app.blade.php`
- root `frontend/` folder, root `index.html`, old `public/frontend-assets`
- Admin panel, emails, error pages: untouched.

## Added
- `resources/views/site/**` — 40+ Blade pages, `layouts/app`, `partials/{header,footer,flash,product-card,product-grid,account-sidebar}`
- `public/frontend-assets/{css,images,js}` — new design assets
- `app/Support/TmCatalog.php` — maps DB products into the array shape the new cards/filters/compare expect
- `app/helpers.php` — `SITE_*` constants, `tm_asset()`, `inr()`, `js_str()`, `tm_page_url()`
- `routes/web.php` — rewritten frontend routes + 301 redirects for old SEO URLs

## Deploy steps
1. `composer dump-autoload`
2. `php artisan storage:link`
3. `php artisan migrate --force` then `php artisan db:seed --force` (seeds default clinic hours)
4. `php artisan config:clear && php artisan view:clear && php artisan cache:clear`
5. Confirm `.env` `APP_URL` / `ASSET_URL` point at your domain (ASSET_URL must include `/public` on shared hosting).

## Notes
- The product catalogue is cached 10 minutes. After bulk product edits run
  `php artisan cache:clear` or call `App\Support\TmCatalog::flushCache()`.
- Cart and wishlist are now server-backed (DB), not localStorage.
- Brand/contact details live in `app/helpers.php` (`SITE_PHONE`, `SITE_ADDRESS`, etc.).
- Card markup exists twice on purpose: `partials/product-card.blade.php` (server)
  and `products.js` `renderCard()` (live re-render). Change both together.
