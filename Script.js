const container = document.getElementById("key-container");

window.addEventListener("keydown", (e) => {
    container.innerHTML = generateHTML(e.key, e.code, e.keyCode);
});

function generateHTML(key, code, keyCode) {
    const displayKey = key === " " ? "Space" : key;
    return `
    <div class="key-container" aria-labelledby="label-key">
        <h4 id="label-key">Key</h4>
        <div class="Key-Content">${displayKey}</div>
    </div>
    <div class="key-container" aria-labelledby="label-code">
        <h4 id="label-code">Code</h4>
        <div class="Key-Content">${code}</div>
    </div>
    <div class="key-container" aria-labelledby="label-keyCode">
        <h4 id="label-keyCode">Key Code</h4>
        <div class="Key-Content">${keyCode}</div>
    </div>
    `;
}
