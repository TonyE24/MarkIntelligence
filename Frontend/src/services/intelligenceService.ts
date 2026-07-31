import api from './api'

export interface Competitor {
  name: string
  price: number
}

export interface MarketProduct {
  product: string
  my_price: number
  competitors: Competitor[]
  market_share: string
}

export interface MarketResponse {
  company_name: string
  industry: string
  market_analysis: MarketProduct[]
}

export interface Trend {
  keyword: string
  volume: number
  sentiment: {
    positive: number
    neutral: number
    negative: number
  }
  trend: 'up' | 'down'
}

export interface TrendResponse {
  company_name: string
  trends: Trend[]
}

const buildParams = (companyId: number, dateFrom?: string, dateTo?: string) => {
  const params = new URLSearchParams({ company_id: String(companyId) })
  if (dateFrom) params.append('date_from', dateFrom)
  if (dateTo)   params.append('date_to', dateTo)
  return params.toString()
}

// Datos de demostración de respaldo (fallback si el backend no responde o en modo demo)
const mockMarketData: MarketResponse = {
  company_name: 'Tech Solutions SV',
  industry: 'Tecnología y Software',
  market_analysis: [
    {
      product: 'Plan Básico SaaS',
      my_price: 29.99,
      competitors: [
        { name: 'Competidor Alfa', price: 35.00 },
        { name: 'Competidor Beta', price: 27.50 },
      ],
      market_share: '34%'
    },
    {
      product: 'Plan Pro Enterprise',
      my_price: 89.99,
      competitors: [
        { name: 'Competidor Alfa', price: 99.00 },
        { name: 'Competidor Beta', price: 85.00 },
      ],
      market_share: '28%'
    },
    {
      product: 'Soporte Premium 24/7',
      my_price: 49.99,
      competitors: [
        { name: 'Competidor Alfa', price: 60.00 },
        { name: 'Competidor Beta', price: 45.00 },
      ],
      market_share: '42%'
    }
  ]
}

const mockTrendData: TrendResponse = {
  company_name: 'Tech Solutions SV',
  trends: [
    {
      keyword: 'Facturación Electrónica El Salvador',
      volume: 24000,
      sentiment: { positive: 80, neutral: 15, negative: 5 },
      trend: 'up'
    },
    {
      keyword: 'Software de Inventarios PYME',
      volume: 12500,
      sentiment: { positive: 65, neutral: 25, negative: 10 },
      trend: 'up'
    },
    {
      keyword: 'Punto de Venta Cloud',
      volume: 8900,
      sentiment: { positive: 55, neutral: 35, negative: 10 },
      trend: 'up'
    },
    {
      keyword: 'Asistentes de IA para Negocios',
      volume: 15300,
      sentiment: { positive: 70, neutral: 20, negative: 10 },
      trend: 'up'
    }
  ]
}

const mockPredictionData = {
  company_name: 'Tech Solutions SV',
  source: 'algorithm_prediction',
  prediction_model: 'Regresión Lineal Múltiple',
  confidence_score: 92.5,
  predictions: [
    { period: 'Ene 2026', actual: 12400, predicted: 12000 },
    { period: 'Feb 2026', actual: 13800, predicted: 13500 },
    { period: 'Mar 2026', actual: 15200, predicted: 15000 },
    { period: 'Abr 2026', actual: 16500, predicted: 16200 },
    { period: 'May 2026', actual: null, predicted: 17800 },
    { period: 'Jun 2026', actual: null, predicted: 19400 },
    { period: 'Jul 2026', actual: null, predicted: 21000 }
  ]
}

const mockInnovationData = {
  company_name: 'Tech Solutions SV',
  opportunities: [
    {
      id: 1,
      type: 'opportunity',
      title: 'Mercado de Automatización de Inventarios en PYMEs',
      description: 'Aumento del 35% en búsquedas de sistemas de stock integrados con facturación en El Salvador.',
      impact: 'High',
      score: 95
    },
    {
      id: 2,
      type: 'gap',
      title: 'Falta de Software Financiero Multi-moneda Adaptado',
      description: 'Las empresas locales requieren integraciones con bancos regionales y reportes automáticos en PDF/Excel.',
      impact: 'Medium',
      score: 82
    },
    {
      id: 3,
      type: 'technology',
      title: 'Integración de Modelos de IA Generativa en Atención al Cliente',
      description: 'Implementar agentes inteligentes reduce tiempos de respuesta en un 60% y mejora la retención.',
      impact: 'High',
      score: 90
    }
  ]
}

const intelligenceService = {
  getMarketIntelligence: async (companyId: number, dateFrom = '', dateTo = ''): Promise<MarketResponse> => {
    try {
      const res = await api.get(`/intelligence/market?${buildParams(companyId, dateFrom, dateTo)}`)
      return res.data
    } catch {
      return mockMarketData
    }
  },

  getTrendIntelligence: async (companyId: number, dateFrom = '', dateTo = ''): Promise<TrendResponse> => {
    try {
      const res = await api.get(`/intelligence/trends?${buildParams(companyId, dateFrom, dateTo)}`)
      return res.data
    } catch {
      return mockTrendData
    }
  },

  getPredictionIntelligence: async (companyId: number, dateFrom = '', dateTo = '') => {
    try {
      const res = await api.get(`/intelligence/predictions?${buildParams(companyId, dateFrom, dateTo)}`)
      return res.data
    } catch {
      return mockPredictionData
    }
  },

  getInnovationIntelligence: async (companyId: number, dateFrom = '', dateTo = '') => {
    try {
      const res = await api.get(`/intelligence/innovation?${buildParams(companyId, dateFrom, dateTo)}`)
      return res.data
    } catch {
      return mockInnovationData
    }
  }
}

export default intelligenceService
