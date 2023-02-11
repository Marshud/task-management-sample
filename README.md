# Task Management App

## Please follow the instructions to install
1. Run `composer install` to install dependencies
2. Make a copy `.env.example` to `.env`
3. Update the `.env` file with the appropriate database credentials and Application Name
4. Run `php artisan migrate --seed` to set up the database
5. Now you start the app with `php artisan serve`

If at any one point there's need to refresh the sample DB, please run `php artisan migrate:refresh --seed`
