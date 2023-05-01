function toggleCommentBox() {
    var commentBox = document.getElementById("comment-box");
    var commentButton = document.querySelector("button[onclick='toggleCommentBox()']");
    commentBox.style.display = "block";
    commentButton.style.display = "none";
}

function clearPost() {
    document.getElementById("comment").value = "";
    tinyMCE.activeEditor.setContent('');
}