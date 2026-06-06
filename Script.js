const container = document.getElementById("key-container");

// Initial state
container.innerHTML = `
<div class="key-container initial-message" style="width: 100%; max-width: none; cursor: default;">
    <h4>Press any key to explore</h4>
</div>
`;

window.addEventListener("keydown", (e) => {
    const displayKey = e.key === " " ? "space" : e.key;
    container.innerHTML = `
    <div class="key-container" tabindex="0" role="button" aria-label="Copy Key: ${displayKey}" onclick="copyToClipboard('${displayKey}', this)">
        <h4>Key</h4>
        <div class="Key-Content">${displayKey}</div>
    </div>
    <div class="key-container" tabindex="0" role="button" aria-label="Copy Code: ${e.code}" onclick="copyToClipboard('${e.code}', this)">
        <h4>Code</h4>
        <div class="Key-Content">${e.code}</div>
    </div>
    <div class="key-container" tabindex="0" role="button" aria-label="Copy Key Code: ${e.keyCode}" onclick="copyToClipboard('${e.keyCode}', this)">
        <h4>Key Code</h4>
        <div class="Key-Content">${e.keyCode}</div>
    </div>
    `;
});

window.copyToClipboard = (text, element) => {
    navigator.clipboard.writeText(text).then(() => {
        element.classList.add("copied");
        setTimeout(() => {
            element.classList.remove("copied");
        }, 1000);
    });
};

// Handle keyboard interaction (Enter/Space) for copying
container.addEventListener("keydown", (e) => {
    if ((e.key === "Enter" || e.key === " ") && e.target.classList.contains("key-container")) {
        e.preventDefault();
        e.stopPropagation(); // Prevent the global window listener from resetting the UI
        e.target.click();
    }
});
