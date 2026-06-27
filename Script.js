const keyV = document.getElementById('key-v');
const codeV = document.getElementById('code-v');
const keycodeV = document.getElementById('keycode-v');
const instruction = document.getElementById('instruction');
const keyDisplay = document.getElementById('key-display');

window.addEventListener('keydown', (e) => {
  if (instruction.style.display !== 'none') {
    instruction.style.display = 'none';
    keyDisplay.style.display = 'flex';
  }

  keyV.textContent = e.key === ' ' ? 'Space' : e.key;
  codeV.textContent = e.code;
  keycodeV.textContent = e.keyCode;
});
