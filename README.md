# Talent Wave - Employee Management System

Talent Wave is a comprehensive employee management system built with Laravel that streamlines HR processes and enhances workplace efficiency.

## Features

### User Management
- Employee registration and profile management
- Admin/HR user administration
- Secure authentication and authorization
- Soft delete functionality for data integrity

### Department Management
- Create and manage organizational departments
- Assign employees to specific departments
- Department-based reporting

### Attendance System
- Employee check-in/check-out functionality
- Real-time attendance tracking
- Attendance reports and analytics
- Admin oversight of attendance records

### Leave Management
- Multiple leave types (annual, sick, personal, etc.)
- Leave request submission and approval workflow
- Leave balance tracking and management
- Automated balance calculations

### Document Management
- Secure document upload and storage
- Document type categorization
- Approval workflow for submitted documents
- Document viewing and downloading

### Ticket System
- Support ticket creation and tracking
- Request processing with approval/rejection workflow
- Ticket status monitoring

### Reporting
- Comprehensive PDF report generation
- Employee data exports
- Attendance and leave summaries
- Customizable report formats

## Technology Stack

- **Backend**: Laravel 12
- **Frontend**: Blade templates, JavaScript
- **Database**: MySQL
- **PDF Generation**: DomPDF
- **Authentication**: Laravel's built-in auth system

## Installation

1. Clone the repository:
   ```
   git clone https://github.com/your-username/talent-wave.git
   cd talent-wave
   ```

2. Install PHP dependencies:
   ```
   composer install
   ```

3. Install JavaScript dependencies:
   ```
   npm install
   ```

4. Set up environment variables:
   ```
   cp .env.example .env
   php artisan key:generate
   ```

5. Configure your database in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=talent_wave
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Run migrations and seed the database:
   ```
   php artisan migrate --seed
   ```

7. Start the development server:
   ```
   php artisan serve
   ```

8. For asset compilation:
   ```
   npm run dev
   ```

## Usage

### Employee Portal
- Access the employee dashboard at `/employee/dashboard`
- Submit leave requests
- Upload documents
- View attendance records
- Create support tickets

### Admin Portal
- Access the admin dashboard at `/admin/dashboard`
- Manage employees and departments
- Process leave requests and document approvals
- Generate reports
- Handle support tickets

## Security

The application implements multiple layers of security:
- Role-based access control
- Authentication middleware
- Form validation
- CSRF protection
- Data sanitization