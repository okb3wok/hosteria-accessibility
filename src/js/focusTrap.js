export function handleFocusTrap(container, event) {
  if (event.key === 'Escape') {
    return 'close';
  }

  if (event.key !== 'Tab') return;

  const focusableSelector = 'a[href], button:not([disabled]), input:not([disabled]), [tabindex]:not([tabindex="-1"])';
  const focusables = Array.from(container.querySelectorAll(focusableSelector));

  if (focusables.length === 0) return;

  const firstFocusable = focusables[0];
  const lastFocusable = focusables[focusables.length - 1];

  if (event.shiftKey) {
    // Shift + Tab: с первого на последний
    if (document.activeElement === firstFocusable) {
      event.preventDefault();
      lastFocusable.focus();
    }
  } else {
    // Tab: с последнего на первый (кнопка закрытия обычно или первый пункт)
    if (document.activeElement === lastFocusable) {
      event.preventDefault();
      firstFocusable.focus();
    }
  }
}

export default handleFocusTrap;