## Installation

This program is using the [Laravel](https://laravel.com/docs/6.x#installing-laravel) framework with a MySQL database, so both needs to be installed for the application to run.

To install the application locally, follow these steps.

1. Clone this repository
    ```
    git clone https://github.com/olivierhsta/serveradmin.git
    ```
2. Copy the .env.example file into a .env file
    ```
    cp .env.example .env
    ```
3. Open the .env file in a text editor and edit it with the correct credentials for the database access
    (the followings are the default credentials)
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=serveradmin
    DB_USERNAME=root
    DB_PASSWORD=
    ```
4. Back to the command line, install the application dependencies
    ```
    composer install
    ```
5. Seed the database with some dummy data
    ```
    php artisan db:seed
    ```
6. Start the local server
    ```
    php artisan serve
    ```
    
The website should now be accessible from the given url.
