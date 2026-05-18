## 2025-05-15 - Interactive State Transitions & Accessibility
**Learning:** For single-purpose utility tools (like key explorers), starting with a clear instructional "empty state" prevents user confusion. Additionally, using targeted DOM updates (textContent) instead of full container refreshes (innerHTML) preserves accessibility live regions and allows for smoother CSS transitions/animations during rapid state changes.
**Action:** Always provide an initial 'how-to' instruction and use aria-live regions for dynamic utility outputs. Prefer individual node updates to maintain UI stability.
