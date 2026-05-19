# Palette's Journal

## 2025-05-14 - Reliability of Key-Triggered Animations
**Learning:** To reliably re-trigger CSS animations on every event (e.g., rapid keydown auto-repeat), force a DOM reflow by accessing a property like `element.offsetWidth` immediately after re-applying the animation class. This prevents the browser from optimizing away the state change if it happens within the same frame.
**Action:** Use `void element.offsetWidth` between class removal and re-addition when triggering pulse or feedback animations on user input.
