## 2025-05-15 - Layout Stability in Dynamic Tools
**Learning:** Initial 'placeholder' states in interactive tools (like 'Press any key') should mirror the final layout structure. If the initial state is simpler than the result state, it causes a 'layout jump' that feels unpolished and jarring to the user.
**Action:** Use a unified UI generation function or shared CSS classes to ensure that empty/instructional states occupy the same visual footprint as the data-heavy states.
