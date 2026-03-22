# Arquitectura del Sistema
## Plataforma de Inteligencia y Monitoreo para PYMEs

---

## 1. Diagrama de Arquitectura General

```mermaid
graph TB
    subgraph "Cliente (Browser)"
        A[React App<br/>TypeScript + Vite]
    end
    
    subgraph "API Layer"
        B[Laravel API<br/>REST Endpoints]
        C[Laravel Sanctum<br/>Authentication]
    end
    
    subgraph "Business Logic"
        D[Controllers]
        E[Services]
        F[Data Processing]
    end
    
    subgraph "Data Layer"
        G[(MySQL Database)]
        H[Eloquent ORM]
    end
    
    subgraph "External Services"
        I[APIs Externas<br/>o Mock Data]
        J[News API]
        K[Market Data API]
        L[Social Media API]
    end
    
    A -->|HTTP/REST| B
    A -->|Auth Tokens| C
    B --> D
    D --> E
    E --> F
    E --> H
    H --> G
    E -->|Fetch Data| I
    I --> J
    I --> K
    I --> L
    
    style A fill:#61dafb,stroke:#333,stroke-width:2px
    style B fill:#ff2d20,stroke:#333,stroke-width:2px
    style G fill:#4479a1,stroke:#333,stroke-width:2px
    style I fill:#ffa500,stroke:#333,stroke-width:2px
```

---

## 2. Arquitectura de 3 Capas Detallada

```mermaid
graph LR
    subgraph "Presentation Layer"
        A1[Components]
        A2[Pages]
        A3[Hooks]
        A4[Context]
    end
    
    subgraph "Application Layer"
        B1[API Routes]
        B2[Controllers]
        B3[Middleware]
        B4[Services]
        B5[Validators]
    end
    
    subgraph "Data Layer"
        C1[Models]
        C2[Migrations]
        C3[Seeders]
        C4[Database]
    end
    
    A1 --> B1
    A2 --> B1
    A3 --> B1
    A4 --> B1
    
    B1 --> B2
    B2 --> B3
    B2 --> B4
    B2 --> B5
    
    B4 --> C1
    C1 --> C2
    C1 --> C3
    C2 --> C4
    C3 --> C4
```

---

## 3. Flujo de Autenticación

```mermaid
sequenceDiagram
    participant U as Usuario
    participant F as Frontend (React)
    participant API as Laravel API
    participant Auth as Sanctum
    participant DB as MySQL
    
    U->>F: Ingresa email/password
    F->>API: POST /api/auth/login
    API->>Auth: Validar credenciales
    Auth->>DB: SELECT user WHERE email
    DB-->>Auth: User data
    Auth->>Auth: Verificar password (bcrypt)
    Auth-->>API: Token generado
    API-->>F: {user, token}
    F->>F: Guardar token en localStorage
    F->>F: Actualizar AuthContext
    F-->>U: Redirigir a /dashboard
    
    Note over F,API: Requests subsecuentes incluyen token en header
    
    F->>API: GET /api/dashboard<br/>Header: Authorization Bearer {token}
    API->>Auth: Validar token
    Auth-->>API: Usuario autenticado
    API-->>F: Dashboard data
```

---

## 4. Flujo de Datos de Inteligencia

```mermaid
sequenceDiagram
    participant U as Usuario
    participant F as Frontend
    participant API as Laravel API
    participant S as DataProcessingService
    participant Ext as API Externa/Mock
    participant DB as MySQL
    
    U->>F: Selecciona "Inteligencia de Mercado"
    F->>API: GET /api/intelligence/market?company_id=1
    API->>S: processMarketData(companyId)
    
    alt Datos en caché (< 1 hora)
        S->>DB: SELECT cached_data
        DB-->>S: Cached data
    else Datos no en caché
        S->>Ext: Fetch market data
        Ext-->>S: Raw JSON data
        S->>S: Limpiar datos (nulls, duplicados)
        S->>S: Normalizar formatos
        S->>S: Calcular métricas
        S->>DB: INSERT processed_data
    end
    
    S-->>API: Processed insights
    API-->>F: JSON response
    F->>F: Renderizar gráficos (Recharts)
    F-->>U: Mostrar visualizaciones
```

---

## 5. Estructura de Componentes Frontend

```mermaid
graph TD
    A[App.tsx] --> B[AuthProvider]
    B --> C[Router]
    
    C --> D[Public Routes]
    C --> E[Protected Routes]
    
    D --> F[LoginPage]
    D --> G[RegisterPage]
    D --> H[ForgotPasswordPage]
    
    E --> I[DashboardLayout]
    I --> J[Sidebar]
    I --> K[Header]
    I --> L[Main Content]
    
    L --> M[DashboardPage]
    L --> N[MarketIntelligencePage]
    L --> O[TrendIntelligencePage]
    L --> P[PredictionPage]
    L --> Q[InnovationPage]
    
    M --> R[KPICard]
    M --> S[QuickAccessCard]
    
    N --> T[LineChart]
    N --> U[BarChart]
    N --> V[DataTable]
    
    O --> T
    O --> W[PieChart]
    O --> V
    
    P --> T
    P --> X[PredictionChart]
    
    Q --> Y[OpportunityCard]
    Q --> V
```

---

## 6. Estructura de Backend (Laravel)

```mermaid
graph TD
    A[routes/api.php] --> B{Middleware}
    
    B -->|Public| C[AuthController]
    B -->|Protected| D[CompanyController]
    B -->|Protected| E[DashboardController]
    B -->|Protected| F[Intelligence Controllers]
    
    C --> G[AuthService]
    D --> H[CompanyService]
    E --> I[DashboardService]
    F --> J[MarketIntelligenceService]
    F --> K[TrendIntelligenceService]
    F --> L[PredictionService]
    F --> M[InnovationService]
    
    G --> N[User Model]
    H --> O[Company Model]
    J --> P[MarketData Model]
    K --> Q[TrendData Model]
    L --> R[PredictionData Model]
    M --> S[InnovationData Model]
    
    J --> T[MockDataService]
    K --> T
    L --> T
    M --> T
    
    T --> U[External APIs]
    
    N --> V[(MySQL)]
    O --> V
    P --> V
    Q --> V
    R --> V
    S --> V
```

---

## 7. Patrones de Diseño Utilizados

### 7.1 Repository Pattern (Opcional)
```
Controller → Service → Repository → Model → Database
```
**Beneficio:** Abstrae acceso a datos, facilita testing

### 7.2 Service Layer Pattern
```
Controller → Service (Business Logic) → Model
```
**Beneficio:** Separa lógica de negocio de controllers

### 7.3 Provider Pattern (Frontend)
```
App → AuthProvider → Components
```
**Beneficio:** Estado global sin prop drilling

### 7.4 Custom Hooks Pattern
```
Component → useAuth() → AuthContext
Component → useIntelligence() → API Service
```
**Beneficio:** Reutilización de lógica

---

## 8. Estrategia de Caché

```mermaid
graph LR
    A[Request] --> B{Caché existe?}
    B -->|Sí| C{Caché válido?}
    B -->|No| D[Fetch API Externa]
    C -->|Sí| E[Retornar caché]
    C -->|No| D
    D --> F[Procesar datos]
    F --> G[Guardar en DB]
    G --> H[Retornar datos]
    E --> I[Response]
    H --> I
```

**Tiempos de caché:**
- Market Intelligence: 1 hora
- Trend Intelligence: 30 minutos
- Prediction: 6 horas
- Innovation: 24 horas

---

## 9. Manejo de Errores

```mermaid
graph TD
    A[Request] --> B{Try}
    B --> C[Ejecutar lógica]
    C --> D{Success?}
    D -->|Sí| E[Return 200 OK]
    D -->|No| F{Tipo de Error}
    
    F -->|ValidationException| G[Return 422]
    F -->|AuthenticationException| H[Return 401]
    F -->|AuthorizationException| I[Return 403]
    F -->|ModelNotFoundException| J[Return 404]
    F -->|Exception| K[Log Error]
    K --> L[Return 500]
    
    G --> M[Frontend: Mostrar errores de validación]
    H --> N[Frontend: Redirigir a login]
    I --> O[Frontend: Mostrar mensaje de acceso denegado]
    J --> P[Frontend: Mostrar recurso no encontrado]
    L --> Q[Frontend: Mostrar error genérico]
```

---

## 10. Seguridad en Capas

```mermaid
graph TB
    A[Request] --> B[CORS Middleware]
    B --> C[Rate Limiting]
    C --> D[Sanctum Auth]
    D --> E[Role Middleware]
    E --> F[Input Validation]
    F --> G[Sanitization]
    G --> H[Business Logic]
    H --> I[Eloquent ORM]
    I --> J[Prepared Statements]
    J --> K[(Database)]
    
    style B fill:#ff6b6b
    style C fill:#ff6b6b
    style D fill:#ff6b6b
    style E fill:#ff6b6b
    style F fill:#ff6b6b
    style G fill:#ff6b6b
    style I fill:#ff6b6b
    style J fill:#ff6b6b
```

**Capas de seguridad:**
1. **CORS:** Solo dominios permitidos
2. **Rate Limiting:** Prevenir abuso
3. **Authentication:** Validar identidad
4. **Authorization:** Validar permisos
5. **Validation:** Validar formato de datos
6. **Sanitization:** Limpiar inputs (XSS)
7. **ORM:** Prevenir SQL Injection
8. **Prepared Statements:** Seguridad adicional

---

## 11. Escalabilidad Futura

```mermaid
graph TB
    subgraph "Fase 1: MVP (Actual)"
        A1[Monolito Laravel]
        A2[MySQL Single Instance]
        A3[React SPA]
    end
    
    subgraph "Fase 2: Optimización"
        B1[Laravel + Redis Cache]
        B2[MySQL + Read Replicas]
        B3[React + Code Splitting]
        B4[CDN para Assets]
    end
    
    subgraph "Fase 3: Microservicios"
        C1[Auth Service]
        C2[Intelligence Service]
        C3[Analytics Service]
        C4[API Gateway]
        C5[Load Balancer]
    end
    
    A1 --> B1
    A2 --> B2
    A3 --> B3
    
    B1 --> C1
    B1 --> C2
    B1 --> C3
    C1 --> C4
    C2 --> C4
    C3 --> C4
    C4 --> C5
```

---

## 12. Deployment Architecture

```mermaid
graph TB
    subgraph "Development"
        D1[Local: localhost:5173]
        D2[Local: localhost:8000]
        D3[Local: MySQL]
    end
    
    subgraph "Production"
        P1[Vercel<br/>React App]
        P2[Railway<br/>Laravel API]
        P3[Railway<br/>MySQL]
    end
    
    subgraph "CI/CD"
        G1[GitHub Repo]
        G2[GitHub Actions]
    end
    
    D1 --> G1
    D2 --> G1
    G1 --> G2
    G2 -->|Auto Deploy| P1
    G2 -->|Auto Deploy| P2
    P2 --> P3
    
    U[Usuario] --> P1
    P1 -->|API Calls| P2
```

**Flujo de Deploy:**
1. Push a `main` branch
2. GitHub Actions ejecuta tests
3. Si tests pasan, deploy automático
4. Vercel despliega frontend
5. Railway despliega backend
6. Railway ejecuta migraciones

---

## 13. Consideraciones de Performance

### Frontend
- ✅ **Code Splitting:** Lazy loading de rutas
- ✅ **Memoización:** React.memo, useMemo, useCallback
- ✅ **Bundle Optimization:** Vite tree-shaking
- ✅ **Image Optimization:** WebP, lazy loading
- ✅ **Debouncing:** En búsquedas y filtros

### Backend
- ✅ **Query Optimization:** Eager loading (with())
- ✅ **Indexing:** Índices en columnas de búsqueda
- ✅ **Pagination:** Limitar resultados
- ✅ **Caching:** Redis para datos frecuentes (futuro)
- ✅ **API Rate Limiting:** Prevenir sobrecarga

---

## 14. Monitoreo y Logging

```mermaid
graph LR
    A[Application] --> B[Laravel Log]
    B --> C[Storage/logs]
    B --> D[Error Tracking<br/>Sentry opcional]
    
    A --> E[Performance Metrics]
    E --> F[Response Times]
    E --> G[Database Queries]
    E --> H[API Calls]
    
    I[Frontend] --> J[Console Errors]
    I --> K[Network Errors]
    K --> L[Axios Interceptor]
    L --> M[Error Boundary]
```

---

## 15. Tecnologías y Versiones

| Componente | Tecnología | Versión |
|------------|------------|---------|
| Frontend Framework | React | 18.x |
| Frontend Language | TypeScript | 5.x |
| Build Tool | Vite | 5.x |
| Styling | Tailwind CSS | 3.x |
| Charts | Recharts | 2.x |
| Backend Framework | Laravel | 11.x |
| Backend Language | PHP | 8.2+ |
| Database | MySQL | 8.0 |
| Authentication | Laravel Sanctum | 4.x |
| HTTP Client | Axios | 1.x |

---

**Documento creado:** 14 Feb 2026  
**Última actualización:** 14 Feb 2026  
**Estado:** ✅ Completado
