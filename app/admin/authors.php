<?php
  require('./includes/nav.inc.php');

  
// Check if the user is an admin
if(isset($_SESSION['ADMIN_ID']) && $_SESSION['ADMIN_ID'] != 1) { 
  alert("Pristup odbijen! Niste Glavni Urednik !");
  redirect('./urednik.php');
}
?>

<script>
function deleteConfirm(id) {
  if (confirm("Da li ste sigurni da zelite da izbrisete novinara?")) {
    var url = "./delete-author.php?id=" + id;
    document.location = url;
  }
}

function addToAdmin(id) {
  if (confirm("Da li ste sigurni da zelite da ga dodate u urednike?")) {
    var url = "./add-urednik.php?id=" + id;
    document.location = url;
  }
}

function removeFromAdmin(id) {
  if (confirm("Da li ste sigurni da zelite da uklonite urednika?")) {
    var url = "./remove-urednik.php?id=" + id;
    document.location = url;
  }
}
function updateCategory(id, selectedCategory) {
  var url = "./update-author-category.php?id=" + id + "&category=" + selectedCategory;
  document.location = url;
}
</script>

<!-- BREADCRUMB -->
<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Početni Panel</a></li>
      <li class="active">Novinari</li>
    </ol>
  </div>
</section>

<section id="main">
  <div class="container">
    <div class="col-md-12">
      <?php
        $limit = 6;
        if(isset($_GET['page'])) {
          $page = $_GET['page'];
        } else {
          $page = 1;
        }
        $offset = ($page - 1) * $limit;

        // Dohvati sve kategorije
        $categoriesQuery = "SELECT * FROM category";
        $categoriesResult = mysqli_query($con, $categoriesQuery);

        $categories = array();
        while($category = mysqli_fetch_assoc($categoriesResult)) {
          $categories[] = $category;
        }

        $sql = "SELECT author.author_id, 
                author.author_name, 
                author.author_email,
                COUNT(article.article_id) AS article_count,
                category.category_id, category.category_name
                FROM author
                LEFT JOIN article ON author.author_id = article.author_id
                LEFT JOIN category ON author.category_id = category.category_id
                GROUP BY author.author_id
                ORDER BY author.author_id DESC
                LIMIT {$offset},{$limit}";

        $result = mysqli_query($con, $sql);
        $row = mysqli_num_rows($result);
      ?>
      <div class="panel panel-default">
        <div class="panel-heading main-color-bg">
          <h3 class="panel-title">Novinari</h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover author-table">
            <tr>
              <th style="min-width: 250px">Ime Novinara</th>
              <th style="min-width: 200px">Email</th>
              <th style="min-width: 120px">Kategorija</th>
              <th style="min-width: 120px">Broj Vesti</th>
              <th style="min-width: 150px">Upravljanje</th>
            </tr>
            <?php
              if($row > 0) {
                while($data = mysqli_fetch_assoc($result)) {
                  $author_id = $data['author_id'];
                  $author_name = $data['author_name'];
                  $author_email = $data['author_email'];
                  $article_count = $data['article_count'];
                  $category_name = $data['category_name'];
                  $category_id = $data['category_id'];

                  $isAdminQuery = "SELECT * FROM admin WHERE admin_email = '$author_email'";
                  $isAdminResult = mysqli_query($con, $isAdminQuery);
                  $isAdmin = mysqli_num_rows($isAdminResult) > 0;

                  echo '
                  <tr>
                      <td>
                          '.$author_name.'
                      </td>
                      <td>
                          '.$author_email.'
                      </td>
                      <td>
                          <select class="form-control" id="categorySelect_'.$author_id.'" onchange="updateCategory('.$author_id.', this.value)">
                            <option value="'.$category_id.'" selected>'.$category_name.'</option>';
                            foreach ($categories as $category) {
                              echo '<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
                            }
                            echo '
                          </select>
                      </td>
                      <td>
                          '.$article_count.'
                      </td>
                      <td>
                          <a class="btn btn-success" href="javascript:addToAdmin('.$author_id.')" title="Add to Urednik" '.($isAdmin ? 'style="display: none;"' : '').'>
                              <span class="glyphicon glyphicon-plus"></span>
                          </a>
                          <a class="btn btn-warning" href="javascript:removeFromAdmin('.$author_id.')" title="Remove from Urednik" '.(!$isAdmin ? 'style="display: none;"' : '').'>
                              <span class="glyphicon glyphicon-minus"></span>
                          </a>
                          <a class="btn btn-danger" href="javascript:deleteConfirm('.$author_id.')" title="Delete Author">
                              <span class="glyphicon glyphicon-trash"></span>
                          </a>
                          
                      </td>
                  </tr>
              ';
            }
          } else {
            echo '
              <td colspan="5" align="center" style="padding-top: 28px; color: var(--active-color);">
                <h4>
                  Nema novinara !
                </h4>
              </td>
            ';
          }
          ?>
          </table>
        </div>
        <div class="text-center">
          <ul class="pagination pg-red">
            <?php
              $paginationQuery = "SELECT DISTINCT author.author_id FROM author LEFT JOIN article ON author.author_id = article.author_id";
              $paginationResult = mysqli_query($con, $paginationQuery);
              if(mysqli_num_rows($paginationResult) > 0) {
                $total_authors = mysqli_num_rows($paginationResult);
                $total_page = ceil($total_authors / $limit);

                if($page > $total_page) {
                  redirect('./authors.php');
                }
                if($page > 1) {
                  echo '
                    <li class="page-item">
                      <a href="authors.php?page='.($page - 1).'" class="page-link">
                        <span>&laquo;</span>
                      </a>
                    </li>';
                }
                for($i = 1; $i <= $total_page; $i++) {
                  $active = "";
                  if($i == $page) {
                    $active = "active";
                  }
                  echo '<li class="page-item '.$active.'"><a href="./authors.php?page='.$i.'" class="page-link">'.$i.'</a></li>';
                }
                if($total_page > $page){
                  echo '
                    <li class="page-item">
                      <a href="authors.php?page='.($page + 1).'" class="page-link">
                        <span>&raquo;</span>
                      </a>
                    </li>';
                }
              }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
  require('./includes/footer.inc.php')
?>
