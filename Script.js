const container = document.getElementById("container");
const onboarding = document.getElementById("onboarding");
const infoDisplay = document.getElementById("info-display");
const keyV = document.getElementById("key-v");
const codeV = document.getElementById("code-v");
const keycodeV = document.getElementById("keycode-v");

window.addEventListener("keydown", (e) => {
  if (onboarding.style.display !== "none") {
    onboarding.style.display = "none";
    infoDisplay.style.display = "flex";
  }

  container.classList.add("pressed");

  keyV.textContent = e.key === " " ? "Space" : e.key;
  codeV.textContent = e.code;
  keycodeV.textContent = e.keyCode;
});

window.addEventListener("keyup", () => {
  container.classList.remove("pressed");
});
