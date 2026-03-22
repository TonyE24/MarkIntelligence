# Guía de Deploy a Producción — MarkIntelligence 🚀

Instrucciones para subir el proyecto a los servicios en la nube que elegimos: **Vercel** para el Frontend y **Railway** para el Backend.

---

## 1. Backend en Railway

Railway permite hostear aplicaciones Laravel conectadas a una base de datos MySQL sin tener que configurar servidores manualmente.

### Pasos

1. **Crea una cuenta en [railway.app](https://railway.app)** y conecta tu repositorio de GitHub.

2. **Agrega un servicio MySQL** desde el dashboard de Railway (botón "+ New" → Database → MySQL). Railway te dará automáticamente las credenciales.

3. **Configura las variables de entorno** en la pestaña "Variables" del servicio de tu app:
   ```
   APP_KEY=base64:... (copia el de tu .env local)
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://tu-dominio-railway.up.railway.app

   DB_CONNECTION=mysql
   DB_HOST=(el host que Railway te da)
   DB_PORT=3306
   DB_DATABASE=railway
   DB_USERNAME=root
   DB_PASSWORD=(la password que Railway genera)

   FRONTEND_URL=https://tu-proyecto.vercel.app
   SANCTUM_STATEFUL_DOMAINS=tu-proyecto.vercel.app
   ```

4. **Configura el build command** en Railway:
   ```bash
   composer install --no-dev --optimize-autoloader && php artisan migrate --force
   ```

5. **Start command:**
   ```bash
   php artisan serve --host=0.0.0.0 --port=$PORT
   ```

6. Una vez desplegado, copia la URL pública que Railway te asigna (algo como `https://markintelligence-production.up.railway.app`).

---

## 2. Frontend en Vercel

Vercel es ideal para apps de React/Vite porque detecta el framework automáticamente.

### Pasos

1. **Crea una cuenta en [vercel.com](https://vercel.com)** e importa el repositorio.

2. **Configura el proyecto:**
   - **Root Directory:** `Frontend`
   - **Framework Preset:** Vite
   - **Build Command:** `npm run build`
   - **Output Directory:** `dist`

3. **Variables de entorno** (en Settings → Environment Variables):
   ```
   VITE_API_BASE_URL=https://tu-dominio-railway.up.railway.app/api
   ```

4. **Haz deploy.** Vercel se encargará del build y te dará una URL pública.

5. **Importante:** Asegúrate de tener el archivo `vercel.json` en la carpeta `Frontend/` con la configuración de rewrites para que React Router funcione bien en producción:
   ```json
   {
     "rewrites": [{ "source": "/(.*)", "destination": "/index.html" }]
   }
   ```

---

## 3. Verificación Post-Deploy

1. Abre la URL de Vercel en tu navegador.
2. Registra un usuario nuevo.
3. Configura una empresa y navega por los módulos del dashboard.
4. Verifica en Railway que las migraciones corrieron bien revisando los logs.

---

## Notas

- Si el login falla con un error de CORS, revisa que `SANCTUM_STATEFUL_DOMAINS` y `FRONTEND_URL` estén bien escritos en las variables de Railway.
- Para poblar la base de datos de producción con datos de prueba, puedes correr manualmente: `php artisan db:seed` desde la consola de Railway.
