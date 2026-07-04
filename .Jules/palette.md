## 2025-05-15 - Targeted DOM Updates for UX Stability
**Learning:** Replacing global `innerHTML` re-renders with targeted `textContent` updates preserves accessibility focus and prevents visual flickering during rapid interactions.
**Action:** Always identify stable DOM elements with IDs for dynamic content instead of rebuilding the entire container.

## 2025-05-15 - Absolute Positioning and Layout Anchors
**Learning:** For tools using absolute-positioned labels (e.g., card titles), the parent container must have `position: relative` to prevent labels from detaching and causing layout shifts during state transitions.
**Action:** Verify container positioning when injecting or showing hidden elements to ensure visual stability.

## 2025-05-15 - Tactile Interaction via Key Listeners
**Learning:** Real-time tactile feedback for keyboard-driven tools is best achieved by combining `keydown` and `keyup` events to toggle a `.pressed` class, providing a more responsive feel than a fixed timer.
**Action:** Use CSS transitions with `transform: scale()` on active/pressed states for immediate user feedback.

## 2025-05-15 - Clipboard Success Feedback
**Learning:** Effective copy-to-clipboard patterns require both a visual state change (e.g., color shift) and a textual confirmation (e.g., "Copied!") to be clear across different user types.
**Action:** Guard clipboard actions to prevent rapid "state clobbering" if the user clicks multiple times during the success animation.
