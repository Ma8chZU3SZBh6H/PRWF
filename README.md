# Products by weather api

## About
This is a simple api that returns two products depending on the weather forecast of a Lithuanian city.

## How it works?
 You just have to send a request to this path, just replace the semicolans with city or a weather condition.
 
	`api/products/recommended/{city_name or weather_condition}`
### For example

With a city

	`http://adeo.web.dragoninja.com/api/products/recommended/kaunas`
	
With forecast 

	`http://adeo.web.dragoninja.com/api/products/recommended/clear`
### Available weather forecasts for the route
	
1.  `clear`
2.  `isolated-clouds`
3.  `scattered-clouds`
4.  `overcast`
5.  `light-rain`
6.  `moderate-rain`
7.  `heavy-rain`
8.  `sleet`
9.  `light-snow`
10.  `moderate-snow`
11.  `heavy-snow`
12.  `fog`
13.  `na`

## How to host it yourself?
1. Download the source code 
	`git clone https://github.com/skindervik/adeo_web_backend_challange.git`
2. Enter the folder
	`cd adeo_web_backend_challange`
3. Install the necessary components with [composer](https://getcomposer.org/download/)
	`composer install`
3. Create .env file, use the .env.example file.
4. Generate app key
    `php artisan key:generate`
6. Launch the project with [docker](https://laravel.com/docs/8.x/sail)
	`./vendor/bin/sail up`
 7. Migrate the Database
    `./vendor/bin/sail artisan migrate`
 8. Create fake products for the database
    `./vendor/bin/sail artisan db:seed`

### It's also hosted here
	http://adeo.web.dragoninja.com/
