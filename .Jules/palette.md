## 2025-05-14 - Accessible Dynamic Key Detection
**Learning:** Tools that update UI based on real-time keyboard input must use `aria-live="polite"` and `aria-atomic="true"` on stable wrapper elements to ensure screen readers announce updates. Updating specific `textContent` instead of re-injecting HTML via `innerHTML` prevents accessibility state loss and provides a smoother experience.
**Action:** Use stable DOM IDs and `aria-live` regions for any high-frequency dynamic content updates.
