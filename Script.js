const instruction = document.getElementById('instruction');
const container = document.getElementById('container');
const displayKey = document.getElementById('display-key');
const displayCode = document.getElementById('display-code');
const displayKeycode = document.getElementById('display-keycode');

window.addEventListener('keydown', (e) => {
  if (instruction.style.display !== 'none') {
    instruction.style.display = 'none';
    container.style.display = 'flex';
  }

  displayKey.textContent = e.key === ' ' ? 'Space' : e.key;
  displayCode.textContent = e.code;
  displayKeycode.textContent = e.keyCode;
});

// Copy to clipboard functionality
const cards = document.querySelectorAll('.key-container');
cards.forEach(card => {
  card.addEventListener('click', () => {
    const value = card.querySelector('.Key-Content').textContent;
    copyToClipboard(value, card);
  });

  card.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      const value = card.querySelector('.Key-Content').textContent;
      copyToClipboard(value, card);
    }
  });
});

function copyToClipboard(text, element) {
  navigator.clipboard.writeText(text).then(() => {
    const hint = element.querySelector('.copy-hint');
    const originalText = hint.textContent;
    hint.textContent = 'Copied!';
    element.classList.add('copied');

    setTimeout(() => {
      hint.textContent = originalText;
      element.classList.remove('copied');
    }, 1500);
  });
}
