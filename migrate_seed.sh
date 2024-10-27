#!/bin/bash

echo "Select an option for migrating and seeding the database:"
echo "1) With Docker"
echo "2) Without Docker"
read -p "Enter your choice (1 or 2): " choice

if [ "$choice" -eq 1 ]; then
    # Migrate and seed with Docker
    echo "Migrating and seeding the Car Service database..."
    docker exec -it cars_ms_container bash -c "php artisan migrate:fresh --seed"

    echo "Migrating and seeding the User Service database..."
    docker exec -it users_service bash -c "php artisan migrate:fresh --seed"

    echo "Database migration and seeding completed with Docker."
elif [ "$choice" -eq 2 ]; then
    # Migrate and seed without Docker
    echo "Navigating to Car Service directory..."
    cd  "car service"
    php artisan migrate:fresh --seed

    echo "Navigating to User Service directory..."
    cd ../"user service"
    php artisan migrate:fresh --seed

    echo "Database migration and seeding completed without Docker."
else
    echo "Invalid choice. Please run the script again."
    exit 1
fi