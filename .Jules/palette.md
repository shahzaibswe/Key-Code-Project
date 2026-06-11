## 2025-05-15 - Improving Visual Stability and Accessibility in Key Detection Tools
**Learning:** To prevent layout jumps when injecting dynamic content, ensure parent containers use `position: relative` to correctly anchor absolutely positioned child labels. Additionally, place `aria-live="polite"` on a persistent wrapper rather than the dynamic content itself to ensure screen readers consistently announce updates.
**Action:** Always verify parent positioning for absolute elements and use targeted `textContent` updates within a stable ARIA-live container.
