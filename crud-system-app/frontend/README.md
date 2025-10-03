# Frontend CRUD System with User Authentication

This project is a CRUD application built with Vue.js for the frontend and Laravel for the backend. It includes user authentication (login and registration) and allows users to manage resources with full CRUD functionality. Additionally, users can import resources from CSV/Excel files.

## Features

- User Authentication
  - Login
  - Register
- Full CRUD functionality for resources
- Import resources from CSV/Excel files
- Vue.js frontend with Vue Router and Vuex for state management
- Laravel backend with API routes for handling requests

## Project Structure

```
crud-system-app
├── backend
│   ├── app
│   ├── bootstrap
│   ├── config
│   ├── database
│   ├── public
│   ├── resources
│   │   └── views
│   ├── routes
│   │   └── api.php
│   ├── storage
│   ├── tests
│   ├── composer.json
│   ├── .env.example
│   └── README.md
├── frontend
│   ├── src
│   │   ├── assets
│   │   ├── components
│   │   │   ├── Auth
│   │   │   │   ├── Login.vue
│   │   │   │   └── Register.vue
│   │   │   ├── Resource
│   │   │   │   ├── ResourceList.vue
│   │   │   │   ├── ResourceForm.vue
│   │   │   │   └── ImportResource.vue
│   │   ├── router
│   │   │   └── index.js
│   │   ├── store
│   │   │   └── index.js
│   │   ├── views
│   │   │   ├── Home.vue
│   │   │   └── Dashboard.vue
│   │   └── App.vue
│   ├── public
│   ├── package.json
│   └── README.md
└── README.md
```

## Getting Started

### Prerequisites

- Node.js and npm installed
- Laravel installed
- Composer installed

### Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   cd crud-system-app
   ```

2. Set up the backend:
   - Navigate to the `backend` directory:
     ```
     cd backend
     ```
   - Install dependencies:
     ```
     composer install
     ```
   - Set up the environment file:
     ```
     cp .env.example .env
     ```
   - Generate the application key:
     ```
     php artisan key:generate
     ```
   - Run migrations:
     ```
     php artisan migrate
     ```

3. Set up the frontend:
   - Navigate to the `frontend` directory:
     ```
     cd ../frontend
     ```
   - Install dependencies:
     ```
     npm install
     ```

4. Run the applications:
   - Start the backend server:
     ```
     php artisan serve
     ```
   - Start the frontend development server:
     ```
     npm run serve
     ```

## Usage

- Access the application in your browser at `http://localhost:8080` (or the port specified by your Vue.js server).
- Use the login and registration forms to authenticate users.
- Manage resources through the provided CRUD interface.
- Import resources using the import functionality.

## Contributing

Contributions are welcome! Please open an issue or submit a pull request for any improvements or features.

## License

This project is licensed under the MIT License.