## 2024-05-23 - [Keyboard Event Accuracy & Onboarding]
**Learning:** Deriving key codes using `event.key.charCodeAt(0)` is logically flawed as it returns Unicode values rather than the physical key's code (e.g., 'Enter' yields 'E'/69 instead of 13). Additionally, tools that rely on user input should always have a clear "empty state" or "initial message" to guide the user.
**Action:** Use native `event.keyCode`, `event.key`, and `event.code` properties directly. Ensure every interactive tool starts with clear instructions rather than dummy data or empty containers.
