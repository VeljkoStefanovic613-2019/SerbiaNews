<?php
require('./includes/nav.inc.php');

if(isset($_GET['id'])) {
    $article_id = $_GET['id'];
} else {
    redirect('./articles.php');
}

if(empty($article_id)) {
    redirect('./articles.php');
} 

if (isset($_POST['submit'])) { 
    if(isset($_SESSION['AUTHOR_ID'])){ 
        $author_id = $_SESSION['AUTHOR_ID'];
    } else {
        alert("Please Login to Enter Author Portal");
        redirect('../author-login.php');
    }

    $article_title = $_POST['article_title'];
    $article_desc = $_POST['article_desc'];
    $article_old_img = $_POST['article_old_img'];

    $article_title = str_replace('"','\"',$article_title);
    $article_desc = str_replace('"','\"',$article_desc);

    // Retrieve hashtags from the form
    $hashtags = explode(',', $_POST['hashtags']);

    // Prepare SQL statement to update article
    $sql = "UPDATE article
            SET article_title = '$article_title',
                article_description = '$article_desc'";

    // Check if a new image is uploaded
    if(!empty($_FILES['article_img']['name'])) {
        $basename = 'article-'.$article_cat_id.'-'.time();
        $extension = pathinfo($_FILES["article_img"]["name"], PATHINFO_EXTENSION);
        $basename = $basename . "." . $extension;
        $tempname = $_FILES["article_img"]["tmp_name"];
        $folder = "../assets/images/articles/{$basename}";

        $sql .= ", article_image = '$basename'";
    } else {
        $basename = $article_old_img;
    }

    $sql .= " WHERE article_id = $article_id";

    $result = mysqli_query($con, $sql); 

    if($result) {
        // Delete existing hashtags associated with the article
        $deleteHashtagsQuery = "DELETE FROM article_hashtag WHERE article_id = $article_id";
        mysqli_query($con, $deleteHashtagsQuery);

        // Insert new hashtags into the database
        foreach ($hashtags as $tag) {
            $tag = trim(mysqli_real_escape_string($con, $tag));  // Trim to remove any whitespace
            if (!empty($tag)) {
                $tagInsertQuery = "INSERT INTO article_hashtag (article_id, hashtag_name) VALUES ($article_id, '$tag')";
                mysqli_query($con, $tagInsertQuery);
            }
        }

        // If a new image is uploaded, move it to the destination folder
        if(!empty($_FILES['article_img']['name'])) {
            move_uploaded_file($tempname, $folder);
            unlink("../assets/images/articles/{$article_old_img}");
        }

        alert("Article updated ".$author_name." !");
        redirect('./articles.php');
    } else {
        echo "Failed to update Article"; 
    }
}
?>


<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Početni Panel</a></li>
      <li><a href="./articles.php">Vesti</a></li>
      <li class="active">Uredjivanje</li>
    </ol>
  </div>
</section>

<section id="main">
  <div class="container">
    <div class="row">
      <?php
        $sql = "SELECT article.article_title, 
                article.article_date, 
                article.article_image, 
                article.article_active, 
                article.article_description, 
                category.category_name,
                article.category_id 
                FROM article, category 
                WHERE article.author_id = {$author_id} 
                AND article.article_id = {$article_id}
                AND article.category_id = category.category_id";
        
        $result = mysqli_query($con,$sql);
        $row = mysqli_num_rows($result);
        
        if($row == 0) {
          redirect('./articles.php');
        }
        
        $data = mysqli_fetch_assoc($result);
        $article_title = $data['article_title'];
        $article_desc = $data['article_description'];
        $article_cat_id = $data['category_id'];
        $article_image = $data['article_image'];

        require('./includes/quick-links.inc.php');
      
      ?>
      <div class="col-md-9">
        <!-- Website Overview -->
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Uredjivanje Vesti</h3>
          </div>
          <div class="panel-body">
            <form method="post" id="edit_form" enctype="multipart/form-data">
              <div class="form-group">
                <label>Naslov Vesti</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Naslov Vesti"
                  value="<?php echo $article_title; ?>" name="article_title" id="article_title" required />
                <p id="error-title" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Kategorija</label>
                <?php
                if (isset($_SESSION['AUTHOR_ID'])) { 
                    $author_id = $_SESSION['AUTHOR_ID'];
                    // Dohvatite naziv kategorije iz tabele 'category'
                    $category_query = "SELECT category_name FROM category WHERE category_id = (SELECT category_id FROM author WHERE author_id = $author_id)";
                    $category_result = mysqli_query($con, $category_query);
                    
                    if ($category_result && mysqli_num_rows($category_result) > 0) {
                        $category_row = mysqli_fetch_assoc($category_result);
                        $cat_name = $category_row['category_name'];
                    } else {
                        $cat_name = "Default Category"; // Postavite podrazumevanu vrednost
                    }
                } else {
                    alert("Please Login to Enter Author Portal");
                    redirect('../author-login.php');
                }
                ?>
                <input type="text" class="form-control" value="<?php echo $cat_name; ?>" readonly />
              </div>
              <div class="form-group">
                <label>Tekst Vesti</label>
                <textarea name="article_desc" autocomplete="off" id="article_desc" class="form-control"
                  placeholder="Unesi tekst..." rows="20" min="150" required><?php echo $article_desc; ?></textarea>
                <p id="error-desc" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Hashtags (odvojeni zapetama)</label>
                <input type="text" class="form-control" placeholder="Enter hashtags" name="hashtags" id="hashtags" 
                    value="<?php
                        // Fetch and display existing hashtags for the article
                        $existingHashtagsQuery = "SELECT hashtag_name FROM article_hashtag WHERE article_id = $article_id";
                        $existingHashtagsResult = mysqli_query($con, $existingHashtagsQuery);
                        while ($row = mysqli_fetch_assoc($existingHashtagsResult)) {
                            echo $row['hashtag_name'] . ', ';
                        }
                    ?>" />
                <p id="error-hashtags" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Slika Vesti</label>
                <input type="file" class="form-control" placeholder="Slika Vesti" name="article_img" id="article_img"
                  accept="image/*" />
                <input type="hidden" class="form-control" name="article_old_img"
                  value="<?php echo $article_image; ?>" />
                <br>
              </div>
              <div class="form-group text-center">
                <img src="../assets/images/articles/<?php echo $article_image; ?>" class="image_preview"
                  id="image_preview" />
              </div>
              <br>
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-success">Azuriraj</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/js/admin/edit-form-validate.js"></script>
</section>

<?php
  require('./includes/footer.inc.php')
?>
