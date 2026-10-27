# Clinic Management Software

A custom Laravel-based clinic management system built to manage patient records, appointment scheduling, financial transactions, and basic clinic administration from a single dashboard.

This project is designed around the day-to-day workflow of a clinic: registering patients, assigning appointment slots, tracking payments, and configuring practice settings for both staff and administrators.

## Project summary

Clinic Management Software is a custom patient and operations management application for a healthcare clinic. It uses Laravel 8 and follows the standard MVC structure while adding custom business workflows tailored to a clinic environment.

The core features revolve around:

- patient registration and detailed patient information records
- appointment booking by date and time
- financial tracking and transaction reporting
- user/admin access control and settings management
- clinic-specific configuration such as doctors, service pricing, and scheduling intervals

## What this application does

### Patient management
- Register new patients with demographic and medical information
- Edit and update patient records
- Prevent duplicate mobile numbers within a clinic context
- Search patients by phone, national ID, first name, last name, or patient ID
- Keep track of the patient’s last appointment and medical history

### Appointment management
- Select a patient and assign an appointment date
- Show available time slots by configured clinic intervals
- Display appointment availability for a given day
- Link each appointment to a doctor and service type when configured
- Cancel or remove appointments when needed

### Financial management
- Record incoming and outgoing financial transactions
- Associate transactions with patient records
- Track service-specific financial data
- Generate filtered reports for financial activity over time
- Support clinic service pricing configuration

### Administration and settings
- Login and account authentication
- Change-password functionality
- Manage clinic doctor names
- Configure service types and financial categories
- Set appointment spacing between bookings
- Manage general clinic software settings
- Restrict content to admin or user-level access

## Tech stack

- PHP
- Laravel 8
- MySQL
- Blade templates
- Bootstrap-based admin interface
- Laravel UI authentication
- npm + Laravel Mix for frontend asset compilation

## Project structure

```text
app/
  Http/
    Controllers/        Controllers for patient, appointment, financial, and user workflows
    Middleware/          Access control and restricted-page logic
  Models/               Eloquent models for core entities

config/                 Laravel application configuration

database/
  migrations/            Tables for users, patients, appointments, and transactions
  seeders/               Seed data support

public/
  back/                  Custom admin dashboard theme and frontend assets

resources/
  views/                 Blade templates for auth and dashboard screens
  js/                    JavaScript files
  sass/                  SCSS styling sources

routes/
  web.php                Main application routes

.env.example            Example environment file
composer.json           PHP dependencies
package.json            Frontend dependencies and scripts
phpunit.xml             PHPUnit configuration
README.md               Project documentation
```

## Core modules

### 1. Patient module
Primary files:

- `app/Http/Controllers/PatientsGeneralInfoController.php`
- `app/Models/patients_general_info.php`
- `resources/views/back/submit_new_patient_form.php`
- `resources/views/back/show_patient_search_from.php`

This module manages patient creation, updates, validation, duplicate checking, and searches. It also tracks last appointment details for each patient.

### 2. Appointment module
Primary files:

- `app/Http/Controllers/PatientsAppointmentController.php`
- `app/Models/patients_appointment.php`
- `resources/views/back/show_form_of_appointments_on_specific_date.php`
- `resources/views/back/show_patient_time_appointment_table.php`

This module builds a clinic scheduling workflow. It calculates available time slots from the configured appointment gap, lists appointments on a selected date, and associates them with patient records and doctor/service information.

### 3. Financial module
Primary files:

- `app/Http/Controllers/FinancialTransactionController.php`
- `app/Models/financial_transaction.php`
- `resources/views/back/show_submit_financial_transaction_form.php`
- `resources/views/back/show_financial_transaction_reporting_form.php`

This module records financial activity, assigns transaction amounts and titles, and generates date-based reports for inflow and outflow types.

### 4. User and settings module
Primary files:

- `app/Http/Controllers/UserController.php`
- `app/Models/User.php`
- `resources/views/back/show_main_settings_of_software_form.php`
- `resources/views/back/show_change_password_form.php`

This module contains the clinic configuration and user account logic. It manages settings such as:

- clinic doctors list
- service pricing configuration
- appointment gap interval
- contact and company details
- system options and menu behavior

## Application data model

The project includes migrations for the main clinic entities:

- `users` — accounts, clinic settings, and access metadata
- `patients_general_infos` — patient details and medical background
- `patients_appointments` — appointment date, time, doctor, service, and status
- `financial_transactions` — transaction type, amount, date, payment title, and related patient

The important migration files are:

- `database/migrations/2014_10_12_000000_create_users_table.php`
- `database/migrations/2021_12_09_055150_create_patients_general_infos_table.php`
- `database/migrations/2021_12_14_085000_create_patients_appointments_table.php`
- `database/migrations/2021_12_25_134116_create_financial_transactions_table.php`

## Authentication and access control

The app uses Laravel’s built-in authentication and its own middleware-based restrictions.

Relevant files:

- `app/Http/Middleware/middleware_check_page_access_for_user_level.php`
- `app/Http/Middleware/middleware_check_page_access_for_admin_level.php`
- `resources/views/auth/login.blade.php`

The root route forwards users to the login page:

```php
Route::get('/', function () {
    return view('auth.login');
});
```

The app also registers the default authentication routes:

```php
Auth::routes();
```

This means the system uses standard Laravel auth flows while applying custom restrictions for user/admin sections.

## Installation and local setup

### Prerequisites

- PHP 7.3+ / Laravel 8 compatible environment
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

### 4. Create the environment file

```bash
cp .env.example .env
```

Then update the database config in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinic_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate the Laravel app key

```bash
php artisan key:generate
```

### 6. Run database migrations

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

Open the app in the browser at:

```text
http://localhost:8000
```

## Typical workflow

A typical clinic workflow in this project is:

1. Admin or clinic staff logs in
2. Patient is registered or searched
3. Appointment is scheduled for a specific date and time
4. Financial transaction is recorded for services or payments
5. Reports are generated over a date range
6. Settings are managed by the admin user

## Important notes

- This repository is a custom internal clinic management application, not a generic Laravel starter template.
- The UI includes a bundled admin dashboard under `public/back`, which appears to contain custom frontend assets and additional libraries.
- Some code naming follows custom snake_case conventions, which matches the original project structure.
- The project is practical and operational, but it also appears to contain legacy implementation patterns and bundled UI assets that may require cleanup or modernization in a future refactor.

## License

This project does not currently document a project-specific license in the README. Before commercial use or redistribution, confirm the intended license and any licensing requirements for bundled assets in `public/back`.

## Contribution

Contributions are welcome in areas such as:

- patient workflow improvements
- appointment validation and logic
- financial reporting
- admin/user role security
- dashboard usability and UI refinement
- modernization and code cleanup

If you would like to contribute, open a pull request or reach out to the repository maintainer.
