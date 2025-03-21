# PHP Visa Management System

## Overview
This project is a PHP-based application for managing visa categories and client information. It provides functionalities for adding, editing, and deleting both visa categories and clients.

## Project Structure
```
php-visa-management
├── public
│   ├── index.php
│   ├── add-client.php
│   ├── add-visa.php
│   ├── edit-client.php
│   ├── edit-visa.php
│   ├── delete-client.php
│   ├── delete-visa.php
│   └── assets
│       ├── css
│       │   └── style.css
│       └── js
│           └── script.js
├── src
│   ├── config
│   │   └── dbconfig.php
│   ├── functions
│   │   ├── visaFunctions.php
│   │   └── clientFunctions.php
│   ├── includes
│   │   ├── header.php
│   │   └── footer.php
│   └── controllers
│       ├── VisaController.php
│       └── ClientController.php
├── vendor
│   └── autoload.php
├── composer.json
├── composer.lock
└── README.md
```

## Installation
1. Clone the repository to your local machine.
2. Navigate to the project directory.
3. Run `composer install` to install the necessary dependencies.
4. Configure your database settings in `src/config/dbconfig.php`.

## Usage
- Access the application through `public/index.php`.
- Use the navigation to add, edit, or delete clients and visa categories.
- Ensure that your server environment supports PHP and has the required extensions enabled.

## Dependencies
This project uses Composer for dependency management. The required packages are listed in `composer.json`.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.