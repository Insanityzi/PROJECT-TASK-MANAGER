# PROJECT-TASK-MANAGER

Project Code: WST21-PM-2026-SF
Student Name: [Arven Q. Sotero]
Course & Year: [BSIT-2]
Database Used: SQLite

## Features
- Add Task
- View Tasks
- Edit Task
- Delete Task
- Update Status

## Project Overview
This repository contains a personal task manager built with Laravel. The app demonstrates a full route-to-controller-to-model-to-database-to-Blade flow for creating and managing tasks.

## Setup
1. Open the project folder.
2. Run `composer install`.
3. Generate the app key with `php artisan key:generate`.
4. Run `php artisan migrate`.
5. Start the app with `php artisan serve`.
6. Visit `http://127.0.0.1:8000`.

## Notes
The application stores tasks with a name, description, status, and due date and supports both task editing and status updates.
