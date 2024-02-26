<?php
  // Fetching all the Navbar Data
  require('./includes/nav.inc.php');
  
  $cat_id = "";
  
  // If we get article_id from URL
  if(isset($_GET['id'])) {

    // Store the article id in a variable
    $article_id =  $_GET['id'];
  }

  // If we get article_id from URL and it is null
  elseif ($_GET['id'] == '' && $_GET['id'] == null) {
    
    // Redirect to home page
    redirect('./index.php');
  }

  // If we dont get article_id from URL
  else {
    
    // Redirect to home page
    redirect('index.php');
  }

  // Article Query to fetch all data related to particular article
  $articleQuery = "SELECT category.category_name, category.category_id, category.category_color, article.*, author.*
                    FROM category, article, author
                    WHERE article.category_id = category.category_id
                    AND article.author_id = author.author_id
                    AND article.article_active = 1
                    AND article.article_id = {$article_id}";

  // Bookmarked variable to determine if the article is bookmarked by the user
  $bookmarked = false;

  if(isset($_POST['like'])) {
    // Increment the likes in the database
    mysqli_query($con, "UPDATE article SET likes = likes + 1 WHERE article_id = {$article_id}");
  }

  if(isset($_POST['dislike'])) {
    // Increment the dislikes in the database
    mysqli_query($con, "UPDATE article SET dislikes = dislikes + 1 WHERE article_id = {$article_id}");
  }
  

  if(isset($_POST['like_comment'])) {
    $comment_id = $_POST['comment_id'];
    mysqli_query($con, "UPDATE comments SET likes = likes + 1 WHERE comment_id = {$comment_id}");
}

if(isset($_POST['dislike_comment'])) {
    $comment_id = $_POST['comment_id'];
    mysqli_query($con, "UPDATE comments SET dislikes = dislikes + 1 WHERE comment_id = {$comment_id}");
}

  // Checking if the user is logged in
  if(isset($_SESSION['USER_ID'])) {
    
    // Bookmark Query to check if the particular article is bookmarked by user
    $bookmarkQuery = "SELECT * FROM bookmark 
                      WHERE user_id = {$_SESSION['USER_ID']}
                      AND article_id = {$article_id}";       
    
    // Running the Bookmark Query
    $bookmarkResult = mysqli_query($con, $bookmarkQuery);
    
    // If query has any result (records) => User has the article bookmarked
    if(mysqli_num_rows($bookmarkResult) > 0) {
      
      // Updating the variable to true to have bookmarked icon on article card
      $bookmarked = true;
    }
  }
  
  // Running Article Query
  $result = mysqli_query($con,$articleQuery);

  // If the Query failed
  if(!$result) {
    
    // Redirected to home page
    redirect('./index.php');
  }

  // Returns the number of rows from the result retrieved.
  $row = mysqli_num_rows($result);
  
  // If query has any result (records) => If article is present
  if($row > 0) {
    
    // Fetching the data of particular record as an Associative Arrayvariables
    while($data = mysqli_fetch_assoc($result)) {
      
      // Storing the article data in variables
      $cat_id = $data['category_id'];
      $category_name = $data['category_name'];
      $category_color = $data['category_color'];
      $article_title = $data['article_title'];
      $article_image = $data['article_image'];
      $article_desc = $data['article_description'];
      $article_date = $data['article_date'];
      $author_name = $data['author_name'];
      
      // Article date is updated to a timestamp 
      $article_date = strtotime($article_date);

?>
<!--  Article Page Container  -->
<section class="article">
  <div class="container">
    <div class="page-container">
      <!-- Container that stores the article -->
      <article class="card1">

        <!-- Article Title -->
        <h1 class="article-heading">
          <?php
          echo $article_title;
          ?>
        </h1>

        <!-- Article Image -->
        <img src="./assets/images/articles/<?php echo $article_image; ?>" class="article-image" />

        <!-- Container that stores author name, date and category name -->
        <div class="meta">

          <!-- Author Name -->
          <div class="author">
            <i class="fas fa-user-alt"></i><?php echo $author_name; ?>
          </div>

          <!-- Article Publish Date -->
          <div class="date">
            <i class="fas fa-calendar-alt"></i>
            <?php
              echo date("d m Y",$article_date);
            ?>
          </div>

          <!-- Category Name -->
          <div class="tag <?php echo $category_color;?>">
            <?php
              echo $category_name;
            ?>
          </div>
        </div>

        <!-- Article Description -->
        <div class="article-content">
          <p>
            <?php
              echo nl2br($article_desc);
            ?>
          </p>
          <div class="hashtags" style="margin-top:20px;margin-bottom:20px;">#:  
            <?php
            $hashtagsQuery = "SELECT hashtag_name FROM article_hashtag WHERE article_id = $article_id";
            $hashtagsResult = mysqli_query($con, $hashtagsQuery);

            while ($row = mysqli_fetch_assoc($hashtagsResult)) {
                echo '<span class="hashtag" style="color:blue;margin-right:10px;font-style: italic;"> ' . $row['hashtag_name'] . '</span>';
            }
            ?>
          </div>
        </div>

        <!-- Container that stores the buttons -->
        <div class="d-flex text-center">
          <?php
             // Like button form
    echo '<form method="post">';
    echo '<button type="submit" name="like" class="btn btn-like">';
    echo '<img src="assets\images\icons\like.png" alt="Like" style="width: 32px; height: 32px;">';
    echo '</button>';
    echo '</form>';
    echo '<div class="likes">' . $data['likes'] . '</div>';

    // Dislike button form
    echo '<form method="post">';
    echo '<button type="submit" name="dislike" class="btn btn-dislike">';
    echo '<img src="assets\images\icons\dislike.png" alt="Dislike" style="width: 32px; height: 32px;">';
    echo '</button>';
    echo '</form>';
    echo '<div class="dislikes">' . $data['dislikes'] . '</div>';

            // If the article is bookmarked
            if ($bookmarked) {
              echo '<a class="btn btn-bookmark" href="remove-bookmark.php?id='.$article_id.'">Ukloni iz Oznacenih &nbsp<i class="fas fa-bookmark"></i></a>';   
            }

            // If the article is not bookmarked
            else {
              echo '<a class="btn btn-bookmark" href="add-bookmark.php?id='.$article_id.'">Oznaci Vest &nbsp<i class="far fa-bookmark"></i></a>';   
            }
            echo'&nbsp';

            // Download button
            echo '<a class="btn btn-download" target="_blank" href="download-article.php?id='.$article_id.'">Preuzmi Vest &nbsp<i class="fas fa-download"></i></a>';   
          ?>
        </div>
        <!-- Ostatak vašeg koda ostaje nepromenjen -->

<!-- Container za prikaz i unos komentara -->
<div class="comments-container">
  <h2>Komentari:</h2>


  <!-- Forma za unos novog komentara -->
<form class="add-comm" method="post" action="add-comment.php">
  <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
  <input type="text" name="user_name" placeholder="Vaše ime" required>
  <textarea name="comment_text" placeholder="Unesite vaš komentar" required></textarea>
  <button type="submit" class="btn btn-comment">Dodaj komentar</button>
</form>

<!-- Prikaz postojećih komentara -->
<?php
$commentQuery = "SELECT * FROM comments WHERE article_id = {$article_id} ORDER BY comment_date DESC";
$commentResult = mysqli_query($con, $commentQuery);

if(mysqli_num_rows($commentResult) > 0) {
  while($commentData = mysqli_fetch_assoc($commentResult)) {
    echo '<div class="comment">';
    echo '<strong>' . $commentData['user_name'] . ':</strong>';
    echo '<p>' . nl2br($commentData['comment_text']) . '</p>';
    
    
    // Like and Dislike buttons for each comment
    echo '<form method="post">';
    echo '<input type="hidden" name="comment_id" value="' . $commentData['comment_id'] . '">';
    
    // Like button
    echo '<button type="submit" name="like_comment" class="btn btn-like">';
    echo '<img src="assets\images\icons\like-comm.png" alt="Like" style="width: 16px; height: 16px;">'; // Postavi veličinu i putanju do ikonice ovde
    echo '</button>';
    echo '<div class="likes">' . $commentData['likes'] . '</div>';
    
    // Dislike button
    echo '<button type="submit" name="dislike_comment" class="btn btn-dislike">';
    echo '<img src="assets\images\icons\dislike-comm.png" alt="Dislike" style="width: 16px; height: 16px;">'; // Postavi veličinu i putanju do ikonice ovde
    echo '</button>';
    echo '<div class="dislikes">' . $commentData['dislikes'] . '</div>';
    
    echo '<small>' . date("d m Y", strtotime($commentData['comment_date'])) . '</small>';
    echo '</form>';
    



    echo '</div>';
  }
} else {
  echo '<p style="color:RGB(6, 12, 234);font-style:italic;">Nema komentara.</p>';
}
?>



</div>

        <?php
            }
          }

          // If article is not present
          else {
            redirect('index.php');
          }
        ?>
      </article>

      <!-- Aside column for other quick links -->
      <aside>

        <!-- Trending Articles Card -->
        <div class="card2">
          <h2 style="color:var(--primary-color);" class="aside-title">U TRENDINGU</h2>
          <?php

            // Trending Article Query to fetch maximum 5 random trending articles
            $trendingArticleQuery = " SELECT *
                                      FROM article, author
                                      WHERE article.article_trend = 1
                                      AND article.author_id = author.author_id
                                      AND article.article_active = 1
                                      AND NOT article.article_id = {$article_id}
                                      ORDER BY RAND() LIMIT 5";
            
            // Running Trending Article Query
            $trendingResult = mysqli_query($con,$trendingArticleQuery);
            
            // Returns the number of rows from the result retrieved.
            $row = mysqli_num_rows($trendingResult);

            // If query has any result (records) => If any trending articles are present
            if($row > 0) {
              
              // Fetching the data of particular record as an Associative Array
              while($data = mysqli_fetch_assoc($trendingResult)) {
                
                // Storing the article data in variables
                $article_id = $data['article_id'];
                $article_title = $data['article_title'];
                $article_image = $data['article_image'];
                $article_date = $data['article_date'];
                $author_name = $data['author_name'];
                
                // Article date is updated to a timestamp 
                $article_date = strtotime($article_date);
            
                // Article date is updated to paticular datetime format 
                $article_date = date("d M Y", $article_date);
                
                // Updating the title with a substring containing at most length of 75 characters
                $article_title = substr($article_title,0,75).' . . . ';
                
                // Calling user defined function to create an aside article card with respective article details
                createAsideCard($article_image, $article_id, $article_title, $author_name,$article_date);
              }
            }
          ?>

          <!-- View all button -->
          <div class="text-center py-1">
            <a href="search.php?trending=1" class="btn btn-card"> Vidi Sve <span>&twoheadrightarrow; </span>
            </a>
          </div>
        </div>

        <!-- Related Articles Card -->
        <div class="card2">
          <h2 style="color:var(--primary-color);" class="aside-title">VESTI IZ OVE KATEGORIJE</h2>
          <?php

            // Related Article Query to fetch maximum of 5 random articles of same article other than the present one
            $relatedArticleQuery = " SELECT *
                                      FROM article, author
                                      WHERE article.category_id = {$cat_id}
                                      AND article.author_id = author.author_id
                                      AND article.article_active = 1
                                      AND NOT article.article_id = {$_GET['id']}
                                      ORDER BY RAND() LIMIT 4";
            
            // Running the Related Article Query
            $relatedResult = mysqli_query($con,$relatedArticleQuery);

            // Returns the number of rows from the result retrieved.
            $row = mysqli_num_rows($relatedResult);
            
            // If query has any result (records) => If any related articles are present
            if($row > 0) {

              // Fetching the data of particular record as an Associative Array
              while($data = mysqli_fetch_assoc($relatedResult)) {
              
                // Storing the article data in variables
                $article_id = $data['article_id'];
                $article_title = $data['article_title'];
                $article_image = $data['article_image'];
                $article_date = $data['article_date'];
                $author_name = $data['author_name'];

                // Article date is updated to a timestamp 
                $article_date = strtotime($article_date);
            
                // Article date is updated to paticular datetime format 
                $article_date = date("d M Y", $article_date);
                
                // Updating the title with a substring containing at most length of 75 characters
                $article_title = substr($article_title,0,75).' . . . ';
                
                // Calling user defined function to create an aside article card with respective article details
                createAsideCard($article_image, $article_id, $article_title, $author_name,$article_date);
              }
            }
          ?>

          <!-- View all button -->
          <div class="text-center py-1">
            <a href="articles.php?id=<?php echo $cat_id;?>" class="btn btn-card"> Vidi Sve <span>&twoheadrightarrow;
              </span>
            </a>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<?php

  // Fetching all the Footer Data
  require('./includes/footer.inc.php');
?>
