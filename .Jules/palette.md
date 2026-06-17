## 2026-06-17 - Onboarding & Copy-to-Clipboard Patterns
**Learning:** For single-purpose utility tools, replacing empty initial states with clear instructional onboarding (e.g., "Press any key...") significantly improves user guidance. Adding "Click to copy" functionality with immediate visual feedback (text and color change) provides delightful micro-interactions.
**Action:** Always implement an explicit initial state for interaction-driven tools. Use a transient "Copied!" state for clipboard actions to confirm success without needing alerts or toasts.
