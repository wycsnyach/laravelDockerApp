## About Laravel Docker App

This Laravel User API web application developed by Laravel 10 framework and Has been Dockerized. It has the following API Features:

- Users
- Dockerization files and configurations

## Requirements

- PHP version 8.1+
- PHP Mcrypt
- PHP Mysql
- Composer
- mbstring
- dom extention
- php8.1-fpm
- php8.1-curl
- libapache2-mod-php8.1


## Installation Steps
## Step 1: Database Creation
- To access the MariaDB prompt after installing the database server, you need to use the following command: **mysql -u username -p**
- Sign in, then create a database and a user for it; grant the database user the necessary permissions.
- CREATE DATABASE laravel_db;
- CREATE USER 'laravel_user'@'localhost' IDENTIFIED BY 'secretpassword';
- GRANT ALL ON laravel_db.* TO 'laravel_user'@'localhost';
- FLUSH PRIVILEGES;
- QUIT;

## Step 2: Composer Installation
- Composer is a package manager and prerequisite management tool for PHP and manages the libraries and dependencies required by PHP based on the particular framework.
- Use this command: **curl -sS https://getcomposer.org/installer | php**
- After executing the above command, the composer. phar file will be downloaded, and to move the file to the usr/local/bin/ path, run the following command:
**sudo mv composer.phar /usr/local/bin/composer**
- Assign authority to execute: **sudo chmod +x /usr/local/bin/composer**

## Step 3: Laravel Installation and setup

- To install Laravel, you must first go to the webroot directory, and for this purpose, you must type the following command: **cd /var/www/html**
- Clone the repository with **git clone -- file name** e.g. **git clone git@github.com:wycsnyach/laravelDockerApp.git**
- Set the web server user to own the Laravel directory. **sudo chown -R www-data:www-data /var/www/html/laravelDockerApp**
- Change Permissions for the storage Directoryt. **sudo chmod -R 775 /var/www/html/laravelDockerApp/storage**
- Once the installation process is finished, go to the installation directory. **cd /var/www/html/laravelDockerApp** then follow the steps below.
- Copy **.env.example** file to **.env** and edit database credentials there
- Run **composer install**
- Run **php artisan key:generate**
- Run **php artisan migrate**
- Run **php artisan db:seed**
- That's it - load the homepage, **localhost/laravelDockerApp/public** and log in with credentials e.g **sssadmin@admin.com / mypassword.**

## Step 4: Laravel Docker Installation and setup

# Laravel Docker REDIS PHP-FPM
- Step 1: Create a new Laravel project
- Step 2: Run git init
- Step 3: Pull this repo git pull **git@github.com:wycsnyach/laravelDockerApp.git**
- Step 4: Adjust your env variables. Make sure you set your database env vars. Add any values as the database will be created per your env var values.

# Adjust your .env variables.

	DB_CONNECTION=mysql
	DB_HOST=database_wnn
	DB_PORT=3306
	DB_DATABASE=default
	DB_USERNAME=laravel
	DB_PASSWORD=secret

	REDIS_HOST=redis
	REDIS_PASSWORD=secret
	REDIS_PORT=6379

## Step 5: To run the containers, please use the provided Makefile. Run make to see all supported commands.

    Usage:
      make <target>

    Targets:
      help        Print help.
      ps          Show containers.
      build       Build all containers for DEV
      build-prod  Build all containers for PROD
      start       Start all containers
      fresh       Destroy & recreate all uing dev containers.
      fresh-prod  Destroy & recreate all using prod containers.
      stop        Stop all containers
      restart     Restart all containers
      destroy     Destroy all containers
      ssh         SSH into PHP container
      install     Run composer install
      migrate     Run migration files
      migrate-fresh  Clear database and run all migrations
      tests       Run all tests
      tests-html  Run tests and generate coverage. Report found in reports/index.html

- Or Run this command while in the directory **docker-compose up --build -d**
- To run all containers for local development, run make fresh. Otherwise make fresh-prod for prod builds.

- Default PHP port is configured to 8000. Connect via http://localhost:8000 or http://127.0.0.1:8000

- Default DB port is 3306.

## License

This Application is developed and licensed under the [TDS DEV TEAM](https://techdevsystems.co.ke/).