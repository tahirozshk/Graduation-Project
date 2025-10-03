# YDU Project Management System for Teachers

A comprehensive Laravel 11 + TypeScript project management system designed for teachers to manage students, projects, reports, and notifications.

## 🎯 Features

- **Teacher Authentication**: Secure login using Laravel Breeze
- **Student Management**: Add, edit, view, and manage students
- **Project Tracking**: Monitor project progress, status, and deadlines
- **Report Management**: Track weekly reports, grades, and submissions
- **Notifications**: Real-time notifications for deadlines and updates
- **Dashboard**: Overview of all activities with statistics
- **Search & Filters**: Advanced filtering and search functionality
- **Responsive Design**: Modern UI with TailwindCSS (YDU branding colors)
- **TypeScript Interactivity**: Enhanced UX with TypeScript

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- npm or yarn
- SQLite, MySQL, or PostgreSQL

## 🚀 Installation Steps

### 1. Install PHP Dependencies

```bash
composer install
```

### 2. Install JavaScript Dependencies

```bash
npm install
```

### 3. Environment Setup

Copy the `.env.example` file to `.env`:

```bash
copy .env.example .env
```

Or on Linux/Mac:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

### 4. Database Configuration

Update your `.env` file with database credentials. For SQLite (simplest option):

```env
DB_CONNECTION=sqlite
# Remove or comment out other DB_ variables
```

The project already includes a SQLite database file at `database/database.sqlite`.

For MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Seed Database (Optional but Recommended)

This will create:
- 3 Teachers (login: `ahmed.hassan@ydu.edu.tr`, password: `password`)
- 10 Students
- 5 Projects
- 10 Reports
- 6 Notifications

```bash
php artisan db:seed
```

### 7. Build Frontend Assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 8. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## 👤 Login Credentials (After Seeding)

- **Email**: `ahmed.hassan@ydu.edu.tr`
- **Password**: `password`

Other teacher accounts:
- `fatima.yilmaz@ydu.edu.tr` / `password`
- `mehmet.demir@ydu.edu.tr` / `password`

## 🗂️ Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php
│   │   ├── StudentController.php
│   │   ├── ProjectController.php
│   │   ├── ReportController.php
│   │   └── NotificationController.php
│   ├── Models/
│   │   ├── User.php (Teacher)
│   │   ├── Student.php
│   │   ├── Project.php
│   │   ├── Report.php
│   │   └── Notification.php
│   └── Policies/
│       ├── StudentPolicy.php
│       └── NotificationPolicy.php
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_students_table.php
│   │   ├── 2024_01_01_000002_create_projects_table.php
│   │   ├── 2024_01_01_000003_create_reports_table.php
│   │   └── 2024_01_01_000004_create_notifications_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   ├── js/
│   │   ├── app.js
│   │   └── dashboard.ts (TypeScript interactivity)
│   └── views/
│       ├── layouts/
│       │   └── dashboard.blade.php
│       ├── dashboard.blade.php
│       ├── students/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── projects/
│       │   └── index.blade.php
│       ├── reports/
│       │   └── index.blade.php
│       └── notifications/
│           └── index.blade.php
└── routes/
    ├── web.php
    └── api.php
```

## 📊 Database Schema

### Users (Teachers)
- id, name, email, password, timestamps

### Students
- id, student_id (unique), teacher_id (FK), name, email, year, department, status, timestamps

### Projects
- id, student_id (FK), title, description, project_type, start_date, end_date, progress, status, timestamps

### Reports
- id, project_id (FK), week_number, content, submission_date, status, grade, timestamps

### Notifications
- id, teacher_id (FK), message, type, is_read, timestamps

## 🎨 YDU Brand Colors

The application uses the following color scheme:

- **Primary**: `#7A001E` (Burgundy)
- **Secondary**: `#2E2E2E` (Dark Gray)
- **Background**: `#F5F5F5` (Light Gray)
- **White**: `#FFFFFF`

## 🔧 API Routes

All API routes are protected with `auth:sanctum` middleware:

```
GET    /api/students           - List all students
POST   /api/students           - Create new student
GET    /api/students/{id}      - Get student details
PUT    /api/students/{id}      - Update student
DELETE /api/students/{id}      - Delete student

GET    /api/projects           - List all projects
POST   /api/projects           - Create new project
GET    /api/projects/{id}      - Get project details
PUT    /api/projects/{id}      - Update project
DELETE /api/projects/{id}      - Delete project

GET    /api/reports            - List all reports
POST   /api/reports            - Create new report
GET    /api/reports/{id}       - Get report details
PUT    /api/reports/{id}       - Update report
DELETE /api/reports/{id}       - Delete report

GET    /api/notifications      - List all notifications
POST   /api/notifications      - Create notification
PATCH  /api/notifications/{id}/read - Mark as read
DELETE /api/notifications/{id} - Delete notification
```

## 🔐 Authorization

The system uses Laravel Policies to ensure:
- Teachers can only view/edit their own students
- Teachers can only access projects of their students
- Teachers can only manage their own notifications

## 📱 Features Implemented

### Dashboard
- Statistics cards (students, projects, reports)
- Recent projects list
- Recent notifications
- Quick navigation

### Students
- Grid view with student cards
- Search by name, email, or student ID
- Filter by status and department
- Add/Edit/Delete functionality
- View student details and projects

### Projects
- Grid view with project cards
- Progress bars
- Search and filter functionality
- Status tracking (Planning, In Progress, Review, Completed)
- Project type classification (Research/Development)

### Reports
- Table view with detailed information
- Week-based organization
- Status tracking (Submitted, Review, Overdue)
- Grade assignment
- Search and filter capabilities

### Notifications
- Real-time notification list
- Type-based filtering (deadline, overdue, system, reminder)
- Mark as read functionality
- Visual indicators for unread notifications

## 🧪 Testing

Run migrations in test environment:

```bash
php artisan migrate --env=testing
```

## 🐛 Troubleshooting

### Vite Build Errors

If you encounter Vite build errors:

```bash
npm run build
```

### Permission Issues (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 📝 Notes

- Default timezone is set to UTC. Update in `config/app.php` if needed.
- File uploads are stored in `storage/app/public`
- Logs are stored in `storage/logs`

## 🤝 Contributing

This project is part of a graduation project for YDU (Yeditepe University).

## 📄 License

This project is created for educational purposes.

---

**Developed with ❤️ using Laravel 11, TypeScript, and TailwindCSS**

