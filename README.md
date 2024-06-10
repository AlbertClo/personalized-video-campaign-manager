# Personalized Video Campaign Manager

## Project Setup
Copy the example env file
`cp .env.example .env`

Start docker containers
`docker-compose up -d`

Install dependencies
`docker-compose exec app composer install`

Fix storage director ownership
`docker-compose exec app chown -R www-data:www-data /var/www/storage`

Run database migrations
`docker-compose exec app php artisan migrate --seed`
This will create the database tables and also insert a test client with id = 1

You should now be able to access the API documentation at http://localhost:8000. 
The page should just show the Laravel version. e.g. `{"Laravel":"11.10.0"}` 

## API Documentation


## Background Jobs
