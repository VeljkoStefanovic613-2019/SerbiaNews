<?php
require('../includes/database.inc.php');

if(isset($_GET['id'])) {
    $author_id = $_GET['id'];

    $check_author_query = "SELECT * FROM author WHERE author_id = $author_id";
    $check_author_result = mysqli_query($con, $check_author_query);

    if(mysqli_num_rows($check_author_result) > 0) {
        $delete_author_query = "DELETE FROM author WHERE author_id = $author_id";
        $delete_author_result = mysqli_query($con, $delete_author_query);

        if($delete_author_result) {
            // Autor uspešno obrisan, dodaj JavaScript redirekciju
            echo "Author successfully deleted. <script>window.history.go(-1);</script>";
            exit; // Dodajte exit kako biste prekinuli izvođenje skripte
        } else {
            echo "Error deleting author: " . mysqli_error($con);
        }
    } else {
        echo "Author with ID $author_id does not exist.";
    }
} else {
    echo "Author ID is missing.";
}
?>