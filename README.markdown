# Insurance Management System

## Overview
The Insurance Management System is a web application built with **Laravel 10** and **Laravel Breeze** for user authentication. It is designed to manage employee, vehicle, and insurance office data within a company, with the primary focus on social insurance tracking. The system fully supports Arabic (with right-to-left `dir="rtl"` layout) and uses **Bootstrap** for a responsive and user-friendly interface.

The system handles employee data (both insured and non-insured), vehicles (private or transport), and insurance offices, with features like automatic insurance contribution calculations, Excel export, and a dedicated statistics dashboard with charts.

## Features
### 1. **Employee Management**
- **Basic Information**:
  - SAP number (unique), name, national ID (14 digits, unique), department, qualification, hiring date, job title, gender (male/female), branch, phone number.
  - Driver's license images (front and back) with expiry date.
- **Insurance Details**:
  - Insurance number, insurance office, office-specific insurance number, and registration number.
  - Insurance status, enrollment date.
  - Insurance salary, gross salary (with validation: gross salary > insurance salary).
  - Automatic calculations:
    - Employee contribution (11% of insurance salary).
    - Employer contribution (18.75% of insurance salary).
    - Total insurance (sum of both contributions).
  - Resignation date, registered company, official resignation date.
- **Documents**:
  - Upload Form 1, Form 6, and additional documents (jpeg, png, jpg, pdf; max 2MB).
  - Support for clearance and resignation documents.
- **Notes**: Text field for additional notes (max 1000 characters).

### 2. **Vehicle Management**
- **Details**:
  - Vehicle name, type (private/transport).
  - For transport vehicles: display follower name and insurance number (requires employee job title to be "Follower").
  - Inspection start/end dates, manufacture year, location, plate number (letters and numbers), chassis number.
  - License images (front and back), insurance certificate.
  - Days remaining until license renewal.
- **Features**:
  - Generate vehicle certificates as PDF.
  - Import/export vehicle data via Excel.

### 3. **Insurance Office Management**
- **Details**:
  - Office name, address, insurance number, registration number, associated company.
- **Relationships**:
  - Each office is linked to employees and companies.

### 4. **Insurance Statistics Dashboard**
- Displays:
  - Number of employees per insurance office and company.
  - Total employee contributions, employer contributions, and total insurance for each office and company.
  - Visual charts (e.g., bar or pie charts) to represent the data.

### 5. **Data Export**
- Export employee data to Excel based on:
  - Registered company.
  - Insurance office.

### 6. **User Interface**
- Fully Arabic interface with right-to-left (`dir="rtl"`) support.
- Bootstrap-based design with components like accordions and custom-styled buttons.
- Delete confirmation via JavaScript (with a suggestion to enhance using SweetAlert2).

## Requirements
- **PHP**: >= 8.1
- **Composer**: Latest version
- **Laravel**: 10.x
- **Database**: MySQL or any Laravel-supported database
- **Node.js and NPM**: For frontend assets (Bootstrap)
- **Optional Libraries**:
  - `Maatwebsite\Excel` for Excel import/export.
  - Chart.js or ApexCharts for charts.
  - SweetAlert2 for enhanced delete confirmation.

## Installation
1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   cd insurance-management-system
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Set Up Environment**:
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update database settings in `.env` (e.g., `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

6. **Create Storage Link**:
   ```bash
   php artisan storage:link
   ```

7. **Start the Server**:
   ```bash
   php artisan serve
   ```

8. **User Authentication**:
   - Use Laravel Breeze to create or log in to user accounts.

## Database Structure
### Table: `employees`
- `id`, `sap_number`, `name`, `national_id`, `department`, `qualification`, `hiring_date`, `job_title`, `gender`, `branch`, `phone`, `license_image_front`, `license_image_back`, `license_expiry_date`, `insurance_number`, `insurance_office_id`, `insurance_number_office`, `register_number_office`, `insurance_status`, `insurance_start_date`, `insurance_salary`, `gross_salary`, `employee_share`, `employer_share`, `total_insurance`, `resignation_date`, `registered_company`, `official_resignation_date`, `form_1`, `form_6`, `other_document`, `notes`.

### Table: `cars`
- `id`, `name`, `type` (private/transport), `follower_name`, `follower_insurance_number`, `inspection_start_date`, `inspection_end_date`, `manufacture_year`, `employee_id`, `location`, `plate_number`, `chassis_number`, `license_image_front`, `license_image_back`, `insurance_certificate`, `days_to_license_renewal`.

### Table: `insurance_offices`
- `id`, `name`, `address`, `insurance_number`, `register_number`, `company`.

## Relationships
- **Employees**:
  - `belongsTo` Insurance Office (`insurance_office_id`).
  - `belongsTo` Car (if assigned as a follower or insured).
- **Cars**:
  - `belongsTo` Employee (`employee_id`).
- **Insurance Offices**:
  - `hasMany` Employees.
  - Linked to a company.

## Suggested Improvements
- Use SweetAlert2 for better delete confirmation UX.
- Implement `Maatwebsite\Excel` for Excel import/export.
- Add notifications for upcoming vehicle license renewals.
- Use Chart.js or ApexCharts for dynamic charts in the statistics dashboard.
- Validate that employees linked to transport vehicles have the "Follower" job title.

## Usage
1. Log in using Laravel Breeze.
2. Manage employees: Add/edit/delete employee data and documents.
3. Manage vehicles: Link employees to vehicles and generate PDF certificates.
4. View statistics: Track employee counts and insurance contributions per office/company.
5. Export data to Excel based on company or insurance office.

## Contributing
- To contribute, create a pull request with a description of your changes.
- Ensure changes are tested in a local environment.

## License
This project is proprietary and subject to the company's internal usage policies.