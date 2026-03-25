# API Documentation — MarkIntelligence

> **Base URL:** `http://127.0.0.1:8000/api`  
> **Formato:** JSON  
> **Autenticación:** Bearer Token se ha utilizado Sanctum  
> **Versión:** 1.0

---
## Índice

- [Autenticación](#autenticación)
- [Empresa (Company)](#empresa-company)
- [Inteligencia de Mercado](#inteligencia-de-mercado)
- [Inteligencia de Tendencias](#inteligencia-de-tendencias)
- [Inteligencia de Predicción](#inteligencia-de-predicción)
- [Inteligencia de Innovación](#inteligencia-de-innovación)
- [Dashboard Consolidado](#dashboard-consolidado)
- [Códigos de Error](#códigos-de-error)
- [Rate Limiting](#rate-limiting)

---

## Autenticación

> **Rate Limit:** *5 requests/minuto por IP*

### `POST /auth/register`

Registra un nuevo usuario en el sistema.

**Body:**

```json
{
  "name": "Alexander Granados",
  "email": "alex@empresa.com",
  "password": "contrasena123",
  "password_confirmation": "contrasena123"
}
```

**Respuesta exitosa `201`:**

```json
{
  "message": "El usuario se ha registrado correctamente",
  "user": {
    "id": 1,
    "name": "Alexander Granados",
    "email": "alex@empresa.com",
    "role": "user"
  },
  "token": "1|abc123xyz..."
}
```

**Errores:**
| Código | Motivo |
|--------|--------|
| `422` | Validación fallida (email duplicado, contraseñas no coinciden, nombre inválido) |
| `429` | Rate limit superado (5 req/min) |

---

### `POST /auth/login`

Inicia sesión y obtiene el token de autenticación.

**Body:**

```json
{
  "email": "alex@empresa.com",
  "password": "contrasena123"
}
```

**Respuesta exitosa `200`:**

```json
{
  "message": "Ha iniciado sesión correctamente",
  "user": {
    "id": 1,
    "name": "Alexander Granados",
    "email": "alex@empresa.com",
    "role": "user"
  },
  "token": "1|abc123xyz..."
}
```

**Errores:**
| Código | Motivo |
|--------|--------|
| `401` | Credenciales incorrectas |
| `422` | Email o contraseña faltantes |
| `429` | Rate limit superado |

---

### `POST /auth/logout` 🔒

Cierra la sesión eliminando el token actual.

**Headers requeridos:**

```
Authorization: Bearer {token}
```

**Respuesta exitosa `200`:**

```json
{
  "message": "Sesión cerrada exitosamente"
}
```

---

### `POST /auth/forgot-password`

Envía un email con el link de recuperación de contraseña.

**Body:**

```json
{
  "email": "alex@empresa.com"
}
```

**Respuesta exitosa `200`:**

```json
{
  "message": "Te enviamos un link para que puedas restablecer la contraseña"
}
```

**Errores:**
| Código | Motivo |
|--------|--------|
| `404` | Email no encontrado en el sistema |
| `422` | Formato de email inválido |

---

### `POST /auth/reset-password`

Cambia la contraseña usando el token recibido por email.

**Body:**

```json
{
  "token": "el-token-del-email",
  "email": "alex@empresa.com",
  "password": "nuevaContrasena123",
  "password_confirmation": "nuevaContrasena123"
}
```

**Respuesta exitosa `200`:**

```json
{
  "message": "Contraseña ha sido reestablecida"
}
```

**Errores:**
| Código | Motivo |
|--------|--------|
| `400` | Token inválido o expirado |
| `422` | Contraseñas no coinciden o campos faltantes |

---

## Empresa (Company)

> **Autenticación requerida** — `Authorization: Bearer {token}`  
> **Rate Limit:** 60 requests/minuto por usuario

### `GET /companies`

Lista todas las empresas del usuario autenticado.

**Respuesta `200`:**

```json
{
  "companies": [
    {
      "id": 1,
      "name": "Mi Empresa SRL",
      "industry": "Tecnología",
      "country": "El Salvador",
      "region": "San Salvador",
      "keywords": ["ecommerce", "delivery", "tecnología"],
      "user_id": 1,
      "created_at": "2026-02-20T14:00:00.000000Z",
      "updated_at": "2026-02-20T14:00:00.000000Z"
    }
  ]
}
```

---

### `POST /companies`

Crea una nueva empresa.

**Body:**

```json
{
  "name": "Mi Empresa SRL",
  "industry": "Tecnología",
  "country": "El Salvador",
  "region": "San Salvador",
  "keywords": ["ecommerce", "ia", "delivery"]
}
```

> **Industrias válidas:** `Tecnología`, `Alimentos`, `Comercio`, `Construcción`, `Servicios`  
> **Keywords:** máximo 20, cada una máximo 50 caracteres

**Respuesta `201`:**

```json
{
  "message": "Empresa registrada con exito!",
  "company": { "id": 1, "name": "Mi Empresa SRL", "..." }
}
```

---

### `GET /companies/{id}`

Obtiene el detalle de una empresa específica.

**Respuesta `200`:**

```json
{
  "company": { "id": 1, "name": "Mi Empresa SRL", "..." }
}
```

**Errores:**
| Código | Motivo |
|--------|--------|
| `404` | Empresa no encontrada o no pertenece al usuario |

---

### `PUT /companies/{id}`

Actualiza datos de una empresa. Todos los campos son opcionales.

**Body (parcial):**

```json
{
  "region": "Santa Ana",
  "keywords": ["nuevo-keyword"]
}
```

**Respuesta `200`:**

```json
{
  "message": "Datos actualizados correctamente",
  "company": { "id": 1, "..." }
}
```

---

### `DELETE /companies/{id}`

Elimina una empresa.

**Respuesta `200`:**

```json
{
  "message": "Empresa eliminada correctamente"
}
```

---

## Inteligencia de Mercado

> **Autenticación requerida** — **Rate Limit:** 60 req/min

### `GET /intelligence/market`

**Query Params:**
| Parámetro | Tipo | Requerido | Descripción |
|-----------|------|-----------|-------------|
| `company_id` | integer | ✅ | ID de la empresa |
| `date_from` | string (`Y-m-d`) | ❌ | Filtro fecha inicio |
| `date_to` | string (`Y-m-d`) | ❌ | Filtro fecha fin |

**Ejemplo:** `GET /intelligence/market?company_id=1&date_from=2026-01-01&date_to=2026-03-31`

**Respuesta `200`:**

```json
{
  "market_data": [
    {
      "product": "Suscripción Cloud",
      "my_price": 120,
      "competitors": [
        { "name": "Competidor Alpha", "price": 115 },
        { "name": "Competidor Beta", "price": 130 }
      ],
      "market_share": "22%"
    }
  ],
  "source": "mock_data"
}
```

---

## Inteligencia de Tendencias

### `GET /intelligence/trends`

**Query Params:** `company_id`, `date_from` (opcional), `date_to` (opcional)

**Respuesta `200`:**

```json
{
  "trends": [
    {
      "keyword": "Sustentabilidad",
      "volume": 35000,
      "sentiment": {
        "positive": 68,
        "neutral": 18,
        "negative": 14
      },
      "trend": "up"
    }
  ]
}
```

---

## Inteligencia de Predicción

### `GET /intelligence/predictions`

**Query Params:** `company_id`, `date_from` (opcional), `date_to` (opcional)

**Respuesta `200` — con datos reales (regresión lineal):**

```json
{
  "predictions": [
    { "period": "2026-01", "actual": 1200, "predicted": null },
    { "period": "2026-02", "actual": 1350, "predicted": null },
    { "period": "2026-03", "actual": null, "predicted": 1480 }
  ],
  "source": "algorithm_prediction"
}
```

**Respuesta `200` — con datos simulados:**

```json
{
  "predictions": [{ "month": "Ene", "actual": 1000, "predicted": 1120 }],
  "source": "mock_data"
}
```

---

## Inteligencia de Innovación

### `GET /intelligence/innovation`

**Query Params:** `company_id`, `date_from` (opcional), `date_to` (opcional)

**Respuesta `200`:**

```json
{
  "innovation_opportunities": [
    {
      "title": "Nicho Desatendido",
      "description": "Hay un 20% de aumento en búsquedas de empaques biodegradables.",
      "impact": "Alto",
      "type": "opportunity"
    },
    {
      "title": "Optimización de Precios",
      "description": "Competidores subieron precios 5%, puedes ajustar tu margen.",
      "impact": "Medio",
      "type": "gap"
    }
  ]
}
```

---

## Dashboard Consolidado

> **Rate Limit:** 30 req/min por usuario

### `GET /dashboard`

**Query Params:** `company_id`, `date_from` (opcional), `date_to` (opcional)

**Respuesta `200`:**

```json
{
  "kpis": {
    "market_share": "22%",
    "sentiment": "68% positivo",
    "next_prediction": "$1,480",
    "active_opportunities": 2
  },
  "modules": {
    "market": { "status": "ok" },
    "trends": { "status": "ok" },
    "prediction": { "status": "ok" },
    "innovation": { "status": "ok" }
  }
}
```

---

## Códigos de Error

| Código | Significado          | Cuándo ocurre                                     |
| ------ | -------------------- | ------------------------------------------------- |
| `200`  | OK                   | Petición exitosa                                  |
| `201`  | Created              | Recurso creado (register, store company)          |
| `400`  | Bad Request          | Token de reset inválido o expirado                |
| `401`  | Unauthorized         | Token de sesión inválido o ausente                |
| `403`  | Forbidden            | Sin permiso para el recurso (rol incorrecto)      |
| `404`  | Not Found            | Recurso no encontrado                             |
| `422`  | Unprocessable Entity | Validación fallida — incluye detalles en `errors` |
| `429`  | Too Many Requests    | Rate limit superado                               |
| `500`  | Server Error         | Error interno del servidor                        |

### Formato de error de validación `422`:

```json
{
  "message": "The email field is required.",
  "errors": {
    "email": ["El correo electrónico es obligatorio."],
    "password": ["La contraseña debe tener al menos 8 caracteres."]
  }
}
```

### Formato de error rate limit `429`:

```json
{
  "message": "Demasiados intentos. Por favor espera 1 minuto antes de intentarlo de nuevo.",
  "retry_after": 60
}
```

---

## Rate Limiting

| Grupo       | Endpoints                                                                        | Límite         | Clave       |
| ----------- | -------------------------------------------------------------------------------- | -------------- | ----------- |
| `auth`      | `/auth/register`, `/auth/login`, `/auth/forgot-password`, `/auth/reset-password` | **5 req/min**  | por IP      |
| `data`      | `/companies/*`, `/intelligence/*`                                                | **60 req/min** | por usuario |
| `dashboard` | `/dashboard`                                                                     | **30 req/min** | por usuario |

---

_Documentación generada para MarkIntelligence v1.0 — Semana 5 del Reto Ogilvy El Salvador_
