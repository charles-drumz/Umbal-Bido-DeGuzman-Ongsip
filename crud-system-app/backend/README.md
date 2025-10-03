# CRUD System with User Authentication

This project is a CRUD application built with Laravel for the backend and Vue.js for the frontend. It includes user authentication (login and registration) and allows users to import data from CSV/Excel files.

## Features

- User authentication (login and register)
- Full CRUD functionality for a chosen resource
- Import users from CSV/Excel files
- RESTful API for handling requests
- Vue.js frontend for a responsive user interface

## Backend Setup

1. **Clone the repository:**
   ```
   git clone <repository-url>
   cd crud-system-app/backend
   ```

2. **Install dependencies:**
   ```
   composer install
   ```

3. **Set up the environment file:**
   Copy the example environment file and configure your database settings.
   ```
   cp .env.example .env
   ```

4. **Generate application key:**
   ```
   php artisan key:generate
   ```

5. **Run migrations:**
   ```
   php artisan migrate
   ```

6. **Start the server:**
   ```
   php artisan serve
   ```

## Frontend Setup

1. **Navigate to the frontend directory:**
   ```
   cd ../frontend
   ```

2. **Install dependencies:**
   ```
   npm install
   ```

3. **Run the development server:**
   ```
   npm run serve
   ```

## API Endpoints

- **POST /api/register** - Register a new user
- **POST /api/login** - Authenticate a user
- **GET /api/resources** - Get a list of resources
- **POST /api/resources** - Create a new resource
- **PUT /api/resources/{id}** - Update an existing resource
- **DELETE /api/resources/{id}** - Delete a resource
- **POST /api/resources/import** - Import resources from a CSV/Excel file

## Testing

Run the tests using:
```
php artisan test
```

## License

This project is licensed under the MIT License.