window.addEventListener("keydown", (e) => {
  const insert = document.getElementById("insert");

  // Helper function to create each info box safely
  const createKeyBox = (label, value) => {
    const box = document.createElement("div");
    box.className = "key-container";

    const title = document.createElement("h4");
    title.textContent = label;
    box.appendChild(title);

    // Create the content wrapper to maintain visual styling
    const content = document.createElement("div");
    content.className = "Key-Content";
    content.textContent = value === " " ? "Space" : value;
    box.appendChild(content);

    return box;
  };

  // Clear the initial instructions
  insert.innerHTML = "";

  // Add the three event properties directly to the #insert container
  // to avoid redundant nesting of .container classes
  insert.appendChild(createKeyBox("event.key", e.key));
  insert.appendChild(createKeyBox("event.code", e.code));
  insert.appendChild(createKeyBox("event.keyCode", e.keyCode.toString()));
});
