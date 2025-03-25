# 📚 Lendflow Backend Assessment – NYT Best Sellers API

This project is a JSON API wrapper around the [New York Times Best Sellers History API](https://developer.nytimes.com/docs/books-product/1/routes/lists/best-sellers/history.json/get), built with Laravel.

It demonstrates clean API integration, request validation, caching, versioned routing, testing, and developer experience best practices.

---

## 🚀 Features

- ✅ Versioned API endpoint: `/api/v1/bestsellers`
- ✅ Query support: `author`, `title`, `isbn[]`, `offset`, `?cache=false`
- ✅ Laravel Form Request validation
- ✅ NYT API service layer with retry + caching
- ✅ JSON response formatted as a table
- ✅ Tests with mocked responses (no external dependency required)
- ✅ Telescope + optional Swagger/OpenAPI support

---

## 📦 Tech Stack

- Laravel 10+
- NYT Books API
- Laravel HTTP Client
- PHPUnit / Pest for testing
- Laravel Cache (file, Redis, etc.)
- Telescope (for observability)

---

## 📂 Installation

```bash
git clone https://github.com/marvindinaku/lendflow-api.git
cd lendflow-api

cp .env.example .env
composer install
php artisan key:generate
```

## Example Request

```
GET /api/v1/bestsellers?author=Grisham&cache=false
```
