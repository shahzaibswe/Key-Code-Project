const insert = document.getElementById('insert');
const instruction = document.getElementById('instruction');
const keyValue = document.getElementById('key-value');
const codeValue = document.getElementById('code-value');
const keycodeValue = document.getElementById('keycode-value');

window.addEventListener('keydown', (e) => {
  // Hide instruction on first key press
  if (instruction) {
    instruction.style.display = 'none';
  }

  // Update text content safely
  keyValue.textContent = e.key === ' ' ? 'Space' : e.key;
  codeValue.textContent = e.code;
  keycodeValue.textContent = e.keyCode;
});

// Add click-to-copy functionality
document.querySelectorAll('.key-container').forEach(container => {
  container.addEventListener('click', () => {
    const textToCopy = container.querySelector('.key-content').textContent;
    // Only copy if a key has been pressed (instruction is hidden)
    if (instruction && instruction.style.display === 'none') {
      navigator.clipboard.writeText(textToCopy).then(() => {
        // Visual feedback
        container.classList.add('copied');
        setTimeout(() => {
          container.classList.remove('copied');
        }, 500);
      });
    }
  });

  // Keyboard accessibility for "click"
  container.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      container.click();
    }
  });
});
