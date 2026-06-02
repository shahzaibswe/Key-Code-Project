# Palette's Journal - Key Code Explorer

## 2025-05-14 - Visual Stability and Accessibility in Dynamic Content
**Learning:** Replacing entire DOM structures via `innerHTML` causes layout jumps and loses the `aria-live` context if the attribute is on the replaced element. Maintaining a consistent DOM structure and updating specific `textContent` is better for both performance and accessibility.
**Action:** Use `textContent` for dynamic values and keep the container structure static. Place `aria-live="polite"` on a persistent wrapper.

## 2025-05-14 - Space Key Visibility
**Learning:** Displaying an empty string or a literal space for the "Space" key is confusing. Users expect the word "Space" to appear.
**Action:** Explicitly check for `event.key === ' '` and display "Space".
