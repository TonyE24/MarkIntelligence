# Guía de Instalación Local — MarkIntelligence 💻

Si deseas descargar, instalar y ejecutar el proyecto **MarkIntelligence** de manera local en tu propia computadora, sigue detalladamente los siguientes pasos.

---

## 📋 Requisitos Previos

Asegúrate de tener instaladas las siguientes herramientas en tu sistema antes de continuar:

- **PHP** (v8.2 o superior)
- **Composer** (v2.x)
- **Node.js** (v18.x o superior) y **npm**
- **MySQL** (v8.x) o MariaDB
- **Git**

---

## 🚀 1. Instalación del Backend (Laravel)

El servidor y la API RESTful de la aplicación viven dentro de la carpeta `Backend`.

1. **Abre tu terminal y clona el repositorio:**
   ```bash
   git clone https://github.com/TU_USUARIO/MarkIntelligence.git
   cd MarkIntelligence/Backend
   ```

2. **Instala las dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Configura las variables de entorno:**
   - Copia el archivo de ejemplo para crear el tuyo propio:
     ```bash
     cp .env.example .env
     ```
   - Abre el archivo `.env` en tu editor de código y configura la conexión a la base de datos MySQL local:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=pyme_intelligence
     DB_USERNAME=root
     DB_PASSWORD=tu_contraseña_si_tienes
     ```

4. **Genera la Clave de la Aplicación, Migra la DB y Carga Datos de Prueba:**
   Asegúrate de haber creado una base de datos vacía llamada `pyme_intelligence` en tu MySQL (puedes hacerlo desde phpMyAdmin o DBeaver).
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```
   > El flag `--seed` pobla la base de datos con empresas y datos de ejemplo para que el dashboard no esté vacío al iniciar.

5. **Levanta el servidor local:**
   ```bash
   php artisan serve
   ```
   > El Backend estará corriendo por defecto en `http://127.0.0.1:8000`.

---

## 🎨 2. Instalación del Frontend (React + Vite)

Toda la interfaz de usuario se encuentra en la carpeta `Frontend`. Abre **otra pestaña nueva** en tu terminal.

1. **Entra al directorio Frontend:**
   ```bash
   cd MarkIntelligence/Frontend
   ```

2. **Instala las dependencias de JavaScript:**
   ```bash
   npm install
   ```

3. **Conecta el Front al Back (Variables de entorno):**
   - Crea un archivo en la raíz de `Frontend/` llamado `.env.local`.
   - Agrega la siguiente línea apuntando al backend local que dejaste corriendo:
     ```env
     VITE_API_BASE_URL=http://127.0.0.1:8000/api
     ```

4. **Levanta el servidor de desarrollo de Vite:**
   ```bash
   npm run dev
   ```
   > El Frontend estará corriendo por defecto en `http://localhost:5173`.

---

## ✅ 3. Verificación Final

1. Abre tu navegador y dirígete a `http://localhost:5173`.
2. Deberías ver la pantalla de Login de MarkIntelligence.
3. Puedes hacer clic en **"Crear Cuenta"** para registrar un nuevo usuario y acceder a la plataforma. Si corriste los seeders, ya tendrás empresas de ejemplo con datos listos para visualizar en el dashboard.
