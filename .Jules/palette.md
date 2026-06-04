## 2026-06-04 - Initial UX/Accessibility Audit of Key Code Explorer
**Learning:** The "Key Code Explorer" utility lacks an initial call-to-action (empty state), which can leave first-time users uncertain about how to interact with the tool. Additionally, the use of `innerHTML` for high-frequency updates can disrupt screen readers.
**Action:** Always provide clear instructional placeholders or welcome messages in interactive tools to improve onboarding. Prioritize stable DOM structures with `textContent` and `aria-live` for dynamic event-driven updates.
