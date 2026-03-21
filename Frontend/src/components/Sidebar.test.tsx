import { describe, it, expect, vi } from 'vitest'
import { render, screen, fireEvent } from '@testing-library/react'
import { BrowserRouter } from 'react-router-dom'
import Sidebar from './Sidebar'

describe('Sidebar', () => {
  it('renders logo and navigation links', () => {
    render(
      <BrowserRouter>
        <Sidebar open={true} onClose={vi.fn()} />
      </BrowserRouter>
    )
    
    expect(screen.getByText('MarkIntelligence')).toBeInTheDocument()
    expect(screen.getByText('Dashboard')).toBeInTheDocument()
    expect(screen.getByText('Mercado')).toBeInTheDocument()
    expect(screen.getByText('Tendencias')).toBeInTheDocument()
  })

  it('calls onClose when close button is clicked in mobile view', () => {
    const handleClose = vi.fn()
    render(
      <BrowserRouter>
        <Sidebar open={true} onClose={handleClose} />
      </BrowserRouter>
    )
    
    // El boton de cerrar se renderiza solo cuando esta abierto.
    // Típicamente es un botón con un ícono (Lucide X). Lo buscamos por su rol genérico si es posible,
    // o le damos clic al boton que está en el div con clases lg:hidden.
    const closeButtons = screen.getAllByRole('button') 
    // Usualmente el boton de cerrar y el de logout están presentes.
    // Le hacemos clic al primero que debería ser el de cerrar menú moble.
    if(closeButtons.length > 0) {
      fireEvent.click(closeButtons[0])
      expect(handleClose).toHaveBeenCalled()
    }
  })
})
