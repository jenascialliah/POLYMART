# POLYMART portfolio deployment

The app ZIP contains only web files. Import schema.sql separately; never publish the original SQL export. Keep a backup of the original project. This is a demonstration, not a production store. Cart and orders are tab-local, editable demo data; no payments or fulfillment. Use fictional details only.

## XAMPP (Windows)
1. Extract the cleaned POLYMART folder into C:\xampp\htdocs\POLYMART. Start MySQL and Apache. Use PHP 8.2+ with mysqli enabled.
2. In phpMyAdmin create a new database named polymart_demo and import schema.sql. In SQL as local administrator, create a dedicated user with a strong unique password (replace the placeholder):
   CREATE USER 'polymart_app'@'localhost' IDENTIFIED BY 'REPLACE_WITH_UNIQUE_PASSWORD';
   GRANT SELECT, INSERT, UPDATE, DELETE ON polymart_demo.* TO 'polymart_app'@'localhost';
3. In C:\xampp\apache\conf\httpd.conf, outside any Directory block, add these directives (keep this file private):
   SetEnv DB_HOST localhost
   SetEnv DB_USER polymart_app
   SetEnv DB_PASSWORD "REPLACE_WITH_UNIQUE_PASSWORD"
   SetEnv DB_NAME polymart_demo
   Restart Apache. Open http://localhost/POLYMART/ . Do not expose XAMPP to the internet.
4. Register two fictional accounts and test the checklist below.

## Azure for Students
Check available student credit, regional quota and pricing in the portal before creating resources. MySQL and paid App Service plans can consume credits even when idle. Create a budget alert (not a hard spending cap). Prefer one instance and a small burstable database; delete resources when no longer needed.
1. Create resource group rg-polymart. Create Linux App Service with PHP 8.4 (or supported 8.3) and a unique name. Select a plan that supports VNet integration (e.g. Basic if offered). Enable HTTPS Only and minimum TLS 1.2 or higher. Disable FTP and SCM basic authentication if not required.
2. Create MySQL Flexible Server in the same region, with private networking and a delegated database subnet; integrate App Service with a separate subnet in the same VNet. Configure private DNS resolution. Keep public database access disabled. If your student quota prevents private networking, stop and review alternatives rather than opening the database to all Azure services.
3. From a trusted client with access to the private network, connect to MySQL using TLS with hostname verification. Create polymart_db, import schema.sql, then create a restricted application account:
   CREATE USER 'polymart_app'@'%' IDENTIFIED BY 'REPLACE_WITH_UNIQUE_PASSWORD' REQUIRE SSL;
   GRANT SELECT, INSERT, UPDATE, DELETE ON polymart_db.* TO 'polymart_app'@'%';
   The wildcard is limited by private network access; never use the administrator account in the app.
4. App Service > Environment variables: DB_HOST = server FQDN, DB_USER = polymart_app, DB_PASSWORD = unique secret (prefer Key Vault reference), DB_NAME = polymart_db, APP_ENV = production. DB_SSL_CA defaults to /etc/ssl/certs/ca-certificates.crt; verify that it contains the Azure MySQL trusted CA. Never disable certificate verification.
5. Sign in locally with Azure CLI (az login), select the student subscription, then run:
   az webapp deploy --resource-group rg-polymart --name YOUR_UNIQUE_APP_NAME --src-path app.zip --type zip
   App ZIP has index.php at its root. Open the HTTPS URL from the portal. If the PHP Linux runtime does not resolve index.php by default, configure its startup/web server according to the runtime documentation or use /index.php.
6. Keep one instance for file-based PHP sessions; verify session persistence on the chosen runtime. Enable diagnostic logs without logging request bodies or secrets. Review cost regularly.

## Acceptance checklist (must run before public sharing)
- Register, sign in, sign out, change password, update profile, upload a small PNG/JPEG, save and delete addresses.
- Use two accounts; attempt to fetch another email or delete the other account's address ID. The API must ignore supplied email and reject unowned deletion.
- Verify logged-out pages redirect and API requests return 401; POST without CSRF returns 403 when authenticated.
- Enter HTML-like text in address fields; it must display as text, not execute.
- Check cart, demo checkout, and purchase history in the same tab; logout clears tab storage.
- Verify HTTPS, Secure/HttpOnly/SameSite cookies, private DB access and TLS certificate validation.
- Add persistent IP/account rate limiting (e.g. gateway/WAF) before broad public exposure. Included throttling is session-only and can be bypassed by clearing cookies. CSP still permits inline scripts for legacy UI. No email verification, password reset, account deletion or global session revocation is implemented. Do not collect real personal data. Review third-party font/image requests and asset rights.

## Validation performed
PHP syntax checks, JavaScript syntax checks, HTTP smoke tests for landing page, protected-page redirect and CSRF rejection. No MySQL server/mysqli extension or Azure subscription was available in the test environment; full database, browser and cloud tests remain outstanding. No live deployment has been performed.
