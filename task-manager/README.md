# Personal Task Manager

Project Code: WST21-PM-2026-SF
Student Name: [Your Name]
Course & Year: [Course & Year]
Database Used: SQLite

## Features
- Add Task
- View Tasks
- Edit Task
- Delete Task
- Update Status

## Project Overview
This project is a simple personal task management system built with Laravel. It allows a user to add, view, edit, delete, and update the status of tasks using a database-backed CRUD workflow.

## Setup Instructions
1. Open the project folder.
2. Run `composer install`.
3. Copy `.env.example` to `.env`.
4. Generate the app key: `php artisan key:generate`.
5. Run the database migration: `php artisan migrate`.
6. Start the local server: `php artisan serve`.
7. Open `http://127.0.0.1:8000` in the browser.

## Database
This project uses SQLite for local development.

## Notes
The system follows the project flow of route -> controller -> model -> database -> Blade view and demonstrates a functional Laravel task manager.
