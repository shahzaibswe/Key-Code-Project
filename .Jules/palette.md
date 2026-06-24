## 2026-06-24 - Key Code Accuracy and Accessibility
**Learning:** For key-detection tools, using `e.keyCode` is more reliable than `e.key.charCodeAt(0)` as the latter only works correctly for printable characters. Additionally, for tools where the main content updates dynamically based on user interaction (like a key press), `aria-live="polite"` and `aria-atomic="true"` are essential to ensure screen readers announce the new state.
**Action:** Always prefer native event properties for technical data reporting and ensure dynamic UI updates are wrapped in ARIA live regions.
