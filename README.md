# Eventus Management System

Eventus is a web application for managing university events, study rooms, friend requests and event bookings.

## Tech Stack

- **Backend**: Laravel 8, Jetstream, Fortify
- **Frontend**: Vue.js, Inertia.js
- **Real-Time**: Pusher, Laravel Echo
- **Styling**: TailwindCSS, Standard CSS
- **Database**: MySQL
- **Authentication**: Laravel Fortify, Jetstream

## System Requirements
Note: This project uses Laravel Fortify for authentication, Jetstream for scaffolding, and Inertia.js for front-end routing.

This project was developed using the following versions:

Laravel Framework: 8.83.29
MAMP Version: 7.2
PHP Version: 8.3.14
MySQL Version: 9.3.0 (installed via Homebrew)
phpMyAdmin Version: 5.2.1 (accessible at http://localhost:8888/phpMyAdmin)

⚠️ Note: These exact versions are not strictly required to run the project. As long as your environment meets Laravel’s minimum requirements (PHP ≥ 7.3 and a supported MySQL version), the application should function correctly. Adjust your setup accordingly based on your local development tools.

## Features
Note: This project uses Laravel Fortify for authentication, Jetstream for scaffolding, and Inertia.js for front-end routing.

- User Authentication (Registration, Login, Password Reset, etc.)
- Create and Manage University Events (CRUD)
- Comment on Events
- Creating and Joining Study Rooms
- Accepting and Declining Friend Requests
- Event Ticket Reservations

## Authentication Flow

1. **Registration**: Managed by **Fortify**, creates users and profiles.
2. **Login**: Handled by **Fortify** for session and API login.
3. **Password Reset**: **Fortify** handles secure password resets.
4. **Profile Updates**: Managed through **Jetstream** and **Fortify**.
5. **Password Change**: Handled by **Fortify**, checking current password.
6. **Account Deletion**: Managed by **Jetstream**, deletes user and data.

## Installation

1. Clone the repo:
   
   git clone https://github.com/your-username/Eventus+Management.git
   
cd Eventus Management


2. **Install PHP dependencies**

composer install


3. **Install JavaScript dependencies**

npm install

4. **Verify the environment file**

Ensure the `.env` file exists with the following database setup:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=eventus_management
DB_USERNAME=root
DB_PASSWORD=root

5. **Run migrations**

php artisan migrate


6. **Build front-end assets**

npm run dev

7. **Start the development server**

php artisan serve


8. **Access the app**

Visit `http://localhost:8000` in your browser.

## MAMP Setup Notes
Download MAMP from https://www.mamp.info/

Start the MySQL server from MAMP.

**Access phpMyAdmin 5 at http://localhost:8888/phpMyAdmin5**

- Default credentials:
Username: root
Password: root

- MySQL port: 8889 (used in .env)

- Ensure a database named eventus_management exists in phpMyAdmin.

If it already exists, just run:

php artisan migrate

- If the database doesn't already exist, create a new database called 'eventus_management' and then execute the database migrations by running:

php artisan migrate

## References

1. [Laravel 8: Jetstream + Inertia and Vue Walkthrough](https://www.youtube.com/watch?v=XbkY8VM6EK4) — A helpful video used during development.

2. [Laravel From Scratch | 4+ Hour Course](https://www.youtube.com/watch?v=MYyJ4PuL4pY&t=13933s)- An insightful video for understanding Laravel and helping to implement my project.
