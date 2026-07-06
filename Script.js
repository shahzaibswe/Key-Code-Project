const onboarding = document.getElementById('onboarding');
const displayWrapper = document.getElementById('display-wrapper');
const valKey = document.getElementById('val-key');
const valCode = document.getElementById('val-code');
const valKeyCode = document.getElementById('val-keycode');
const cards = document.querySelectorAll('.key-container[role="button"]');

window.addEventListener('keydown', (e) => {
  if (onboarding.style.display !== 'none') {
    onboarding.style.display = 'none';
    displayWrapper.style.display = 'flex';
  }

  valKey.textContent = e.key === ' ' ? 'Space' : e.key;
  valCode.textContent = e.code;
  valKeyCode.textContent = e.keyCode;

  // Visual feedback for the key pressed
  displayWrapper.classList.add('pressed');
});

window.addEventListener('keyup', () => {
  displayWrapper.classList.remove('pressed');
});

cards.forEach(card => {
  card.addEventListener('click', () => {
    const value = card.querySelector('.Key-Content').textContent;
    copyToClipboard(value, card);
  });

  card.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      card.click();
    }
  });
});

async function copyToClipboard(text, element) {
  try {
    await navigator.clipboard.writeText(text);
    const hint = element.querySelector('.copy-hint');
    const originalText = hint.textContent;
    hint.textContent = 'Copied!';
    element.classList.add('success');

    setTimeout(() => {
      hint.textContent = originalText;
      element.classList.remove('success');
    }, 1500);
  } catch (err) {
    console.error('Failed to copy: ', err);
  }
}
