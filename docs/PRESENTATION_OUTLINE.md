# Esquema de Presentación — MarkIntelligence 📊

> **Tiempo estimado:** 15 a 20 minutos
> **Formato:** Presentación interactiva con Live Demo
> **Público:** Jurado técnico y de negocio.

Este es un esquema de **12 diapositivas** diseñado para llevar a la audiencia a través del viaje de construcción de la plataforma, desde el problema inicial hasta el producto funcional, destacando nuestro stack, arquitectura, seguridad y experiencia de usuario.

---

### Slide 1: Portada (Intro)
- **Título:** MarkIntelligence
- **Subtítulo:** Plataforma de Inteligencia de Mercado accionable para PYMEs.
- **Tu Nombre/Equipo:** Reto Ogilvy El Salvador.
- **Visual:** Logo/Nombre moderno.

### Slide 2: El Problema
- **Contexto:** Las PYMEs tienen muchísimos datos pero no saben cómo convertirlos en decisiones estratégicas que aumenten sus ventas.
- **Dolor Principal:** Herramientas complejas y poco intuitivas. Las PYMEs mueren rápido sin entender su propio mercado.
- **Bullets:** Desconexión, altos costos de investigación, "data-parálisis".

### Slide 3: La Solución (Nuestra Propuesta de Valor)
- **Concepto:** Una plataforma SaaS (Software as a Service) 100% autogestionable y con inteligencia artificial algorítmica.
- **Pilares:**
  1. Análisis de Sentimiento y Tendencias.
  2. Predicciones con Machine Learning (Regresión).
  3. UX Increíble que habla el idioma de las PYMEs.
- **Visual:** Un pequeño preview de la interfaz limpia del dashboard.

### Slide 4: Arquitectura del Sistema
- **Diagrama de alto nivel:** Mostrar cómo están separadas las capas.
  - *Frontend:* React + Vite + Tailwind CSS.
  - *Backend:* Laravel 11 (API REST), Rutas estructuradas.
  - *Base de Datos:* MySQL relacional.
- **Enfoque API-first:** Frontend y Backend completamente desacoplados.

### Slide 5: Seguridad y Buenas Prácticas (Backend)
- **Autenticación (Sanctum):** Seguridad moderna con Bearer Tokens y flujos como *Forgot Password*.
- **Rate Limiting:** Estrategia de "Throttle" contra ataques DDOS (ej. 5 peticiones de login por minuto).
- **Sanitización & FormRequests:** Filtros estrictos a todos los JSONs de entrada para evitar ataques XSS e Inyecciones SQL.
- **Logging Automático:** Registro global de todas las llamadas API para auditoría y debug fácil.

### Slide 6: Rendimiento y Experiencia de Usuario (Frontend)
- **Lazy Loading (Code Splitting):** La aplicación no carga toda de una vez; se rompe el "Javascript Chunk" por cada módulo para bajar latencias.
- **Memoización:** Hooks nativos e Inteligentes (`useIntelligenceData`) que usan `useCallback` para evitar peticiones repetidas.
- **Manejo de Errores (Error Boundaries):** Si algo se rompe, solo esa sección muestra un error amigable, protegiendo al resto de la App.
- **UX Atractiva:** Gráficos responsive interactivos (Recharts), Skeleton loaders en lugar de spinners pesados, notificaciones estilo Toast.

### Slide 7 a 9: ✨ Live Demo (¡Lo más importante!)
- *Muestra directamente la App corriendo en Vercel.*
  - **Slide 7 / Demo 1:** Flujo de Registro de un Usuario Nuevo y Creación de "La Empresa".
  - **Slide 8 / Demo 2:** Muestra el Dashboard. Explica qué es un KPI de "Cuota de Mercado" y cómo el sistema genera recomendaciones (Innovación).
  - **Slide 9 / Demo 3:** Navegación Responsive. Redimensionar la pantalla a "Mobile" y mostrar cómo funciona el Menú Hamburguesa en tiempo real.

### Slide 10: Testing y Calidad (QA)
- **Testing Unitario/Característico:** Expresión de confianza. Mención de los tests automatizados en PHP (`php artisan test`) sobre el `Auth`, `RateLimiting`, `DataProcessingService`.
- **Frontend Vitest:** Pruebas DOM que aseguran que el ecosistema reaccione correctamente.
- *Visual:* Mostrar un pantallazo verde (✅ 100% Pass) corriendo las pruebas.

### Slide 11: Retos y Aprendizajes
- Compartir obstáculos verdaderos enfrentados durante estas 6 semanas (e.g., config de CORS para separar Laravel de React, algoritmos de regresión lineal base en PHP, manejo avanzado del estado de los gráficos).
- **Enfoque Final:** Cómo se adaptó el desarrollo usando guías claras de GitHub e Issues estructurados.

### Slide 12: Próximos Pasos (Roadmap del Producto)
- ¿Hasta dónde queremos llegar si nos dan más tiempo?
  - IA Generativa: Modelos como GPT-4V para que lean gráficos automáticamente.
  - Exportación PDF/CSV en un solo botón.
  - Websockets para datos realmente "En vivo" sobre ventas.
- **Cierre:** Q&A. ¡Gracias!
