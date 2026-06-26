const t = document.getElementById("title"), d = document.getElementById("display");
const kv = document.getElementById("key-v"), cv = document.getElementById("code-v"), kc = document.getElementById("keycode-v");
const copy = document.getElementById("copy-c");

window.addEventListener("keydown", (e) => {
  if (["Tab", "Enter"].includes(e.key)) return;
  if (d.style.display === "none") { t.style.display = "none"; d.style.display = "flex"; }
  kv.textContent = e.key === " " ? "Space" : e.key;
  cv.textContent = e.code;
  kc.textContent = e.keyCode;
});

const doCopy = () => {
  navigator.clipboard.writeText(kc.textContent).then(() => {
    const old = kc.textContent; kc.textContent = "Copied!";
    setTimeout(() => kc.textContent = old, 1000);
  });
};

copy.addEventListener("click", doCopy);
copy.addEventListener("keydown", (e) => {
  if (e.key === "Enter" || e.key === " ") {
    e.stopPropagation();
    doCopy();
  }
});
