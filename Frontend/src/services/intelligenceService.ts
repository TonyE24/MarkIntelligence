import api from './api'

// Interfaces para que el resto del equipo sepa que devuelve la API
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

const intelligenceService = {
  // obtiene inteligencia de mercado (precios, etc)
  getMarketIntelligence: async (companyId: number): Promise<MarketResponse> => {
    const res = await api.get(`/intelligence/market?company_id=${companyId}`)
    return res.data
  },

  // obtiene tendencias y sentimiento de redes
  getTrendIntelligence: async (companyId: number): Promise<TrendResponse> => {
    const res = await api.get(`/intelligence/trends?company_id=${companyId}`)
    return res.data
  },

  // obtiene predicciones historicas
  getPredictionIntelligence: async (companyId: number) => {
    const res = await api.get(`/intelligence/predictions?company_id=${companyId}`)
    return res.data
  },

  // obtiene oportunidades de innovacion
  getInnovationIntelligence: async (companyId: number) => {
    const res = await api.get(`/intelligence/innovation?company_id=${companyId}`)
    return res.data
  }
}

export default intelligenceService
