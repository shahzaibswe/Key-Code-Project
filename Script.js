const insert = document.getElementById("insert");

window.addEventListener("keydown", (event) => {
  // Visual feedback: pulse animation
  insert.classList.remove("pressed");
  void insert.offsetWidth; // Force reflow
  insert.classList.add("pressed");

  insert.innerHTML = `
    <div class="key-container">
        <h4>event.key</h4>
        <div class="Key-Content">${event.key === " " ? "Space" : event.key}</div>
    </div>
    <div class="key-container">
        <h4>event.code</h4>
        <div class="Key-Content">${event.code}</div>
    </div>
    <div class="key-container">
        <h4>event.keyCode (legacy)</h4>
        <div class="Key-Content">${event.keyCode}</div>
    </div>
  `;
});
