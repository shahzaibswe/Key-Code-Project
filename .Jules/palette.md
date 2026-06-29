## 2025-01-24 - [Key Code Explorer Enhancement]
**Learning:** For utility tools like a Key Code Explorer, maintaining a stable DOM structure with `aria-live` is superior to regenerating HTML on every event. Rebuilding the DOM destroys focus states and can be jarring for screen readers. Using persistent elements with IDs and updating `textContent` preserves accessibility and performance.
**Action:** Prioritize updating specific DOM nodes over `innerHTML` refreshes for real-time data displays.

## 2025-01-24 - [Interactive Feedback & Accessibility]
**Learning:** Adding "Click to Copy" functionality to informational cards significantly increases the utility of a developer tool. To ensure this is accessible, cards must have `role="button"`, `tabindex="0"`, and handle both `Enter` and `Space` keys. Visual feedback (e.g., changing "Click to copy" to "Copied!") is essential for confirming the action.
**Action:** Always provide a transient success state after clipboard operations and ensure all interactive elements are keyboard-reachable.
