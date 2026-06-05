## 2026-06-05 - [Technical Labeling & Layout Stability]
**Learning:** For developer-centric tools, using technical API property names (e.g., `event.key`, `event.code`) as UI labels is preferred over generic terms to provide precise context. Additionally, to maintain visual stability and prevent layout jumps when content is injected, use `position: relative` on parent containers to correctly anchor absolute-positioned labels.
**Action:** Always prefer precise technical terminology for developer tools and ensure parent containers have explicit positioning when using absolute-positioned children for UI labels.

## 2026-06-05 - [Initial State Guidance]
**Learning:** For interactive tools, replacing empty initial states with clear instructional messages (e.g., 'Press any key...') improves user onboarding and guidance compared to showing empty placeholders.
**Action:** Implement 'empty state' instructions that transition to the functional UI upon first interaction.
