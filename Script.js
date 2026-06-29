const keyV = document.getElementById('key-v');
const codeV = document.getElementById('code-v');
const keycodeV = document.getElementById('keycode-v');
const instruction = document.getElementById('instruction');
const cards = document.querySelectorAll('.key-card');

window.addEventListener('keydown', (e) => {
  // Update values
  keyV.textContent = e.key === ' ' ? 'Space' : e.key;
  codeV.textContent = e.code;
  keycodeV.textContent = e.keyCode;

  // Update instruction if it's the first key press
  if (instruction.textContent !== 'Key Info Detected') {
    instruction.textContent = 'Key Info Detected';
  }
});

cards.forEach(card => {
  card.addEventListener('click', () => {
    const value = card.querySelector('.Key-Content').textContent;
    if (value === '-') return;

    navigator.clipboard.writeText(value).then(() => {
      const hint = card.querySelector('.copy-hint');
      const originalText = hint.textContent;
      hint.textContent = 'Copied!';
      hint.style.color = '#00ff00';

      setTimeout(() => {
        hint.textContent = originalText;
        hint.style.color = '';
      }, 1500);
    });
  });

  card.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      e.stopPropagation();
      card.click();
    }
  });
});
