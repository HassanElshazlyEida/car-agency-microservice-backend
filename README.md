# Documentation
-  [Microservices Interaction](#microservices-interaction)
-  [Project Management Script](#project-management-script)
-  [Postman API Collection ](#postman-api-collection)
-  [Bonus Features](#bonus-features)

## Microservices Interaction
### Overview
In this architecture, we have two main microservices: User Service and Car Service. They interact with each other through API requests, token-based authentication, and event-driven communication. Below is a detailed description of how these microservices work together.

### User Service
- The User Service manages JWT (JSON Web Token) authentication independently from the Car Service.
- It provides a middleware for protecting routes, ensuring that only authenticated users can access certain endpoints.

- Example User Service Middleware
	```bash
	Route::middleware('auth:api')->group(function() {
		Route::get('/user', [AuthController::class, 'user']);
	});
	```
- Users can authenticate themselves and obtain a token, which they can inject into the Car Service API endpoints for secure access.
### Car Service
- The Car Service uses the JWT provided by the user to authenticate requests against the User Service.
- It sends API requests to the User Service to validate the user’s token. If the token is valid, the response will allow access to protected routes.

- Example Car Service Middleware
	```bash
	Route::middleware('service.user')->group(function() {
    // Protected routes go here
	});
	```
### Event Management with RabbitMQ
- Car events such as creation, updates, and deletions are managed through RabbitMQ, which acts as a message broker using the CloudAMQP provider.
- For instance, when a car is updated, a job is dispatched to handle the event:
```bash
	CarUpdatedJob::dispatch($carResource->toArray($request), ModelStatusEnum::created()->value);
```
- There is a container named cars_queue that acts as a consumer, listening for events from RabbitMQ. This setup allows the Car Service to respond to events asynchronously.

### Running the Queue (With Queue Database)

If running with queue with database, ensure to start the queue worker in the background by executing the following command:
```bash
php artisan queue:work
```
### WebSocket Notifications
Events dispatched to RabbitMQ can also trigger notifications through **Pusher**. The Car Service fires a channel for real-time WebSocket notifications whenever an event occurs within the job queue.


## Project Management Script

### Introduction

This project consists of two microservices: **User Service** and **Car Service**. Below are scripts to run and manage these services both with and without Docker.

#### How to Run the Scripts

To execute the scripts, use the following commands:

```bash
sh ./run_project.sh
sh ./migrate_seed.sh  # Run this only once to migrate and seed the database at the first time only
```
### Notes
- Ensure that your .sh scripts have execute permissions:

```bash
chmod +x run_project.sh migrate_seed.sh
```

#### Car Service **.env**
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1   # Change to cars_db for Docker
DB_PORT=3306
DB_DATABASE=cars_service
DB_USERNAME=root
DB_PASSWORD=root

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=
PUSHER_PORT=443
PUSHER_SCHEME=https

QUEUE_CONNECTION=database
# Uncomment the next line to use RabbitMQ
# QUEUE_CONNECTION=rabbitmq

# RabbitMQ Credentials (if using RabbitMQ)
RABBITMQ_HOST=
RABBITMQ_PORT=
RABBITMQ_USER=
RABBITMQ_PASSWORD=
RABBITMQ_VHOST=

USER_MS_API=http://users_service:8000/api/v1 # with docker
USER_MS_API=http://localhost:8001/api/v1
# without docker
```
####  User Service .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1  # Change to users_db for Docker
DB_PORT=3306
DB_DATABASE=users_service
DB_USERNAME=root
DB_PASSWORD=root

JWT_SECRET= # Generate it using `php artisan jwt:secret`
```
## Postman API Collection
- You can test the API endpoints using the Postman API collection  . Download the collection through this file in the project `project.postman_collection.json` 

- To import the collection into Postman, you can read more [here](https://learning.postman.com/docs/getting-started/importing-and-exporting/importing-and-exporting-overview/).

## Bonus Features
- Docker: The project is containerized using Docker, allowing easy setup and management of dependencies and services.

- RabbitMQ Message Broker: The architecture utilizes RabbitMQ for handling event-driven communication between the microservices, ensuring reliable message delivery and processing.

- API Collection: A Postman API collection is available for testing the endpoints, simplifying the process of validating API functionality.