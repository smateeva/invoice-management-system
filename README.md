# Simple Invoice Management System

## Overview
The Simple Invoice Management System is a web application built with Laravel that allows authenticated users to create, view, update, and delete invoices. Users can also add multiple line items to each invoice, making it easy to manage billing for various services or products.

## Requirements
- **PHP**: 8.2.4
- **Composer**: 2.6.5
- **XAMPP**: v3.3.0 (includes MySQL)
- **Laravel**: This project uses the Laravel framework.

## Setup and Installation

### 1. Clone the repository:
<pre><code>
    git clone https://github.com/your-username/invoice-management-system.git
</code></pre>
<pre><code>
   cd invoice-management-system
    </code></pre>
   
### 2. Install dependencies:
   <pre><code>
   composer install
    </code></pre>
   
### 3. Create a _**.env**_ file: Copy the _**.env.example**_ file to _**.env**_:
   <pre><code>
   cp .env.example .env
   </code></pre>
   
### 4. Set up the database:
   - Open XAMPP Control Panel and start the Apache and MySQL services.
   - Open phpMyAdmin by http://localhost/phpmyadmin.
   - Create a new database (invoice-management-system).
   - Update _**.env**_
   <pre><code>
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=invoice-management-system 
    DB_USERNAME=root                 
    DB_PASSWORD=
    </code></pre>
### 5. Generate an application key:
   <pre><code>
   php artisan key:generate
    </code></pre>

### 6. Run migrations:
   <pre><code>
   php artisan migrate
   </code></pre>
   
### 7. Start the local development server:
   <pre><code>
   php artisan serve
   </code></pre>
