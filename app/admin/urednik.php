<?php
  require('./includes/nav.inc.urednik.php');
  
?>


<section id="main">
  <div class="container">
    <div class="row">
    <?php
    $admin_id = $_SESSION['ADMIN_ID'];

    // Pronađi kategoriju admina
    $admin_category_sql = "SELECT category_id FROM admin WHERE admin_id = $admin_id";
    $admin_category_result = mysqli_query($con, $admin_category_sql);
    $admin_category_data = mysqli_fetch_assoc($admin_category_result);
    $admin_category_id = $admin_category_data['category_id'];

    $category_name_sql = "SELECT category_name FROM category WHERE category_id = $admin_category_id";
    $category_name_result = mysqli_query($con, $category_name_sql);
    $category_name_data = mysqli_fetch_assoc($category_name_result);
    $admin_category_name = $category_name_data['category_name'];

    // Broj autora sa istom kategorijom kao i admin
    $authors_sql = "SELECT COUNT(DISTINCT author_id) AS no_of_authors
                    FROM author
                    WHERE category_id = $admin_category_id";
    $authors_result = mysqli_query($con, $authors_sql);
    $authors_data = mysqli_fetch_assoc($authors_result);
    $no_of_authors = $authors_data['no_of_authors'];

    require('./includes/quick-links-editor-urednik.inc.php');
?>


      <div class="col-md-9">
        <!-- Website Overview -->
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Pregled</h3>
          </div>
          <div class="panel-body" style="padding: 2.5rem;">
            <div class="col-md-4">
              <div class="well dash-box">
                <h2>
                  <span class="glyphicon glyphicon-pencil"></span>
                  <?php echo $no_of_articles;?>
                </h2>
                <h4>Vesti</h4>
              </div>
            </div>
            <div class="col-md-4">
              <div class="well dash-box">
                <h2>
                  <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                  <?php echo $admin_category_name;?>
                </h2>
                <h4>Kategorija</h4>
              </div>
            </div>
            <div class="col-md-4">
              <div class="well dash-box">
                <h2>
                  <span class="glyphicon glyphicon-user"></span>
                  <?php echo $no_of_authors;?>
                </h2>
                <h4>Novinari</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Latest Articles -->
    <div class="row">
    <?php
$admin_id = $_SESSION['ADMIN_ID'];

$sql = "SELECT article.article_title, 
        article.article_date, 
        article.article_image, 
        category.category_name,
        author.author_name 
        FROM article
        INNER JOIN category ON article.category_id = category.category_id 
        INNER JOIN author ON article.author_id = author.author_id
        WHERE category.category_id IN (SELECT category_id FROM `admin` WHERE admin_id = $admin_id)
        ORDER BY article_date DESC
        LIMIT 4";

$result = mysqli_query($con, $sql);
$row = mysqli_num_rows($result);
?>

      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Skorije Vesti</h4>
          </div>
          <div class="panel-body">
            <table class="table table-striped article-list table-hover">
              <tr>
                <th>Naslov</th>
                <th>Kategorija</th>
                <th>Slika</th>
                <th>Ime Autora</th>
                <th>Datum Objave</th>
              </tr>
              <?php
                if($row > 0) {
                  while($data = mysqli_fetch_assoc($result)) {
                    $category_name = $data['category_name'];
                    $author_name = $data['author_name'];
                    $article_title = $data['article_title'];
                    $article_image = $data['article_image'];
                    $article_date = $data['article_date'];
                    $article_date = date("d M y",strtotime($article_date));

                    echo '
                      <tr>
                        <td>
                          '.$article_title.'
                        </td>
                        <td>
                          '.$category_name.'
                        </td>
                        <td>
                          <img src="../assets/images/articles/'.$article_image.'" />
                        </td>
                        <td>
                          '.$author_name.'
                        </td>
                        <td>
                          '.$article_date.'
                        </td>
                      </tr>
                    ';
                  }
                  echo '
                    <tr>
                      <td colspan="5" align="center" style="padding-top: 2rem;">
                        <a href="./articles-urednik.php" class="btn btn-danger ">Vidi Sve</a>
                      </td>
                    </tr>
                  ';
                }
                else {
                  echo '
                    <td colspan="4" align="center" style="padding-top: 28px; color: var(--active-color);">
                      <h4>
                        You need to start writing '.$_SESSION['AUTHOR_NAME'].' !
                      </h4>
                    </td>
                  ';
                }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
  require('./includes/footer.inc.php')
?>