const instruction = document.getElementById('instruction');
const displayContainer = document.getElementById('display-container');
const keyDisplay = document.getElementById('key-display');
const codeDisplay = document.getElementById('code-display');
const keycodeDisplay = document.getElementById('keycode-display');

window.addEventListener('keydown', (e) => {
  if (instruction.style.display !== 'none') {
    instruction.style.display = 'none';
    displayContainer.style.display = 'block';
  }

  keyDisplay.textContent = e.key === ' ' ? 'Space' : e.key;
  codeDisplay.textContent = e.code;
  keycodeDisplay.textContent = e.keyCode;
});
