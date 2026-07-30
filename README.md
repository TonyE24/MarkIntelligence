# MarkIntelligence – Plataforma de Inteligencia de Mercados

[![Live Demo](https://img.shields.io/badge/Demo-Live%20Vercel-brightgreen?style=for-the-badge&logo=vercel)](https://mark-intelligence.vercel.app/)
[![GitHub Repo](https://img.shields.io/badge/GitHub-MarkIntelligence-181717?style=for-the-badge&logo=github)](https://github.com/TonyE24/MarkIntelligence)
[![React](https://img.shields.io/badge/Frontend-React%2018%20%2B%20TS-61DAFB?style=for-the-badge&logo=react)](https://react.dev/)
[![Laravel](https://img.shields.io/badge/Backend-Laravel%2011-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=for-the-badge&logo=mysql)](https://www.mysql.com/)

Plataforma Web Full-Stack de analítica de mercado y soporte a decisiones de negocio para PYMEs, desarrollada como proyecto principal para el **Reto Ogilvy El Salvador**. El sistema combina un dashboard interactivo de alto rendimiento con una API RESTful desacoplada y robusta.

---

## Enlaces Rápidos

* **Demo en Vivo (Frontend):** [mark-intelligence.vercel.app](https://mark-intelligence.vercel.app/)
* **Repositorio GitHub:** [github.com/TonyE24/MarkIntelligence](https://github.com/TonyE24/MarkIntelligence)
* **Documentación Técnica:** [Carpeta /docs](docs/README.md)

---

## Características Principales

La plataforma implementa 4 módulos de analítica estratégica:

1. **Inteligencia de Mercado:** Comparativas de precios, posicionamiento competitivo y cuotas de mercado.
2. **Inteligencia de Tendencias:** Análisis de volumen de búsqueda de palabras clave y análisis de sentimiento.
3. **Inteligencia de Predicción:** Algoritmos de proyección de ventas basados en modelos de regresión lineal.
4. **Inteligencia de Innovación:** Identificación dinámica de nichos y oportunidades emergentes en el mercado.

---

## Stack Tecnológico & Arquitectura

### **Frontend (SPA)**
- **Framework:** React 18 + TypeScript + Vite 5
- **Estilos & UI:** Tailwind CSS + Lucide Icons
- **Visualización de Datos:** Recharts (gráficos interactivos adaptables)
- **Rutado:** React Router v6
- **Despliegue:** Vercel

### **Backend (API RESTful)**
- **Framework:** Laravel 11 (PHP 8.2+)
- **Base de Datos:** MySQL 8.0
- **Autenticación:** Laravel Sanctum (Tokens de API con seguridad SPA)
- **Testing:** PHPUnit
- **Despliegue:** Railway

---

## Estructura del Monorepo

```
MarkIntelligence/
├── Backend/             # API RESTful en Laravel 11
│   ├── app/             # Controladores, Modelos y Lógica de Negocio
│   ├── database/        # Migraciones y Seeders
│   └── routes/          # Endpoints de API (/api/v1)
├── Frontend/            # SPA en React 18 + TypeScript
│   ├── src/             # Componentes, Vistas, Hooks y Servicios API
│   └── public/          # Assets estáticos
└── docs/                # Documentación Técnica Completa (Architecture, Database, API)
```

---

## Inicio Rápido en Desarrollo Local

### 1. Clonar el repositorio
```bash
git clone https://github.com/TonyE24/MarkIntelligence.git
cd MarkIntelligence
```

### 2. Levantar el Backend (Laravel)
```bash
cd Backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
> El Backend estará escuchando en: `http://localhost:8000`

### 3. Levantar el Frontend (React)
```bash
cd ../Frontend
npm install
npm run dev
```
> El Frontend estará escuchando en: `http://localhost:5173`

---

## Documentación Técnica Completa

Toda la documentación técnica del sistema se encuentra organizada en la carpeta [`/docs`](docs/README.md):

* **[Arquitectura del Sistema](docs/ARCHITECTURE.md):** Diagrama de capas y comunicación desacoplada.
* **[Esquema de Base de Datos](docs/DATABASE_SCHEMA.md):** Modelo ER, tablas y relaciones.
* **[Documentación de API](docs/API_DOCUMENTATION.md):** Especificación de endpoints, headers y formatos JSON.
* **[Decisiones Técnicas](docs/TECHNICAL_DECISIONS.md):** Justificación del stack, trade-offs y patrones de diseño.
* **[Guía de Instalación Local](docs/INSTALLATION.md):** Requisitos y troubleshooting.
* **[Guía de Despliegue](docs/DEPLOYMENT.md):** Configuración en Vercel y Railway.

---

## 👨‍💻 Autor

**Tony E.**  
- **GitHub:** [@TonyE24](https://github.com/TonyE24)
