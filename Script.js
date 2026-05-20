const container = document.getElementById("container");
const initialMessage = document.getElementById("initial-message");
const keyDisplay = document.getElementById("key-display");
const keyVal = document.getElementById("key-val");
const codeVal = document.getElementById("code-val");
const keycodeVal = document.getElementById("keycode-val");

let animationTimeout;

window.addEventListener("keydown", (e) => {
    if (initialMessage && !initialMessage.classList.contains("display-none")) {
        initialMessage.classList.add("display-none");
    }
    if (keyDisplay && keyDisplay.classList.contains("display-none")) {
        keyDisplay.classList.remove("display-none");
        keyDisplay.style.display = "flex";
    }

    keyVal.textContent = e.key === " " ? "Space" : e.key;
    codeVal.textContent = e.code;
    keycodeVal.textContent = e.keyCode;

    // Pulse animation
    if (keyDisplay) {
        keyDisplay.classList.remove("pressed");
        void keyDisplay.offsetWidth; // Force reflow
        keyDisplay.classList.add("pressed");
    }

    clearTimeout(animationTimeout);
    animationTimeout = setTimeout(() => {
        if (keyDisplay) {
            keyDisplay.classList.remove("pressed");
        }
    }, 100);
});
