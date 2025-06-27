# Curlsy

Curlsy is an online store focused on premium hair care products. It is built with [Laravel](https://laravel.com), [Livewire](https://livewire.laravel.com) and [Vite](https://vitejs.dev). The project provides a simple e‑commerce foundation with a focus on Ukrainian language support and a pleasant development experience.

## Setup

1. Clone the repository
   ```bash
   git clone <repository-url>
   cd curlsy
   ```
2. Install PHP dependencies
   ```bash
   composer install
   ```
3. Install JavaScript dependencies
   ```bash
   npm install
   ```
4. Copy the example environment file and adjust the values for your local database
   ```bash
   cp .env.example .env
   # edit .env to match your environment
   ```
5. Generate the application key
   ```bash
   php artisan key:generate
   ```
6. Create a database (for quick testing you can use the provided SQLite file)
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```
7. Build frontend assets
   ```bash
   npm run build    # or `npm run dev` while developing
   ```

## Local development

To start a local development environment with the Laravel server, queue worker, logs and Vite all running, use the Composer script:

```bash
composer dev
```

Alternatively you can start each process individually:

```bash
php artisan serve
php artisan queue:listen --tries=1
npm run dev
```

## Testing

Automated tests can be executed with:

```bash
composer test
```
## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
