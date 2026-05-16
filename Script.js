const keyContainer = document.getElementById("key-container");
const mainContainer = document.getElementById("main-container");

let animationTimeout;

window.addEventListener("keydown", (e) => {
  // Update HTML structure on the first keypress if needed
  if (keyContainer.querySelector(".Key-Content").textContent.includes("Press any key")) {
    keyContainer.innerHTML = generateHTML(e.key, e.code, e.keyCode || e.key.charCodeAt(0));
  } else {
    updateHTML(e.key, e.code, e.keyCode || e.key.charCodeAt(0));
  }

  // Visual feedback pulse
  mainContainer.classList.remove("pressed");
  void mainContainer.offsetWidth; // Trigger reflow
  mainContainer.classList.add("pressed");

  clearTimeout(animationTimeout);
  animationTimeout = setTimeout(() => {
    mainContainer.classList.remove("pressed");
  }, 100);
});

function generateHTML(key, code, keyCode) {
  return `
    <div class="key-container">
        <h4>Key</h4>
        <div class="Key-Content" id="key-value">${key === " " ? "Space" : key}</div>
    </div>
    <div class="key-container">
        <h4>Code</h4>
        <div class="Key-Content" id="code-value">${code}</div>
    </div>
    <div class="key-container">
        <h4>Key Code</h4>
        <div class="Key-Content" id="keycode-value">${keyCode}</div>
    </div>
    `;
}

function updateHTML(key, code, keyCode) {
  document.getElementById("key-value").textContent = key === " " ? "Space" : key;
  document.getElementById("code-value").textContent = code;
  document.getElementById("keycode-value").textContent = keyCode;
}
