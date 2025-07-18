function showDeleteButtons() {
    let userId = Number(document.body.getAttribute("data-userid"));
    console.log("Session User ID:", userId);

    let events = document.querySelectorAll(".event-entry");

    events.forEach(event => {
        let eventUserId = Number(event.getAttribute("userid"));
        let deleteButton = event.querySelector(".delete-event");

        console.log(`Event Owner ID: ${eventUserId}, Current Session ID: ${userId}`);

        if (deleteButton) {
            if (userId === 1 || userId === eventUserId) {
                deleteButton.classList.add("active");
                deleteButton.classList.remove("inactive");
                // console.log("Showing delete button for event owner:", eventUserId);
            } else {
                deleteButton.classList.add("inactive");
                deleteButton.classList.remove("active");
                // console.log("Hiding delete button for:", eventUserId);
            }
        }
    });
}

document.addEventListener("EventContainerLoaded", function () {
    document.querySelectorAll(".delete-event").forEach(button => {
        button.addEventListener("click", function () {
            let eventId = this.getAttribute("eventid");

            if (confirm("Are you sure you want to delete this event?")) {
                fetch(`delete_event.php?eventid=${eventId}`, {
                    method: "GET"
                })
                .then(response => response.text())
                .then(() => {
                    // console.log("Event deleted. Dispatching DeleteEvent...");
                    document.dispatchEvent(new Event("DeleteEvent"));
                    window.location.reload();
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });
});

document.addEventListener("EventContainerLoaded", showDeleteButtons);