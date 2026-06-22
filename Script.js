const container = document.getElementById("key-container");

window.addEventListener("keydown", (e) => {
  // Prevent default behavior for interaction keys if needed,
  // but usually we want them to be caught by the tool.
  // We exclude 'Tab' to allow keyboard navigation.
  if (e.key === 'Tab') return;

  container.innerHTML = generateHTML(e.key, e.code, e.keyCode);
});

function generateHTML(key, code, keyCode) {
  const displayKey = key === " " ? "Space" : key;
  return `
    <div class="key-container clickable-card" tabindex="0" role="button" aria-labelledby="key-title" data-value="${displayKey}">
        <h4 id="key-title">event.key</h4>
        <div class="Key-Content">${displayKey}</div>
        <small class="copy-hint">Click to copy</small>
    </div>
    <div class="key-container clickable-card" tabindex="0" role="button" aria-labelledby="code-title" data-value="${code}">
        <h4 id="code-title">event.code</h4>
        <div class="Key-Content">${code}</div>
        <small class="copy-hint">Click to copy</small>
    </div>
    <div class="key-container clickable-card" tabindex="0" role="button" aria-labelledby="keycode-title" data-value="${keyCode}">
        <h4 id="keycode-title">event.keyCode</h4>
        <div class="Key-Content">${keyCode}</div>
        <small class="copy-hint">Click to copy</small>
    </div>
  `;
}

container.addEventListener("click", (e) => {
  const card = e.target.closest(".clickable-card");
  if (card) {
    copyToClipboard(card);
  }
});

container.addEventListener("keydown", (e) => {
  if (e.key === "Enter" || e.key === " ") {
    const card = e.target.closest(".clickable-card");
    if (card) {
      e.preventDefault();
      copyToClipboard(card);
    }
  }
});

async function copyToClipboard(card) {
  const value = card.dataset.value;
  try {
    await navigator.clipboard.writeText(value);
    const hint = card.querySelector(".copy-hint");
    const originalText = hint.textContent;
    hint.textContent = "Copied!";
    card.classList.add("copied");

    setTimeout(() => {
      hint.textContent = originalText;
      card.classList.remove("copied");
    }, 1500);
  } catch (err) {
    console.error("Failed to copy!", err);
  }
}
