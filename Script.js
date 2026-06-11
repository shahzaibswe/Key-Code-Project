const container = document.getElementById("key-container");

window.addEventListener("keydown", (e) => {
  const keyDisplay = e.key === " " ? "Space" : e.key;

  // On the first key press, transition from instruction to the data layout
  if (container.textContent.includes("Press any key")) {
    container.innerHTML = `
            <div class="key-container">
                <h4>Key</h4>
                <div class="Key-Content"></div>
            </div>
            <div class="key-container">
                <h4>Code</h4>
                <div class="Key-Content"></div>
            </div>
            <div class="key-container">
                <h4>Key Code</h4>
                <div class="Key-Content"></div>
            </div>
        `;
  }

  const keyContents = container.querySelectorAll(".Key-Content");
  if (keyContents.length === 3) {
    keyContents[0].textContent = keyDisplay;
    keyContents[1].textContent = e.code;
    keyContents[2].textContent = e.keyCode;
  }
});
