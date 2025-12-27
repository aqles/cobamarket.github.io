# StoreTerate (Smart Bazaar Template)

This is an E-commerce web application template customized as "StoreTerate". 

## Features

- **Responsive Design**: Built with Bootstrap for mobile-friendly layouts.
- **Product Management**: Browse products by category (Electronics, Fashion, etc.).
- **Shopping Cart**: Add items, view cart, and checkout.
- **Order Tracking**: Track order status from payment to delivery (Paid, Shipped, Delivered, Completed).
- **Admin Panel**: Manage products and transactions.

## Technology Stack

- **Frontend**: HTML5, CSS3, JavaScript (jQuery, Bootstrap)
- **Backend**: PHP (Refactored to support PHP 7+)
- **Database**: MySQL

## Improvements & Fixes

The following improvements and fixes have been applied to the original codebase:
1.  **Modernized PHP Code**: Refactored the entire database layer (`root.php` and `admin/root.php`) to use `mysqli` instead of the obsolete `mysql_*` functions. This ensures compatibility with modern PHP versions (PHP 7+).
2.  **File Extensions**: Renamed all dynamic `.html` files to `.php` (e.g., `index.html` -> `index.php`, `checkout.html` -> `checkout.php`) to ensure PHP code is executed correctly.
3.  **Link Updates**: Updated internal links to point to the correct `.php` files.
4.  **Typo Fixes**: Renamed `fotter.php` to `footer.php` and updated all include references.
5.  **Security**: Added basic SQL escaping (`real_escape_string`) to prevent SQL injection in login and data insertion functions.

## Installation & Setup

### Prerequisites
- A local web server environment like **XAMPP**, **MAMP**, or **WAMP**.
- PHP 7.0 or higher.
- MySQL Database.

### Steps
1.  **Clone the Repository**:
    Place the project folder into your web server's root directory (e.g., `htdocs` for XAMPP).
2.  **Database Setup**:
    - Open phpMyAdmin (usually `http://localhost/phpmyadmin`).
    - Create a new database named `db_terate`.
    - Import the `db_terate.sql` file provided in the root directory.
3.  **Configuration**:
    - The database connection is configured in `root.php` and `admin/root.php`.
    - Default credentials:
        - Host: `localhost`
        - User: `root`
        - Password: `` (empty)
        - DB Name: `db_terate`
    - If your MySQL configuration differs, update the `__construct` method in both files.
4.  **Run the Application**:
    - Open your browser and navigate to `http://localhost/cobamarket.github.io/` (or your project folder name).

### Admin Panel
- Access the admin panel at: `http://localhost/your-project/admin/`
- Default Credentials (from SQL dump):
    - Username: `admin`
    - Password: `admin`

## Important Note on Hosting
This project utilizes **PHP**, which requires a server-side processor. It will **NOT** work on static hosting services like **GitHub Pages** (which only supports HTML/CSS/JS). Use a hosting provider that supports PHP and MySQL.



## License & Attribution

This project is built upon the **Smart Bazaar** template designed by [W3Layouts](http://w3layouts.com).

- **Template Name**: Smart Bazaar
- **License**: Creative Commons Attribution 3.0 Unported
- **Author**: W3Layouts

Even though this project has been heavily modified by me, the original design credit goes to W3Layouts. Please respect their licensing terms by keeping the footer credits or purchasing a license if you intend to remove them.
