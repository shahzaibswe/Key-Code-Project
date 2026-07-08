## 2025-01-24 - Stable DOM for Interactive Tools
**Learning:** Replacing the entire DOM tree on every event (e.g., using `innerHTML` on a keydown listener) breaks accessibility, kills persistent UI states, and prevents smooth transitions. Using targeted updates with `textContent` preserves the interactive environment, allowing for features like "Click to Copy" and ARIA live announcements to function reliably.
**Action:** Always prefer fine-grained DOM updates over full container resets in event-driven interfaces to maintain accessibility and enable persistent visual feedback.
