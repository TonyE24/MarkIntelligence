# Plataforma de Inteligencia de Mercados - Reto Ogilvy

Este es el repositorio del MVP que construí para el reto de pasantía de Ogilvy El Salvador. La plataforma es un sistema de análisis de mercado enfocado en ayudar a PYMEs a tomar mejores decisiones basadas en datos. 

Durante el desarrollo, me enfoqué mucho en que el dashboard se sintiera fluido y en tener una API sólida por detrás.

## 🛠️ Retos y Decisiones Técnicas

- **Setup del Monorepo (Casi):** Decidí mantener Backend y Frontend en la misma raíz para facilidad de desarrollo, pero se deployan por separado.
- **Gráficos Reactivos:** Usé Recharts porque necesitaba customizar bastante los tooltips, y era la que mejor rendimiento me daba con el *mock data* pesado.
- **Autenticación:** Implementé Laravel Sanctum por su simplicidad con SPAs. Costó un poco alinear los headers de CORS con Vite, pero quedó estable.

## 🚀 Stack Tecnológico

- **Frontend:** React + TypeScript + Vite + Tailwind CSS
- **Backend:** Laravel + MySQL
- **Autenticación:** Laravel Sanctum (Tokens JWT-like para API)
- **Visualizaciones:** Recharts
- **Navegación:** React Router v6

## 📋 Módulos de Inteligencia

- **Inteligencia de Mercado** - Comparativa de precios y cuota de mercado
- **Inteligencia de Tendencias** - Análisis de keywords y sentimiento
- **Inteligencia de Predicción** - Proyecciones de ventas (regresión lineal manual)
- **Inteligencia de Innovación** - Detección de oportunidades emergentes

## 🏗️ Estructura del Proyecto

## ⚡ Inicio Rápido

### Backend (Laravel)

<img width="1485" height="1398" alt="Backend" src="https://github.com/user-attachments/assets/06c5ad03-3d53-477a-968b-618ede496434" />

API disponible en: http://localhost:8000

### Frontend (React)
<img width="2133" height="1038" alt="Frontend" src="https://github.com/user-attachments/assets/1d79fad4-5ebc-4d30-88da-45cd918673f8" />
Aplicación disponible en: http://localhost:5173

## 📚 Documentación Interactiva

Toda la documentación técnica y de negocio vive en la carpeta `/docs`:

- ⚙️ **[Guía de Instalación Local](docs/INSTALLATION.md)** - Cómo levantar el proyecto de cero.
- 🚀 **[Guía de Deploy (Producción)](docs/DEPLOYMENT.md)** - Cómo subir a Vercel y Railway.
- 🔌 **[Documentación de API](docs/API_DOCUMENTATION.md)** - Endpoints, Headers y ejemplos.
- 📊 **[Arquitectura](docs/ARCHITECTURE.md)** y **[Base de Datos](docs/DATABASE_SCHEMA.md)** - Diagramas técnicos.
- 💡 **[Estrategia de APIs](docs/API_STRATEGY.md)** y **[Decisiones Técnicas](docs/TECHNICAL_DECISIONS.md)**.
