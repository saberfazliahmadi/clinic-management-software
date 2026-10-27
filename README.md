# MatabeOnline Clinic Management Software

MatabeOnline Clinic Management Software is a custom Laravel-based clinic management system designed to support the daily operations of a medical clinic. It provides a central dashboard for managing patients, appointments, financial records, and administrative settings.

This repository is not a generic Laravel starter project. It was built as a practical clinic operations platform for handling patient intake, appointment coordination, billing, and internal admin configuration in one place.

## Overview

The application is built with Laravel 8 and follows the standard MVC pattern used by Laravel, while adding clinic-specific business workflows. It is designed to help clinic staff and administrators:

- register and maintain patient records
- manage appointment schedules by date and time
- record and review financial transactions
- configure doctors, service types, and practice settings
- restrict access to admin-level or user-level pages

The project includes a custom admin-style interface under `public/back`, giving it a dashboard-oriented appearance rather than the default Laravel starter UI.

## Core Features

### Patient management
- add and edit patient profiles
- search patients by ID, name, mobile number, or national ID
- store demographic and medical background details
- track last appointment and visit-related metadata
- prevent duplicate mobile numbers within the same clinic context

### Appointment management
- schedule patients on a selected date
- assign appointment times using a configured time gap
- view appointment activity for a given day
- assign doctor and service type when relevant
- manage appointment cancellation and deletion flows

### Financial management
- record incoming and outgoing financial transactions
- link transactions to patients and appointments
- store payment titles, amounts, and timestamps
- generate financial reports for a date range
- configure service pricing and receiving-money settings

### Administration and settings
- login and administrator/user authentication
- password change workflow
- manage clinic doctors list
- configure service types and financial rules
- define appointment gap intervals
- maintain clinic contact information and software settings
- restrict sensitive pages to authorized roles

## Tech Stack

- PHP
- Laravel 8
- MySQL
- Blade templating
- Bootstrap-based UI
- Laravel authentication
- npm + Laravel Mix for frontend asset compilation

## Project Structure

```text
app/
  Http/
    Controllers/        logic for patient, appointment, user, and financial workflows
    Middleware/          access control and restricted-page checks
  Models/               Eloquent models for clinic data

config/                 Laravel configuration files

database/
  migrations/            tables for users, patients, appointments, and financial records
  seeders/               database seed support

public/
  back/                  admin dashboard assets and bundled frontend resources

resources/
  views/                 Blade templates for auth and dashboard screens
  js/                    frontend JavaScript
  sass/                  frontend stylesheet source files

routes/
  web.php                application routes

.env.example            example environment file
composer.json           PHP dependencies
package.json            frontend dependencies and build scripts
phpunit.xml             PHPUnit configuration
README.md               project documentation
```

## Main Modules

### 1. Patient module
Relevant files:

- `app/Http/Controllers/PatientsGeneralInfoController.php`
- `app/Models/patients_general_info.php`
- `resources/views/back/submit_new_patient_form.php`
- `resources/views/back/show_patient_search_from.php`

This module handles patient creation, editing, validation, duplicate checking, and search functionality.

### 2. Appointment module
Relevant files:

- `app/Http/Controllers/PatientsAppointmentController.php`
- `app/Models/patients_appointment.php`
- `resources/views/back/show_form_of_appointments_on_specific_date.php`
- `resources/views/back/show_patient_time_appointment_table.php`

This module manages scheduling by date, calculates available time slots, and stores appointment data linked to a specific patient and doctor/service.

### 3. Financial module
Relevant files:

- `app/Http/Controllers/FinancialTransactionController.php`
- `app/Models/financial_transaction.php`
- `resources/views/back/show_submit_financial_transaction_form.php`
- `resources/views/back/show_financial_transaction_reporting_form.php`

This module records clinic financial activity and supports filtered reporting across dates.

### 4. User and settings module
Relevant files:

- `app/Http/Controllers/UserController.php`
- `app/Models/User.php`
- `resources/views/back/show_main_settings_of_software_form.php`
- `resources/views/back/show_change_password_form.php`

This module manages clinic configuration such as doctor names, appointment spacing, service pricing, and general software settings.

## Database Model Summary

The application includes migrations for the primary clinic entities:

- `database/migrations/2014_10_12_000000_create_users_table.php`
- `database/migrations/2021_12_09_055150_create_patients_general_infos_table.php`
- `database/migrations/2021_12_14_085000_create_patients_appointments_table.php`
- `database/migrations/2021_12_25_134116_create_financial_transactions_table.php`

### `users`
The `users` table stores account data and clinic settings, including:

- `parent_id` and `user_type`
- `name`, `email`, and `password`
- `gap_time_between_appointments`
- `company_name`, `contact_address`, `phone_number`, `mobile_number`, `website`
- `clinic_doctors_name`
- `financial_management`
- `cms_menu_title`
- `options_for_user`

### `patients_general_infos`
This table stores patient records, such as:

- `patient_first_name`, `patient_last_name`
- `patient_mobile_number`, `patient_phone_number`
- `patient_birth_day`, `patient_gender`
- `patient_address`, `patient_email_address`
- `patient_nationality_number`
- `patient_surgery_history`
- `patient_disease_background`
- `patient_medication_history`
- `patient_allergies_history`
- `patient_more_description`
- `patient_last_appointment_date`, `patient_last_appointment_time`

### `patients_appointments`
This table tracks scheduled visits and appointment metadata, including:

- `appointment_dr_related_id`
- `appointment_patient_related_id`
- `appointment_date`, `appointment_time`
- `appointment_status` and `appointment_status_unique`
- `appointment_child_dr_related_name`
- `appointment_service_type`
- `appointment_received_financial_status`
- `appointment_from_where`
- `appointment_canceling_status`

### `financial_transactions`
This table records money movement in the clinic, including:

- `financial_dr_related_id`
- `financial_patient_related_id`
- `financial_appointment_related_id`
- `financial_transaction_type` (`+` for incoming, `-` for outgoing)
- `financial_transaction_date`, `financial_transaction_time`
- `financial_transaction_title`
- `financial_transaction_amount`
- `financial_transaction_child_dr_related_name`

## Authentication and Access Control

The app uses Laravel's built-in authentication along with custom middleware for role-aware access control.

Relevant files:

- `resources/views/auth/login.blade.php`
- `app/Http/Middleware/middleware_check_page_access_for_user_level.php`
- `app/Http/Middleware/middleware_check_page_access_for_admin_level.php`

Authentication routes are registered with:

```php
Auth::routes();
```

and the app redirects users to the login page when needed.

## Installation

### Prerequisites

- PHP 7.3+ / Laravel 8 environment
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

Then configure your database in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinic_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate the Laravel application key

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

Then open:

```text
http://localhost:8000
```

## Typical Usage Flow

A normal clinic workflow in this project looks like this:

1. staff logs into the system
2. patient is created or searched
3. an appointment is scheduled for a selected date and time
4. financial transaction is added for the service or payment
5. report is generated for a chosen date range
6. admin adjusts clinic settings and service definitions

## Notes

- This project is a custom clinic operations system rather than a generic Laravel starter template.
- The admin dashboard uses bundled frontend assets and a custom theme under `public/back`.
- Some implementation patterns are legacy/custom and reflect an older software development approach.
- The overall design is practical and operational, with a strong emphasis on clinic workflows and internal management.

## License

This repository does not currently declare a project-specific license in the README. Before public distribution, commercial use, or production deployment, confirm the proper licensing terms and check whether any bundled frontend assets under `public/back` have their own license requirements.

## Contributing

Contributions are welcome for:

- improving patient workflows
- improving appointment scheduling logic
- financial reporting and transaction handling
- security and role-based access enhancements
- dashboard UI/UX improvements
- code cleanup and modernization

If you would like to contribute, open a pull request or contact the repository maintainer.
