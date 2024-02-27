<?php
  $art_sql = "SELECT COUNT(article_id) 
              AS no_of_articles 
              FROM article";
  $art_result = mysqli_query($con,$art_sql);
  $art_data = mysqli_fetch_assoc($art_result);
  $no_of_articles = $art_data['no_of_articles'];

  $authors_sql = "SELECT COUNT(DISTINCT author_id) AS no_of_authors FROM author";
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
    <a href="./index.php" class="list-group-item active main-color-bg">
      <span class="glyphicon glyphicon-link"></span>
      Prečice
    </a>
    <a href="./index.php" class="list-group-item"><span class="glyphicon glyphicon-home"></span> Početni Panel
    </a>
    <a href="./authors.php" class="list-group-item"><span class="glyphicon glyphicon-pencil"></span> Novinari
      <span class="badge"><?php echo $no_of_authors ?></span></a>
    <a href="./articles.php" class="list-group-item"><span class="glyphicon glyphicon-pencil"></span> Vesti
      <span class="badge"><?php echo $no_of_articles ?></span></a>
    <a href="./categories.php" class="list-group-item"><span class="glyphicon glyphicon-list"></span> Kategorije
      <span class="badge"><?php echo $no_of_categories ?></span>
    </a>
        <a href="./change-password.php" class="list-group-item"><span class="glyphicon glyphicon-cog"></span> Promeni Lozinku
      </a>
    <a href="./logout.php" class="list-group-item"><span class="glyphicon glyphicon-log-out"></span> Odjavi se
    </a>
  </div>
</div>