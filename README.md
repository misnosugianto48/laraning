
# Laraning

Laravel E Learning. API Manajemen Kampus Simple

## Requirements

Pastikan sudah terinstall:

- PHP >= 8.2
- Composer >= 2.8
- PostgreSQL >= 17
- Node.js & NPM
- Git

Cek versi:

```bash
php -v
composer -v
node -v
npm -v
````

---

## Installation Guide

### Clone Repository

```bash
git clone https://github.com/username/nama-repository.git
cd nama-repository
```

---

### Install Dependency

```bash
composer install
```

---

### Setup Environment File

```bash
cp .env.example .env
```

Windows:

```bash
copy .env.example .env
```

---

### Generate Application Key

```bash
php artisan key:generate
```

---

### Setup Database

Buat database baru di PostgreSQL.

Lalu edit file `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migration:

```bash
php artisan migrate
```

### Setup Mail

Daftar di [Resend](https://resend.com/docs/send-with-laravel). Pada bagian api key create. atau ikuti langkah di dokumentasi

Lalu edit file `.env`:

```env
RESEND_API_KEY=
```

Jalankan migration:

```bash
php artisan migrate
```

Jalankan seed:

```bash
php artisan migrate --seed
```

---

### Jalankan Server

```bash
php artisan serve
```

---

### Test Endpoint

import file laraning.json yang ada di project ke dalam collection postman. Silahkan test endpoint

---

## Useful Commands

Clear cache:

```bash
php artisan optimize:clear
```

Rollback migration:

```bash
php artisan migrate:rollback
```

Reset migration:

```bash
php artisan migrate:fresh --seed
```

---

## Default Login

```php
Email: admin@laraning.com
Password: PasswordQwert
```

---

## Troubleshooting

error permission (Linux/Mac):

```bash
chmod -R 775 storage bootstrap/cache
```

vendor belum muncul:

```bash
composer install
```

error APP_KEY:

```bash
php artisan key:generate
```

storage belum sync:

```bash
php artisan storage:link
```

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
