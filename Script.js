const elements = {
    welcome: document.getElementById('welcome-message'),
    display: document.getElementById('display-container'),
    vals: { key: document.getElementById('key-v'), code: document.getElementById('code-v'), keycode: document.getElementById('keycode-v') }
};

window.addEventListener('keydown', (e) => {
    elements.welcome.style.display = 'none';
    elements.display.style.display = 'flex';
    const data = { key: e.key === ' ' ? 'Space' : e.key, code: e.code, keycode: e.keyCode };
    for (const k in data) {
        const el = elements.vals[k];
        el.textContent = data[k];
        el.parentElement.dataset.current = data[k];
    }
});

document.querySelectorAll('.key-container').forEach(card => {
    const triggerCopy = () => {
        const valEl = card.querySelector('.Key-Content');
        if (valEl.textContent === 'Copied!') return;
        navigator.clipboard.writeText(card.dataset.current);
        valEl.textContent = 'Copied!';
        card.classList.add('active');
        setTimeout(() => {
            card.classList.remove('active');
            if (valEl.textContent === 'Copied!') valEl.textContent = card.dataset.current;
        }, 1000);
    };
    card.onclick = triggerCopy;
    card.onkeydown = (e) => { if (e.key === 'Enter' || e.key === ' ') { e.stopPropagation(); triggerCopy(); } };
});
