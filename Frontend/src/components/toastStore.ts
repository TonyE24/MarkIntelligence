// ---------------------------------------------------------------
// Tienda de tostadas y despachador: utilidades compartidas (sin componentes)
// Mantenido en un archivo separado para que Toast.tsx solo exporte componentes
// y React Fast Refresh funcione correctamente.
// ---------------------------------------------------------------

export type ToastType = 'success' | 'error' | 'warning' | 'info'

export interface ToastMessage {
  id: string
  type: ToastType
  message: string
  duration?: number  // ms hasta que se auto-cierra, default 4000
}

type Listener = (toast: ToastMessage) => void
export const listeners: Listener[] = []

function dispatch(type: ToastType, message: string, duration = 4000) {
  const toastMsg: ToastMessage = {
    id: `${Date.now()}-${Math.random()}`,
    type,
    message,
    duration,
  }
  listeners.forEach(fn => fn(toastMsg))
}

export const toast = {
  success: (message: string, duration?: number) => dispatch('success', message, duration),
  error:   (message: string, duration?: number) => dispatch('error',   message, duration),
  warning: (message: string, duration?: number) => dispatch('warning', message, duration),
  info:    (message: string, duration?: number) => dispatch('info',    message, duration),
}
