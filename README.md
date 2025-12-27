# StoreTerate (Smart Bazaar Template)

This is an E-commerce web application template customized as "StoreTerate". It features a responsive design, product listings, shopping cart functionality, and an admin panel.

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

## Known Issues (Missing Files)
Some files referenced in the code appear to be missing from the repository:
- `products.html`/`products.php` (and numbered variants `products1` to `products9`)
- `single.html`/`single.php`

Links to these pages may result in 404 errors until the files are created.
