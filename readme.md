## Api Gix

Implementación del api usando el protocolo GIX. Desarrollada con Laravel con el objetivo de ser un proyecto que de puntapie a una implementacion particular de algun actor, en caso de usar este stack tecnológico. 

## Requerimientos

- PHP 7.1 o superior
- laravel 5.6 o superior

## Instalación

1. Clonar el repo en una carpeta local
2. Navegar a la carpeta del proyecto y ejecutar "composer install" para instalar dependencias de php
3. ejecutar "php artisan key:generate" para generar la llave de encriptacion del proyecto
4. Duplicar el .env.example y renombrarlo .env, setear ahi datos de db, smtp, etc etc.
5. php artisan passport:install para generar las credenciales oAuth para generar api keys etc...
6. php artisan migrate para crear tablas en la base de datos

[Documentación del laravel](https://laravel.com/docs/routing).

## Documentacion del api

Para documentar usamos Swagger. Despues de modificar los meta tags que se encuentran encima de cualquier metodo del controlador, tendremos que ejecutar el comando "php artisan l5-swagger:generate" Para que se actualice la UI

La ruta de acceso es {BASE_URL}/api/docs

[Documentación api Gix](http://localhost/apigix/public/api/docs).

