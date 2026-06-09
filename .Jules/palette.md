# Palette's Journal - UX & Accessibility Learnings

## 2025-05-15 - [Enhancing Key Code Explorer UX]
**Learning:** For interactive tools, replace empty initial states with clear instructional messages (e.g., 'Press any key...') to improve user onboarding and guidance. Also, using `aria-atomic="true"` alongside `aria-live` ensures screen readers announce the full updated state, providing better context.

**Action:** Always check if a landing page provides immediate direction. Use `aria-atomic` for dynamic regions where the full context of the update is needed.

## 2025-05-15 - [Absolute Positioning Alignment]
**Learning:** To maintain visual stability and prevent layout jumps when content is injected, use `position: relative` on parent containers to correctly anchor absolute-positioned labels.

**Action:** Verify that any container with absolute-positioned children has a defined positioning context (like `relative`).
