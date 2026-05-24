const container = document.getElementById("key-container");

container.innerHTML = '<div class="key-container">Press any key to get the JavaScript event keycode</div>';

window.addEventListener("keydown", (e) => {
    container.innerHTML = generateHTML(e.key, e.code, e.keyCode);
});

function generateHTML(key, code, keyCode) {
    return `
    <div class="key-container">
        <h4 id="label-key">Key</h4>
        <div class="Key-Content" aria-labelledby="label-key">${key === " " ? "space" : key}</div>
    </div>
    <div class="key-container">
        <h4 id="label-code">Code</h4>
        <div class="Key-Content" aria-labelledby="label-code">${code}</div>
    </div>
    <div class="key-container">
        <h4 id="label-keycode">Key Code</h4>
        <div class="Key-Content" aria-labelledby="label-keycode">${keyCode}</div>
    </div>
    `;
}
