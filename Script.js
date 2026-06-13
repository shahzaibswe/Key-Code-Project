const container = document.getElementById("container");
const announcer = document.getElementById("announcer");

// Event delegation for copying to clipboard
container.addEventListener("click", (e) => {
  const card = e.target.closest(".key-container");
  if (card) {
    copyToClipboard(card);
  }
});

container.addEventListener("keydown", (e) => {
  if (e.key === "Enter" || e.key === " ") {
    const card = e.target.closest(".key-container");
    if (card) {
      e.preventDefault();
      copyToClipboard(card);
    }
  }
});

window.addEventListener("keydown", (e) => {
  // Prevent default for keys like Space to avoid scrolling
  if (e.key === " ") {
    e.preventDefault();
  }

  const key = e.key === " " ? "Space" : e.key;
  const code = e.code;
  const keyCode = e.keyCode;

  // Clear initial message and set up cards if they don't exist
  if (document.getElementById("instruction")) {
    container.innerHTML = `
      <div class="key-container" tabindex="0" role="button" aria-labelledby="key-label">
        <h4 id="key-label">event.key</h4>
        <div class="Key-Content"></div>
        <div class="copy-hint">Click to copy</div>
      </div>
      <div class="key-container" tabindex="0" role="button" aria-labelledby="code-label">
        <h4 id="code-label">event.code</h4>
        <div class="Key-Content"></div>
        <div class="copy-hint">Click to copy</div>
      </div>
      <div class="key-container" tabindex="0" role="button" aria-labelledby="keycode-label">
        <h4 id="keycode-label">event.keyCode (Legacy)</h4>
        <div class="Key-Content"></div>
        <div class="copy-hint">Click to copy</div>
      </div>
    `;
  }

  const cards = container.querySelectorAll(".key-container");
  if (cards.length === 3) {
    updateCard(cards[0], key);
    updateCard(cards[1], code);
    updateCard(cards[2], keyCode.toString());
  }

  announcer.textContent = `Key pressed: ${key}, Code: ${code}, Key Code: ${keyCode}`;
});

function updateCard(card, value) {
  const content = card.querySelector(".Key-Content");
  content.textContent = value;
  // Use dataset to store the value safely (no HTML escaping issues)
  card.dataset.value = value;
}

function copyToClipboard(card) {
  const value = card.dataset.value;
  if (!value) return;

  navigator.clipboard.writeText(value).then(() => {
    const content = card.querySelector(".Key-Content");
    const hint = card.querySelector(".copy-hint");
    const originalText = content.textContent;
    const originalHint = hint.textContent;

    content.textContent = "Copied!";
    hint.textContent = "Copied to clipboard";
    card.classList.add("copied");

    setTimeout(() => {
      // Only restore if the current text is still "Copied!"
      // (prevents conflict if another key is pressed quickly)
      if (content.textContent === "Copied!") {
        content.textContent = card.dataset.value;
        hint.textContent = originalHint;
        card.classList.remove("copied");
      }
    }, 1000);
  }).catch(err => {
    console.error("Could not copy text: ", err);
  });
}
