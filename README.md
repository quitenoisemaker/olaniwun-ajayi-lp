# Laravel Project Management System with Database Assessment

This repository contains a Laravel application implementing **Part 1: User Management and Project Management** and **Part 2: Database Assessment – Advanced SQL and Modelling**. The application provides a robust admin panel and a RESTful API for managing users, projects, tasks, and assessment queries.

## Table of Contents
- [Overview](#overview)
- [Features](#features)
  - [Part 1: User Management and Project Management](#part-1-user-management-and-project-management)
  - [Part 2: Database Assessment](#part-2-database-assessment)
- [Installation](#installation)
  - [Prerequisites](#prerequisites)
  - [Setup Steps](#setup-steps)
- [API Documentation](#api-documentation)
- [Database Schema](#database-schema)

## Overview
This Laravel-based web application demonstrates advanced PHP/Laravel development skills, including:
- **Part 1**: A user management system with CRUD operations, extended to include project and task management with a responsive Bootstrap 4 UI.
- **Part 2**: Solutions to a database assessment task involving SQL queries and Laravel integration for employee, department, and project data, exposed via a RESTful API.

The application uses Laravel’s Eloquent ORM, resourceful routes, Form Request validation, AJAX for dynamic search, and a RESTful API for programmatic access.

## Features

### Part 1: User Management and Project Management
- **User Management**:
  - CRUD operations for users (`name`, `email`, `role_id`, `is_active`, `salary`, `department_id`).
  - AJAX-powered search by name, email, or role.
  - Toggle user activation status.
- **Project Management**:
  - CRUD operations for projects (`title`, `description`) using resourceful routes.
  - Nested task management (`title`, `description`, `project_id`, `assigned_user_id`, `is_completed`) with CRUD operations.
  - Sample projects and tasks seeded for testing.

### Part 2: Database Assessment
The assessment involves three tasks using the provided schema (`Employees`, `Departments`, `Projects`). The solutions are integrated into the existing project by mapping `Employees` to `Users` and reusing the `Projects` table, with results exposed via API endpoints.

#### Task 1: Retrieve a List of Employees with Their Department Names
- **SQL Query**:
  ```sql
  SELECT e.id, e.name AS employee_name, COALESCE(d.name, 'N/A') AS department_name
  FROM employees e
  LEFT JOIN departments d ON e.department_id = d.id;
  ```
- **API Endpoint**: `GET /api/v1/employees`
- **Output**: Lists all employees with their department names (e.g., Alice Johnson - Legal).

#### Task 2: Find Total Salary Expenditure per Department
- **SQL Query**:
  ```sql
  SELECT d.id, d.name AS department_name, COALESCE(SUM(e.salary), 0) AS total_salary
  FROM departments d
  LEFT JOIN employees e ON d.id = e.department_id
  GROUP BY d.id, d.name;
  ```
- **API Endpoint**: `GET /api/v1/departments/salary`
- **Output**: Shows total salary per department (e.g., Legal: 122,000.00).

#### Task 3: List Employees Working on More Than One Project
- **SQL Query**:
  ```sql
  SELECT e.id, e.name AS employee_name, COUNT(p.id) AS project_count
  FROM employees e
  JOIN projects p ON e.id = p.employee_id
  GROUP BY e.id, e.name
  HAVING COUNT(p.id) > 1;
  ```
- **API Endpoint**: `GET /api/v1/employees/multiple-projects`
- **Output**: Lists employees with multiple projects (e.g., Alice Johnson, 2 projects).

## Installation

### Prerequisites
- **PHP**: 8.1 or higher
- **Composer**: Latest version
- **Node.js**: For compiling assets
- **MySQL**: Database server
- **Git**: For cloning the repository

### Setup Steps
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/quitenoisemaker/olaniwun-ajayi-lp.git
   cd <olaniwun-ajayi-lp>
   ```

2. **Install PHP Dependencies**:
   ```bash
   composer install
   ```

3. **Install JavaScript/CSS Dependencies**:
   ```bash
   npm install
   npm run dev
   ```

4. **Configure Environment**:
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update `.env` with your database credentials:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```
   - Generate an application key:
     ```bash
     php artisan key:generate
     ```

5. **Run Migrations**:
   - Create and migrate the database schema:
     ```bash
     php artisan migrate
     ```
   - The migrations create tables: `users`, `roles`, `projects`, `tasks`, `departments`, `employees`, `employee_projects`.

6. **Run Seeders**:
   - Populate the database with sample data:
     ```bash
     php artisan db:seed
     ```
   - Sample admin credentials: `admin@example.com` / `password`

7. **Start the Development Server**:
   ```bash
   php artisan serve
   ```
   - Access the web app at `http://localhost:8000`.
   - Access the API at `http://localhost:8000/api/v1/*`.

## API Documentation
The API provides endpoints for the database assessment tasks and optional user/project management. Test using tools like Postman or cURL.

### Endpoints
| Method | Endpoint                              | Description                                   | Response Example                                                                 |
|--------|---------------------------------------|-----------------------------------------------|----------------------------------------------------------------------------------|
| GET    | `/api/v1/employees`                   | List employees with department names          | `{"success": true, "data": [{"id": 1, "employee_name": "Alice Johnson", "department_name": "Legal"}, ...]}` |
| GET    | `/api/v1/departments/salary`          | Total salary expenditure per department       | `{"success": true, "data": [{"id": 1, "department_name": "Legal", "total_salary": 122000.00}, ...]}` |
| GET    | `/api/v1/employees/multiple-projects` | Employees with multiple projects              | `{"success": true, "data": [{"id": 1, "employee_name": "Alice Johnson", "project_count": 2}, ...]}` |
| GET    | `/api/v1/users`                      | List all users with roles and departments     | `{"success": true, "data": [{"id": 1, "name": "Alice Johnson", "email": "...", "department": {...}}, ...]}` |
| GET    | `/api/v1/projects`                   | List all projects with assigned users         | `{"success": true, "data": [{"id": 1, "title": "CMS Upgrade", "assigned_user": {...}}, ...]}` |

### Testing the API
- Use Postman or cURL to send requests:
  ```bash
  curl http://localhost:8000/api/v1/employees
  ```
- Expected response format:
  ```json
  {
      "success": true,
      "data": [...]
  }
  ```
## Technologies Used
- **Laravel**: 8.x
- **PHP**: 7.4+
- **MySQL**: Database for storing users, projects, tasks, and departments
- **Bootstrap**: 4.5.2 for responsive UI
- **jQuery**: 3.2.1 for AJAX search and dynamic interactions
- **Blade**: Templating engine for views
