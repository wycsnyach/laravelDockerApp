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

