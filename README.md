## Voting App

Laravel Breeze App for Voting (Laravel, Vue.js, Inertia.js, Tailwind CSS)

Copy the .env.example file and rename it to .env

Create the database and populate the .env file with appropriate database details.

##### Basic

run `composer install`

run `php artisan migrate`

run `npm install`

run `npm run dev` to compile assets

run `php artisan serve`

run `php artisan voting:results` to manually send an email with the voting results (otherwise scheduled to be sent daily at 23:59)
