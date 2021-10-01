# Davor Minchorov API

[![Fix PHP Code Styles](https://github.com/davorminchorov/api.davorminchorov.com/actions/workflows/phpcs.yml/badge.svg?branch=main)](https://github.com/davorminchorov/api.davorminchorov.com/actions/workflows/phpcs.yml)
[![Run PHPStan Analysis](https://github.com/davorminchorov/api.davorminchorov.com/actions/workflows/phpstan.yml/badge.svg?branch=main)](https://github.com/davorminchorov/api.davorminchorov.com/actions/workflows/phpstan.yml)
[![Run PHPUnit Tests](https://github.com/davorminchorov/api.davorminchorov.com/actions/workflows/phpunit.yml/badge.svg?branch=main)](https://github.com/davorminchorov/api.davorminchorov.com/actions/workflows/phpunit.yml)

The REST API for Davor Minchorov's personal website and blog.

For the front end application, please see: [davorminchorov/davorminchorov.com](https://github.com/davorminchorov/davorminchorov.com)

### Installation instructions

To set up the project locally follow the instructions.

#### Laravel Sail (Docker) installation
1. Install Docker and Docker Compose for the operating system of your choice.
2. Get into your project directory (`cd api.davorminchorov.com`)
3. Set up the docker containers using the following command:
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```
4. Run the containers in daemon mode using `vendor/bin/sail up -d`
5. Access the PHP container using `vendor/bin/sail shell`
6. Run `composer install` to install of the composer dependencies.
7. Rename the docker example `.env` file using `cp .env.example .env`
8. Run `php artisan key:generate` to generate an application key (`APP_KEY`)
9. Run `php artisan migrate` to run all migrations
10. Add `127.0.0.1 api.davorminchorov.test:8000` to your `/etc/hosts` file
11. Access the site using `api.davorminchorov.test:8000` in your browser
