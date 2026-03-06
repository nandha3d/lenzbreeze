# Hostinger Deployment Guide – Lenz Breeze

## Step 1 — Prepare files locally

```bash
npm run build          # compiles CSS/JS into /public/build
```

> Then zip everything **except**: `.git/`, `node_modules/`, `storage/app/`, `storage/logs/`, `.env`

---

## Step 2 — Upload to Hostinger

Upload your zip via **Hostinger File Manager** → extract into `public_html/` (or your subdomain folder).

---

## Step 3 — Create `.env` on the server

In Hostinger File Manager, create a new `.env` file in the project root with this exact content:

```env
APP_NAME="Lenz Breeze"
APP_ENV=production
APP_KEY=base64:EWBl8fd/wzVGtvAcm8VTRTm8KcXKm9GX0IbP5Ri3YwA=
APP_DEBUG=false
APP_URL=https://lenzbreeze.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u362580417_lenzbreeze
DB_USERNAME=u362580417_lenzbreeze
DB_PASSWORD=LenzBreeze@123

SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=local

MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@lenzbreeze.com"
MAIL_FROM_NAME="Lenz Breeze"

VITE_APP_NAME="Lenz Breeze"
```

---

## Step 4 — Run migrations via Hostinger Terminal

In **Hostinger hPanel → Advanced → SSH / Terminal**:

```bash
cd ~/public_html          # adjust path to your project
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
```

This creates ALL tables on MySQL — including `qr_codes`.

---

## Step 5 — (Optional) Import local data

If you created QR codes or other data locally that you want on the live site:

**Locally**, run:
```bash
php sqlite_to_mysql_export.php
```

This creates `export_for_hostinger.sql`. Then:
1. Open **Hostinger hPanel → Databases → phpMyAdmin**
2. Select database `u362580417_lenzbreeze`
3. Click **Import** tab → upload `export_for_hostinger.sql` → Go

---

## Step 6 — Verify

Visit `https://lenzbreeze.com/admin` → log in → click **QR Codes** in sidebar.
All QR codes render live in the browser — no images stored, nothing lost.

---

## Local development (unchanged)

Your local `.env` stays as **SQLite** — fast, zero setup, no MySQL needed locally.
