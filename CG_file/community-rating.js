function updateRatingDisplay(newRating, status, prevRating, likeHolder, dislikeHolder) {
    let currentLikes = parseInt(likeHolder.textContent) || 0;
    let currentDislikes = parseInt(dislikeHolder.textContent) || 0;

    if (status === "removed") {
        if (prevRating === 1) currentLikes -= 1; // Removing a like
        else if (prevRating === -1) currentDislikes -= 1; // Removing a dislike
    } else if (status === "added") {
        if (newRating === 1) currentLikes += 1;
        else if (newRating === -1) currentDislikes += 1;
    } else if (status === "updated") {
        if (newRating === 1) {
            currentLikes += 1;
            currentDislikes -= 1;
        } else {
            currentLikes -= 1;
            currentDislikes += 1;
        }
    }

    likeHolder.textContent = currentLikes;
    dislikeHolder.textContent = currentDislikes;
}

function sendRating(userid, tipID, newRating, prevRating, likeCount, dislikeCount, likeButton, dislikeButton) {
    if (!tipID) {
        console.error(`Missing tipID!`);
        return;
    }

    fetch(`save_tip_rating.php?userid=${userid}&tipID=${tipID}&rating=${newRating}`)
    .then(response => response.json())
    .then(data => {
        if (data.status === "added") {
            if (newRating === 1) {
                likeCount.textContent = parseInt(likeCount.textContent) + 1;
            } else if (newRating === -1) {
                dislikeCount.textContent = parseInt(dislikeCount.textContent) + 1;
            }
            likeButton.classList.toggle("active", newRating === 1);
            dislikeButton.classList.toggle("active", newRating === -1);
        } else if (data.status === "updated") {
            if (newRating === 1) {
                likeCount.textContent = parseInt(likeCount.textContent) + 1;
                dislikeCount.textContent = parseInt(dislikeCount.textContent) - 1;
            } else if (newRating === -1) {
                dislikeCount.textContent = parseInt(dislikeCount.textContent) + 1;
                likeCount.textContent = parseInt(likeCount.textContent) - 1;
            }
            likeButton.classList.toggle("active", newRating === 1);
            dislikeButton.classList.toggle("active", newRating === -1);
        } else if (data.status === "removed") {
            if (prevRating === 1) {
                likeCount.textContent = parseInt(likeCount.textContent) - 1;
            } else if (prevRating === -1) {
                dislikeCount.textContent = parseInt(dislikeCount.textContent) - 1;
            }
            likeButton.classList.remove("active");
            dislikeButton.classList.remove("active");
        }
    })
    .catch(error => console.error(`Error updating tip rating:`, error));
}

function setupRatingHandlers(tipID, userid) {
    let ratingContainer = document.querySelector(".rating-container");
    if (!ratingContainer) {
        console.error("No .rating-container found!");
        return;
    }

    let likeButton = ratingContainer.querySelector(".like-button");
    let dislikeButton = ratingContainer.querySelector(".dislike-button");
    let likeCount = ratingContainer.querySelector("#like-count");
    let dislikeCount = ratingContainer.querySelector("#dislike-count");

    if (!likeButton || !dislikeButton || !likeCount || !dislikeCount) {
        console.error("Missing rating elements (like/dislike buttons or counters).");
        return;
    }

    // console.log(`Setting up event listeners for Tip ID: ${tipID}`);

    function showLoginMessage() {
        alert("You must be logged in to rate this tip!");
    }

    likeButton.addEventListener("click", function () {
        if (!userid) {
            showLoginMessage();
            return;
        }
        
        // console.log(`Like clicked for Tip ID: ${tipID}`);
        let prevRating = likeButton.classList.contains("active") ? 1 : (dislikeButton.classList.contains("active") ? -1 : 0);
        let newRating = likeButton.classList.contains("active") ? "remove" : 1;
        sendRating(userid, tipID, newRating, prevRating, likeCount, dislikeCount, likeButton, dislikeButton);
    });

    dislikeButton.addEventListener("click", function () {
        if (!userid) {
            showLoginMessage();
            return;
        }

        // console.log(`Dislike clicked for Tip ID: ${tipID}`);
        let prevRating = dislikeButton.classList.contains("active") ? -1 : (likeButton.classList.contains("active") ? 1 : 0);
        let newRating = dislikeButton.classList.contains("active") ? "remove" : -1;
        sendRating(userid, tipID, newRating, prevRating, likeCount, dislikeCount, likeButton, dislikeButton);
    });
}

document.addEventListener("TipContainerLoaded", function() {
    let container = document.getElementById("tips");
    let tipID = container.getAttribute("tip-id");

    const userid = document.body.getAttribute("data-userid");

    if (!userid) {
        console.warn("User is not logged in. Ratings will be displayed but cannot be submitted.");
    }

    setupRatingHandlers(tipID, userid);
});