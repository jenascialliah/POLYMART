# POLYMART — Guest portfolio demo

A campus marketplace UI built with PHP, HTML, CSS and JavaScript. No registration or database is required. Browse the sample catalog, search, add items to the cart, simulate checkout and view demo orders. All cart/order state is editable, tab-local browser sessionStorage, not real transactions. No real payments, deliveries, user accounts or personal data collection. Seller tools and external services are not implemented.

## Local testing (XAMPP)
1. Back up the previous POLYMART folder **outside htdocs**. Extract this ZIP so `C:\xampp\htdocs\POLYMART\index.php` exists. Do not merge over the old folder: removed login/database endpoints must not remain. Preserve the old `.git` folder separately if updating an existing repository.
2. Start Apache. MySQL is not required. Visit http://localhost/POLYMART/ or http://localhost/POLYMART/main_pm.php directly.
3. Browse Products, open a product, add to cart, checkout, place demo order, check My Purchases, reset demo. Test in a new private window. No DB variables are required. Old DBs and configuration remain private; do not publish them.

## GitHub and Azure
- Commit the clean tree including deletions; review `git status` and `git ls-files`. Keep backups, `.git`, secrets, and database dumps out of the deployed web root. Prior commits may contain obsolete files or credentials; review history, rotate any exposed secrets, and keep the repo private until reviewed.
- App Service for Linux with a supported PHP runtime is enough. No Azure MySQL server or VNet needed for this version. Select a free plan if offered and sufficient, otherwise review costs before creating anything. Enable HTTPS Only, TLS 1.2+, and disable FTP/basic publishing credentials if not needed.
- In Deployment Center connect the existing GitHub repo and main branch, use GitHub Actions with federated identity where supported. Deploy only web files from repository root (not `.git`, `.github`, README, backups or archives); do not include old login scripts. On Azure, use a fresh deployment or ensure stale files are deleted. Apache `.htaccess` is not honored by nginx; use a clean web root rather than relying on it. Test the HTTPS URL and verify removed endpoints return 404. Do not publish real personal data.

## Limitations
Static sample products; cart and orders only within the browser tab; no accounts, database, actual payment or real order service. Existing inline scripts require CSP unsafe-inline; external fonts/icons are optional dependencies. Check asset rights before public sharing. No live Azure deployment has been performed.
