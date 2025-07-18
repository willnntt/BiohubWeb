window.currentPage = 1;
let totalPages = 1;
let sortFilter = document.querySelector(".filter-button.active");
window.sortBy = sortFilter.id;

function loadComments(page, sortby) {
    fetch(`load_comments.php?page=${page}&sort=${sortby}`)
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error("Invalid comments data received:", data);
            return;
        }

        let commentsContainer = document.getElementById("comments-section"); 
        commentsContainer.innerHTML = ""; // Clear previous chat containers

        if (!data.comments || data.comments.length === 0) {
            console.warn("No comments found.");
            let chatContainer = document.createElement("div");
            chatContainer.classList.add("chat-container");
            chatContainer.innerHTML = "<p>No comments yet.</p>";
            commentsContainer.appendChild(chatContainer);
            return;
        }

        let comments = data.comments.slice(0, 5); // Only take up to 5 comments

        comments.forEach(comment => {
            let chatContainer = document.createElement("div");
            chatContainer.classList.add("chat-container");
            chatContainer.setAttribute("commentid", comment.comment_id || "Unknown id");
            chatContainer.setAttribute("userid", comment.user_id || "Unknown userID");

            chatContainer.innerHTML = `
                <div class="message-container">
                    <div class="title-date-row">
                        <div class="title-container"><h2 class="title">${comment.comment_title || "Placeholder title"}</h2></div>
                        
                        <div class="username-date">
                            <p class="username">${comment.username || "Anonymous"}</p>
                            <div class="date-container"><p class="date">${comment.comment_date || "Unknown date"}</p></div>                        
                        </div>
                    </div>
                    <hr>
                    <div class="comment-container">
                        <p class="comment">${comment.comment_message || "No content available."}</p>
                    </div>
                </div>

                <div class="rating-container">
                    <button class="like-button material-icons ${comment.user_rating == 1 ? "active" : ""}" ${!window.isLoggedIn ? "disabled" : ""}>
                        thumb_up
                    </button>
                    <div class="rating-holder">${comment.comment_rating ?? 0}</div>
                    <button class="dislike-button material-icons ${comment.user_rating == -1 ? "active" : ""}" ${!window.isLoggedIn ? "disabled" : ""}>
                        thumb_down
                    </button>
                    <a href="forum_reply.php?commentid=${comment.comment_id}" class="reply-link">
                        <button class="chat-button material-icons">chat</button>
                    </a>
                    ${window.isLoggedIn ? `<button class="delete-button material-icons inactive">delete</button>` : ""}
                </div>
            `;

            commentsContainer.appendChild(chatContainer);
        });

        document.dispatchEvent(new Event("CommentContainerLoaded"));
        updatePagination(data.totalPages, page, sortby);
    })
    .catch(error => console.error("Error fetching messages:", error));
}

// Detect if user is logged in
document.addEventListener("DOMContentLoaded", function () {
    window.isLoggedIn = document.body.hasAttribute("data-userid");
    loadComments(window.currentPage, window.sortBy);
});

// Pagination
function updatePagination(totalPages, currentPage, sortby) {
    document.getElementById('page-info').textContent = `Page ${currentPage} of ${totalPages}`;

    let prevBtn = document.getElementById('prev-btn');
    let nextBtn = document.getElementById('next-btn');

    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;

    prevBtn.onclick = () => {
        if (currentPage > 1) {
            currentPage--;
            loadComments(currentPage - 1, sortby);
        } 
    };
    
    nextBtn.onclick = () => {
        if (currentPage < totalPages) {
            currentPage++;
            loadComments(currentPage + 1, sortby);
        }
    };
}

// Filter button function
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".filter-button");
    let original = document.getElementById("newest-first");

    buttons.forEach(button => {
        button.addEventListener("click", function () {
            // Remove active class from all buttons
            buttons.forEach(btn => btn.classList.remove("active"));

            if (this === original) {
                this.classList.add("active");
            } else {
                this.classList.add("active");
            }

            let sortBy = document.querySelector(".filter-button.active").id;

            loadComments(1, sortBy); //Reset page to 1 when changing filter
        });
    });
});

loadComments(window.currentPage, window.sortBy);

// Reload comments when comment is deleted
document.addEventListener("DeleteCommentEvent", function() {
    // console.log("DeleteCommentEvent received! Reloading comments...");
    
    let page = window.currentPage;
    let sort = window.sortBy;
    
    loadComments(page, sort);
})