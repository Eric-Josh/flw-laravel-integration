## Flutterwave Laravel Integration 

## Installation

- Clone Repository
    > `git clone https://github.com/Eric-Josh/flw-laravel-integration`
    x
- Install all dependencies
    > `cd flw-laravel-integration`
    > `composer install or composer update`

- Create DB
- Copy .env.example to .env
    > `cp .env.example .env`

- Generate APP_KEY
    > `php artisan key:generate`

- Add DB credentials to .env
- Run Migration
    > `php artisan migrate`

- Add cronjob for mail job queues
    > `* * * * * /usr/local/bin/php /hostpath/flw-laravel-integration/artisan schedule:run >> /hostpath/flw-laravel-integration/storage/logs/mail-job.log 2>&1`