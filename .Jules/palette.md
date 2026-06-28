# Palette's Journal

## 2025-05-14 - Initializing Key Code Explorer Improvements
**Learning:** Reconstructing the DOM via `innerHTML` on every keypress causes accessibility regressions by destroying focus states and interrupting screen readers. Using stable elements with `textContent` updates is the preferred pattern for real-time data tools.
**Action:** Transition the UI to use stable IDs and update `textContent` directly.
