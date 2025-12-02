Contacts App

A simple PHP MVC application built as a technical challenge.  
It includes a complete CRUD for managing contacts, a custom router, and a MySQL database integration.  
The project uses Composer with PSR-4 autoloading and a clean folder structure.

Features

- Create, Read, Update and Delete contacts  
- Pure PHP MVC architecture  
- Custom Router (no frameworks)  
- MySQL database integration  
- Organized PSR-4 autoloading via Composer  
- Clean structure following best practices  
- Basic form validation  
- Simple UI for listing and managing contacts  

Project Structure

project/
│
├── app/
│ ├── Controllers/
│ ├── Models/
│ ├── Views/
│ └── Core/ (Router + Database classes)
│
├── public/
│ └── index.php (entry point)
│
├── vendor/
├── composer.json
└── database.sql

Technologies Used

- *PHP 8.5*
- *MySQL*
- *Composer (PSR-4 Autoload)*
- *HTML/CSS*

How to Run the Project

1. Clone this repository:

```bash
git clone https://github.com/Countrywine667/contatos-app.git

Install dependencies:

composer install


Configure your MySQL connection in:

app/Core/Database.php


Run the PHP development server:

php -S localhost:8000 -t public


Open the browser:

http://localhost:8000
