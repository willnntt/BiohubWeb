document.addEventListener("DOMContentLoaded", function () {
    const joinButton = document.querySelector(".join-news");

    function updateButtonStatus() {
        fetch("join_newsletter.php?check_status=1")
            .then(response => response.json())
            .then(data => {
                // console.log("Received data:", data);

                if (data.success) {
                    if (data.joinnewsletter === 1) {
                        joinButton.textContent = "Joined";
                        joinButton.style.backgroundColor = "#934d4d";
                    } else {
                        joinButton.textContent = "Sign Up";
                        joinButton.style.backgroundColor = "#78976e";
                    }
                } else {
                    console.warn("Issue checking status:", data.message);
                }
            })
            .catch(error => console.error("Error:", error));
    }

    updateButtonStatus();

    joinButton.addEventListener("click", function () {
        // console.log("Button clicked! Sending request...");

        fetch("join_newsletter.php", { method: "POST" })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert(data.message); // Show error message if not logged in
                    return;
                }

                // console.log("Server response:", data);

                if (data.success) {
                    updateButtonStatus();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error:", error));
    });
});
