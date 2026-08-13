# Smart University Event Management System

A presentation-ready university mini project that demonstrates why Laravel and Node.js are useful together.

## Technology roles

- **Laravel 13:** MVC, authentication, role middleware, validation, Eloquent ORM, event CRUD and registrations.
- **MySQL:** users, events, registrations and announcements.
- **Node.js + Socket.IO:** instant announcement delivery without page refresh.
- **Blade + CSS:** responsive student and administrator interface.

## Main features

1. Student registration, login and logout
2. Administrator role and protected routes
3. Event search and event CRUD
4. Student event registration
5. Duplicate registration prevention at application and database levels
6. Capacity checking inside a database transaction
7. Real-time announcements using Socket.IO
8. Seeded presentation accounts and sample events

## Requirements

- PHP 8.3 or newer
- Composer
- MySQL / XAMPP
- Node.js 22 or newer

## Setup

### 1. Database

Create a MySQL database named `smart_university_events`.

### 2. Laravel application

```bash
cd laravel-app
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

On macOS/Linux, replace `copy` with `cp`. Open `http://127.0.0.1:8000`.

### 3. Node.js notification server

Open a second terminal:

```bash
cd notification-server
npm install
copy .env.example .env
npm start
```

The notification server runs at `http://localhost:3000`.

## Demo accounts

- Administrator: `admin@unievent.test` / `admin123`
- Student: `student@unievent.test` / `student123`

## Three-minute presentation demo

1. Log in as the student and register for an event.
2. Click Register again to demonstrate duplicate prevention.
3. Open a second browser and log in as the administrator.
4. Create an event, then broadcast an announcement.
5. Show the announcement appearing immediately in the student browser.
6. Briefly show `routes/web.php`, `RegistrationController.php` and `server.js`.

## Important learning points

- Laravel receives a request through a route, sends it to a controller and uses an Eloquent model to access MySQL.
- Middleware protects administrator routes.
- Validation prevents invalid input.
- The unique database key prevents duplicate registrations even if two requests arrive together.
- A transaction and row lock protect capacity from concurrent registrations.
- Node.js keeps Socket.IO connections open and broadcasts an event to connected browsers.
