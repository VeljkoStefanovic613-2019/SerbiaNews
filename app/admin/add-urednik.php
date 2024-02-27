<?php
require('../includes/database.inc.php');

session_start();

if(isset($_SESSION['ADMIN_LOGGED_IN']) && $_SESSION['ADMIN_LOGGED_IN'] == "YES") {
    if(isset($_GET['id'])) {
        $author_id = $_GET['id'];

        // Dodaj autora u admin tabelu
        $addToAdminQuery = "INSERT INTO admin (admin_id, admin_email, admin_password, category_id) 
                            SELECT author_id, author_email, author_password, category_id FROM author WHERE author_id = {$author_id}";
        
        $addToAdminResult = mysqli_query($con, $addToAdminQuery);

        if($addToAdminResult) {
            // Uspešno dodato u admin
            header("Location: ./authors.php");
            exit();
        } else {
            // Greška prilikom dodavanja u admin
            echo "Error: " . mysqli_error($con);
        }
    } else {
        // Nedostaje parametar za ID autora
        echo "Author ID is missing.";
    }
} else {
    // Nije autorizovan pristup
    echo "Unauthorized access.";
}
?>
