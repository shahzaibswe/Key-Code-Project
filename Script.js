const container = document.getElementById("key-container");
const mainContainer = document.querySelector(".container");

window.addEventListener("keydown", (e) => {
  mainContainer.classList.add("pressed");
  container.innerHTML = generateHTML(e.key, e.code, e.keyCode);
});

window.addEventListener("keyup", () => {
  mainContainer.classList.remove("pressed");
});

function generateHTML(key, code, keyCode) {
  return `
    <div class="key-container">
        <h4>Key</h4>
        <div class="Key-Content">${key === " " ? "Space" : key}</div>
    </div>
    <div class="key-container">
        <h4>Code</h4>
        <div class="Key-Content">${code}</div>
    </div>
    <div class="key-container">
        <h4>Key Code</h4>
        <div class="Key-Content">${keyCode}</div>
    </div>
    `;
}
