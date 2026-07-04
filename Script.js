const instruction = document.getElementById('instruction');
const displayArea = document.getElementById('display-area');
const keyElement = document.getElementById('key-v');
const codeElement = document.getElementById('code-v');
const keyCodeElement = document.getElementById('keycode-v');
const cards = document.querySelectorAll('.key-container');

window.addEventListener('keydown', (e) => {
  if (instruction.style.display !== 'none') {
    instruction.style.display = 'none';
    displayArea.style.display = 'block';
  }

  keyElement.textContent = e.key === " " ? "Space" : e.key;
  codeElement.textContent = e.code;
  keyCodeElement.textContent = e.keyCode;

  cards.forEach(card => card.classList.add('pressed'));
});

window.addEventListener('keyup', () => {
  cards.forEach(card => card.classList.remove('pressed'));
});

cards.forEach(card => {
  card.addEventListener('click', () => {
    const value = card.querySelector('.Key-Content').textContent;
    if (value === "-") return;

    navigator.clipboard.writeText(value).then(() => {
      const hint = card.querySelector('.copy-hint');
      const originalHint = hint.textContent;

      card.classList.add('success');
      hint.textContent = 'Copied!';

      setTimeout(() => {
        card.classList.remove('success');
        hint.textContent = originalHint;
      }, 1500);
    });
  });

  card.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      card.click();
    }
  });
});
