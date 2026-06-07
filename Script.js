const keyContainer = document.getElementById('key-container');

window.addEventListener('keydown', (e) => {
    keyContainer.innerHTML = `
        <div class="key-card">
            <h4>event.key</h4>
            <div class="Key-Content">${e.key === ' ' ? 'Space' : e.key}</div>
        </div>
        <div class="key-card">
            <h4>event.code</h4>
            <div class="Key-Content">${e.code}</div>
        </div>
        <div class="key-card">
            <h4>event.keyCode</h4>
            <div class="Key-Content">${e.keyCode}</div>
        </div>
    `;
});