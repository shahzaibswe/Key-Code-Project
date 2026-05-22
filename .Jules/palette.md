## 2025-05-14 - [Initial State Accessibility & Event Announcements]
**Learning:** For dynamic, event-driven utilities like a keycode explorer, a cryptic initial state (like "---") creates a poor first impression. Additionally, without ARIA live regions, screen reader users are unaware of updates happening in response to interactions.
**Action:** Always provide clear, instructional initial states ("Press any key...") and use `aria-live="polite"` with `aria-atomic="true"` on containers that update dynamically to ensure accessibility.
