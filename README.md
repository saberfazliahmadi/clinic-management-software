# MatabeOnline Clinic Management Software

MatabeOnline Clinic Management Software is a custom Laravel-based clinic management system built to handle the daily operations of a clinic. It provides a centralized dashboard for patient management, appointment scheduling, financial tracking, and administrative configuration.

This project is designed as a practical clinic operations platform rather than a generic Laravel starter app. It helps clinic staff manage patient records, reservation workflows, and transaction reporting from a single system.

## Overview

The application is built with Laravel 8 and follows the standard MVC pattern with custom business logic for a medical practice environment. The project includes:

- patient registration and profile management
- appointment booking and scheduling
- financial transaction recording and reporting
- clinic settings and configuration
- admin/user access restrictions
- a custom admin-style dashboard stored in the `public/back` directory

## Why this project exists

This system addresses the core needs of a small or mid-sized clinic:

- keep all patient information in one place
- manage appointments by date and time
- monitor revenue and patient-related financial activity
- configure doctor names, service types, and practice defaults
- control access to internal management features

## Features

### Patient management
- add and update patient records
- search patients by ID, name, mobile number, or national ID
- track personal and medical details
- keep last appointment information for each patient
- avoid duplicate mobile numbers in the same clinic scope

### Appointment scheduling
- schedule appointments for a selected patient
- assign appointment date and time
- calculate available time slots based on configured gaps
- show date-based appointment lists
- support doctor assignment and service type configuration
- manage appointment cancellation and deletion flows

### Financial operations
- record incoming and outgoing financial transactions
- link financial entries to patients and appointments
- store transaction titles, amounts, and timestamps
- generate report views for date-based financial activity
- configure service pricing and receive-money settings

### Administration and settings
- user login and authentication
- password update support
- clinic configuration for doctor names and service categories
- practice settings for menu titles, appointment intervals, and financial defaults
- access restriction for user/admin pages using middleware

## Tech Stack

- PHP
- Laravel 8
- MySQL
- Blade templates
- Bootstrap-based admin UI
- Laravel authentication
- npm + Laravel Mix

## Project Structure

```text
app/
  Http/
    Controllers/        business logic for patient, appointment, user, and financial flows
    Middleware/          access-control checks and protected-page logic
  Models/               Eloquent models for clinic data

config/                 Laravel config files

database/
  migrations/            database schema for users, patients, appointments, and finances
  seeders/               seed support

public/
  back/                  bundled admin dashboard assets and frontend UI resources

resources/
  views/                 Blade templates for auth and dashboard screens
  js/                    frontend JavaScript
  sass/                  frontend stylesheets

routes/
  web.php                main application routes

.env.example            environment template
composer.json           PHP dependencies
package.json            frontend dependencies and scripts
phpunit.xml             PHPUnit configuration
README.md               project documentation
```

## Core Modules

### 1. Patient module
Key files:

- `app/Http/Controllers/PatientsGeneralInfoController.php`
- `app/Models/patients_general_info.php`
- `resources/views/back/submit_new_patient_form.php`
- `resources/views/back/show_patient_search_from.php`

This module handles patient creation, record updates, duplicate checking, and search behavior.

### 2. Appointment module
Key files:

- `app/Http/Controllers/PatientsAppointmentController.php`
- `app/Models/patients_appointment.php`
- `resources/views/back/show_form_of_appointments_on_specific_date.php`
- `resources/views/back/show_patient_time_appointment_table.php`

This module schedules appointments, checks slot availability, and organizes appointments by date and time.

### 3. Financial module
Key files:

- `app/Http/Controllers/FinancialTransactionController.php`
- `app/Models/financial_transaction.php`
- `resources/views/back/show_submit_financial_transaction_form.php`
- `resources/views/back/show_financial_transaction_reporting_form.php`

This module records clinic financial transactions and supports filtered reporting for a date range.

### 4. User and settings module
Key files:

- `app/Http/Controllers/UserController.php`
- `app/Models/User.php`
- `resources/views/back/show_main_settings_of_software_form.php`
- `resources/views/back/show_change_password_form.php`

This module manages clinic configuration such as doctors, service pricing, appointment intervals, and account settings.

## Database Model Summary

The application has several key migrations that define the main clinic data model:

- `database/migrations/2014_10_12_000000_create_users_table.php`
- `database/migrations/2021_12_09_055150_create_patients_general_infos_table.php`
- `database/migrations/2021_12_14_085000_create_patients_appointments_table.php`
- `database/migrations/2021_12_25_134116_create_financial_transactions_table.php`

### `users`
Stores user account details and practice configuration, including:

- `name`, `email`, `password`
- `user_type`, `parent_id`
- `gap_time_between_appointments`
- `company_name`, `contact_address`
- `phone_number`, `mobile_number`, `website`
- `clinic_doctors_name`
- `financial_management`
- `cms_menu_title`
- `options_for_user`

### `patients_general_infos`
Stores patient-level information:

- `patient_first_name`, `patient_last_name`
- `patient_mobile_number`, `patient_phone_number`
- `patient_birth_day`, `patient_gender`
- `patient_address`, `patient_email_address`
- `patient_relationship_status`
- `patient_surgery_history`
- `patient_disease_background`
- `patient_medication_history`
- `patient_allergies_history`
- `patient_more_description`
- `patient_last_appointment_date`, `patient_last_appointment_time`

### `patients_appointments`
Tracks appointment records:

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
Tracks all money movement:

- `financial_dr_related_id`
- `financial_patient_related_id`
- `financial_appointment_related_id`
- `financial_transaction_type` (`+` = income, `-` = expense)
- `financial_transaction_date`, `financial_transaction_time`
- `financial_transaction_title`
- `financial_transaction_amount`
- `financial_transaction_child_dr_related_name`

## Authentication and Access Control

The app uses Laravel's built-in authentication and custom middleware to protect management areas.

Relevant files:

- `resources/views/auth/login.blade.php`
- `app/Http/Middleware/middleware_check_page_access_for_user_level.php`
- `app/Http/Middleware/middleware_check_page_access_for_admin_level.php`

The project also uses the standard auth routes:

```php
Auth::routes();
```

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

### 4. Configure environment variables

```bash
cp .env.example .env
```

Update the database configuration in `.env`:

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

Open the app at:

```text
http://localhost:8000
```

## Typical Usage Flow

A standard clinic workflow in this application is:

1. staff logs into the system
2. patient record is created or searched
3. appointment is scheduled for a specific date and time
4. financial transaction is recorded for service/payment
5. reports are generated over a date range
6. admin adjusts settings, doctors, and financial configuration

## Notes

- This repository is a custom clinic operations system, not a generic Laravel starter template.
- The admin UI is bundled under `public/back` and includes custom/template-based frontend assets.
- Some parts of the codebase were built in a more legacy/custom style and may benefit from future cleanup and modernization.
- The project is practical and operational, but it is not a fully polished enterprise SaaS product out of the box.

## License

This project does not currently document a project-specific license in the README. Before public distribution, commercial use, or deployment in production, verify the appropriate licensing status and check whether any bundled assets in `public/back` have separate license terms.

## Contributing

Contributions are welcome for:

- patient workflow improvements
- appointment scheduling and validation
- financial reporting and transaction handling
- admin/user access improvements
- UI and UX enhancements
- maintainability and modernization

If you would like to contribute, open a pull request or contact the repository maintainer.
