const insert = document.getElementById('insert');

window.addEventListener('keydown', (event) => {
  // Clear the initial instruction if it exists
  const instruction = document.getElementById('instruction');
  if (instruction) {
    instruction.style.display = 'none';
  }

  const keyContents = document.querySelectorAll('.Key-Content');

  // Property mapping: [event.key, event.code, event.keyCode]
  const values = [
    event.key === ' ' ? 'Space' : event.key,
    event.code,
    event.keyCode
  ];

  keyContents.forEach((content, index) => {
    content.textContent = values[index];
  });
});
