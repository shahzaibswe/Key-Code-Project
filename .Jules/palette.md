## 2024-05-17 - [Animation and Layout Stability]
**Learning:** Updating the DOM using `textContent` on specific nodes rather than replacing a container's `innerHTML` prevents layout 'jumps' and allows CSS transitions/animations to persist more smoothly.
**Action:** Use IDs for specific content nodes and update `textContent` during event loops to maintain stateful UI transitions.

## 2024-05-17 - [Initial Interaction Guidance]
**Learning:** For utility tools (like keycode explorers), providing a clear initial instruction helps users understand the 'empty' state without needing external documentation.
**Action:** Always include a 'hero' instruction or placeholder that disappears upon the first user interaction.
