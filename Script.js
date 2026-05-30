const container = document.getElementById("key-container");

container.innerHTML = `
<div class="key-container">
    <div class="Key-Content">Press any key to get the JavaScript Key Code</div>
</div>
`;

window.addEventListener("keydown", (e) => {
  container.innerHTML = `
    <div class="key-container" aria-labelledby="key-label">
        <h4 id="key-label">event.key</h4>
        <div class="Key-Content">${e.key === " " ? "Space" : e.key}</div>
    </div>
    <div class="key-container" aria-labelledby="code-label">
        <h4 id="code-label">event.code</h4>
        <div class="Key-Content">${e.code}</div>
    </div>
    <div class="key-container" aria-labelledby="keycode-label">
        <h4 id="keycode-label">event.keyCode</h4>
        <div class="Key-Content">${e.keyCode}</div>
    </div>
    `;
});
