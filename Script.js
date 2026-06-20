const container = document.getElementById("key-container");

container.innerHTML = `
  <div class="key-container">
    <div class="Key-Content">Press any key to get the JavaScript event keycode</div>
  </div>
`;

window.addEventListener("keydown", (e) => {
  if (["Tab", "Shift", "Control", "Alt", "Meta"].includes(e.key)) return;
  container.innerHTML = generateHTML(e.key, e.code, e.keyCode);
});

function generateHTML(key, code, keyCode) {
  const displayKey = key === " " ? "Space" : key;
  return `
    <div class="key-container" role="button" tabindex="0" aria-label="Copy Key: ${displayKey}" data-value="${displayKey}">
      <h4>Key</h4>
      <div class="Key-Content">${displayKey}</div>
    </div>
    <div class="key-container" role="button" tabindex="0" aria-label="Copy Code: ${code}" data-value="${code}">
      <h4>Code</h4>
      <div class="Key-Content">${code}</div>
    </div>
    <div class="key-container" role="button" tabindex="0" aria-label="Copy Key Code: ${keyCode}" data-value="${keyCode}">
      <h4>Key Code</h4>
      <div class="Key-Content">${keyCode}</div>
    </div>
  `;
}

container.addEventListener("click", (e) => {
  const card = e.target.closest(".key-container");
  if (!card) return;

  const titleElement = card.querySelector("h4");
  if (!titleElement) return;

  const originalTitle = titleElement.textContent;
  const content = card.dataset.value;

  navigator.clipboard.writeText(content).then(() => {
    titleElement.textContent = "Copied!";
    setTimeout(() => {
      titleElement.textContent = originalTitle;
    }, 1000);
  });
});

container.addEventListener("keydown", (e) => {
  if (e.key === "Enter" || e.key === " ") {
    const card = e.target.closest(".key-container");
    if (card) {
      e.preventDefault();
      e.stopPropagation();
      card.click();
    }
  }
});
