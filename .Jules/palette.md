## 2025-05-14 - Key Code Explorer UX & Accessibility Refactor

**Learning:** Using `innerHTML` with template strings for dynamic updates can lead to redundant DOM nesting and makes it harder to maintain accessibility states (like `aria-live`). Additionally, relying on `charCodeAt(0)` for keycodes is incorrect for multi-character keys (e.g., "Enter"), which returns the code for 'E'.

**Action:** Prefer targeted DOM updates using `textContent` for security and performance. Use `aria-live="polite"` on persistent containers to ensure screen readers announce updates. Always provide an "instructional" initial state (e.g., "Press any key...") instead of empty placeholders to guide the user.
