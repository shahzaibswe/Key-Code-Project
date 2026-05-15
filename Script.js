const container = document.getElementById("container");
let timeoutId = null;

function generateHTML(key = "Press any key", code = "-", keyCode = "-") {
    return `
    <div class="key-container">
        <h4>Key</h4>
        <div class="Key-Content">${key === " " ? "space" : key}</div>
    </div>
    <div class="key-container">
        <h4>Code</h4>
        <div class="Key-Content">${code}</div>
    </div>
    <div class="key-container">
        <h4>Key Code</h4>
        <div class="Key-Content">${keyCode}</div>
    </div>
    `;
}

// Initial state
container.innerHTML = generateHTML();

window.addEventListener("keydown", (e) => {
    container.innerHTML = generateHTML(e.key, e.code, e.keyCode);

    // Clear previous timeout if any to prevent flickering on hold
    if (timeoutId) {
        clearTimeout(timeoutId);
    }

    container.classList.add("pressed");
    timeoutId = setTimeout(() => {
        container.classList.remove("pressed");
        timeoutId = null;
    }, 100);
});
