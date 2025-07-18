let mainCommentRatingProcessed = false;

function updateRatingDisplay(newRating, status, prevRating, ratingHolder) {
    let currentRating = parseInt(ratingHolder.textContent) || 0;

    if (status === "removed") {
        if (prevRating === 1) currentRating -= 1; // Removing a like
        else if (prevRating === -1) currentRating += 1; // Removing a dislike
    } else if (status === "added") {
        currentRating += newRating;
    } else if (status === "updated") {
        currentRating += (newRating === 1 ? 2 : -2);
    }

    ratingHolder.textContent = currentRating;
}

function sendRating(itemId, newRating, prevRating, type, ratingHolder, likeButton, dislikeButton) {
    let newType;

    if (type === "comment" || type === "question") {
        newType = "comment";
    } else {
        newType = "reply";
    }
    
    if (!itemId) {
        console.error(`Missing ${type} ID!`);
        return;
    }

    // console.log(`Sending ${type} rating:`, { itemId, newRating, prevRating });

    let formData = new URLSearchParams();
    formData.append(newType + "id", itemId); // "commentid", "replyid", or "questionid"
    formData.append("rating", newRating === "remove" ? "remove" : newRating);
    formData.append("prevRating", prevRating);

    fetch(`save_${newType}_rating.php`, {
        method: "POST",
        credentials: "include",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: formData.toString()
    })
    .then(response => response.json())
    .then(data => {
        // console.log("Server Response:", data);
        if (data.status === "added") {
            updateRatingDisplay(newRating, "added", prevRating, ratingHolder);
            likeButton.classList.toggle("active", newRating === 1);
            dislikeButton.classList.toggle("active", newRating === -1);
        } else if (data.status === "updated") {
            updateRatingDisplay(newRating, "updated", prevRating, ratingHolder);
            likeButton.classList.toggle("active", newRating === 1);
            dislikeButton.classList.toggle("active", newRating === -1);
        } else if (data.status === "removed") {
            updateRatingDisplay(newRating, "removed", prevRating, ratingHolder);
            likeButton.classList.remove("active");
            dislikeButton.classList.remove("active");
        }
    })
    .catch(error => console.error(`Error updating ${type} rating:`, error));
}

function setupRatingHandlers(container, type, parentSelector, idAttr) {
    // console.log(`Setting up rating handlers for ${type}...`);

    if (type === "question") {
        let parentContainer = document.querySelector(parentSelector);
        let ratingContainer = parentContainer.querySelector("#question-rating-container");
        let likeButton = ratingContainer.querySelector(".like-button");
        let dislikeButton = ratingContainer.querySelector(".dislike-button");
        let ratingHolder = ratingContainer.querySelector("#rating-holder");
        let itemId = parentContainer ? parentContainer.getAttribute(idAttr) : null;
        let userId = document.body.getAttribute("data-userid");

        if (!likeButton || !dislikeButton || !ratingHolder || !itemId || !userId) {
            console.log(`Skipping rating setup - missing elements for ${type}`);
            return;
        }

        // console.log(`Attaching event listeners to ${type} rating buttons. ID: ${itemId}`);

        likeButton.addEventListener("click", function () {
            // console.log(`Like button clicked for ${type} ID: ${itemId}`);
            let prevRating = likeButton.classList.contains("active") ? 1 : (dislikeButton.classList.contains("active") ? -1 : 0);
            let newRating = likeButton.classList.contains("active") ? "remove" : 1;
            sendRating(itemId, newRating, prevRating, type, ratingHolder, likeButton, dislikeButton);
        });
        
        dislikeButton.addEventListener("click", function () {
            // console.log(`Dislike button clicked for ${type} ID: ${itemId}`);
            let prevRating = dislikeButton.classList.contains("active") ? -1 : (likeButton.classList.contains("active") ? 1 : 0);
            let newRating = dislikeButton.classList.contains("active") ? "remove" : -1;
            sendRating(itemId, newRating, prevRating, type, ratingHolder, likeButton, dislikeButton);
        });
    } else {
        container.querySelectorAll(".rating-container").forEach(ratingContainer => {
            if (ratingContainer.id === "question-rating-container") {
                console.log(`Skipping #question-rating-container for reply processing.`);
                return;
            }

            let likeButton = ratingContainer.querySelector(".like-button");
            let dislikeButton = ratingContainer.querySelector(".dislike-button");
            let ratingHolder = ratingContainer.querySelector(".rating-holder");
            
            let parentContainer = ratingContainer.closest(parentSelector);
            let itemId = parentContainer ? parentContainer.getAttribute(idAttr) : null;
            let userId = document.body.getAttribute("data-userid");
    
            if (!likeButton || !dislikeButton || !ratingHolder || !itemId || !userId) {
                console.log(`Skipping rating setup - missing elements for ${type}`);
                return;
            }
    
            // console.log(`Attaching event listeners to ${type} rating buttons. ID: ${itemId}`);
    


            likeButton.addEventListener("click", function () {
                // console.log(`Like button clicked for ${type} ID: ${itemId}`);
                let prevRating = likeButton.classList.contains("active") ? 1 : (dislikeButton.classList.contains("active") ? -1 : 0);
                let newRating = likeButton.classList.contains("active") ? "remove" : 1;
                sendRating(itemId, newRating, prevRating, type, ratingHolder, likeButton, dislikeButton);
            });
            
            dislikeButton.addEventListener("click", function () {
                // console.log(`Dislike button clicked for ${type} ID: ${itemId}`);
                let prevRating = dislikeButton.classList.contains("active") ? -1 : (likeButton.classList.contains("active") ? 1 : 0);
                let newRating = dislikeButton.classList.contains("active") ? "remove" : -1;
                sendRating(itemId, newRating, prevRating, type, ratingHolder, likeButton, dislikeButton);
            });
        });
    }

}

document.addEventListener("ReplyContainerLoaded", function () {
    setupRatingHandlers(document, "reply", ".reply-container", "replyid");
});

document.addEventListener("QuestionContainerLoaded", function() {
    setupRatingHandlers(document, "question", "#main-comment-container", "questionid");
});

document.addEventListener("CommentContainerLoaded", function () {
    setupRatingHandlers(document, "comment", ".chat-container", "commentid");
});

