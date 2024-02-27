<?php
require('../includes/database.inc.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id']) && isset($_GET['category'])) {
        $author_id = $_GET['id'];
        $category_id = $_GET['category'];

        // Validacija da li su author_id i category_id brojevi
        if (!is_numeric($author_id) || !is_numeric($category_id)) {
            die("Invalid parameters.");
        }

        // Provera da li postoji autor sa datim id
        $checkAuthorQuery = "SELECT * FROM author WHERE author_id = $author_id";
        $checkAuthorResult = mysqli_query($con, $checkAuthorQuery);

        if (mysqli_num_rows($checkAuthorResult) > 0) {
            // Ako autor postoji, izvršavamo upit za ažuriranje kategorije
            $updateCategoryQuery = "UPDATE author SET category_id = $category_id WHERE author_id = $author_id";
            $updateCategoryResult = mysqli_query($con, $updateCategoryQuery);

            if ($updateCategoryResult) {
                // Ažuriranje uspešno, sada vršimo redirekciju
                echo '<script>window.location.href = "./authors.php";</script>';
            } else {
                echo "Error updating category: " . mysqli_error($con);
            }
        } else {
            echo "Nije pronadjen autor.";
        }
    } else {
        echo "Nedostaju parametri.";
    }
} else {
    echo "Invalid request method.";
}
?>
