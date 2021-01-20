Copy .env.example and rename to .env 

Create database in mysql or other database

my example .env file

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=battleship 
DB_USERNAME=root
DB_PASSWORD=

After creating db, in terminal run this commands

For creating tables: $ php artisan migrate 

Seeding data: $ php artisan db:seed

Run server: $ php artisan ser
