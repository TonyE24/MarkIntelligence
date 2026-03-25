# 📚 Documentación del Proyecto - MarkIntelligence

Bienvenido a la documentación técnica del MVP de **Plataforma de Inteligencia y Monitoreo para PYMEs**, desarrollado como parte del reto de Ogilvy El Salvador.

---

## 📋 Documentos Principales (Requeridos por el Reto)

Estos documentos responden directamente a los entregables solicitados:

### 🏗️ [ARCHITECTURE.md](ARCHITECTURE.md)
**Descripción de arquitectura y diagramas**
- Arquitectura general del sistema
- Diagrama de componentes (Frontend ↔ Backend ↔ Database)
- Flujo de comunicación entre capas
- Decisiones arquitectónicas

### 🔧 [TECHNICAL_DECISIONS.md](TECHNICAL_DECISIONS.md)
**Decisiones técnicas y justificaciones**
- Stack tecnológico seleccionado (React, Laravel, MySQL)
- Justificación de cada tecnología elegida
- Alternativas evaluadas
- Trade-offs y consideraciones

### 💾 [DATABASE_SCHEMA.md](DATABASE_SCHEMA.md)
**Diagrama de base de datos**
- Esquema de tablas y relaciones
- Modelos de datos (Users, Companies, Intelligence modules)
- Migraciones y seeders
- Decisiones de normalización

### ⚙️ [INSTALLATION.md](INSTALLATION.md)
**Instrucciones de instalación local**
- Requisitos del sistema
- Instalación paso a paso del Backend (Laravel)
- Instalación paso a paso del Frontend (React)
- Configuración de base de datos
- Troubleshooting común

---

## 📖 Documentación Complementaria

Estos documentos proporcionan información adicional valiosa:

### 🌐 [API_DOCUMENTATION.md](API_DOCUMENTATION.md)
**Documentación completa de endpoints**
- Lista de todos los endpoints disponibles
- Métodos HTTP, parámetros y respuestas
- Ejemplos de requests y responses
- Headers requeridos (Authorization)
- Códigos de error

### 🔌 [API_STRATEGY.md](API_STRATEGY.md)
**Estrategia de consumo de APIs**
- Enfoque de integración con fuentes externas
- Mock Data Service para simular APIs reales
- Estrategia de escalabilidad para APIs comerciales
- Manejo de errores y rate limiting
- Estructura de respuestas

### 🚀 [DEPLOYMENT.md](DEPLOYMENT.md)
**Guía de despliegue en producción**
- Deploy del Frontend en Vercel
- Deploy del Backend en Railway
- Configuración de variables de entorno
- Conexión a base de datos en producción
- Verificación del despliegue

### 📁 [PROJECT_STRUCTURE.md](PROJECT_STRUCTURE.md)
**Estructura detallada del proyecto**
- Árbol de directorios del Backend (Laravel)
- Árbol de directorios del Frontend (React)
- Diagramas de flujo de desarrollo
- Organización de módulos y componentes
- Convenciones de código

---

## 🎯 Orden Recomendado de Lectura

Si eres un evaluador o revisor técnico, te recomendamos leer los documentos en este orden:

1. **`ARCHITECTURE.md`** → Entender la solución completa
2. **`TECHNICAL_DECISIONS.md`** → Conocer las decisiones técnicas
3. **`DATABASE_SCHEMA.md`** → Revisar el modelo de datos
4. **`INSTALLATION.md`** → Levantar el proyecto localmente
5. **`API_DOCUMENTATION.md`** → Probar los endpoints
6. **`PROJECT_STRUCTURE.md`** → Navegar el código fuente

---

## 🛠️ Stack Tecnológico (Resumen)

### Backend
- **Framework:** Laravel 11
- **Lenguaje:** PHP 8.2+
- **Base de Datos:** MySQL 8.0
- **Autenticación:** Laravel Sanctum
- **Testing:** PHPUnit

### Frontend
- **Framework:** React 18
- **Lenguaje:** TypeScript 5
- **Build Tool:** Vite 5
- **Estilos:** Tailwind CSS 3
- **Gráficos:** Recharts
- **Testing:** Vitest + React Testing Library

---

## 📦 Módulos de Inteligencia Implementados

La plataforma incluye los 4 módulos requeridos:

1. **Inteligencia de Mercado** - Comparativa de precios y cuota de mercado
2. **Inteligencia de Tendencias** - Análisis de keywords y sentimiento
3. **Inteligencia de Predicción** - Proyecciones con regresión lineal
4. **Inteligencia de Innovación** - Detección de oportunidades emergentes

---

## 🔗 Enlaces Rápidos

- **[Repositorio Principal](../README.md)** - README del proyecto
- **[Backend README](../Backend/README.md)** - Documentación del Backend
- **[Frontend README](../Frontend/README.md)** - Documentación del Frontend

---

## 📞 Soporte

Si tienes dudas sobre la documentación o el proyecto, revisa:
- Los comentarios en el código fuente
- Los tests del proyecto
- Las migraciones de la base de datos

---

**Proyecto:** MarkIntelligence  
**Reto:** Ogilvy El Salvador - Desarrollo de Plataforma de Inteligencia para PYMEs  
**Última actualización:** Marzo 2026
