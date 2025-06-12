# Learner Progress Dashboard

A Laravel-based application to track learner progress across various courses. Users can view and filter learners by course and sort them by progress percentage.

## 🧰 Requirements

Ensure the following are installed on your Linux system:

- PHP >= 8.1
- Composer
- Laravel 10 or 11 (handled by Composer)
- MySQL or SQLite
- Node.js & NPM (for frontend assets, if extended later)
- Git (optional but recommended)

---

## 🚀 Getting Started

### 1. Clone the Repository

``bash
git clone https://github.com/Strycho/learner-progress-dashboard.git

cd learner-progress-dashboard

2. Install Dependencies

composer install

3. Setup Environment

cp .env.example .env
php artisan key:generate

Edit .env and configure your database settings:

DB_CONNECTION=sqlite
DB_DATABASE=./database/database.sqlite

4. Run Migrations and Seeders

Make sure your database exists, then:

php artisan migrate --seed

This seeds learners, courses, and enrolments data.
5. Serve the Application

php artisan serve

The app will be available at http://127.0.0.1:8000
📘 Features

    /learner-progress – View learners and filter by course

    Sort learners by progress (ascending/descending toggle)

    API Endpoint: /api/learners?course=Course+Name

📂 File Overview

Path	                                                Purpose
routes/web.php	                                        Displays the learner progress Blade view
routes/api.php	                                        API endpoint for fetching learner data
app/Http/Controllers/Api/LearnerProgressController.php	Handles both Blade and JSON responses
resources/views/learner-progress.blade.php	            Frontend HTML with JS logic
database/seeders	                                    Populates test data for learners, courses, enrolments
✅ Testing

To verify it's working:

    Visit /learner-progress

    Use the course filter dropdown

    Click the Sort by Progress button to toggle sorting

📌 Notes

    This setup assumes local development. Use php artisan config:cache and php artisan route:cache for production.

    No authentication or admin features are included by default.
