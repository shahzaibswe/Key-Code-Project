const insert = document.getElementById("insert");

function createKeyCard(label, id) {
    const container = document.createElement("div");
    container.className = "key-container";
    container.setAttribute("aria-labelledby", `label-${id}`);

    const h4 = document.createElement("h4");
    h4.id = `label-${id}`;
    h4.textContent = label;

    const content = document.createElement("div");
    content.className = "Key-Content";
    content.textContent = "-";

    container.appendChild(h4);
    container.appendChild(content);
    return { container, content };
}

let keyCards = null;

window.addEventListener("keydown", (event) => {
    if (!keyCards) {
        insert.innerHTML = "";
        const keyInfo = createKeyCard("event.key", "key");
        const codeInfo = createKeyCard("event.code", "code");
        const keyCodeInfo = createKeyCard("event.keyCode", "keycode");

        keyCards = {
            key: keyInfo.content,
            code: codeInfo.content,
            keyCode: keyCodeInfo.content
        };

        insert.appendChild(keyInfo.container);
        insert.appendChild(codeInfo.container);
        insert.appendChild(keyCodeInfo.container);
    }

    keyCards.key.textContent = event.key === " " ? "Space" : event.key;
    keyCards.code.textContent = event.code;
    keyCards.keyCode.textContent = event.keyCode;
});
