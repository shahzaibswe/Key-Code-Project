const insert = document.getElementById("insert");

window.addEventListener("keydown", (event) => {
  if (!document.getElementById("key-value")) {
    insert.innerHTML = `
      <div class="container">
        <div class="key-container" aria-labelledby="label-key">
          <h4 id="label-key">event.key</h4>
          <div id="key-value" class="Key-Content"></div>
        </div>
        <div class="key-container" aria-labelledby="label-code">
          <h4 id="label-code">event.code</h4>
          <div id="code-value" class="Key-Content"></div>
        </div>
        <div class="key-container" aria-labelledby="label-keycode">
          <h4 id="label-keycode">event.keyCode</h4>
          <div id="keycode-value" class="Key-Content"></div>
        </div>
      </div>
    `;
  }

  document.getElementById("key-value").textContent =
    event.key === " " ? "Space" : event.key;
  document.getElementById("code-value").textContent = event.code;
  document.getElementById("keycode-value").textContent = event.keyCode;
});
