# Palette's Journal

## 2025-05-14 - Interactive Utility Tool UX & Accessibility
**Learning:** For single-purpose utility tools (like a Key Code Explorer), the initial state is critical for onboarding. An empty screen or a single number with no context is confusing. Additionally, interactive cards used for displaying data need explicit keyboard support and screen reader live regions to be inclusive. Redundant visual feedback (color changes + text updates) for "Copy to Clipboard" operations significantly reduces user uncertainty.
**Action:** Always start utilities with instructional text. Use `aria-live="polite"` on dynamic content containers. For custom interactive elements, implement `tabindex="0"`, `role="button"`, and handle Enter/Space keys alongside mouse clicks.
