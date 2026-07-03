const container = document.getElementById('container');
const instruction = document.getElementById('instruction');

const fields = {
  key: document.getElementById('key-v'),
  code: document.getElementById('code-v'),
  keycode: document.getElementById('keycode-v')
};

window.addEventListener('keydown', (e) => {
  if (instruction.style.display !== 'none') {
    instruction.style.display = 'none';
    container.classList.add('active');
  }

  fields.key.textContent = e.key === ' ' ? 'Space' : e.key;
  fields.code.textContent = e.code;
  fields.keycode.textContent = e.keyCode;
});

container.addEventListener('click', (e) => {
  const card = e.target.closest('.key');
  if (!card) return;

  const value = card.querySelector('.key-value').textContent;
  const hint = card.querySelector('.copy-hint');

  if (card.classList.contains('success')) return;

  navigator.clipboard.writeText(value).then(() => {
    const originalText = hint.textContent;
    hint.textContent = 'Copied!';
    card.classList.add('success');
    setTimeout(() => {
      hint.textContent = originalText;
      card.classList.remove('success');
    }, 1500);
  });
});

container.addEventListener('keydown', (e) => {
  if (e.key === 'Enter' || e.key === ' ') {
    e.preventDefault();
    e.target.click();
  }
});
