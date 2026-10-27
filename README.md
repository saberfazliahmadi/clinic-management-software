# Clinic Management Software

A custom Laravel-based clinic management system for handling patient records, appointments, financial tasks, and clinic administration from a single web dashboard.

This project is designed to support the day-to-day workflow of a clinic with a practical interface for staff and administrators. It centralizes patient data, appointment scheduling, and financial tracking into one application.

## Overview

Clinic Management Software is built on Laravel 8 and uses the default MVC structure with custom business logic and a Bootstrap-based admin dashboard. The app includes role-aware access control and a set of operational workflows tailored to clinic management.

## Features

### Patient management
- Create and update patient profiles
- View patient demographic details
- Search for patients by relevant criteria
- Store medical background and related patient information

### Appointment management
- Schedule appointments by date and time
- View appointment tables for specific days
- Manage appointment status and cancellations
- Link appointments to patient records

### Financial management
- Record financial transactions
- Track revenue and payment-related records
- Associate transactions with patients and appointments
- Review transaction reporting and financial settings

### Administration
- User login and authentication
- Change password support
- Admin-only management screens
- Software settings and financial configuration controls

## Tech Stack

- PHP
- Laravel 8
- MySQL
- Blade templates
- Bootstrap
- Laravel UI authentication
- npm / Laravel Mix for frontend asset compilation

## Project Structure

```text
app/
  Http/
    Controllers/         Application logic for patients, appointments, finances, and auth
    Middleware/           Access control and request flow checks
  Models/                Eloquent models for the main business entities

config/                  Laravel configuration files

database/
  migrations/             Database schema for the application
  seeders/                Seeding support for initial data

public/
  back/                   Custom admin dashboard frontend and bundled assets

resources/
  views/                  Blade templates for auth and backend screens
  js/                     JavaScript frontend files
  sass/                   Sass stylesheets

routes/
  web.php                 Main application routes

.env.example             Example environment file
composer.json            PHP dependencies
package.json             Frontend build scripts
phpunit.xml              PHPUnit configuration
README.md                Project documentation
```

## Main Models

The application centers around these model classes:

- `app/Models/User.php` — user authentication and admin/user profile information
- `app/Models/patients_general_info.php` — patient personal and medical details
- `app/Models/patients_appointment.php` — appointment scheduling and status
- `app/Models/financial_transaction.php` — billing and financial records

## Core Workflow

The application follows a standard Laravel flow:

1. Requests enter through `routes/web.php`
2. Controllers handle logic for patient, appointment, or financial operations
3. Eloquent models interact with the database
4. Blade views render the dashboard and forms
5. Middleware enforces access rules for user and admin functionality

## Installation

### Prerequisites

- PHP 7.3+ or compatible Laravel 8 environment
- Composer
- Node.js and npm
- MySQL database

### Clone the repository

```bash
git clone https://github.com/saberfazliahmadi/clinic-management-software.git
cd clinic-management-software
```

### Install dependencies

```bash
composer install
npm install
```

### Configure environment

```bash
cp .env.example .env
```

Update the database values in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### Generate application key

```bash
php artisan key:generate
```

### Run migrations

```bash
php artisan migrate
```

### Build frontend assets

```bash
npm run dev
```

### Start the app

```bash
php artisan serve
```

Then open:

```text
http://localhost:8000
```

## Authentication and Access Control

The app uses Laravel's built-in authentication system. Login functionality is provided through standard auth routes and the login view located in:

- `resources/views/auth/login.blade.php`

Access is controlled with custom middleware, including:

- `app/Http/Middleware/middleware_check_page_access_for_user_level.php`
- `app/Http/Middleware/middleware_check_page_access_for_admin_level.php`

These middleware checks protect user-specific and admin-only sections of the system.

## Important Notes

- This repository is a custom clinic operations system rather than a generic Laravel starter project.
- The app includes a bundled admin dashboard theme under `public/back`.
- The codebase contains a mix of standard Laravel conventions and custom naming styles, such as snake_case model names and custom controller methods.
- Some assets appear to be derived from bundled frontend templates or legacy static admin UI resources.

## License

This repository does not currently declare a project-specific license in the README. Before commercial use or public distribution, confirm the correct licensing terms for the project and any bundled assets.

## Contribution

Contributions are welcome for improvements related to:

- patient workflow efficiency
- appointment handling
- financial reporting and tracking
- admin and user access control
- UI/UX improvements
- code cleanup and modernization

If you would like to contribute, open a pull request or contact the repo maintainer.
