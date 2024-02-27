<?php

$admin_id = $_SESSION['ADMIN_ID'];
  

  // Pronađi kategoriju admina
  $admin_category_sql = "SELECT category_id FROM admin WHERE admin_id = $admin_id";
  $admin_category_result = mysqli_query($con, $admin_category_sql);
  $admin_category_data = mysqli_fetch_assoc($admin_category_result);
  $admin_category_id = $admin_category_data['category_id'];

  // Broj artikala sa istom kategorijom kao i admin
  $articles_sql = "SELECT COUNT(article_id) AS no_of_articles
  FROM article
  WHERE category_id = $admin_category_id";
$articles_result = mysqli_query($con, $articles_sql);
$articles_data = mysqli_fetch_assoc($articles_result);
$no_of_articles = $articles_data['no_of_articles'];

  // Broj autora sa istom kategorijom kao i admin
  $authors_sql = "SELECT COUNT(DISTINCT author_id) AS no_of_authors
                  FROM author
                  WHERE category_id = $admin_category_id";
  $authors_result = mysqli_query($con, $authors_sql);
  $authors_data = mysqli_fetch_assoc($authors_result);
  $no_of_authors = $authors_data['no_of_authors'];


     
  $cat_sql = "SELECT COUNT(category_id) 
              AS no_of_categories 
              FROM category";
  $cat_result = mysqli_query($con,$cat_sql);
  $cat_data = mysqli_fetch_assoc($cat_result);
  $no_of_categories = $cat_data['no_of_categories'];


?>
<div class="col-md-3">
  <div class="list-group">
    <a href="./urednik.php" class="list-group-item active main-color-bg">
      <span class="glyphicon glyphicon-link"></span>
      Prečice
    </a>
    <a href="./urednik.php" class="list-group-item"><span class="glyphicon glyphicon-home"></span> Početni Panel
    </a>
   <a href="./authors-urednik.php" class="list-group-item"><span class="glyphicon glyphicon-pencil"></span> Novinari
    <span class="badge"><?php echo $no_of_authors ?></span></a> 
    <a href="./articles-urednik.php" class="list-group-item"><span class="glyphicon glyphicon-pencil"></span> Vesti
      <span class="badge"><?php echo $no_of_articles ?></span></a>
      
        <a href="./change-password.php" class="list-group-item"><span class="glyphicon glyphicon-cog"></span> Promeni Lozinku
      </a>
    <a href="./logout.php" class="list-group-item"><span class="glyphicon glyphicon-log-out"></span> Odjavi se
    </a>
  </div>
</div>