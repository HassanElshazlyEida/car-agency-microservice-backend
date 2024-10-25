<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Task

1. API Development:
	- User Registration: Implement user registration with validation (name, email, phone number, and password).
	- User Login: Implement login functionality using either email or phone number and password. Return a JSON Web Token (JWT) upon successful login.
	- CRUD Operations: Build a CRUD API for managing a "Car" entity (fields: car name, model, price, availability status).
2. WebSocket Implementation:
	- Implement WebSocket communication in Laravel (using pusher, laravel-echo, or similar) for real-time updates. Example: Send real-time updates when a new car is added, modified, or deleted.
	- Ensure clients can receive real-time notifications in the Flutter app when car details are updated.
3. Microservice Architecture:
	- Refactor part of the application to use microservice architecture, e.g., separating user authentication and car management into two services. Use queues or event-based communication between services if needed.
	- Provide documentation explaining how you structured the services and how they communicate with each other.
4. Database Design:
	- Provide the database schema (migration files) for the user and car entities.
5. Security:
	- Ensure that your API endpoints are secured with JWT authentication.
6. Error Handling:
	- Implement proper error handling and validation for all API endpoints.