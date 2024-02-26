<?php
require('./includes/nav.inc.php');

if (isset($_POST['submit'])) {
    if(isset($_SESSION['AUTHOR_ID'])){ 
        $author_id = $_SESSION['AUTHOR_ID'];
        
        $author_category_query = "SELECT category_id FROM author WHERE author_id = $author_id";
        $author_category_result = mysqli_query($con, $author_category_query);

        if ($author_category_result && mysqli_num_rows($author_category_result) > 0) {
            $author_category_row = mysqli_fetch_assoc($author_category_result);
            $article_cat_id = $author_category_row['category_id'];
        } else {
            $article_cat_id = 0;
        }
    } else {
        alert("Please Login to Enter Author Portal");
        redirect('../author-login.php');
    }

    $article_title = mysqli_real_escape_string($con, $_POST['article_title']);
    $article_desc = mysqli_real_escape_string($con, $_POST['article_desc']);
    $hashtags = explode(',', $_POST['hashtags']);  // Split hashtags into an array

    $name   = 'article-'.$article_cat_id.'-'.time(); 
    $extension  = pathinfo( $_FILES["article_img"]["name"], PATHINFO_EXTENSION ); 
    $basename   = $name . "." . $extension; 

    $tempname = $_FILES["article_img"]["tmp_name"];     
    $folder = "../assets/images/articles/{$basename}"; 
    
    $article_date = date("Y-m-d");

    $sql = "INSERT INTO article 
            (category_id, author_id, article_title, article_image, article_description, article_date, article_trend, article_active) 
            VALUES 
            ('$article_cat_id', '$author_id', '$article_title', '$basename', '$article_desc', '$article_date', 0, 0)";

    $result = mysqli_query($con, $sql);

    if ($result)  { 
        $lastInsertId = mysqli_insert_id($con);  // Get the last inserted article_id

        move_uploaded_file($tempname, $folder);

        // Insert hashtags into the database
        foreach ($hashtags as $tag) {
            $tag = trim(mysqli_real_escape_string($con, $tag));  // Trim to remove any whitespace
            if (!empty($tag)) {
                $tagInsertQuery = "INSERT INTO article_hashtag (article_id, hashtag_name) VALUES ('$lastInsertId', '$tag')";
                mysqli_query($con, $tagInsertQuery);
            }
        }

        alert("Article posted. Please wait for Admin to activate it.");
        redirect('./articles.php');
    } else { 
        echo "Failed to upload Data: " . mysqli_error($con); 
    } 
}
?>


<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Početni Panel</a></li>
      <li><a href="./articles.php">Vesti</a></li>
      <li class="active">Dodavanje Vesti</li>
    </ol>
  </div>
</section>

<section id="main">
  <div class="container">
    <div class="row">
      <?php
        require('./includes/quick-links.inc.php');
      ?>
      <div class="col-md-9">
        <!-- Website Overview -->
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Nova Vest</h3>
          </div>
          <div class="panel-body">
            <form method="post" id="add_form" enctype="multipart/form-data">
              <div class="form-group">
                <label>Naslov Vesti</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Naslov..."
                  name="article_title" id="article_title" required />
                <p id="error-title" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
    <label>Kategorija</label>
    <?php
    $cat_name = ""; // Dodajte ovu liniju kako biste definisali $cat_name unapred
    if (isset($_SESSION['AUTHOR_ID'])){ 
        $author_id = $_SESSION['AUTHOR_ID'];
        
        // Pretpostavljamo da postoji tabela 'author' sa poljem 'category_id'
        $author_category_query = "SELECT category_id FROM author WHERE author_id = $author_id";
        $author_category_result = mysqli_query($con, $author_category_query);

        if ($author_category_result && mysqli_num_rows($author_category_result) > 0) {
            $author_category_row = mysqli_fetch_assoc($author_category_result);
            $article_cat_id = $author_category_row['category_id'];
            
            // Dohvatite naziv kategorije iz tabele 'category'
            $category_query = "SELECT category_name FROM category WHERE category_id = $article_cat_id";
            $category_result = mysqli_query($con, $category_query);
            
            if ($category_result && mysqli_num_rows($category_result) > 0) {
                $category_row = mysqli_fetch_assoc($category_result);
                $cat_name = $category_row['category_name'];
            }
        } else {
            // Postavljamo podrazumevanu vrednost za kategoriju ako ne možemo dohvatiti iz baze
            $article_cat_id = 0;
        }
    } else {
        alert("Prijavite se da bi ste pristupili portalu");
        redirect('../author-login.php');
    }
    ?>
    <input type="text" class="form-control" value="<?php echo $cat_name; ?>" readonly />
</div>
              <div class="form-group">
                <label>Tekst Vesti</label>
                <textarea name="article_desc" autocomplete="off" id="article_desc" class="form-control"
                  placeholder="Unesi Tekst..." rows="20" min="150" required></textarea>
                <p id="error-desc" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                  <label>Hashtags (odvojeni zapetama)</label>
                  <input type="text" class="form-control" placeholder="Unesi hashtag-ove" name="hashtags" id="hashtags" />
                  <p id="error-hashtags" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Slika Vesti</label>
                <input type="file" class="form-control" placeholder="Slika Vesti" name="article_img" id="article_img"
                  accept="image/*" required />
                <p id="error-img" class="error-msg text-danger"></p>
              </div>
              <div class="form-group text-center">
                <img src="../assets/images/articles/choose.png" class="image_preview" id="image_preview" />
              </div>
              <br>
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-success">Objavi Vest</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/js/admin/add-form-validate.js"></script>
</section>

<?php
  require('./includes/footer.inc.php')
?>