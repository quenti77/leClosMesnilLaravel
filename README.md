<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Introduction

# Langages
```
 - php: ^7.4|^8.0
 - Bootstrap 5

```
# Start
- Once the installation is complete, type **npm -i** in the terminal. Install the dependencies in the local node_modules
folder.
- entry to project
- Run ```composer install``` on your cmd or terminal
- Copy ```.env.example``` file to ```.env``` on the root folder. 
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
  By default, the username is root and you can leave the password field empty. (This is for Xampp)
  By default, the username is root and password is also root. (This is for Lamp)
- Run ```php artisan migrate```
- Run ```php artisan serve```
```
Starting Laravel development server: http://127.0.0.1:8000
[Thu Apr 15 21:30:12 2021] PHP 8.0.0 Development Server (http://127.0.0.1:8000) started
```
# installation binairy files (optimisation pictures)
[spatie image-optimizer](https://github.com/spatie/image-optimizer)

# Larastan
Larastan is a static analysis command line tool built on top of PHPStan and focuses on finding errors in your Laravel code before running it.
The configuration file ```phpstan.neo.dist```
```bash
# install
composer require --dev nunomaduro/larastan
# file configuration
phpstan.neon.dist
# lunch
./vendor/bin/phpstan analyse
```
[more infos](https://github.com/nunomaduro/larastan)
# PHP_CodeSniffer

```bash
# install
composer global require "squizlabs/php_codesniffer=*"
# file configuration 
phpcs.xml
# lunch command
./vendor/bin/phpcs
```
[more infos](https://github.com/squizlabs/PHP_CodeSniffer)
# Telescope
Telescope is a debugging assistant for the Laravel framework. Telescope provides an overview of requests entering your 
application, exceptions, log entries, database queries...
```bash
# lunch server
php artisan serve
# go to the browser
http://localhost:8000/telescope/
# open second browser
http://localhost:8000/post/actualite-semaine30
# return 
http://localhost:8000/telescope/requests 
```

- [more infos](https://github.com/squizlabs/PHP_CodeSniffer) 
- [wiki github](https://github.com/squizlabs/PHP_CodeSniffer/wiki)
