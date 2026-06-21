const container = document.getElementById("key-container");

window.addEventListener("keydown", (e) => {
  // Prevent reset when navigating via Tab or interacting with cards
  if (e.key === "Tab" || e.key === "Enter" || e.key === " ") {
    if (document.activeElement.classList.contains("key-container")) {
      return;
    }
  }
  container.innerHTML = generateHTML(e.key, e.code, e.keyCode);
});

function generateHTML(key, code, keyCode) {
  const displayKey = key === " " ? "Space" : key;
  return `
    <div class="key-container" tabindex="0" role="button" aria-labelledby="key-label" data-value="${displayKey}">
        <h4 id="key-label">Key</h4>
        <div class="Key-Content">${displayKey}</div>
        <div class="copy-hint">Click to copy</div>
    </div>
    <div class="key-container" tabindex="0" role="button" aria-labelledby="code-label" data-value="${code}">
        <h4 id="code-label">Code</h4>
        <div class="Key-Content">${code}</div>
        <div class="copy-hint">Click to copy</div>
    </div>
    <div class="key-container" tabindex="0" role="button" aria-labelledby="keycode-label" data-value="${keyCode}">
        <h4 id="keycode-label">Key Code</h4>
        <div class="Key-Content">${keyCode}</div>
        <div class="copy-hint">Click to copy</div>
    </div>
    `;
}

container.addEventListener("click", (e) => {
  const card = e.target.closest(".key-container");
  if (card && card.dataset.value) {
    copyToClipboard(card);
  }
});

container.addEventListener("keydown", (e) => {
  const card = e.target.closest(".key-container");
  if (card && (e.key === "Enter" || e.key === " ")) {
    e.preventDefault();
    copyToClipboard(card);
  }
});

function copyToClipboard(card) {
  const value = card.dataset.value;
  const hint = card.querySelector(".copy-hint");
  const originalHint = hint.textContent;

  navigator.clipboard.writeText(value).then(() => {
    hint.textContent = "Copied!";
    card.classList.add("copied");
    setTimeout(() => {
      hint.textContent = originalHint;
      card.classList.remove("copied");
    }, 1500);
  });
}
