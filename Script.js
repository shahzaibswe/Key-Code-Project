const insert = document.getElementById("insert");

window.addEventListener("keydown", (event) => {
  insert.innerHTML = `
    <div class="key-container" aria-labelledby="key-label">
        <h4 id="key-label">event.key</h4>
        <div class="Key-Content">${event.key === " " ? "Space" : event.key}</div>
    </div>
    <div class="key-container" aria-labelledby="code-label">
        <h4 id="code-label">event.code</h4>
        <div class="Key-Content">${event.code}</div>
    </div>
    <div class="key-container" aria-labelledby="keycode-label">
        <h4 id="keycode-label">event.keyCode</h4>
        <div class="Key-Content">${event.keyCode}</div>
    </div>
    `;
});
