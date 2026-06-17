const insert = document.getElementById("insert");

window.addEventListener("keydown", (e) => {
  // Prevent resetting when Tab/Enter/Space are used for navigation/interaction
  if (["Tab", "Enter"].includes(e.key)) return;
  if (e.key === " " && e.target.closest(".key")) return;

  const keyName = e.key === " " ? "Space" : e.key;
  insert.innerHTML = [
    ["Key", keyName], ["Code", e.code], ["Key Code", e.keyCode]
  ].map(([label, val]) => `
    <div class="key" role="button" tabindex="0" aria-label="Copy ${label}: ${val}">
      <h4>${label}</h4>
      <span class="val">${val}</span>
      <small class="hint">Click to copy</small>
    </div>`).join("");
});

insert.addEventListener("click", (e) => {
  const card = e.target.closest(".key");
  const val = card?.querySelector(".val");
  const hint = card?.querySelector(".hint");
  if (!val || !hint || card.classList.contains("copied")) return;

  navigator.clipboard.writeText(val.textContent).then(() => {
    card.classList.add("copied");
    hint.textContent = "Copied!";
    setTimeout(() => {
      card.classList.remove("copied");
      hint.textContent = "Click to copy";
    }, 1000);
  });
});

insert.addEventListener("keydown", (e) => {
  if (e.key === "Enter" || e.key === " ") {
    e.target.click();
    e.preventDefault();
    e.stopPropagation();
  }
});
