## 2025-05-14 - [Initial Review]
**Learning:** The application uses a "glassmorphism" design with semi-transparent backgrounds and blurs. The current implementation of keycode detection uses `e.key.charCodeAt(0)` which is incorrect for non-printable keys and doesn't match standard "keycode" expectations.
**Action:** Use `e.keyCode` for the "Key Code" display and ensure the initial state is informative.
