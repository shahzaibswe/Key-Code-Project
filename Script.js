const keyDisplay = document.getElementById('key');
const codeDisplay = document.getElementById('code');
const keyCodeDisplay = document.getElementById('keyCode');
const init = document.getElementById('init');
const containers = document.querySelectorAll('.key-container');

window.addEventListener('keydown', (e) => {
  if (init.style.display !== 'none') {
    init.style.display = 'none';
    containers.forEach(c => { if(c !== init) c.style.display = 'flex'; });
  }

  keyDisplay.textContent = e.key === ' ' ? 'Space' : e.key;
  codeDisplay.textContent = e.code;
  keyCodeDisplay.textContent = e.keyCode;

  containers.forEach(c => {
    if (c.style.display !== 'none') {
      c.classList.remove('pressed');
      void c.offsetWidth; // Trigger reflow
      c.classList.add('pressed');
    }
  });
});
