const container = document.getElementById("key-container");
container.innerHTML = generateHTML("-", " -", "_");
window.addEventListener("keydown", (e) => {
    container.innerHTML = generateHTML(e.key, e.code, e.key.charCodeAt(0));
});

function generateHTML(key, code, keyCode) {
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
