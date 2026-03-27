DOCUMENTO DE INSTRUCCIONES - CRM SIMPLE
========================================

REQUISITOS PREVIOS

Antes de comenzar, asegurate de tener instalado:

PHP 8.1 o superior

Composer (ultima version)

Node.js 18.x o superior

MySQL 5.7 o superior (XAMPP recomendado)

Git (ultima version)

RECOMENDACION: Instala XAMPP que incluye Apache, MySQL y PHP.

DESCARGAR EL PROYECTO

Opcion A: Clonar desde GitHub

git clone https://github.com/TU-USUARIO/crm-simple.git
cd crm-simple

Opcion B: Descargar ZIP

Ve a https://github.com/TU-USUARIO/crm-simple

Haz clic en "Code" -> "Download ZIP"

Extrae el archivo en tu computadora

Abre la terminal en la carpeta extraida

CONFIGURAR BASE DE DATOS

2.1 Iniciar MySQL (XAMPP)

Abre XAMPP Control Panel

Haz clic en "Start" junto a MySQL

Verifica que el icono este verde

2.2 Crear base de datos

Abre tu navegador y ve a: http://localhost/phpmyadmin

Haz clic en "Nueva"

En "Nombre de la base de datos" escribe: crm_simple

Selecciona utf8mb4_general_ci como cotejamiento

Haz clic en "Crear"

O usando MySQL en la terminal:

CREATE DATABASE crm_simple CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CONFIGURAR BACKEND (LARAVEL)

3.1 Instalar dependencias

cd backend
composer install

3.2 Configurar archivo .env

Copia el archivo de ejemplo:

copy .env.example .env

Edita el archivo .env y configura la base de datos:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm_simple
DB_USERNAME=root
DB_PASSWORD=

3.3 Generar clave de aplicacion

php artisan key:generate

3.4 Ejecutar migraciones

php artisan migrate

3.5 Crear usuario administrador

php artisan tinker

Dentro de tinker, copia y pega:

$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@crm.com';
$user->password = bcrypt('123456');
$user->save();
exit;

3.6 Iniciar servidor backend

php artisan serve

El servidor estara corriendo en: http://localhost:8000

CONFIGURAR FRONTEND (REACT)

4.1 Instalar dependencias

cd frontend
npm install

4.2 Iniciar servidor frontend

npm start

El servidor estara corriendo en: http://localhost:3000

ACCEDER AL SISTEMA

Abre el navegador en: http://localhost:3000

Usa las credenciales:
Email: admin@crm.com
Contraseña: 123456

Una vez dentro, podras:

Agregar nuevos leads

Editar leads existentes

Eliminar leads

Cerrar sesion

ESTRUCTURA DEL PROYECTO

crm-simple/
├── backend/ # Laravel API
│ ├── app/ # Modelos y controladores
│ ├── database/ # Migraciones
│ ├── routes/ # Rutas de la API
│ └── storage/ # Logs y archivos temporales
└── frontend/ # React App
├── src/
│ ├── api/ # Configuracion de axios
│ ├── pages/ # Componentes de paginas
│ └── App.js # Componente principal
└── public/ # Archivos estaticos

SOLUCION DE PROBLEMAS COMUNES

7.1 Error "Could not connect to database"

Verifica que MySQL este corriendo en XAMPP

Revisa las credenciales en el archivo .env

7.2 Error 419 Page Expired

Verifica que el middleware CSRF este deshabilitado

El archivo app/Http/Middleware/VerifyCsrfToken.php debe tener:

protected $except = ['*'];

7.3 Error "No autenticado"

Limpia el localStorage del navegador

Vuelve a iniciar sesion

7.4 Error "npm start" no funciona

Elimina node_modules y package-lock.json

Ejecuta npm install nuevamente

7.5 Comandos utiles para limpiar

php artisan optimize:clear # Limpia toda la cache de Laravel
php artisan route:clear # Limpia cache de rutas
php artisan config:clear # Limpia cache de configuracion
php artisan cache:clear # Limpia cache de la aplicacion

ENDPOINTS DE LA API

Metodo GET:

/api/login-get?email=admin@crm.com&password=123456 (Login)

/api/leads (Listar leads)

/api/leads-add (Crear lead via GET)

/api/leads-update/{id} (Actualizar lead via GET)

/api/leads-delete/{id} (Eliminar lead via GET)

Metodo POST (con token):

/api/leads (Crear lead con POST)

Todos los endpoints requieren el token en el header:
Authorization: Bearer {token}

CREDENCIALES POR DEFECTO

Usuario administrador:

Email: admin@crm.com

Contraseña: 123456

SOPORTE

Si tenes problemas con la instalacion, verifica:

Que todos los requisitos esten instalados correctamente

Que MySQL este corriendo

Que los puertos 8000 y 3000 esten libres

Los logs de Laravel en backend/storage/logs/laravel.log