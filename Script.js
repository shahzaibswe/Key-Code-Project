const container = document.querySelector('.container');
const keyV = document.getElementById('key-v');
const codeV = document.getElementById('code-v');
const keycodeV = document.getElementById('keycode-v');

window.addEventListener('keydown', (e) => {
  container.classList.add('pressed');
  keyV.textContent = e.key === ' ' ? 'Space' : e.key;
  codeV.textContent = e.code;
  keycodeV.textContent = e.keyCode;
});

window.addEventListener('keyup', () => {
  container.classList.remove('pressed');
});
