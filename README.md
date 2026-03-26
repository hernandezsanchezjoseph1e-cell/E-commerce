# E-commerce Laravel

Sistema de tienda en línea desarrollado con Laravel 12.

## Descripción
Este proyecto es una aplicación web tipo E-commerce que permite la gestión de productos, usuarios y compras.

## Tecnologías utilizadas
- PHP 8.2
- Laravel 12
- MySQL
- Blade

## Instalación

```bash
git clone https://github.com/hernandezsanchezjoseph1e-cell/E-commerce.git
cd E-commerce
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve