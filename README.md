# Personalized Video Campaign Manager

## Project Setup
Copy the example env file.
```
cp .env.example .env
```

Set terminal env vars for docker-compose.
```
export USER="$(whoami)"
export UID="$(id -u)"
```
This ensures that the files will be writable from inside docker.

Start docker containers.
```
docker-compose up -d
```

Install Composer dependencies.  
```
docker-compose exec app composer install
```

Run database migrations.
```
docker-compose exec app php artisan migrate --seed
```

This will create the database tables and also insert a test client with id = 1.

You should now be able to access the site in your browser at http://localhost:8000.   
The page should show the Laravel version. e.g. `{"Laravel":"11.10.0"}`.

## API Documentation
#### POST /api/campaigns
Example request:
```
curl --request POST \
    --url http://localhost:8000/api/campaign \
    --header 'Accept: application/json' \
    --header 'Content-Type: application/json' \
    --data '{
        "client_id": 1,
        "name": "Test Campaign One",
        "start_date": "2024-06-10",
        "end_date": "2024-06-30"
}'
```
Example Response:
```
HTTP Code: 201 Created
{
    "id": 22,
    "client_id": "1",
    "name": "Test Campaign One",
    "start_date": "2024-06-10",
    "end_date": "2024-06-30",
    "campaign_data": [],
}
```
#### POST /api/campaigns/{campaignId}/data
Example Request:
```
curl --request POST \
    --url http://localhost:8000/api/campaign/1/data \
    --header 'Accept: application/json' \
    --header 'Content-Type: application/json' \
    --data '{
        "data": [
            {
                "user_id": "one@test.test",
                "video_url": "https://test.test.io/one",
                "custom_fields": "{\"title\": \"One\"}"
            },
            {
                "user_id": "two@test.test",
                "video_url": "https://test.test.io/two",
                "custom_fields": "{\"title\": \"Two\"}"
            },
            {
                "user_id": "three@test.test",
                "video_url": "https://test.test.io/three",
                "custom_fields": "{\"title\": \"Three\"}"
            }
	]
}'
```
Example Response:
```
HTTP Code: 202 Accepted
{
    "message": "Request Accepted"
}
```
#### GET /api/campaigns/{campaignId}
Example request:
```
curl --request GET \
    --url http://localhost:8000/api/campaign/1 \
    --header 'Accept: application/json' \
    --header 'Content-Type: application/json' 
```
Example Response:
```
HTTP Code: 200 OK
{
	"id": 1,
	"client_id": 1,
	"name": "Test Campaign One",
	"start_date": "2024-06-10",
	"end_date": null,
	"campaign_data": [
		{
			"id": 1,
			"user_id": "one@test.test",
			"video_url": "https:\/\/test.test.io\/one",
			"custom_fields": "{\"title\": \"One\"}"
		},
		{
			"id": 2,
			"user_id": "two@test.test",
			"video_url": "https:\/\/test.test.io\/two",
			"custom_fields": "{\"title\": \"Two\"}"
		},
		{
			"id": 3,
			"user_id": "three@test.test",
			"video_url": "https:\/\/test.test.io\/three",
			"custom_fields": "{\"title\": \"Three\"}"
		}
	]
}
```

## Background Jobs
When calling the **POST /api/campaigns/{campaignId}/data** endpoint, messages are written to the default queue. The `pvcm-queue` container included in the `docker-compose.yml` file automatically processes this queue by running the `php artisan queue:work` command. So you don't need to run this manually.

For production workloads, you'd likely want multiple queue workers running in parallel.

## Tests
Run automated tests.
`docker-compose exec app php artisan test`
