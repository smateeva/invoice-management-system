# Simple Invoice Management System

## Overview
The Simple Invoice Management System is a web application built with Laravel that allows authenticated users to create, view, update, and delete invoices. Users can also add multiple line items to each invoice, making it easy to manage billing for various services or products.

## Requirements
- **PHP**: 8.2.4
- **Composer**: 2.6.5
- **XAMPP**: v3.3.0 (includes MySQL)
- **Laravel**: This project uses the Laravel framework.

## Setup and Installation

1. Clone the repository:
   git clone https://github.com/your-username/invoice-management-system.git
   cd invoice-management-system
   
2. Install dependencies:
   ``bash
   composer install
   
3. Create a <b>.env</b> file: Copy the <b>.env.example</b> file to <b>.env</b>:
   ``bash
   cp .env.example .env
   
4. Set up the database:
   - Open XAMPP Control Panel and start the Apache and MySQL services.
   - Open phpMyAdmin by http://localhost/phpmyadmin.
   - Create a new database (invoice-management-system).
   - Update <b>.env</b>
   ``bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=invoice-management-system 
    DB_USERNAME=root                 
    DB_PASSWORD=

5. Generate an application key:
   ``bash
   php artisan key:generate

6. Run migrations:
   ``bash
   php artisan migrate
   
7. Start the local development server:
   ``bash
   php artisan serve    
