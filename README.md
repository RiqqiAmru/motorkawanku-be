<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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

-   [x] delete the registration controller
-   [ ] make role admin and user (validation)
-   [ ] make user CRUD on admin role
-   [ ] make CRUD data investasi in both role (with geolocation [optional])
-   [ ] make CRUD geolocation data for admin role
-   [ ] user can see the data within their area, and admin can see all data
-   [ ] user can lock the investasi data if the data is already inputted
-   [ ] admin can see the data that is locked and not locked by the user
-   [ ] admin can reject the data that submitted by the user and give the reason / feedback detail
-   [ ] user can see the feedback from the admin via notification (in browser only)
-   [ ] admin can make a report based on the data that is locked by the user in excel based format
-   [ ] there are log system for every action that is done by the user and admin, and can be seen by the admin
-   [ ] there are notification system for every action that is done by the user and admin, and can be seen by the user