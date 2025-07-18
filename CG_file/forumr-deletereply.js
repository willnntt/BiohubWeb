function showDeleteButtons() {
    let userId = Number(document.body.getAttribute("data-userid"));
    console.log("Session User ID:", userId);

    let replies = document.querySelectorAll(".reply-container");

    replies.forEach(reply => {
        let replyUserId = Number(reply.getAttribute("userid"));
        let deleteButton = reply.querySelector(".delete-button");

        console.log(`Reply Owner ID: ${replyUserId}, Current Session ID: ${userId}`);

        if (deleteButton) {
            if (userId === 1 || userId === replyUserId) {
                deleteButton.classList.add("active");
                deleteButton.classList.remove("inactive");
                console.log("Showing delete button for:", replyUserId);
            } else {
                deleteButton.classList.add("inactive");
                deleteButton.classList.remove("active");
                console.log("Hiding delete button for:", replyUserId);
            }
        }
    });
}

document.addEventListener("ReplyContainerLoaded", function () {
    // console.log("ReplyContainerLoaded received! Setting up delete buttons...");

    let deleteButtons = document.querySelectorAll(".delete-button");
    // console.log(`Found ${deleteButtons.length} delete buttons.`);

    let mainCommentContainer = document.getElementById("main-comment-container");
    let commentID = mainCommentContainer ? mainCommentContainer.getAttribute("questionid") : null;

    deleteButtons.forEach(button => {
        // console.log("Adding event listener to:", button);
        button.addEventListener("click", function () {
            // console.log("Delete button clicked!");

            if (button.getAttribute("name") === "deleteComment") {
                if (confirm("Are you sure you want to delete this comment?")) {
                    fetch(`delete_comment.php?deleteComment=true&commentid=${commentID}`, {
                        method: "GET"
                    })
                    .then(response => response.text())
                    .then(() => {
                        // console.log("Comment deleted. Dispatching DeleteCommentEvent...");
                        document.dispatchEvent(new Event("DeleteCommentEvent"));
                        window.location.href(`forum.php`);
                    })
                    .catch(error => console.error("Error deleting comment:", error));
                }

            } else {
                let replyContainer = this.closest(".reply-container");
                let replyID = replyContainer ? replyContainer.getAttribute("replyid") : null;
    
                if (!replyID) {
                    console.error("replyID is missing!");
                    return;
                }
    
                if (!commentID) {
                    console.error("commentID is missing!");
                    return;
                }
    
                // console.log("Comment ID:", commentID);
                // console.log("Reply ID:", replyID);
    
                if (confirm("Are you sure you want to delete this reply?")) {
                    fetch(`delete_reply.php?deletereply=true&replyid=${replyID}&commentid=${commentID}`, {
                        method: "GET"
                    })
                    .then(response => response.text())
                    .then(() => {
                        // console.log("Reply deleted. Dispatching DeleteReplyEvent...");
                        document.dispatchEvent(new Event("DeleteReplyEvent"));
                    })
                    .catch(error => console.error("Error deleting reply:", error));
                }
            }
        });
    });
});


document.addEventListener("ReplyContainerLoaded", showDeleteButtons);