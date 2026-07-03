## 2025-05-15 - [Layout State Management]
**Learning:** Using a CSS class (e.g., `.active`) on a parent container to trigger layout transitions (from onboarding to results) is more maintainable than manipulating multiple inline styles via JavaScript. It keeps the UI logic in CSS and reduces the JavaScript diff size.
**Action:** Prefer CSS-driven state transitions for major layout shifts to maintain a cleaner separation of concerns.

## 2025-05-15 - [Event Delegation for Dynamic UI]
**Learning:** Attaching a single event listener to a stable parent container for clipboard actions avoids the need to re-bind listeners when content is updated. This ensures interactive elements are functional as soon as they are rendered.
**Action:** Use event delegation for UI interactions that involve dynamic content updates or repeated interactive elements.
