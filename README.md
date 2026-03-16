# Laravel + MongoDB Query Performance Monitoring

This project shows how to build lightweight query performance monitoring for a Laravel app using MongoDB.

It captures MongoDB command-level metrics for each request and stores them in a `performance_logs` collection so you can analyze slow operations and route-level database behavior.

## What This Project Does

- Tracks MongoDB query duration per operation
- Captures operation type (`find`, `insert`, `update`, etc.)
- Captures target collection
- Captures request duration and route
- Flags slow queries using a configurable threshold in code
- Stores all metrics in MongoDB (`performance_logs`)

## Tech Stack

- PHP 8.2+
- Laravel 12
- `mongodb/laravel-mongodb`
- MongoDB Atlas or local MongoDB

## Local Setup

### 1. Clone And Install Dependencies

```bash
git clone <your-repo-url>
cd devrel-tutorial-customMiddlewareForQueryPerformance-laravelnews
composer install
npm install
```

### 2. Configure Environment

Create `.env` if needed:

```bash
cp .env.example .env
php artisan key:generate
```

Set MongoDB values in `.env`:

```env
DB_CONNECTION=mongodb
MONGODB_URI="your-mongodb-uri"
MONGODB_DATABASE="your-database-name"
```

### 3. Seed Test Data

```bash
php artisan db:seed
```

### 4. Run The App

```bash
php artisan serve
```

Visit:

- `http://127.0.0.1:8000/posts`

This triggers MongoDB queries and writes monitoring documents into `performance_logs`.

## Verify Monitoring Logs

Use Laravel Tinker:

```bash
php artisan tinker
```

Then run:

```php
App\Models\PerformanceLog::latest('created_at')->take(5)->get();
```

You should see fields like:

- `route`
- `collection`
- `operation`
- `duration_ms`
- `request_duration`
- `is_slow`
- `created_at`

## Read The Full Tutorial

For the full step-by-step implementation and architecture walkthrough, read the article:

- [Build custom middleware for query performance monitoring and optimization (Laravel News)](#)

## Support The Project

If this helped you, please give the repository a star. It helps others discover the project and supports future improvements.

## License

This project is open-source and available under the MIT License.
