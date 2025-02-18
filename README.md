

# How to run the app in local ?

## Set Env File

$ cp .env.example .en

## Create SSL 

$ cd nginx/ssl

$ sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout ssl.key -out ssl.crt

## Install Packages

$ docker compose exec laravel-crud-app composer install

## Database Migration

$ docker compose exec laravel-crud-app php artisan migration

## Add Host Entry

$ C:/Windows/System32/Drivers/etc/
$ vi hosts

Add entry
127.0.0.1 laravel-crud-app.local

## Run containers

$ docker compose up -d

## Access the app

https://laravel-crud-app.local
