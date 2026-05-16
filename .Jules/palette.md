# Palette's Journal - Key Code Explorer

## 2025-05-14 - Initial Assessment
**Learning:** The application currently replaces the entire innerHTML on every keypress, which is disruptive for screen readers and prevents smooth transitions. The initial state is a cryptic "-" which lacks guidance for the user.
**Action:** Use a more stable HTML structure and update text content instead of innerHTML if possible, or at least provide an aria-live region. Add a clear initial prompt.
