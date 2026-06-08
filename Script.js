const onboarding = document.getElementById("onboarding");
const displayArea = document.getElementById("display-area");
const keyValue = document.getElementById("key-value");
const codeValue = document.getElementById("code-value");
const keycodeValue = document.getElementById("keycode-value");

window.addEventListener("keydown", (e) => {
    // If the user is typing in the body, update the display
    // But if they are focusing an interactive element and pressing Enter/Space, handle that separately
    if (document.activeElement.getAttribute("role") === "button" && (e.key === "Enter" || e.key === " ")) {
        return;
    }

    if (displayArea.style.display === "none") {
        onboarding.style.display = "none";
        displayArea.style.display = "block";
    }

    keyValue.textContent = e.key === " " ? "space" : e.key;
    codeValue.textContent = e.code;
    keycodeValue.textContent = e.keyCode;
});

function setupCopy(cardId, valueId) {
    const card = document.getElementById(cardId);
    const valueEl = document.getElementById(valueId);

    const copyToClipboard = () => {
        const text = valueEl.textContent;
        navigator.clipboard.writeText(text).then(() => {
            card.classList.add("copied");
            setTimeout(() => {
                card.classList.remove("copied");
            }, 500);
        });
    };

    card.addEventListener("click", copyToClipboard);
    card.addEventListener("keydown", (e) => {
        if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            e.stopPropagation();
            copyToClipboard();
        }
    });
}

setupCopy("card-key", "key-value");
setupCopy("card-code", "code-value");
setupCopy("card-keycode", "keycode-value");
