![Logo](public/Estilos/Imagenes/bannerS.png)

# Real Hermandad de Santa Rita de Casia - Luque

Bienvenido a la plataforma de gestión de hermandad. Este sistema te permite administrar las cuotas, hermanos y eventos de la Hermandad de santa luque.

## Funcionalidades Principales

### 1. Cuotas

Gestiona las cuotas de la hermandad de forma sencilla. Registra nuevas cuotas, realiza pagos y lleva un seguimiento de las cuotas pendientes.

---

### 2. Hermanos

Administra la información de los hermanos de la hermandad. Registra nuevos hermanos, actualiza sus datos y realiza búsquedas fácilmente.



---

### 3. Eventos

Mantente al tanto de los eventos próximos de la Hermandad. Agrega nuevos eventos, actualiza la información y comunica a los hermanos sobre las actividades.



## Instalación

Sigue estos pasos para instalar y ejecutar la aplicación:

```bash
# Clona el repositorio
git clone https://github.com/Xxjorge20/proyectoHermandad

# Instala las dependencias
composer install
npm install

# Configura el archivo .env y genera la clave de la aplicación
cp .env.example .env
php artisan key:generate

# Ejecuta las migraciones y seeders
php artisan migrate --seed

# Inicia el servidor
php artisan serve

## Licencia

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
