let scrollPosition = 0;

function openPopup(popupId) {
    let popup = document.getElementById(popupId);

    scrollPosition = window.scrollY;

    document.body.style.position = "fixed";
    document.body.style.top = `-${scrollPosition}px`;
    document.body.style.width = "100%";

    popup.classList.add("active");
    document.body.classList.add("popup-open");
}

// Function to close popup and restore scroll position
function closePopup(popupId) {
    let popup = document.getElementById(popupId);
    
    document.body.style.position = "";
    document.body.style.top = "";
    document.body.style.width = "";
    
    window.scrollTo(0, scrollPosition);

    popup.classList.remove("active");
    document.body.classList.remove("popup-open");
}

document.addEventListener("EventContainerLoaded", function() {
    // Newsletter Popup Functions
    document.getElementById("newsletter-openpopup").addEventListener("click", () => openPopup("newsletter-popup"));
    document.getElementById("newsletter-closepopup").addEventListener("click", () => closePopup("newsletter-popup"));

    // Event Popup Functions
    document.querySelectorAll(".event-openpopup").forEach(button => {
        button.addEventListener("click", () => openPopup("register-event-popup"));
    });
    document.getElementById("event-closepopup").addEventListener("click", () => closePopup("register-event-popup"));

    document.getElementById("create-event-openpopup").addEventListener("click", () => openPopup("create-event-popup"));
    document.getElementById("create-event-closepopup").addEventListener("click", () => closePopup("create-event-popup"));

    // Clicking outside popup to close
    document.querySelectorAll(".event-popup, .news-popup, .create-event-popup").forEach(popup => {
        popup.addEventListener("click", (e) => {
            if (e.target === popup) {
                closePopup(popup.id);
            }
        });
    });
})

