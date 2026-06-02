const keyValue = document.getElementById("key-value");
const codeValue = document.getElementById("code-value");
const keycodeValue = document.getElementById("keycode-value");

window.addEventListener("keydown", (event) => {
  // Update textContent instead of innerHTML for better stability and security.
  // Explicitly handle "Space" for better user visibility.
  keyValue.textContent = event.key === " " ? "Space" : event.key;
  codeValue.textContent = event.code;
  keycodeValue.textContent = event.keyCode;
});
