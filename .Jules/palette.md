## 2025-05-14 - Interaction Conflict in Key Explorers
**Learning:** In tools that globally listen for `keydown` events (like a key code explorer), custom interactive elements (like copy-to-clipboard buttons) that also handle `keydown` (Enter/Space) will trigger the global listener unless event bubbling is stopped. This causes the UI to refresh with the code for "Enter" instead of performing the copy action on the intended key.
**Action:** Use `e.stopPropagation()` and `e.preventDefault()` in the local interactive element's keyboard listener to isolate specific user actions from the global explorer logic.

## 2025-05-14 - Accurate Key Code Representation
**Learning:** Developers expect "Key Code" in explorer tools to represent the physical key's identifier (`event.keyCode` or `event.code`). Using `charCodeAt()` returns the case-sensitive character code, which is technically different and can be misleading for debugging physical key events.
**Action:** Prioritize `event.keyCode` for legacy compatibility or `event.code` for modern physical key identification in developer tools.
