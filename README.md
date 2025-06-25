<div align="center">

<img src="./public/img/Ambato.png" width="100" alt="Ambato imagen" />

### *Proyecto para gestion de espacios de la Casa de la cultura de Ambato*

*API REST para la gestión de espacios, talleres y eventos*

---

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?logo=mysql&logoColor=white)
![JWT](https://img.shields.io/badge/JWT-Auth-000000?logo=jsonwebtokens&logoColor=white)


</div>

---

## 📚 Índice

- [Equipo de desarrollo](#-equipo-de-desarrollo)
- [Características](#-características)
- [Creación de la base de datos](#-creación-de-la-base-de-datos)
- [Instalación rápida](#-instalación-rápida)
- [Comandos útiles](#-comandos-útiles)
- [Configuración recomendada](#-configuración-recomendada)
- [Estructura del proyecto](#-estructura-del-proyecto)
- [Notas finales](#-notas-finales)

---

## 👥 Equipo de desarrollo

<div align="center">

| **Desarrollador** | **Rol** | **GitHub** |
|:-----------------:|:-------:|:----------:|
| **Elías** | Backend & API | [@JosliBlue](https://github.com/JosliBlue/) |
| **Alex** | FullStack | [@IAlexLizano](https://github.com/IAlexLizano) |
| **Oscar** | Frontend | [@OscarJRM](https://github.com/OscarJRM) |
</div>

---

## ✨ Características

-   ✅ Autenticación JWT completa
-   📝 Gestión completa de talleres, reservas, instructores, ensayos ubicaciones, eventos y horarios
-   📊 API REST bien documentada con Scramble(en modo desarrollador)

---

## 🗄️ Creación de la base de datos

> 🏗️ **¡Un paso y listo!**
>
> Crea una base de datos llamada **spaces_cca** con cotejamiento **utf8mb4_unicode_ci** antes de migrar 🚦. Así tendrás soporte para todos los caracteres y emojis que necesites.

---

## 🚀 Instalación rápida

```bash
# 1. Clona el repositorio
$ git clone <url-del-repo>
$ cd espacios_cca_backend

# 2. Instala dependencias PHP
$ composer install

# 3. Configura tu entorno
$ cp .env.example .env
# Edita .env con tus credenciales de la bd creada

# 4. Genera claves y configura JWT
$ php artisan key:generate
$ php artisan jwt:secret

# 5. Migra y llena la base de datos con lo basico
$ php artisan migrate --seed

# 6. (Opcional) Publica configuraciones JWT
$ php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"
```

<div align="center">
  <strong>¡ARRANCA LA API EN TU NAVEGADOR!</strong>
</div>

```sh
php artisan serve
```

<span style="font-size:1.1em; color:#4CAF50;">Accede a <b>http://127.0.0.1:8000</b> para ver la API en acción 🚀</span>

---

## 🧹 Comandos útiles

-   Limpiar cachés de Laravel:
    ```sh
    php artisan config:clear && php artisan route:clear && php artisan view:clear && php artisan cache:clear
    ```
-   Limpiar caché de Composer:
    ```sh
    composer dump-autoload
    ```
---

## ⚙️ Configuración recomendada

### Variables de Entorno Principales
```env
APP_NAME=Espacios_cca_backend
APP_ENV=local
APP_TIMEZONE=America/Guayaquil
APP_LOCALE=es_EC

# Base de datos
DB_CONNECTION=mysql
DB_DATABASE=spaces_cca
DB_USERNAME=root
DB_PASSWORD=root

# JWT Configuration
JWT_SECRET=your-jwt-secret
JWT_ALGO=HS256
```
---

## 📦 Estructura del proyecto

```text
espacios_cca_backend/
├── app/
│   ├── Models/           # Modelos Eloquent (Workshop, SpaceReservation, etc.)
│   └── Http/Controllers/ # Lógica de negocio y endpoints API
├── database/
│   ├── migrations/       # Migraciones de tablas
│   └── seeders/          # Datos de ejemplo
├── routes/api.php        # Rutas de la API REST
├── config/               # Configuraciones (JWT, database, etc.)
└── ...
```

---

## 💡 Notas finales

-   Documentación interactiva disponible en `/docs/api` (cuando esta en desarrollo).
-   Si tienes problemas, limpia cachés y revisa  `.env`.
