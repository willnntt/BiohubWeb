function loadTip() {
    fetch(`load_tip.php`)
        .then(response => response.json())
        .then(data => {
            if (!data.dailyTip || data.message) {
                console.warn("No tips received:", data.message || "Unknown reason");
                return;
            }

            let mainContainer = document.getElementById('tips');
            let contentContainer = mainContainer.querySelector("#tip-content");
            let likeButton = mainContainer.querySelector(".like-button");
            let dislikeButton = mainContainer.querySelector(".dislike-button");
            let likeCount = mainContainer.querySelector("#like-count");
            let dislikeCount = mainContainer.querySelector("#dislike-count");

            contentContainer.innerHTML = "";

            let tipID = data.dailyTip.tipID || "Invalid tip ID";
            let tipdesc = data.dailyTip.tipdesc || "Unknown description";
            let tiplikes = data.dailyTip.tiplikes ?? 0;
            let tipdislikes = data.dailyTip.tipdislikes ?? 0;
            let userRating = data.dailyTip.rating ?? 0;

            mainContainer.setAttribute("tip-id", tipID);

            contentContainer.innerHTML = `
                <h1>TIP OF THE DAY</h1> 
                <p>${tipdesc}</p>`;

            likeCount.innerHTML = `<p>${tiplikes}</p>`;
            dislikeCount.innerHTML = `<p>${tipdislikes}</p>`;

            if (likeButton && dislikeButton) {
                likeButton.classList.toggle("active", userRating == 1);
                dislikeButton.classList.toggle("active", userRating == -1);
            }

            document.dispatchEvent(new Event("TipContainerLoaded"));
            // console.log("Dispatched TipContainerLoaded event");
        })
        .catch(error => {
            console.error("Error fetching tips:", error);
            alert("Failed to load tips. Check console for details.");
        });
}

document.addEventListener("DOMContentLoaded", loadTip);
