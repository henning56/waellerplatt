#!/usr/bin/env bash
set -euo pipefail

# Prepare a deployment zip for shared hosting (no composer on host).
# Run this locally (or in a build environment) and upload the generated
# `build/hermann-deploy.zip` to your shared host, then extract into the
# webroot (document root should point to the `public/` directory).

ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT_DIR"

echo "[deploy] Preparing production build in $ROOT_DIR"

echo "[deploy] Fixing vendor ownership (if needed) and installing PHP dependencies (no-dev)..."
# Ensure vendor files are writable by current user so composer can remove dev packages
sudo chown -R $(id -u):$(id -g) vendor || true
# Ensure vendor is in a consistent state locally. We avoid removing dev packages here
# because on some systems partial uninstalls can leave autoload references broken.
composer install --prefer-dist --no-interaction --optimize-autoloader

echo "[deploy] Installing node dependencies and building assets..."
npm ci
npm run build

echo "[deploy] Creating storage link (may fail on some systems; harmless)..."
php artisan storage:link || true

echo "[deploy] Caching config/routes/views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "[deploy] Ensuring APP_KEY exists in .env (will generate if missing)..."
if [ -f .env ]; then
    if ! grep -q '^APP_KEY=' .env; then
        KEY=$(php artisan key:generate --show)
        echo "APP_KEY=$KEY" >> .env
        echo "[deploy] APP_KEY appended to .env"
    fi
else
    echo "[deploy] Warning: .env not found. Copy .env.example to .env and set values before uploading."
fi

echo "[deploy] Creating zip package (build/hermann-deploy.zip) ..."
mkdir -p build
rm -f build/hermann-deploy.zip

# Exclude development files and local build artifacts that are not needed on host
zip -r build/hermann-deploy.zip . \
    -x "node_modules/*" "tests/*" \
    ".git/*" ".github/*" "build/*" "docker/*" "compose.yaml" "scripts/*" \
    "*.log" "*.sqlite" ".env" "vendor/*/.git/*"

echo "[deploy] Package ready: build/hermann-deploy.zip"
echo "[deploy] Upload the zip to your shared host (SFTP/FTP), extract it and set the webroot to the 'public' folder."

cat <<'INSTR'
Upload & host steps (summary):

1) Upload `build/hermann-deploy.zip` to your hosting account (e.g. via SFTP).
2) Extract the zip into a folder that your host serves. Configure the host's document-root to point to the extracted `public/` folder.
3) Ensure `storage/` and `bootstrap/cache` are writable by the webserver. Typical permissions:
   chmod -R 775 storage bootstrap/cache
   chmod -R 644 public/index.php public/.htaccess

4) Create a MySQL database in the hosting control panel and import your SQL dump (or run migrations if SSH with PHP CLI is available):
   - Import via phpMyAdmin the SQL export of your DB (recommended if you can't run artisan migrate on host).
   - Or via SSH, if `php` CLI works: `php artisan migrate --force` (after updating `.env`).

5) Edit `.env` on the host: set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://your-domain.example`, set DB_* and mail settings and `APP_KEY` (copy the key from local `.env`).

6) Cron / Scheduler: if your host provides a Scheduler, add a cron job:
   * * * * * cd /path/to/app && /usr/bin/php artisan schedule:run >> /dev/null 2>&1

Notes and caveats:
- If the hosting account does NOT provide SSH/PHP-CLI, you must import the DB via phpMyAdmin and cannot run artisan commands on the server. Generate APP_KEY and run `php artisan` commands locally before zipping.
- If symlinks are not allowed on the host, create `public/storage` and copy the contents of `storage/app/public` into it, or configure the `public` disk to point to a suitable path.
- Make sure the webserver's document root points to the `public/` directory.

INSTR

echo "[deploy] Done."
