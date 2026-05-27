const insert = document.getElementById("insert");

window.addEventListener("keydown", (e) => {
    insert.innerHTML = `
    <div class="container">
        <div class="key-container" aria-labelledby="label-key">
            <h4 id="label-key">event.key</h4>
            <div class="Key-Content">${e.key === ' ' ? 'Space' : e.key}</div>
        </div>
        <div class="key-container" aria-labelledby="label-code">
            <h4 id="label-code">event.code</h4>
            <div class="Key-Content">${e.code}</div>
        </div>
        <div class="key-container" aria-labelledby="label-keycode">
            <h4 id="label-keycode">event.keyCode</h4>
            <div class="Key-Content">${e.keyCode}</div>
        </div>
    </div>
    `;
});
