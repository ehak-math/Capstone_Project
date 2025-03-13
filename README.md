# first time to run the project 

- step 1 : 

duplicate the .env.example to .env

- step 2:

set update the .env on connect database by create database example: db-test

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=your-port
- DB_DATABASE=your-db-name
- DB_USERNAME=your-user
- DB_PASSWORD=your-password


- step 3: 

run the command : 

- php artisan key:generate
- php artisan migrate

- step 4 : 

run the command for start the server 

- php artisan serve --port=your-port-you-want-to-run
