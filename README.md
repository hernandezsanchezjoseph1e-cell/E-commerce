# Tech & Home - Ecommerce Laravel

## Descripción del proyecto

Tech & Home es un sistema ecommerce desarrollado con Laravel 12. El sistema permite gestionar productos, categorías, usuarios, roles, carrito de compras, ventas y autenticación de usuarios.

El proyecto incluye un flujo de autenticación con verificación en dos pasos mediante código OTP enviado por correo electrónico. También cuenta con roles diferenciados para cliente, gerente y administrador, permitiendo separar las funciones principales del sistema.

Esta práctica tuvo como objetivo integrar el proyecto con herramientas de Integración Continua y Despliegue Cloud, utilizando GitHub Actions, pruebas automáticas, variables de entorno y publicación en internet.

## Tecnologías usadas

- Laravel 12
- PHP 8.3
- MySQL
- SQLite para pruebas automáticas
- Composer
- Node.js
- Vite
- Tailwind CSS
- Git
- GitHub
- GitHub Actions
- Docker
- Render
- Aiven MySQL

## Instalación local

Clonar el repositorio:

```bash
git clone URL_DEL_REPOSITORIO
cd E-commerce
```

Instalar dependencias de PHP:

```bash
composer install
```

Instalar dependencias de Node.js:

```bash
npm install
```

Crear el archivo de variables de entorno:

```bash
cp .env.example .env
```

Generar la clave de la aplicación:

```bash
php artisan key:generate
```

Configurar la conexión a base de datos en el archivo `.env`.

Ejecutar migraciones y seeders:

```bash
php artisan migrate:fresh --seed
```

Compilar los assets del frontend:

```bash
npm run build
```

Levantar el servidor local:

```bash
php artisan serve
```

## Ejecución de pruebas

Las pruebas automáticas se ejecutan con el siguiente comando:

```bash
php artisan test
```

Resultado validado durante la práctica:

```txt
15 tests passed, 51 assertions
```

Las pruebas implementadas validan comportamientos reales del sistema, como autenticación, login incorrecto, registro de usuarios, actualización de contraseña, perfil de usuario, página principal y flujo de verificación OTP.

## Integración Continua

El proyecto utiliza GitHub Actions para ejecutar un pipeline de Integración Continua. El archivo de configuración se encuentra en:

```txt
.github/workflows/laravel.yml
```

El pipeline se ejecuta automáticamente al realizar:

- `push`
- `pull_request` hacia la rama `main`

El flujo configurado realiza las siguientes tareas:

- clona el repositorio,
- instala PHP 8.3,
- instala dependencias de Composer,
- instala dependencias de Node.js,
- configura el entorno de pruebas,
- configura SQLite como base de datos de testing,
- ejecuta migraciones,
- ejecuta seeders,
- compila los assets frontend,
- ejecuta las pruebas automáticas de Laravel.

Para el entorno de pruebas se utiliza SQLite, lo que permite ejecutar el pipeline sin depender de una base de datos MySQL externa.

## Despliegue Cloud

La aplicación fue desplegada en Render como un Web Service utilizando Docker.

URL pública del sistema:

```txt
https://ecommerce-laravel-qzsm.onrender.com
```

La base de datos de producción se configuró en Aiven MySQL. Laravel se conecta a esta base mediante variables de entorno configuradas directamente en Render.

## Despliegue Continuo

El despliegue continuo se configuró conectando Render con el repositorio de GitHub. Después de validar el funcionamiento en la rama `feature/ci-cd-despliegue`, los cambios se integran a la rama `main`, que representa la versión estable del proyecto.

Render puede reconstruir y publicar automáticamente la aplicación cuando se realiza un `push` hacia la rama configurada.

Flujo final del proceso:

```txt
Push a main -> GitHub Actions ejecuta pruebas -> Render despliega automáticamente
```

Este flujo permite reducir errores manuales, mantener una versión pública actualizada y asegurar que los cambios integrados a la rama principal puedan publicarse de forma controlada.

## Variables de entorno

El archivo `.env` no se sube al repositorio porque contiene información sensible. En su lugar, el repositorio incluye `.env.example` como plantilla.

En producción, las variables se configuran directamente en Render.

Variables principales:

```env
APP_NAME=
APP_ENV=
APP_KEY=
APP_DEBUG=
APP_URL=
ASSET_URL=

DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

En producción se utilizan valores como:

```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
MAIL_MAILER=smtp
```

## Seguridad

El proyecto evita subir credenciales al repositorio. Las claves, contraseñas de base de datos, credenciales SMTP y configuración sensible se manejan mediante variables de entorno en la plataforma cloud.

También se evita subir archivos como `.env`, claves privadas o contraseñas hardcodeadas dentro del código fuente. 
