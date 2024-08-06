# Multi-Level Affiliate Payout System

This project is a Laravel application that manages a 5-level affiliate payout system. The application tracks sales made by users and distributes commission payouts up to the 5th level of the affiliate hierarchy.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Database Configuration](#database-configuration)
- [Importing SQL File](#importing-sql-file)
- [Running Migrations](#running-migrations)
- [Usage](#usage)
- [Testing](#testing)
- [License](#license)

## Requirements

- PHP >= 8.0
- Composer
- MySQL
- Laravel 10

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/affiliate-payout-system.git
    cd affiliate-payout-system
    ```

2. Install the dependencies:

    ```bash
    composer install
    ```

3. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

4. Generate the application key:

    ```bash
    php artisan key:generate
    ```

## Database Configuration

1. Open the `.env` file and update the following lines with your database credentials:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

## Importing SQL File

1. Navigate to the `sqlfiles` folder and import the SQL file into your MySQL database:

    ```bash
    mysql -u your_database_username -p your_database_name < sqlfiles/your_sql_file.sql
    ```

    Replace `your_database_username`, `your_database_name`, and `your_sql_file.sql` with your actual database username, database name, and the SQL file name.

## Running Migrations

1. Run the database migrations:

    ```bash
    php artisan migrate
    ```

## Usage

### Adding Users

To add a new user, navigate to the `/add-user` page and fill out the form with the user's name, email, password, and optionally select a parent user. Click "Add User" to save the new user.

### Recording Sales

To record a sale, navigate to the `/record-sale` page, select the user who made the sale, and enter the sale amount. Click "Record Sale" to save the sale and distribute the commissions.

## Testing

1. Run the tests:

    ```bash
    php artisan test
    ```

## License

This project is open-source and available under the [MIT license](LICENSE).
