let currentPage = 1; // Keeps track of the current page number
let totalPages = 1;  // Stores the total number of pages

let replySortDropdown = document.getElementById("reply-sort");
let sortBy = replySortDropdown?.value || "top-rated";

let selectedQuestionId;

// Load question details
function loadQuestion(page, questionid, sortBy) {
    fetch(`load_reply.php?page=${page}&commentid=${questionid}&sort=${sortBy}`)
        .then(response => response.json())
        .then(data => {
            if (!data.question) {
                console.warn("No question received.");
                return;
            }

            let main_comment_container = document.getElementById('main-comment-container');
            let title_container = document.getElementById('title-container');
            let username_container = document.getElementById('username-container');
            let question_container = document.getElementById('question-container');
            let date_container = document.getElementById('date-container');
            let rating_container = document.getElementById('rating-holder');

            let likeButton = main_comment_container.querySelector('.like-button');
            let dislikeButton = main_comment_container.querySelector('.dislike-button');

            let userid = data.question.userid ?? "Unknown user id";
            let username = data.question.username || "Anonymous";
            let question_title = data.question.comment_title || "Unknown Title";
            let question_message = data.question.comment_message || "Unknown question message";
            let question_date = data.question.comment_date || "Unknown date";
            let question_rating = data.question.comment_rating ?? 0;
            let userRating = data.question.user_rating ?? 0;

            main_comment_container.setAttribute("userid", userid);

            title_container.innerHTML = `<h2>${question_title}</h2>`;
            username_container.innerHTML = `<p class="username">${username}</p>`;
            question_container.innerHTML = `<p class="comment">${question_message}</p>`;
            date_container.innerHTML = `<p class="date">${question_date}</p>`;
            rating_container.innerHTML = `<p>${question_rating}</p>`;

            if (likeButton && dislikeButton) {
                likeButton.classList.toggle("active", userRating == 1);
                dislikeButton.classList.toggle("active", userRating == -1);
            }

            document.dispatchEvent(new Event("QuestionContainerLoaded"));
            // console.log("Dispatched QuestionContainerLoaded event");
        })
        .catch(error => {
            console.error("Error fetching question:", error);
            alert("Failed to load question. Check console for details.");
        });
}

// Load replies
function loadReply(page, questionid, sort) {
    console.log(`Fetching replies for Page ${page}, Question ID: ${questionid}, Sort: ${sort}`);

    fetch(`load_reply.php?page=${page}&commentid=${questionid}&sort=${sort}`)
        .then(response => response.json())
        .then(data => {
            let replySection = document.getElementById('reply-section');
            let existingReplies = replySection.querySelectorAll('.reply-container');

            // Remove extra containers if there are fewer than 5 replies
            if (existingReplies.length > data.replies.length) {
                existingReplies.forEach((container, index) => {
                    if (index >= data.replies.length) container.remove();
                });
            }

            if (!data.replies || data.replies.length === 0) {
                console.warn("No replies found.");
                replyContainer = document.createElement("div");
                replyContainer.classList.add("reply-container");
                replyContainer.innerHTML = "<p>No replies yet.</p>";
                replySection.appendChild(replyContainer);
                return;
            }

            data.replies.forEach((reply, index) => {
                let replyContainer;

                // Reuse existing containers if available, otherwise create a new one
                if (existingReplies[index]) {
                    replyContainer = existingReplies[index];
                } else {
                    replyContainer = document.createElement("div");
                    replyContainer.classList.add("reply-container");
                    replySection.appendChild(replyContainer);
                }

                replyContainer.setAttribute("replyid", reply.replyid || "Unknown reply id");
                replyContainer.setAttribute("userid", reply.userid || "Unknown user id");

                replyContainer.innerHTML = `
                    <div class="message-container">
                        <div class="username-date">
                            <div class="username-container"><p class="username">${reply.username || "Anonymous"}</p></div>
                            <div class="date-container"><p class="date">${reply.reply_date || "Unknown date"}</p></div>
                        </div>
                        <hr>
                        <div class="comment-container"><p class="comment">${reply.reply_message || "No reply message"}</p></div>
                    </div>
                    <div class="rating-container">
                        <button class="like-button material-icons ${reply.user_rating == 1 ? "active" : ""}">thumb_up</button>
                        <div class="rating-holder">${reply.reply_rating ?? 0}</div>
                        <button class="dislike-button material-icons ${reply.user_rating == -1 ? "active" : ""}">thumb_down</button>
                        <button class="delete-button material-icons" type="submit" name="deleteReply">delete</button>
                    </div>
                `;
            });

            // Update Pagination UI
            document.dispatchEvent(new Event("ReplyContainerLoaded"));
            updatePagination(data.totalPages || 1, page, questionid, sort);
        })
        .catch(error => {
            console.error("Error fetching replies:", error);
            alert("Failed to load replies. Check console for details.");
        });
}

document.addEventListener("DOMContentLoaded", function () {
    let mainCommentContainer = document.getElementById("main-comment-container");
    let replySortDropdown = document.getElementById("reply-sort");

    selectedQuestionId = mainCommentContainer?.getAttribute("questionid");

    console.log("Selected Question ID (After DOM Loaded):", selectedQuestionId);

    if (!selectedQuestionId) {
        console.error("Question ID is missing. Replies cannot be loaded.");
        return;
    }

    // Load question and replies
    loadQuestion(currentPage, selectedQuestionId, sortBy);
    loadReply(currentPage, selectedQuestionId, sortBy);

    // Sort filter event listener
    if (replySortDropdown) {
        sortBy = replySortDropdown.value;
        replySortDropdown.addEventListener("change", function () {
            sortBy = this.value;
            currentPage = 1;
            // console.log("Sorting by:", sortBy);
            // console.log("Reloading replies for Question ID:", selectedQuestionId);
            loadReply(currentPage, selectedQuestionId, sortBy);
        });
    } else {
        console.error("replySortDropdown not found.");
    }
});

function updatePagination(totalPages, currentPage, questionid, sort) {
    document.getElementById('page-info').textContent = `Page ${currentPage} of ${totalPages}`;

    let prevBtn = document.getElementById('prev-btn');
    let nextBtn = document.getElementById('next-btn');

    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;

    prevBtn.onclick = () => {
        if (currentPage > 1) {
            currentPage--;
            loadReply(currentPage, questionid, sort);
            loadQuestion(currentPage, questionid, sort);
        }
    };

    nextBtn.onclick = () => {
        if (currentPage < totalPages) {
            currentPage++;
            loadReply(currentPage, questionid, sort);
            loadQuestion(currentPage, questionid, sort);
        }
    };
}

// Reload comments when a reply is deleted
document.addEventListener("DeleteReplyEvent", function () {
    // console.log("DeleteReplyEvent received! Reloading comments...");

    loadReply(currentPage, selectedQuestionId, sortBy);
});