### if you setup when first time
```
$ sail build 
$ sail up -d
$ sail composer install
$ sail npm install
$ sail npm run && sail npm run dev
```
### setup
``` 
# docker-compose up -d
$ sail up -d

# laravel app
http://localhost:80/

# phpMyAdmin
http://localhost:8888/
user: sail
pw: password

# mailhog
http://localhost:8025/
```
```
# filament 
$ sail composer require filament/filament:"^2.0"
$ sail php artisan make:filament-user
```
### if you want to create php.ini
```
$ sail php artisan sail:publish
```