const instruction = document.getElementById("instruction");
const display = document.getElementById("display");
const keyV = document.getElementById("key-v");
const codeV = document.getElementById("code-v");
const keycodeV = document.getElementById("keycode-v");
const cards = document.querySelectorAll(".key-container");

window.addEventListener("keydown", (e) => {
  if (display.style.display === "none") {
    instruction.style.display = "none";
    display.style.display = "flex";
  }

  keyV.textContent = e.key === " " ? "Space" : e.key;
  codeV.textContent = e.code;
  keycodeV.textContent = e.keyCode;

  cards.forEach(card => card.classList.add("pressed"));
});

window.addEventListener("keyup", () => {
  cards.forEach(card => card.classList.remove("pressed"));
});
