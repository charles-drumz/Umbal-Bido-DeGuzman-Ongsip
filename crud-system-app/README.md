# CRUD System Application

This project is a CRUD (Create, Read, Update, Delete) system built with Laravel for the backend and Vue.js for the frontend. It includes user authentication features such as login and registration, as well as the ability to import users from a CSV/Excel file.

## Project Structure

The project is organized into two main directories: `backend` and `frontend`.

### Backend

- **app**: Contains the core application logic, including models, controllers, and middleware.
- **bootstrap**: Contains files for bootstrapping the Laravel application.
- **config**: Contains configuration files for various services and settings.
- **database**: Contains database migrations, seeders, and factories.
- **public**: Contains the public assets of the Laravel application.
- **resources/views**: Contains Blade templates for rendering views.
- **routes/api.php**: Defines the API routes for user authentication and CRUD operations.
- **storage**: Used for storing logs, cache, and other generated files.
- **tests**: Contains test cases for ensuring functionality works as expected.
- **composer.json**: Lists the dependencies required for the Laravel application.
- **.env.example**: Example environment configuration file.

### Frontend

- **src/assets**: Contains static assets such as images, fonts, and stylesheets.
- **src/components/Auth**: Contains Vue components for user authentication (Login and Register).
- **src/components/Resource**: Contains Vue components for managing resources (list, form, and import).
- **src/router/index.js**: Defines the routes for the Vue.js application.
- **src/store/index.js**: Sets up the Vuex store for state management.
- **src/views**: Contains Vue components for the home page and dashboard.
- **src/App.vue**: The root component of the Vue.js application.
- **public**: Contains the public assets of the Vue.js application.
- **package.json**: Lists the dependencies and scripts for the Vue.js application.

## Features

- User authentication (Login and Register)
- Full CRUD functionality for a chosen resource
- User import from CSV/Excel file

## Setup Instructions

1. Clone the repository.
2. Navigate to the `backend` directory and run `composer install` to install PHP dependencies.
3. Copy `.env.example` to `.env` and configure your database settings.
4. Run `php artisan migrate` to set up the database.
5. Navigate to the `frontend` directory and run `npm install` to install JavaScript dependencies.
6. Run `npm run serve` to start the Vue.js application.
7. Access the application in your web browser.

## License

This project is open-source and available under the MIT License.