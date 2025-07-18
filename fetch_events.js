document.addEventListener("DOMContentLoaded", function() {
    // Fetch data from fetch_events.php
    fetch("fetch_events.php")
      .then(response => response.json())
      .then(data => {
        const tbody = document.querySelector("#eventsTable tbody");
        tbody.innerHTML = ""; // Clear any existing content
        let rowNumber = 1;
        data.forEach(event => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${rowNumber}</td>
            <td>${event.event_id}</td>
            <td>${event.event_name}</td>
            <td>${event.location}</td>
            <td>${event.event_date}</td>
            <td>${event.event_start_time}</td>
            <td>${event.event_end_time}</td>
            <td>${event.event_detail}</td>
            <td>${event.image ? `<img src="uploads/${event.image}" alt="Event Image" style="max-width: 100px;">` : "No Image"}</td>
          `;
          tbody.appendChild(row);
          rowNumber++;
        });
      })
      .catch(error => console.error("Error fetching data:", error));
  });
  