const insert = document.getElementById("insert");

window.addEventListener("keydown", (event) => {
  insert.innerHTML = "";

  const keyCodes = {
    "event.key": event.key === " " ? "Space" : event.key,
    "event.code": event.code,
    "event.keyCode": event.keyCode,
  };

  for (const label in keyCodes) {
    const keyContainer = document.createElement("div");
    keyContainer.className = "key-container";

    const title = document.createElement("h4");
    const titleId = label.replace(".", "-");
    title.id = titleId;
    title.textContent = label;

    const content = document.createElement("div");
    content.className = "Key-Content";
    content.textContent = keyCodes[label];
    content.setAttribute("aria-labelledby", titleId);

    keyContainer.appendChild(title);
    keyContainer.appendChild(content);
    insert.appendChild(keyContainer);
  }
});
