## 2025-05-15 - Event Propagation Conflicts in State-Refreshing UIs
**Learning:** In applications where a global keyboard listener refreshes the entire UI (e.g., re-rendering via `innerHTML`), specific interaction keys (like Enter or Space for accessibility) can trigger a race condition or an immediate reset of the state they were intended to interact with.
**Action:** Always use `e.stopPropagation()` in localized keyboard listeners to prevent global re-renders during intentional interactions. Additionally, blacklist navigation keys (Tab, Shift) and modifier keys from global listeners to preserve accessibility-focused focus management.

## 2025-05-15 - Data Integrity in Dynamic DOM Injection
**Learning:** Using `textContent` for clipboard operations can lead to bugs if the DOM structure changes or if the visible text is transformed (e.g., for human readability).
**Action:** Use the HTML5 `dataset` API to store raw values directly on the element. This ensures that the value copied to the clipboard remains consistent regardless of visual labels or dynamic text updates.
