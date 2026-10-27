# Clinic Management Software

A custom Laravel-based clinic management system designed to help a clinic organize patients, appointments, financial records, and basic administration from a single dashboard.

This project is built around operational workflows that a small clinic would use every day: registering patients, selecting appointment times, tracking billing activity, and managing practice settings for both staff and administrators.

## Why this project exists

The application combines several clinic workflows into one system:

- patient registration and profile management
- mobile and contact tracking for patients
- appointment scheduling by date and time
- financial transaction recording and reporting
- admin/user access management
- clinic configuration such as service names, doctor list, and practice settings

It is not a generic starter Laravel app; it is a customized operational tool built for clinic usage.

## Main features

### Patient management
- Add and edit patient records
- Search patients by mobile number, national ID, first name, last name, or ID
- Track patient demographics and medical history
- Maintain last appointment dates and related patient metadata

### Appointment management
- Schedule appointments for a selected patient and date
- Choose a time slot based on configured clinic gap settings
- View all appointments for a specific date
- Display time availability with visual status states
- Support appointment deletion and rebooking workflows

### Financial management
- Record incoming and outgoing financial transactions
- Link transactions to patients and appointment records
- Track transaction types and titles
- Generate date-based financial reports
- Manage service types and financial settings for the clinic

### Administration and settings
- User login and authentication
- Change password workflow
- Clinic doctor configuration
- Service list configuration for financial flows
- Practice-wide menu settings and appointment time spacing
- Admin-only settings and user-level restriction middleware

## Tech stack

- PHP
- Laravel 8
- MySQL
- Blade templates
- Bootstrap-based admin UI
- Laravel UI authentication
- Laravel Mix / npm for frontend asset compilation

## High-level architecture

This project follows the standard Laravel MVC pattern with custom business modules:

- Routes are defined in `routes/web.php`
- Controllers live in `app/Http/Controllers`
- Eloquent models live in `app/Models`
- Views live in `resources/views`
- Middleware controls access and user/admin restrictions
- Frontend/admin assets are stored in `public/back`

## Core application modules

### 1. Patient module
Files and logic are centered around patient records and searches.

- `app/Http/Controllers/PatientsGeneralInfoController.php`
- `app/Models/patients_general_info.php`
- `resources/views/back/submit_new_patient_form.php`
- `resources/views/back/show_patient_search_from.php`

This module is responsible for creating patient records, editing them, preventing duplicate mobile numbers, and searching records.

### 2. Appointment module
Files and logic focus on appointment selection, listing, and booking.

- `app/Http/Controllers/PatientsAppointmentController.php`
- `app/Models/patients_appointment.php`
- `resources/views/back/show_form_of_appointments_on_specific_date.php`
- `resources/views/back/show_patient_time_appointment_table.php`

This module determines available appointment slots based on date and configured gap interval, while also showing whether a time is free, busy, or heavily loaded.

### 3. Financial module
Files and logic handle billing and reporting.

- `app/Http/Controllers/FinancialTransactionController.php`
- `app/Models/financial_transaction.php`
- `resources/views/back/show_submit_financial_transaction_form.php`
- `resources/views/back/show_financial_transaction_reporting_form.php`

This module records transactions, filters reports by date and service/doctor, and supports financial tracking for the clinic.

### 4. User and settings module
Files and logic manage account settings and admin control.

- `app/Http/Controllers/UserController.php`
- `app/Models/User.php`
- `resources/views/back/show_main_settings_of_software_form.php`
- `resources/views/back/show_change_password_form.php`

This module includes practice configuration like doctors, payment service names, gap times between appointments, and general software settings.

## Project structure

```text
app/
  Http/
    Controllers/        Patient, appointment, financial, and auth logic
    Middleware/          User/admin access validation and request flow checks
  Models/               Eloquent models for the clinic domain

config/                 Laravel configuration

database/
  migrations/            Application schema for patients, appointments, transactions, users
  seeders/               Seeder support for initial data

public/
  back/                  Custom admin dashboard assets and bundled frontend components

resources/
  views/                 Blade templates for login and dashboard pages
  js/                    JavaScript frontend code
  sass/                  Frontend styling source files

routes/
  web.php                Main route definitions for the app

.env.example            Environment template
composer.json           PHP dependency definition
package.json            Frontend package definition and scripts
phpunit.xml             PHPUnit configuration
README.md               Project documentation
```

## Database model summary

The application uses SQL tables created through Laravel migrations. The most relevant data domains are:

- `users` — login users, account metadata, practice configuration, and access variables
- `patients_general_infos` — patient details including first/last name, mobile, address, medical background, etc.
- `patients_appointments` — appointment date, time, doctor, service, status, and patient linkage
- `financial_transactions` — transaction type, amount, title, date, and patient linkage

The project also includes standard Laravel table migrations such as password resets, failed jobs, and personal access tokens.

## Authentication and authorization

The app uses Laravel's built-in authentication stack with custom middleware-defined restrictions.

Key files:

- `app/Http/Middleware/middleware_check_page_access_for_user_level.php`
- `app/Http/Middleware/middleware_check_page_access_for_admin_level.php`
- `resources/views/auth/login.blade.php`

The root route redirects to the login screen:

```php
Route::get('/', function () {
    return view('auth.login');
});
```

The app also calls:

```php
Auth::routes();
```

This means the project uses default Laravel auth endpoints for login and related flows, while custom middleware continues to restrict access to protected pages.

## Installation

### Prerequisites

- PHP 7.3+ / Laravel 8 compatible runtime
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

### 4. Set up the environment file

```bash
cp .env.example .env
```

Then configure database values inside `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinic_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate the app key

```bash
php artisan key:generate
```

### 6. Run migrations

```bash
php artisan migrate
```

### 7. Build frontend assets

```bash
npm run dev
```

### 8. Start the app

```bash
php artisan serve
```

Then open:

```text
http://localhost:8000
```

## Default login flow

The application starts at the login page and expects a valid Laravel user. If you are using a fresh setup, create a user using the regular Laravel auth flow or seed the user table if your database was prepared for it.

## Operational behavior summary

This app behaves like a practical clinic dashboard rather than a generic CRUD project:

- A patient gets registered with contact and clinical data
- An appointment is scheduled for a date and time
- The system checks for availability based on time slots and preconfigured delay between appointments
- Financial transactions are created with a selected patient and payment title/amount
- Reports can be filtered across ranges and service types
- Admin users manage settings such as doctors, services, and operational defaults

## Important notes

- The project is a custom internal management app rather than an open-source SaaS product template.
- The admin dashboard uses bundled static assets under `public/back` and appears to include a custom theme or legacy UI components.
- Several custom identifiers and class names are written in snake_case to match the original project structure.
- The codebase contains some older Laravel conventions and custom implementation patterns that reflect a research/project prototype style rather than a production-ready modern app skeleton.

## License

This repository does not currently document a specific project license in the README. Before commercial deployment or redistribution, confirm the intended license and whether any bundled frontend assets in `public/back` have their own licensing terms.

## Contribution

Contributions are welcome for improvements in:

- patient workflow logic
- appointment handling and validation
- financial reporting and transaction integrity
- user/admin access rules
- dashboard UX and usability
- code modernization and maintainability

If you want to contribute, open a pull request or contact the repository maintainer.
