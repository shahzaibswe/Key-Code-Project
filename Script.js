const keyV = document.getElementById('key-v');
const codeV = document.getElementById('code-v');
const keycodeV = document.getElementById('keycode-v');
const container = document.getElementById('key-container');

window.addEventListener('keydown', (e) => {
  keyV.textContent = e.key === ' ' ? 'Space' : e.key;
  codeV.textContent = e.code;
  keycodeV.textContent = e.keyCode;
  container.classList.add('pressed');
});

window.addEventListener('keyup', () => {
  container.classList.remove('pressed');
});
