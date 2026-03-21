import { describe, it, expect, vi, beforeEach, afterEach } from 'vitest'
import { render, screen, act } from '@testing-library/react'
import ToastContainer from './Toast'
import { toast } from './toastStore'

describe('Toast System', () => {
  beforeEach(() => {
    vi.useFakeTimers()
  })

  afterEach(() => {
    vi.useRealTimers()
  })

  it('renders toast message when toast.success is called', () => {
    render(<ToastContainer />)
    
    act(() => {
      toast.success('Prueba de éxito guardada')
    })

    expect(screen.getByText('Prueba de éxito guardada')).toBeInTheDocument()
  })

  it('removes toast message after timeout', () => {
    render(<ToastContainer />)
    
    act(() => {
      toast.error('Error simulado')
    })
    
    expect(screen.getByText('Error simulado')).toBeInTheDocument()

    // Avanzamos el tiempo simulado más allá del autoClose (usualmente 3000ms a 5000ms)
    act(() => {
      vi.advanceTimersByTime(6000)
    })

    expect(screen.queryByText('Error simulado')).not.toBeInTheDocument()
  })
})
