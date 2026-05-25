# Palette's Journal - Critical UX/Accessibility Learnings

## 2025-05-14 - Initial Onboarding & Accessibility
**Learning:** For interactive utility tools like this, a blank initial state with placeholder dashes ("-") can be confusing for new users. Providing a clear call-to-action (e.g., "Press any key to get started") improves immediate usability.
**Action:** Replace empty initial states with instructional messages and use `aria-live` to ensure dynamic updates are announced.
