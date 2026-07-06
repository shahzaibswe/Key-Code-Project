## 2025-05-14 - Accessible Interactive Cards
**Learning:** For interactive data displays (like key code cards), combining `role="button"` and `tabindex="0"` with a dual `click` and `keydown` listener (targeting Enter/Space) ensures that mouse and keyboard users have parity. Using `aria-live="polite"` on a persistent container allows for seamless updates without disruptive focus shifts.
**Action:** Always implement keyboard listeners for custom interactive elements and use `aria-live` for dynamic content updates.

## 2025-05-14 - Transient Interaction Feedback
**Learning:** Providing immediate, transient visual feedback (e.g., changing text to "Copied!" and shifting color) after a clipboard action significantly improves user confidence in the interaction.
**Action:** Use temporary state classes (like `.success`) to provide clear "action completed" signals for non-persistent UI changes.
