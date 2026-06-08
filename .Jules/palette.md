# Palette's Journal - UX & Accessibility Learnings

## 2025-05-14 - Initial UX Audit
**Learning:** For interactive tools like a Key Code Explorer, providing a clear instructional message ("Press any key...") instead of empty placeholders ("-") significantly improves user onboarding and clarifies the app's purpose immediately.
**Action:** Always initialize tools with guidance or a "Ready" state rather than empty data fields.

**Learning:** Using `innerHTML` to rebuild the entire UI on every keystroke is detrimental to accessibility as it can cause screen readers to lose focus or re-announce the entire container, and it's less performant than targeted DOM updates.
**Action:** Prefer updating specific elements (via `id` or `ref`) to maintain DOM stability and accessibility state.
