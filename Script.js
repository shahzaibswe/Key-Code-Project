const startMessage = document.getElementById("start-message");
const displayContainer = document.getElementById("display-container");
const keyValue = document.getElementById("key-value");
const codeValue = document.getElementById("code-value");
const keycodeValue = document.getElementById("keycode-value");
const mainContainer = document.getElementById("main-container");

let isFirstKey = true;
let animationTimeout;

window.addEventListener("keydown", (e) => {
    if (isFirstKey) {
        startMessage.style.display = "none";
        displayContainer.style.display = "flex";
        isFirstKey = false;
    }

    // Update values
    keyValue.textContent = e.key === " " ? "Space" : e.key;
    codeValue.textContent = e.code;
    keycodeValue.textContent = e.keyCode;

    // Visual feedback
    mainContainer.classList.remove("pressed");
    void mainContainer.offsetWidth; // Force reflow
    mainContainer.classList.add("pressed");

    clearTimeout(animationTimeout);
    animationTimeout = setTimeout(() => {
        mainContainer.classList.remove("pressed");
    }, 100);
});
