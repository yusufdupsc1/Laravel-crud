# Laravel Task CRUD Application

This is a simple Laravel application demonstrating basic Create, Read, Update, and Delete (CRUD) operations for tasks. It's built to showcase professional development practices, including clean code, robust testing, and clear documentation.

## Features

*   **Task Management**: Create, view, edit, and delete tasks.
*   **Form Request Validation**: Utilizes Laravel Form Request objects for clean and reusable validation logic.
*   **Comprehensive Testing**: Includes feature tests to ensure the reliability of CRUD operations.
*   **Flash Messages**: Provides user feedback on successful operations.

## Technologies Used

*   PHP 8.2+
*   Laravel Framework 10.x
*   MySQL (or other database supported by Laravel)
*   Composer
*   NPM (for frontend asset compilation)

## Setup Instructions

Follow these steps to get the project up and running on your local machine.

### 1. Clone the Repository

```bash
git clone <repository-url>
cd gemini-laravel-crud
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Environment Configuration

Copy the example environment file and generate an application key:

```bash
cp .env.example .env
php artisan key:generate
```

Then, edit the `.env` file to configure your database connection. For example, for MySQL:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_crud
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Migrations

Run the database migrations to create the necessary tables:

```bash
php artisan migrate
```

### 5. Install Frontend Dependencies (if any)

```bash
npm install
npm run dev
```

### 6. Start the Local Development Server

```bash
php artisan serve
```

You can now access the application at `http://127.0.0.1:8000/tasks`.

## How to Run Tests

The project includes feature tests to ensure the functionality works as expected.

To run all tests, use the following Artisan command:

```bash
php artisan test
```

## Contributing

Feel free to fork the repository, make improvements, and submit pull requests.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
