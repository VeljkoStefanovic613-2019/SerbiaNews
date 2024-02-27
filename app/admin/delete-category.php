<?php
require('../includes/database.inc.php');
session_start();

if(!isset($_SESSION['ADMIN_LOGGED_IN'])) {
    // Redirect if not logged in
    header("Location: ./login.php");
    exit();
}

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $category_id = $_GET['id'];

    // Perform the deletion
    $delete_sql = "DELETE FROM category WHERE category_id = $category_id";
    $result = mysqli_query($con, $delete_sql);

    if($result) {
        // Deletion successful
        $_SESSION['SUCCESS_MESSAGE'] = "Kategorija je obrisana.";
    } else {
        // Deletion failed
        $_SESSION['ERROR_MESSAGE'] = "Pokusajte ponovo.";
    }

    // Redirect to the categories page
    header("Location: ./categories.php");
    exit();
} else {
    // Redirect if invalid category ID
    header("Location: ./categories.php");
    exit();
}
?>
