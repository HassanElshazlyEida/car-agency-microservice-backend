#!/bin/bash

echo "Select an option to run the project:"
echo "1) Run with Docker"
echo "2) Run without Docker"
read -p "Enter your choice (1 or 2): " choice

if [ "$choice" -eq 1 ]; then
    # Stop all running Docker containers
    echo "Stopping all running Docker containers..."
    docker stop $(docker ps -a)

    # Build and run the services
    echo "Building and running the services with Docker..."
    cd "car service"
    docker-compose up -d --build
    cd ../"user service"
    docker-compose up -d --build

    echo "Services are running with Docker."
elif [ "$choice" -eq 2 ]; then
    # Run without Docker
    echo "Running the Car Service..."
    cd "car service"
    php artisan serve &  # Run car service on default port 8000

    echo "Running the User Service on port 8001..."
    cd ../"user service"
    php artisan serve --port=8001 &  # Run user service on port 8001

    echo "Services are running without Docker."
else
    echo "Invalid choice. Please run the script again."
    exit 1
fi