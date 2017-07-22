# UNLuTrabajo

Sistema Web de una bolsa de empleo para la materia Práctica Profesional en la Universidad Nacional de Luján.

Tecnologias utilizadas:
* PHP y Framework Laravel 5.1
* Servidor Web: Apache
* BD: MySQL

### Funcionalidades Principales

SuperUsuario/Administrador:
* Gestión de Personas, Usuarios y Parametría.
* Registro de Empleadores.
* Reportes.

Empleador:
* Gestiòn de Propuestas Laborales.
* Visualización de Postulantes.
* Descarga de archivos adjuntos de Postulantes.
* Reportes.

Postulante:
* Bùsqueda de Ofertas Laborales.
* Visualización de postulaciones realizadas.
* Gestión de Cv
* Reportes.

### Instalación

Se requiere tener previamente instalado "Composer" y "wkhtmltox"(Necesario para la generación de reportes).

```sh
$ git git@github.com:rafaalderete/Bolsa-de-Empleo_UNLuTrabajo.git
$ cd Bolsa-de-Empleo_UNLuTrabajo
$ composer install
$ touch .env
$ php artisan migrate (crear previamente la db)
```
Completar el archivo .env con los siguientes datos, segun corresponda (o utilizar el env.example):
>   APP_ENV=local

>   APP_DEBUG=true

>   APP_KEY=AGggRwhhU3Pho3VZA52OCY70ZXGTMTeg

>   DB_HOST=localhost

>   DB_DATABASE=db

>   DB_USERNAME=root

>   DB_PASSWORD=""

>   CACHE_DRIVER=file

>   SESSION_DRIVER=file

>   QUEUE_DRIVER=sync

>   MAIL_DRIVER=

>   MAIL_HOST=

>   MAIL_PORT=

>   MAIL_USERNAME=

>   MAIL_PASSWORD=

>   MAIL_ENCRYPTION=

Para la configuración del envío de mails, ademas de completar de completar la sección correspondiente en el .env, modificar en archivo de configuración que se encuentra en config/mail.php.

Modificar las siguientes variables segun corresponda:
```sh
$ 'host' => env('MAIL_HOST', 'smtp.proveedor.com'),
$ 'port' => env('MAIL_PORT', 465)
$ 'from' => ['address' => 'email@ejemplo.com', 'name' => 'UNLu Trabajo']
```

### Colaboradores
* Alexis Alderete (https://github.com/rafaalderete).
* Pedro Guerrero (https://github.com/Pebros).
* Victoria Medina (https://github.com/victoriamedina).
* Maria Eliana Pighin (https://github.com/mepighin).
