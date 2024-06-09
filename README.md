# Personalized Video Campaign Manager

## Project Setup
Copy the example env file
`cp .env.example .env`

Start docker containers
`docker-compose up -d`

Fix storage director ownership
`docker-compose exec app chown -R www-data:www-data /var/www/storage`

Run database migrations
`docker-compose exec app php artisan migrate`

Access the app from http://localhost:8000

## API Documentation

## Background Jobs
