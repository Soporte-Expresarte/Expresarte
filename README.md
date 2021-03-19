<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Expresarte

## Configuración inicial
Clonar el proyecto por SSH hacia el VPS.

Cuando el proyecto esté clonado, ejecuta ```composer install``` en la raíz del proyecto, esto es para instalar composer en tu versión del proyecto.

Ahora debes crear una copia del archivo "**.env.example**" y renombrarlo como "**.env**". Este archivo se encuentra en la raíz del proyecto: <br> <br>


<div align='center'>

![](https://drive.google.com/uc?export=view&id=1awDjmEO7SPPx0msUgOAzycih_QM7Plt7)
</div>
<br>

Luego se debe ejecutar el siguiente comando ```php artisan key:generate```  para crear una llave de acceso única.

A continuación deberás migrar las tablas a una base de datos MySql. Esto se puede hacer de 2 formas:
* Si usas Xampp, deberás abrir la aplicación **XAMPP Control Panel** e iniciar los servicios de Apache y MySql. Acto seguido deberás entrar a http://localhost/phpmyadmin/server_databases.php y crear una nueva base de datos llamada *expresarte*.

* Por otro lado, si usas Laragon para gestionar el proyecto, deberás mover la carpeta del proyecto a **C:\laragon\www** o un path similar, dependerá de dónde hayas instalado Laragon. Luego deberás iniciar Laragon y sus servicios Apache y MySql. Finalmente, entra al apartado de Bases de Datos, luego al nombre de sesión *Laragon* y crea una nueva base de datos con el nombre de *expresarte* (Puedes presionar click derecho donde están las demás bases de datos, luego Crear nuevo -> Base De Datos).

* Si no tienes ninguno de estos 2 y tienes MySql Workbench puedes visualizar las migraciones con estos pasos: En el archivo .env en DB_PASSWORD escribir la contrasena de la conexion de la base de datos, luego en la hojita de MySQL Workbench debes cambiar la contraseña nativa, basicamente es hacer una consulta para cambiarla, pones la misma que pusiste en la conexion y en DB_PASSWORD, entonces ejecutas esta consulta: ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'nuevacontrasena', y en nuevacontrasena pones la de DB_PASSWORD o conexion (debieran ser la misma). 

Independiente del método que hayas usado, ejecuta ```php artisan migrate``` en la raíz del proyecto. Con esto se hará la migración de las tablas a la Base de datos que hayas creado.

En caso de que uses Laragon, el proyecto debiese estar alojado en *expresarte.test*

En caso de que no quieras usar el servicio de host Apache que proveen Xampp o Laragon, puedes alojar el proyecto en localhost con el siguiente comando:
```php artisan serve```, este debe ser ejecutado en la raíz del proyecto y estará operativo en http://127.0.0.1:8000.

## Configuración adicional

Primero ejecuta el comando ```php artisan storage:link``` en la raíz del proyecto. Esto creará un link simbólico entre la carpeta storage/public y public/storage,
permitiendo el acceso a imágenes desde la carpeta public y con el helper *asset()*.

Deberás tener instalado [Node.js](https://nodejs.org/es/) para tener acceso a los comandos de su gestionador/instalador de paquetes **npm**. 
A continuación debes ejecutar los siguientes comandos en la raíz del proyecto para habilitar ciertas funcionalidades extra (como la carga de clases CSS, habilitación de comandos npm, etc):

```npm install```

```npm run dev```


A continuación deberás crear una copia del archivo "**config/livewire.php.example**". Cambia el nombre de dicha copia a "**livewire.php**".

Finalmente, debes asegurarte de que cierta propiedad esté bien configurada en tu proyecto para que las funcionalidades async. de Livewire funcionen correctamente. Revisa el archivo "**Expresarte/config/livewire.php**". Cerca de las líneas 45-46 debieses ver la propiedad *asset_url*, ya volveremos a revisar esta propiedad más adelante.

Ve al sitio web y entra a la página del registro de usuario. Si escribes "hola" en el campo del correo electrónico, o un nombre que tenga menos de 3 caracteres, y te aparecen los mensajes de error en rojo, no debes hacer nada más, tu configuración del proyecto está lista.

Si no aparece ningún mensaje de error, deberás modificar el valor de la propiedad *asset_url* mencionada anteriormente al siguiente: 
asset_url => url('https://expresarte.cl'),

Guarda cambios, recarga la página, y si te aparecen los mensajes de error al escribir valores incorrectos en los campos del formulario, ya tienes todo configurado correctamente.
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
