<p align="center">><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Logo Motorkawanku"></p>

<p align="center">
<!-- <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p> -->

## About Motor Kawanku

Motor kawanku is a web application to monitoring slum area based on PERMEN PUPR No.14/PRT/M/2018. This application is focusing on the area of Pekalongan City, Central Java, Indonesia. This application is built using Laravel 11.

## Installation

1. Clone this repository
2. Run `composer install`
3. Run `npm install`
4. Run `npm run dev`
5. Run `php artisan serve`
6. Open `http://localhost:8000` in your browser

## License

The project is licensed under the MIT License. You can find the full text of the license in the [LICENSE](https://github.com/RiqqiAmru/motorkawanku-be/blob/main/LICENSE) file.

## on the way

### app

-   [x] delete the registration controller
-   [x] make role admin and user (validation)
-   [x] make user CRUD on admin role
-   [x] make CRUD data investasi
-   [ ] make CRUD data geolocation

### guest

-   [x] view data kumuh awal, akhir, investasi and maps

### secondary

-   user management

    -   [x] admin can see the list of user
    -   [x] admin can make new user (role user/ admin) with default password,
    -   [x] admin can update the user data -> change the role, name, email,
    -   [x] admin can delete the user ->deleted user not really deleted, but only change the status to inactive, and can be seen by the admin or activated again
    -   [x] admin cannot delete another admin (can only delete itself)

-   data investasi

    -   [x] view breadcrumbs location, for user, its default location whether on username, for admin the breadcrumb itself can be changed for all locations
    -   based on location, view the table for investasi in current year,
    -   user or admin can make CRUD operations in investasi table
    -   user can lock the investasi data if it felt proper,
    -   investasi data that was already locked cannot be removed/changed by user,
    -   only if admin is open the lock user allowed to access the the data again
    -   admin can make CRUD operations, and approve the data that inputted by the user,
    -   if approved, the data will be viewed in guest data kumuh
    -   if not approved, admin will make a text input for reason the data is invalid
    -   the investasi data that inputted by the admin automatically approved (not validated) and waiting to be locked

-   [x] add progress bar for alert information with self extinct
-   [x] user can see the data within their area, and admin can see all data
-   [x] admin can lock the user data

## DEV NOTE

-   [x]feat:laporan to excel
-   [x] data tables and pagination
-   [x] 1 Account Admin Default harusnya cannot be deleted
-   [ ] there are log system for every action that is done by the user and admin, and can be seen by the admin
-   [ ] user with default password will get a alert to change their password, the alert cannot be hide itself
-   [ ] feature to see wilayah yang belum diinputkan data investasi and lock it to input kumuh akhir

## error
