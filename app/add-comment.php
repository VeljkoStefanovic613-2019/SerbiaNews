<?php
session_start();
require('./includes/database.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $article_id = $_POST['article_id'];
    $user_name = $_POST['user_name'];
    $comment_text = $_POST['comment_text'];

    $insertCommentQuery = "INSERT INTO comments (article_id, user_name, comment_text, likes, dislikes) VALUES ('$article_id', '$user_name', '$comment_text', 0, 0)";
    $insertCommentResult = mysqli_query($con, $insertCommentQuery);

    if ($insertCommentResult) {
        header("Location: news.php?id=$article_id#comments");
    } else {
        echo "Greška prilikom dodavanja komentara.";
    }

    // Handle likes and dislikes
    if (isset($_POST['like_comment'])) {
        $comment_id = $_POST['comment_id'];
        mysqli_query($con, "UPDATE comments SET likes = likes + 1 WHERE comment_id = $comment_id");
    }

    if (isset($_POST['dislike_comment'])) {
        $comment_id = $_POST['comment_id'];
        mysqli_query($con, "UPDATE comments SET dislikes = dislikes + 1 WHERE comment_id = $comment_id");
    }
} else {
    header("Location: index.php");
}
?>
