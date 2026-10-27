# Clinic Management Software

Clinic Management Software is a custom Laravel web application designed for managing a clinic's daily operations. It centralizes patient data, appointment scheduling, financial transactions, and clinic configuration into a single admin dashboard.

This project is focused on practical clinic workflow management rather than being a generic Laravel starter application. It includes patient intake, appointment planning, billing records, and role-based access controls for different users.

## Overview

The repository is built on Laravel 8 and follows a typical MVC structure with custom business logic tailored to a clinic environment. The app allows staff and administrators to:

- create and update patient records
- schedule appointments by date and time
- track clinic-related financial transactions
- configure service pricing and doctor information
- restrict sensitive sections using user/admin middleware

The system uses a custom admin dashboard under `public/back`, which gives the app a more operational management interface rather than a standard Laravel UI.

## Key Features

### Patient management
- add and edit patient records
- search patients by ID, first name, last name, mobile number, or nationality number
- store personal and clinical details such as address, gender, relationship status, and medical history
- manage last appointment information for each patient
- enforce unique mobile number checking for patient records

### Appointment management
- schedule patients on a chosen date
- assign appointment times using a configurable gap interval
- view appointment calendars or date-specific appointment lists
- assign doctor and service type when configured
- manage appointment status and deletion workflows

### Financial management
- record inflow and outflow financial transactions
- assign transaction amounts, titles, dates, and times
- link transactions to patient records and doctor names
- filter financial reporting by date range
- define service pricing and receive-money settings through admin configuration

### Administration and settings
- login and authentication
- change password workflow
- configure clinic doctors list
- configure service types and financial settings
- set appointment interval between bookings
- manage staff/admin user settings
- protect admin-only routes with middleware

## Technology Stack

- PHP
- Laravel 8
- MySQL
- Blade templates
- Bootstrap-based admin UI
- Laravel UI authentication
- npm + Laravel Mix for frontend asset building

## Application Architecture

This project follows standard Laravel architecture with custom business modules:

- `routes/web.php` contains the app routes
- `app/Http/Controllers` contains the application logic
- `app/Models` contains the Eloquent models
- `resources/views` stores the Blade templates
- `public/back` contains the custom admin dashboard assets
- `database/migrations` defines the application schema
- `app/Http/Middleware` enforces access rules

## Core Modules

### Patient module
Relevant files:

- `app/Http/Controllers/PatientsGeneralInfoController.php`
- `app/Models/patients_general_info.php`
- `resources/views/back/submit_new_patient_form.php`
- `resources/views/back/show_patient_search_from.php`

This module handles adding, editing, searching, validating, and updating patient records. It also prevents duplicate mobile numbers within the same admin context.

### Appointment module
Relevant files:

- `app/Http/Controllers/PatientsAppointmentController.php`
- `app/Models/patients_appointment.php`
- `resources/views/back/show_form_of_appointments_on_specific_date.php`
- `resources/views/back/show_patient_time_appointment_table.php`

This module controls the scheduling flow. It calculates appointment availability based on the clinic's configured time gap, lists appointments for a selected day, and stores appointments against specific patients and doctor/service choices.

### Financial module
Relevant files:

- `app/Http/Controllers/FinancialTransactionController.php`
- `app/Models/financial_transaction.php`
- `resources/views/back/show_submit_financial_transaction_form.php`
- `resources/views/back/show_financial_transaction_reporting_form.php`

This module records financial transactions and generates date-range reports for incoming and outgoing clinic money movement.

### User/settings module
Relevant files:

- `app/Http/Controllers/UserController.php`
- `app/Models/User.php`
- `resources/views/back/show_main_settings_of_software_form.php`
- `resources/views/back/show_change_password_form.php`

This module manages clinic configuration, such as doctor names, service pricing, appointment spacing, contact info, and default software options.

## Data Model Summary

The application includes Laravel migrations for the following main tables:

### `users`
The `users` table stores account-level information and operational defaults, including:

- `parent_id` for hierarchical/user-subaccount behavior
- `user_type` for admin/user distinction
- `gap_time_between_appointments`
- `company_name`
- `contact_address`
- `phone_number`, `mobile_number`, `website`
- `clinic_doctors_name`
- `financial_management`
- `options_for_user`
- `cms_menu_title`

This shows the app is designed for a clinic operating with configurable workflow settings and fallback admin/user management.

### `patients_general_infos`
This table stores patient details like:

- `patient_first_name`
- `patient_last_name`
- `patient_birth_day`
- `patient_mobile_number`
- `patient_phone_number`
- `patient_address`
- `patient_email_address`
- `patient_gender`
- `patient_relationship_status`
- `patient_surgery_history`
- `patient_disease_background`
- `patient_medication_history`
- `patient_allergies_history`
- `patient_more_description`
- `patient_last_appointment_date`
- `patient_last_appointment_time`

### `patients_appointments`
This table tracks appointment information, including:

- `appointment_dr_related_id`
- `appointment_patient_related_id`
- `appointment_date`
- `appointment_time`
- `appointment_status`
- `appointment_status_unique`
- `appointment_child_dr_related_name`
- `appointment_service_type`
- `appointment_received_financial_status`
- `appointment_from_where`
- `appointment_canceling_status`

### `financial_transactions`
This table records financial movement for the clinic:

- `financial_dr_related_id`
- `financial_patient_related_id`
- `financial_appointment_related_id`
- `financial_transaction_type` (`+` for income, `-` for expense)
- `financial_transaction_date`
- `financial_transaction_time`
- `financial_transaction_title`
- `financial_transaction_amount`
- `financial_transaction_child_dr_related_name`

## Authentication and Access Control

The app uses Laravel's built-in authentication system. The login form is located in:

- `resources/views/auth/login.blade.php`

The app registers Laravel auth routes with:

```php
Auth::routes();
```

The application also includes custom middleware to limit access based on user/admin status:

- `app/Http/Middleware/middleware_check_page_access_for_user_level.php`
- `app/Http/Middleware/middleware_check_page_access_for_admin_level.php`

The root route redirects to the login page:

```php
Route::get('/', function () {
    return view('auth.login');
});
```

## Project Structure

```text
app/
  Http/
    Controllers/        main app logic for patients, appointments, settings, and finances
    Middleware/          custom access control logic
  Models/               Eloquent models

config/                 Laravel configuration files

database/
  migrations/            schema for users, patients, appointments, and financial transactions
  seeders/               seeder support

public/
  back/                  admin dashboard assets and frontend UI resources

resources/
  views/                 Blade templates for the app
  js/                    frontend JS
  sass/                  frontend stylesheets

routes/
  web.php                main route definitions

.env.example            sample environment configuration
composer.json           PHP dependencies
package.json            frontend build dependencies
phpunit.xml             PHPUnit config
README.md               project documentation
```

## Installation

### Prerequisites

- PHP 7.3+ (Laravel 8 compatible)
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

### 4. Configure the environment file

```bash
cp .env.example .env
```

Update the database values in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinic_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate the application key

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

### 8. Start the application

```bash
php artisan serve
```

Then open the app in the browser:

```text
http://localhost:8000
```

## Typical Workflow

A normal clinic workflow in this application looks like this:

1. A user logs into the system.
2. The staff member searches for or creates a patient record.
3. An appointment is scheduled for a specific date and time.
4. The patient’s appointment is associated with a doctor and service type if configured.
5. Financial transactions are added for services or payments.
6. Reports are generated for clinic financial data over a date range.
7. Admin users adjust clinic settings, doctor lists, and service definitions.

## Notes and Observations

- This project is a custom clinic operations tool rather than a generic Laravel starter package.
- The dashboard uses bundled frontend assets and a custom admin theme under `public/back`.
- Some naming conventions and implementation patterns are custom and legacy-oriented, especially in older controller logic and model naming.
- The codebase reflects a practical clinic management workflow rather than a polished SaaS product template.

## License

This repository currently does not declare a specific project license in the README. Before commercial use, redistribution, or public deployment, confirm the correct licensing terms for the project and any bundled frontend assets in `public/back`.

## Contributing

Contributions are welcome for:

- patient workflow improvements
- appointment scheduling logic
- financial transaction handling
- admin/user authorization improvements
- UI/UX enhancements
- code cleanup and modernization

If you would like to contribute, open a pull request or contact the repository maintainer.
