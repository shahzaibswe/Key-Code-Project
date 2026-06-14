## 2025-01-24 - Key Code Explorer UX & Accessibility
**Learning:** For interactive browser-based tools, absolute-positioned labels require their parent containers to have `position: relative` to prevent layout shifts when content is dynamically injected. Additionally, using `event.keyCode` is more reliable for a "Key Code" display than deriving codes from character strings via `charCodeAt()`.
**Action:** Always verify parent positioning when using absolute child labels and prioritize native event properties for technical data displays.
