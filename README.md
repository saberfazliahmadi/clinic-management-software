# Clinic Management Software

Clinic Management Software is a custom Laravel-based web application built to help a clinic manage patients, appointments, financial records, and administrative settings from a single dashboard.

The system is designed for day-to-day clinic operations, allowing staff to register patients, schedule appointments, track payments, and manage core software settings while keeping the interface simple and practical.

## Tech Stack

- PHP
- Laravel 8
- MySQL
- Blade templating
- Bootstrap-based admin UI
- Laravel UI authentication

## Project Overview

This repository is not a generic Laravel starter app. It is a customized clinic operations platform created around a small set of core business entities:

- Patients
- Appointments
- Financial transactions
- Users and settings

The project structure follows the standard Laravel architecture, with route definitions in `routes/web.php`, Eloquent models in `app/Models`, controllers in `app/Http/Controllers`, and Blade views in `resources/views`.

A custom admin-themed frontend is included in `public/back`, giving the app a dashboard-style UI for clinic management tasks.

## Core Features

### Patient Management
- Add new patient records
- Update existing patient information
- Search patient data
- Manage patient demographic and medical details

### Appointment Scheduling
- View appointment slots by date
- Schedule patient visits by time
- Review appointment status
- Delete or cancel appointments when needed

### Financial Management
- Record incoming or outgoing financial transactions
- Associate transactions with patients and appointments
- View financial tracking and reporting screens
- Manage receiving-money settings

### Admin and User Access
- Login and authentication via Laravel auth system
- Middleware-based access control
- User-level and admin-level permission separation
- Password change support

## Repository Structure

```text
app/
  Http/
    Controllers/        Main app logic for patients, appointments, finances, and auth
    Middleware/          Access control and request handling
  Models/               Eloquent models for clinic data

config/                 Laravel configuration files

database/
  migrations/            Database schema for users, patient data, appointments, and finances
  seeders/               Seed data support

public/
  back/                  Custom admin dashboard theme and frontend assets

resources/
  views/                 Blade templates for login and dashboard screens
  js/                    Frontend JavaScript
  sass/                  Styling sources

routes/
  web.php                Main application routes

.env.example            Example env configuration
composer.json           PHP package dependencies
package.json            Frontend dependencies and scripts
phpunit.xml             PHPUnit configuration
README.md               Project documentation
```

## Main Models

The project uses several key Eloquent models:

- `app/Models/User.php` — authentication and application user information
- `app/Models/patients_general_info.php` — patient personal and medical details
- `app/Models/patients_appointment.php` — appointment records and scheduling
- `app/Models/financial_transaction.php` — financial transactions and billing data

## Routing Overview

The application routes are defined in `routes/web.php` and cover:

- login and auth pages
- patient creation/edit/search
- appointment viewing and management
- financial reporting and transaction handling
- system settings and password change screens
- admin-only sections protected by middleware

## Authentication and Access Control

This application uses Laravel's built-in authentication system and custom middleware for role-based access:

- `app/Http/Middleware/middleware_check_page_access_for_user_level.php`
- `app/Http/Middleware/middleware_check_page_access_for_admin_level.php`

These middleware checks control which pages are visible or usable based on user access level.

## Installation

### Prerequisites

- PHP 7.3 or newer (project is compatible with Laravel 8)
- Composer
- Node.js and npm
- MySQL database

### 1. Clone the repository

```bash
git clone https://github.com/saberfazliahmadi/clinic-management-software.git
cd clinic-management-software
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install frontend dependencies

```bash
npm install
```

### 4. Create your environment file

```bash
cp .env.example .env
```

Then update the database settings in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 5. Generate the Laravel app key

```bash
php artisan key:generate
```

### 6. Run the database migrations

```bash
php artisan migrate
```

### 7. Build frontend assets

```bash
npm run dev
```

### 8. Start the application

```bash
php artisan serve
```

Then open:

```text
http://localhost:8000
```

## Login

The login page is stored in:

- `resources/views/auth/login.blade.php`

The project also uses Laravel's generated auth routes via:

```php
Auth::routes();
```

## Notes

- This project is a custom clinic operations dashboard rather than a generic starter template.
- It includes a bundled admin panel frontend under `public/back`.
- Many model and controller names use custom snake_case naming conventions, which reflect the project's original implementation style.
- Some parts of the project appear to be based on a legacy admin template or custom dashboard assets bundled into the repository.

## License

The project does not currently document a distinct custom license in the README. If you intend to distribute or commercialize this software, confirm the final licensing terms before publishing or deploying it externally.

## Contribution

Contributions are welcome for improvements related to:

- patient workflow management
- appointment logic
- financial reporting
- UI and dashboard usability
- access control and security
- code cleanup and modernization

If you want to contribute, open a pull request or contact the repository maintainer.
