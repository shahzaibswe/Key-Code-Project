# Palette's Journal - Key Code Explorer

## 2025-05-14 - Initial Observations
**Learning:** The Key Code Explorer has a basic glassmorphism UI but lacks initial instructions and has some accessibility/UX gaps:
- No instructions for the user on how to start.
- `innerHTML` is used for frequent updates, which can be inefficient and risky for XSS if not careful.
- `aria-live` is missing for dynamic content updates.
- Technical API property names are more useful for developers than generic labels.
- `e.key.charCodeAt(0)` is used instead of `e.keyCode`, which might not match developer expectations for the legacy property.

**Action:** Implement instructional state, switch to technical labels, add ARIA attributes, and use `textContent` for safer updates.
