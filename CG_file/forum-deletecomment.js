function showDeleteButtons() {
    let userId = Number(document.body.getAttribute("data-userid"));
    // console.log("Session User ID:", userId);

    let comments = document.querySelectorAll(".chat-container");

    comments.forEach(comment => {
        let commentUserId = Number(comment.getAttribute("userid"));
        let deleteButton = comment.querySelector(".delete-button");

        // console.log(`Comment Owner ID: ${commentUserId}, Current Session ID: ${userId}`);

        if (deleteButton) {
            if (userId === 1 || userId === commentUserId) {
                deleteButton.classList.add("active");
                deleteButton.classList.remove("inactive");
                // console.log("Showing delete button for:", commentUserId);
            } else {
                deleteButton.classList.add("inactive");
                deleteButton.classList.remove("active");
                // console.log("Hiding delete button for:", commentUserId);
            }
        }
    });
}

document.addEventListener("CommentContainerLoaded", function () {
    document.querySelectorAll(".delete-button").forEach(button => {
        button.addEventListener("click", function () {
            let chatContainer = this.closest(".chat-container");
            let commentID = chatContainer.getAttribute("commentid");

            if (confirm("Are you sure you want to delete this comment?")) {
                fetch(`delete_comment.php?deleteComment=true&commentid=${commentID}`, {
                    method: "GET"
                })
                .then(response => response.text())
                .then(() => {
                    // console.log("Comment deleted. Dispatching DeleteCommentEvent...");
                    document.dispatchEvent(new Event("DeleteCommentEvent"));
                })
                .catch(error => console.error("Error deleting comment:", error));
            }
        });
    });
});

document.addEventListener("CommentContainerLoaded", showDeleteButtons);