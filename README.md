# Wardrobe Management System

## Overview
The **Wardrobe Management System** is a web application built using Laravel 11 and Vue 3. It enables users to manage their wardrobe efficiently by organizing clothing items, tracking outfits, and planning wardrobe selections.

## Features
- User authentication with Laravel Sanctum
- Intuitive dashboard for wardrobe management
- Categorization of clothing items
- Outfit planning and recommendations
- Responsive UI built with Vue 3
- RESTful API for seamless frontend-backend integration

## Repository Structure
This repository consists of two main folders:
- `wardrobe-backend` - Laravel 11 backend
- `wardrobe-frontend` - Vue 3 frontend

## Prerequisites
Ensure your system has the following installed:
- PHP 8.1+
- MySQL
- Composer
- Node.js & NPM
- Laravel 11
- PowerShell (for Windows users)

## Installation Guide

### 1. Clone the Repository
Open PowerShell and run:
```sh
 git clone https://github.com/brunoadul/wardrobe-management-system.git
```

### 2. Navigate to the Backend Directory
```sh
cd wardrobe-management-system/wardrobe-backend
```

### 3. Install Backend Dependencies
```sh
composer install
```

### 4. Configure Environment Variables
Copy the example environment file:
```sh
cp .env.example .env
```
Then, update the `.env` file with your database credentials.

### 5. Generate Application Key
```sh
php artisan key:generate
```

### 6. Run Database Migrations
```sh
php artisan migrate --seed
```

### 7. Navigate to the Frontend Directory
```sh
cd ../wardrobe-frontend
```

### 8. Install Frontend Dependencies
```sh
npm install
```

### 9. Build Frontend Assets
If any changes are made to the frontend, you need to rebuild it:
```sh
npm run build
```

### 10. Start the Application
Go back to the backend directory and serve the application:
```sh
cd ../wardrobe-backend
php artisan serve
```
The application will be available at `http://127.0.0.1:8000`.

## API Authentication
This project uses Laravel Sanctum for authentication. Ensure you configure it properly in your frontend to manage authentication tokens.

## Contribution
Contributions are welcome! Feel free to fork the repository, create a new branch, and submit a pull request.

## License
This project is licensed under the MIT License.

## Contact
For any inquiries, feel free to contact [brunoadul](https://github.com/brunoadul) on GitHub.

