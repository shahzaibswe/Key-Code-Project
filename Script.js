const insert = document.getElementById("insert");

window.addEventListener("keydown", (event) => {
  if (event.key === " ") {
    event.preventDefault();
  }

  // Use textContent for better security and clear existing content if it's the first keypress
  if (insert.querySelector(".instruction")) {
    insert.textContent = "";

    // Create the containers once
    ["Key", "Code", "Key Code"].forEach(label => {
      const div = document.createElement("div");
      div.className = "key-container";
      div.id = label.toLowerCase().replace(" ", "-");

      const h4 = document.createElement("h4");
      h4.textContent = label;
      div.appendChild(h4);

      const content = document.createElement("div");
      content.className = "Key-Content";
      div.appendChild(content);

      insert.appendChild(div);
    });
  }

  const keyDiv = document.getElementById("key");
  const codeDiv = document.getElementById("code");
  const keyCodeDiv = document.getElementById("key-code");

  if (keyDiv && codeDiv && keyCodeDiv) {
    keyDiv.querySelector(".Key-Content").textContent = event.key === " " ? "Space" : event.key;
    codeDiv.querySelector(".Key-Content").textContent = event.code;
    keyCodeDiv.querySelector(".Key-Content").textContent = event.keyCode;

    // Add visual feedback
    document.querySelectorAll(".key-container").forEach(el => el.classList.add("pressed"));
  }
});

window.addEventListener("keyup", () => {
  document.querySelectorAll(".key-container").forEach(el => el.classList.remove("pressed"));
});
