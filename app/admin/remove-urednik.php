<?php
require('../includes/database.inc.php');
session_start();

if(isset($_SESSION['ADMIN_LOGGED_IN']) && $_SESSION['ADMIN_LOGGED_IN'] == "YES") {
    if(isset($_GET['id'])) {
        $author_id = $_GET['id'];

        // Izbriši autora iz admin tabele
        $removeFromAdminQuery = "DELETE FROM admin WHERE admin_id = {$author_id}";
        
        $removeFromAdminResult = mysqli_query($con, $removeFromAdminQuery);

        if($removeFromAdminResult) {
            // Uspešno izbrisano iz admin
            header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
        } else {
            // Greška prilikom brisanja iz admin
            echo "Error: " . mysqli_error($con);
        }
    } else {
        // Nedostaje parametar za ID autora
        echo "Nedostaje parametar za ID novinara.";
    }
} else {
    // Nije autorizovan pristup
    echo "Nije autorizovan pristup.";
}
?>