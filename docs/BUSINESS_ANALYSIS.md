# Análisis del Caso de Negocio
## Plataforma de Inteligencia y Monitoreo para PYMEs

---

## 1. Resumen Ejecutivo

**Problema:** Las PYMEs no tienen acceso a herramientas de inteligencia de mercado debido a costos elevados y complejidad técnica.

**Solución:** Plataforma web accesible que consolida datos de múltiples fuentes y los transforma en información útil para la toma de decisiones.

**Objetivo:** Democratizar el acceso a inteligencia de mercado para pequeñas y medianas empresas.

---

## 2. Stakeholders

### Primarios
- **PYMEs:** Usuarios finales de la plataforma
- **Administradores:** Configuran y gestionan la cuenta empresarial
- **Usuarios:** Consultan dashboards y reportes

### Secundarios
- **Equipo de Desarrollo:** Construyen y mantienen la plataforma
- **Ogilvy El Salvador:** Patrocinador del reto
- **Proveedores de APIs:** Servicios externos de datos

---

## 3. Requisitos Funcionales

### RF-01: Autenticación
- Registro de usuarios
- Login con email/password
- Recuperación de contraseña
- Roles: admin y usuario
- Protección de rutas

### RF-02: Configuración de Empresa
- Crear perfil de empresa
- Definir industria, país, región
- Configurar palabras clave de interés
- Editar configuración

### RF-03: Dashboard General
- Mostrar KPIs principales
- Filtros por fecha y categoría
- Acceso a 4 módulos de inteligencia

### RF-04: Inteligencia de Mercado
- Comparativa de precios
- Cuota de mercado
- Identificar competidores
- Visualizaciones en gráficos

### RF-05: Inteligencia de Tendencias
- Análisis de keywords
- Análisis de sentimiento
- Volumen de menciones
- Gráficos de tendencias

### RF-06: Inteligencia de Predicción
- Predicciones con regresión lineal
- Datos históricos vs predicción
- Métricas de confianza

### RF-07: Inteligencia de Innovación
- Detectar oportunidades
- Identificar gaps de mercado
- Tecnologías emergentes

### RF-08: Procesamiento de Datos
- Limpieza de datos
- Normalización
- Generación de métricas

### RF-09: Visualizaciones
- Gráficos de líneas
- Gráficos de pastel
- Tablas de datos
- Diseño responsive

---

## 4. Requisitos No Funcionales

### RNF-01: Seguridad
- Contraseñas cifradas (bcrypt)
- Rutas protegidas
- Validación de inputs
- Prevención XSS/SQL Injection
- Rate limiting

### RNF-02: Rendimiento
- Carga inicial < 3 segundos
- Queries optimizadas
- Lazy loading
- Bundle optimizado

### RNF-03: Usabilidad
- Interfaz intuitiva
- Responsive design
- Feedback visual
- Mensajes de error claros

### RNF-04: Escalabilidad
- Arquitectura modular
- Soporte multi-empresa
- Base de datos normalizada
- Código SOLID

### RNF-05: Mantenibilidad
- Código documentado
- Cobertura de tests > 70%
- Convenciones de código
- Logging de errores

---

## 5. Casos de Uso

### CU-01: Registro e Inicio de Sesión
1. Usuario accede a la plataforma
2. Selecciona "Registrarse"
3. Ingresa datos (nombre, email, password)
4. Sistema valida y crea cuenta
5. Usuario hace login
6. Sistema redirige al dashboard

### CU-02: Configuración de Empresa
1. Admin hace login
2. Sistema muestra wizard de configuración
3. Admin ingresa datos de empresa
4. Sistema guarda configuración
5. Redirige al dashboard

### CU-03: Consulta de Inteligencia de Mercado
1. Usuario accede al módulo
2. Selecciona filtros (fecha, categoría)
3. Sistema consulta datos
4. Sistema procesa y calcula métricas
5. Muestra gráficos y tablas

---

## 6. Criterios de Éxito

✅ Sistema de autenticación funcional  
✅ 4 módulos de inteligencia implementados  
✅ Dashboard con visualizaciones  
✅ Integración con APIs (reales o mock)  
✅ Base de datos correctamente diseñada  
✅ Código con buenas prácticas  
✅ Documentación completa  
✅ MVP desplegado en producción  

---

## 7. Riesgos

| Riesgo | Probabilidad | Impacto | Mitigación |
|--------|--------------|---------|------------|
| APIs no disponibles | Media | Alto | Mock data como fallback |
| Complejidad de IA | Alta | Medio | Algoritmos simples |
| Problemas de integración | Media | Medio | Definir contrato de API temprano |
| Falta de experiencia | Media | Alto | Tiempo de aprendizaje |
| Alcance muy amplio | Alta | Alto | Priorizar MVP |

---

**Documento creado:** 14 Feb 2026  
**Estado:** ✅ Completado
