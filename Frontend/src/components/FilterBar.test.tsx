import { describe, it, expect, vi, beforeEach } from 'vitest'
import { render, screen, fireEvent } from '@testing-library/react'
import FilterBar from './FilterBar'

describe('FilterBar', () => {
  const onFilterMock = vi.fn()

  beforeEach(() => {
    vi.clearAllMocks()
  })

  it('renders correctly with default dates', () => {
    render(<FilterBar onFilter={onFilterMock} />)
    
    expect(screen.getByText('Desde')).toBeInTheDocument()
    expect(screen.getByText('Hasta')).toBeInTheDocument()
    expect(screen.getByRole('button', { name: /filtrar/i })).toBeInTheDocument()
  })

  it('calls onFilter when form is submitted', () => {
    render(<FilterBar onFilter={onFilterMock} />)

    // Simulamos escribir en los inputs de fecha (que en jsdom no tienen un type rigido)
    const dateFromInput = screen.getByLabelText('Desde') as HTMLInputElement
    const dateToInput = screen.getByLabelText('Hasta') as HTMLInputElement

    fireEvent.change(dateFromInput, { target: { value: '2026-01-01' } })
    fireEvent.change(dateToInput, { target: { value: '2026-03-31' } })

    const filterButton = screen.getByRole('button', { name: /filtrar/i })
    fireEvent.click(filterButton)

    expect(onFilterMock).toHaveBeenCalledTimes(1)
    expect(onFilterMock).toHaveBeenCalledWith({
      dateFrom: '2026-01-01',
      dateTo: '2026-03-31'
    })
  })

  it('clears dates and calls onFilter when clear button is clicked', () => {
    render(<FilterBar onFilter={onFilterMock} />)
    
    const dateFromInput = screen.getByLabelText('Desde')
    fireEvent.change(dateFromInput, { target: { value: '2026-01-01' } })
    
    // Ahora deberia aparecer el boton de limpiar porque hay fecha
    const clearButton = screen.getByRole('button', { name: /limpiar/i })
    expect(clearButton).toBeInTheDocument()

    fireEvent.click(clearButton)

    expect(onFilterMock).toHaveBeenCalledWith({ dateFrom: '', dateTo: '' })
    
    // El input deberia estar vacio
    expect((dateFromInput as HTMLInputElement).value).toBe('')
    // El boton limpiar deberia de haber desaparecido
    expect(screen.queryByRole('button', { name: /limpiar/i })).not.toBeInTheDocument()
  })
})
