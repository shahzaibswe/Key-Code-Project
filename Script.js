const instruction = document.getElementById("instruction");
const results = document.getElementById("results");
const keyValue = document.getElementById("key-value");
const codeValue = document.getElementById("code-value");
const keycodeValue = document.getElementById("keycode-value");

window.addEventListener("keydown", (e) => {
    if (instruction && !instruction.classList.contains("hidden")) {
        instruction.classList.add("hidden");
        results.classList.remove("hidden");
    }

    keyValue.textContent = e.key === " " ? "Space" : e.key;
    codeValue.textContent = e.code;
    keycodeValue.textContent = e.keyCode;
});
