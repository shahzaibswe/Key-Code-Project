## 2025-05-14 - [Initial State & A11y in Simple Utilities]
**Learning:** For single-purpose utility apps (like key code listeners), an empty or dash-filled initial state is a missed opportunity for onboarding. Adding `aria-live` and `role="status"` ensures that screen reader users are notified when the content changes, which is critical for apps whose entire purpose is displaying real-time data.
**Action:** Always provide a clear call-to-action in the initial HTML and wrap dynamic output areas in `aria-live` regions.
