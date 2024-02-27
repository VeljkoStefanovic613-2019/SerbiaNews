<?php
require('./includes/nav.inc.php');


// Provera da li je prosleđen article_id u URL parametru
if(isset($_GET['id'])) {
  $article_id = $_GET['id'];
  // Upit za dohvatanje svih podataka o članku
  $sql = "SELECT article.*, author.author_name, category.category_name
          FROM article
          INNER JOIN author ON article.author_id = author.author_id
          INNER JOIN category ON article.category_id = category.category_id
          WHERE article_id = $article_id";
  $result = mysqli_query($con, $sql);
  if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $article_title = $row['article_title'];
    $article_desc = $row['article_description'];
    $article_image = $row['article_image'];
    $article_author = $row['author_name'];
    $article_date = date("d M y", strtotime($row['article_date']));
    $article_category = $row['category_name'];

    // Dohvatanje hashtagova
    $hashtags_sql = "SELECT hashtag_name FROM article_hashtag WHERE article_id = $article_id";
    $hashtags_result = mysqli_query($con, $hashtags_sql);
    $hashtags = [];
    while ($tag_row = mysqli_fetch_assoc($hashtags_result)) {
      $hashtags[] = $tag_row['hashtag_name'];
    }

    

    echo '
    <section id="main">
  <div class="container">
  <div class="col-md-1">
  </div>
    <div  style="background-color:white;padding:40px;" class="col-md-10">
      <h2 style="display: flex;justify-content:center;"margin:30px 0 !important;>'.$article_title.'</h2>
      <p><strong>Datum Objave: </strong>'.$article_date.'</p>
      <p><strong>Autor: </strong>'.$article_author.'</p>
      <p><strong>Kategorija: </strong>'.$article_category.'</p>
      <img style="max-width:100%;max-height:1200px;margin:20px 0;" src="../assets/images/articles/'.$article_image.'" />
      <p style="margin:20px 0;">'.$article_desc.'</p>
      <p style="margin:20px 0;color:blue;"><strong>#: </strong>'.implode(', ', $hashtags).'</p>
      </div>
      </div>

      </section>
    ';
   
  } else {
    echo '<p>Članak nije pronađen.</p>';
  }
} else {
  echo '<p>Članak nije odabran.</p>';
}
?>

<?php
require('./includes/footer.inc.php');
?>
