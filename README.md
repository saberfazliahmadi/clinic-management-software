# MatabeOnline Clinic Management Software

MatabeOnline Clinic Management Software is a custom Laravel-based clinic management system built to streamline daily clinical operations. It provides a single dashboard for patient management, appointment planning, financial tracking, and clinic administration.

This repository is not a generic Laravel starter project. It is a practical healthcare-management application tailored to the needs of a clinic, with workflows for patient intake, appointment coordination, billing, and configurable admin settings.

## Overview

The application is built with Laravel 8 and follows the standard MVC architecture used by Laravel, but the actual business logic is customized for clinic operations. The project includes:

- patient registration and profile management
- appointment scheduling and time-slot management
- financial transaction recording and reporting
- clinic configuration and administrative settings
- user/admin access control through custom middleware
- a dashboard-style frontend under `public/back`

## Why this project exists

The app is designed to support the day-to-day operational workflow of a clinic:

- keep patient records in one place
- organize appointment dates and times
- record financial transactions tied to patient activity
- define clinic service prices and doctor names
- control user access to sensitive admin sections

## Main Features

### Patient management
- add, edit, and search patient records
- store patient personal and medical information
- track patient last appointment details
- prevent duplicate mobile numbers within a clinic context
- keep history fields such as surgery history, diagnosis background, medications, and allergies

### Appointment management
- schedule appointments for specific dates and times
- generate available time slots based on configured clinic intervals
- display appointments on a selected day
- assign doctor names and service types when relevant
- support appointment deletion and rescheduling workflows

### Financial management
- record incoming and outgoing financial transactions
- link transactions to patients and appointment records
- store payment title, date, time, and amount
- generate filtered reports for date ranges
- define pricing and service names in admin settings

### Administration and settings
- login and authentication
- password change workflow
- clinic doctor configuration
- financial service configuration
- appointment gap configuration
- general clinic software settings
- admin/user role restrictions on sensitive pages

## Tech Stack

- PHP
- Laravel 8
- MySQL
- Blade templates
- Bootstrap-based admin interface
- Laravel authentication
- npm + Laravel Mix for frontend asset compilation

## Application Architecture

The application follows the standard Laravel folder structure, while tying together clinic-specific modules:

```text
app/
  Http/
    Controllers/        logic for patient, appointment, financial, and user workflows
    Middleware/          access control and protected-page checks
  Models/               Eloquent models for clinic entities

config/                 Laravel application configuration

database/
  migrations/            schema definition for users, patients, appointments, and money records
  seeders/               optional seed support

public/
  back/                  bundled admin dashboard frontend assets and static UI resources

resources/
  views/                 Blade templates for auth and admin screens
  js/                    frontend JavaScript
  sass/                  frontend stylesheets

routes/
  web.php                route definitions

.env.example            example environment file
composer.json           PHP dependency list
package.json            frontend dependency list and scripts
phpunit.xml             PHPUnit configuration
README.md               project documentation
```

## Core Modules

### Patient module
Relevant files:

- `app/Http/Controllers/PatientsGeneralInfoController.php`
- `app/Models/patients_general_info.php`
- `resources/views/back/submit_new_patient_form.php`
- `resources/views/back/show_patient_search_from.php`

This module manages patient creation, editing, validation, duplicate prevention, and patient search workflows.

### Appointment module
Relevant files:

- `app/Http/Controllers/PatientsAppointmentController.php`
- `app/Models/patients_appointment.php`
- `resources/views/back/show_form_of_appointments_on_specific_date.php`
- `resources/views/back/show_patient_time_appointment_table.php`

This module handles date-based clinic scheduling, time slot visibility, and appointment assignments for patients.

### Financial module
Relevant files:

- `app/Http/Controllers/FinancialTransactionController.php`
- `app/Models/financial_transaction.php`
- `resources/views/back/show_submit_financial_transaction_form.php`
- `resources/views/back/show_financial_transaction_reporting_form.php`

This module stores financial records and produces transaction reports based on date ranges and selected filters.

### User and settings module
Relevant files:

- `app/Http/Controllers/UserController.php`
- `app/Models/User.php`
- `resources/views/back/show_main_settings_of_software_form.php`
- `resources/views/back/show_change_password_form.php`

This module contains configuration logic for doctor names, service pricing, appointment intervals, clinic contact info, and general software settings.

## Database Model Summary

The application includes migrations for its main operational tables:

- `database/migrations/2014_10_12_000000_create_users_table.php`
- `database/migrations/2021_12_09_055150_create_patients_general_infos_table.php`
- `database/migrations/2021_12_14_085000_create_patients_appointments_table.php`
- `database/migrations/2021_12_25_134116_create_financial_transactions_table.php`

### `users`
The users table stores core account information and clinic configuration values, including:

- `parent_id` and `user_type`
- `name`, `email`, `password`
- `company_name`, `contact_address`, `phone_number`, `mobile_number`, `website`
- `gap_time_between_appointments`
- `clinic_doctors_name`
- `financial_management`
- `cms_menu_title`
- `options_for_user`

This suggests the app is designed for clinic-level configuration and a hierarchical user/admin model.

### `patients_general_infos`
This table stores patient demographics and clinical history, including:

- `patient_first_name`, `patient_last_name`
- `patient_birth_day`, `patient_gender`
- `patient_mobile_number`, `patient_phone_number`
- `patient_address`, `patient_email_address`
- `patient_nationality_number`
- `patient_relation_ship_status`
- `patient_surgery_history`
- `patient_disease_background`
- `patient_medication_history`
- `patient_allergies_history`
- `patient_more_description`
- `patient_last_appointment_date`, `patient_last_appointment_time`

### `patients_appointments`
This table stores scheduled visits and appointment metadata, including:

- `appointment_dr_related_id`
- `appointment_patient_related_id`
- `appointment_date`, `appointment_time`
- `appointment_status`, `appointment_status_unique`
- `appointment_child_dr_related_name`
- `appointment_service_type`
- `appointment_received_financial_status`
- `appointment_from_where`
- `appointment_canceling_status`

### `financial_transactions`
This table captures monetary records for the clinic:

- `financial_dr_related_id`
- `financial_patient_related_id`
- `financial_appointment_related_id`
- `financial_transaction_type` (`+` for income, `-` for expense)
- `financial_transaction_date`, `financial_transaction_time`
- `financial_transaction_title`
- `financial_transaction_amount`
- `financial_transaction_child_dr_related_name`

## Authentication and Access Control

The application uses Laravel authentication and custom middleware to restrict access to certain pages.

Relevant files:

- `resources/views/auth/login.blade.php`
- `app/Http/Middleware/middleware_check_page_access_for_user_level.php`
- `app/Http/Middleware/middleware_check_page_access_for_admin_level.php`

Authentication is registered via:

```php
Auth::routes();
```

The app also redirects unauthenticated users to the login page.

## Installation

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

Then open:

```text
http://localhost:8000
```

## Typical Workflow

A common clinic workflow in this application is:

1. admin or staff logs in
2. patient is created or searched
3. appointment is scheduled for a selected date and time
4. financial transaction is recorded for the service or payment
5. report is generated for the selected date range
6. clinic settings are managed through the admin screen

## Notes

- This is a custom healthcare operations application rather than a generic Laravel starter template.
- The app includes a custom administrative dashboard under `public/back`.
- Some implementation patterns reflect legacy custom development and may benefit from future cleanup or modernization.
- The project is operational and purpose-built for clinic use, but it is not a polished SaaS product template out of the box.

## License

This repository does not currently declare a specific project license in the README. Before public distribution, commercial use, or deployment in a production environment, verify the intended licensing terms and check whether any bundled frontend assets under `public/back` have their own license obligations.

## Contribution

Contributions are welcome for:

- patient workflow improvements
- appointment scheduling logic
- financial reporting and integrity
- access control improvements
- dashboard usability and UI refinement
- maintainability and modernization

If you would like to contribute, open a pull request or contact the repository maintainer.
