## 2025-05-14 - Layout Stability and Screen Reader Feedback
**Learning:** For interactive tools, providing an initial instructional state that maintains the same layout as the result state (using placeholders) prevents jarring layout shifts. Additionally, using `aria-live="polite"` on the main container ensures that dynamic keyboard event data is accessible to screen reader users.
**Action:** Always prefer updating existing placeholder elements with `textContent` over replacing the entire innerHTML of a container to maintain visual and accessibility stability.
