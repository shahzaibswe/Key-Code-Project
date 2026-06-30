# Palette's Journal

## 2024-06-30 - Initial UX Audit of Key Code Explorer
**Learning:** The current implementation uses innerHTML to reconstruct the UI on every keypress, which is bad for accessibility (loses focus, screen readers might struggle) and performance. The initial state is also unhelpful ("-").
**Action:** Transition to stable DOM elements with textContent updates and add a clear onboarding message with aria-live support.
