import { describe, it, expect, vi } from 'vitest'
import { render, screen } from '@testing-library/react'
import ErrorBoundary from './ErrorBoundary'

const ProblematicComponent = () => {
  throw new Error('Crash provocado para test')
  return <div>No debo renderizar</div>
}

describe('ErrorBoundary', () => {
  it('catches errors in children and renders fallback UI', () => {
    // Suprimimos los errores en consola generados intencionalmente por React
    const consoleSpy = vi.spyOn(console, 'error').mockImplementation(() => {})
    
    render(
      <ErrorBoundary>
        <ProblematicComponent />
      </ErrorBoundary>
    )
    
    // Verificamos que el boundary renderizó su mensaje genérico o título
    expect(screen.getByText(/Algo salió mal|intentar de nuevo/i)).toBeInTheDocument()
    
    consoleSpy.mockRestore()
  })
})
