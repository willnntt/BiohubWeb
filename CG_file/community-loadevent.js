function loadEvent() {
    fetch(`load_event.php`)
        .then(response => response.json())
        .then(data => {
            console.log("Fetched Events:", data);

            if (!data.events || data.message) {
                console.warn("No event details received:", data.message || "Unknown reason");
                return;
            }

            let eventList = document.querySelector(".event-list");
            if (!eventList) {
                console.error("Event list container (.event-list) not found!");
                return;
            }

            eventList.innerHTML = "";
            data.events.forEach(event => {
            
                // console.log("Fixed Image Path:", imagePath);
            
                let eventHTML = `
                    <li class="event-entry swiper-slide" eventid=${event.eventid} userid=${event.userid} username=${event.username}>
                        <a href="#" class="event-link">
                            <img class="event-image" src="${event.eventimage}" alt="${event.eventname}" onerror="this.onerror=null; this.src='fallback.jpg';">
                            <p class="event-filter">${event.eventcategory}</p>
                            <h2 class="event-title">${event.eventname}</h2>
                            <div class="event-details">
                                <p class="date">${event.eventdate}</p>
                                <p class="time">${event.starttime} - ${event.endtime}</p>
                                <span class="event-desc" style="display: none;">${event.eventdesc}</span>
                            </div>
                            <p class="event-venue">${event.eventvenue}</p>
                            <button class="event-openpopup">REGISTER NOW</button>                            
                        </a>
                        <button class="delete-event" eventid="${event.eventid}">DELETE</button>
                    </li>
                `;
                eventList.innerHTML += eventHTML;
            });

            document.dispatchEvent(new Event("EventContainerLoaded"));
            // console.log("Events added to the DOM");
        })
        .catch(error => {
            console.error("Error fetching events:", error);
        });
}

document.addEventListener("EventContainerLoaded", function () {
    document.querySelectorAll(".event-link").forEach(card => {
        card.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default link behavior

            let eventPopup = document.getElementById("register-event-popup");

            let eventEntry = card.closest(".event-entry");

            if (!eventEntry) {
                console.error("Error: Event entry not found.");
                return;
            }

            const eventName = eventEntry.querySelector(".event-title").innerText;
            const eventHost = eventEntry.getAttribute("username") || "Unknown Host";
            const eventDesc = eventEntry.querySelector(".event-desc")?.innerText || "No description available.";
            const eventDate = eventEntry.querySelector(".date").innerText;
            const eventTime = eventEntry.querySelector(".time").innerText;
            const eventVenue = eventEntry.querySelector(".event-venue")?.innerText || "Venue not specified.";
            const eventImage = eventEntry.querySelector(".event-image")?.src || "";
            const eventCategory = eventEntry.querySelector(".event-filter").innerText;
            const eventID = eventEntry.getAttribute("eventid");

            eventPopup.querySelector(".event-name").innerText = eventName;
            eventPopup.querySelector(".event-desc").innerText = eventDesc;  
            eventPopup.querySelector(".event-date").innerText = "Date: " + eventDate;
            eventPopup.querySelector(".event-time").innerText = "Time: " + eventTime;
            eventPopup.querySelector(".event-venue").innerText = "Venue: " + eventVenue;
            eventPopup.querySelector(".event-host").innerText = eventHost;
            eventPopup.querySelector(".event-category").innerText = eventCategory;
            eventPopup.querySelector(".event-button").setAttribute("eventid", eventID);

            const imageContainer = eventPopup.querySelector(".image-container");
            imageContainer.innerHTML = "";
            if (eventImage) {
                const imgElement = document.createElement("img");
                imgElement.src = eventImage;
                imgElement.alt = eventName;
                imageContainer.appendChild(imgElement);
            }
        });
    });
});

document.addEventListener("EventContainerLoaded", function () {
    const registerButton = document.getElementById("event-confirm-register");

    // Function to update button status based on joinstatus
    function updateRegisterButtonStatus(eventID) {
        fetch(`register_event.php?eventid=${eventID}&check_status=1`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.joinstatus === 1) {
                        registerButton.textContent = "Registered";
                        registerButton.style.backgroundColor = "#934d4d";
                    } else {
                        registerButton.textContent = "Register";
                        registerButton.style.backgroundColor = "#78976e";
                    }
                    registerButton.setAttribute("eventid", eventID);
                } else {
                    console.warn("Unable to check registration status:", data.message);
                }
            })
            .catch(error => console.error("Error fetching registration status:", error));
    }

    // Ensure button updates when event popup opens
    document.querySelectorAll(".event-link").forEach(card => {
        card.addEventListener("click", function (event) {
            event.preventDefault();

            let eventEntry = card.closest(".event-entry");
            if (!eventEntry) {
                console.error("Error: Event entry not found.");
                return;
            }

            let eventID = eventEntry.getAttribute("eventid");
            if (eventID) {
                updateRegisterButtonStatus(eventID);
            }
        });
    });

    // Handle button click for registering/unregistering
    registerButton.addEventListener("click", function () {
        let eventID = registerButton.getAttribute("eventid");
        if (!eventID) {
            console.error("No event ID found!");
            return;
        }

        fetch("register_event.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `eventid=${eventID}`
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateRegisterButtonStatus(eventID);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error:", error));
    });
});


document.addEventListener("DOMContentLoaded", loadEvent);

document.addEventListener("DeleteEvent", loadEvent);
