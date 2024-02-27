<?php
  require('./includes/nav.inc.php');

  // Check if the user is an admin
if(isset($_SESSION['ADMIN_ID']) && $_SESSION['ADMIN_ID'] != 1) { 
  alert("Pristup odbijen! Niste Glavni Urednik !");
  redirect('./urednik.php');
}
  
  if (isset($_POST['submit'])) { 
    
    if(isset($_SESSION['ADMIN_ID'])){ 
      $ADMIN_ID = $_SESSION['ADMIN_ID'];
    }
    else {
      alert("Prvo se prijavite kao Glavni Urednik");
      redirect('./login.php');
    }
    
    $category_name = $_POST['category_title'];
    $category_desc = $_POST['category_desc'];
    $category_color = $_POST['category_color'];

    $category_name = str_replace('"','\"',$category_name);
    $category_desc = str_replace('"','\"',$category_desc);

    $name   = $category_name.time(); 
    $extension  = pathinfo( $_FILES["category_img"]["name"], PATHINFO_EXTENSION ); 
    $basename   = $name . "." . $extension; 

    $tempname = $_FILES["category_img"]["tmp_name"];     
    $folder = "../assets/images/category/{$basename}"; 
    
    $sql = "INSERT INTO category 
            (category_name,category_color,category_description,category_image) 
            VALUES 
            (\"$category_name\",\"$category_color\",\"$category_desc\",\"$basename\")"; 

    $result = mysqli_query($con, $sql); 
    
    if ($result)  { 
      move_uploaded_file($tempname, $folder);
      alert("Kategorija uspesno napravljena !");
      redirect('./categories.php');
    }else{ 
      echo "Failed to upload Data"; 
    } 
  }
?>

<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Početni Panel</a></li>
      <li><a href="./categories.php">Kategorije</a></li>
      <li class="active">Nova Kategorija</li>
    </ol>
  </div>
</section>

<section id="main">
  <div class="container">
    <div class="row">
    <div class="col-md-2">
</div>
      <div class="col-md-8">
        <!-- Website Overview -->
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Praljenje Kategorije</h3>
          </div>
          <div class="panel-body">
            <form method="post" id="add_form" enctype="multipart/form-data">
              <div class="form-group">
                <label>Naziv Kategorije</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Unesi ime..."
                  name="category_title" id="category_title" required />
                <p id="error-title" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Boja Oznake</label>
                <select name="category_color" class="form-control" id="category_color">
                  <option value="0" selected>Izaberi bilo koju boju...</option>
                  <option value="tag-yellow">Zuta</option>
                  <option value="tag-green">Zelena</option>
                  <option value="tag-pink">Roze</option>
                  <option value="tag-orange">Narandzasta</option>
                  <option value="tag-purple">Ljubicasta</option>
                  <option value="tag-brown">Braon</option>
                  <option value="tag-blue">Plava</option>
                </select>
                <p id="error-cat" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Opis Kategorije</label>
                <textarea name="category_desc" autocomplete="off" id="category_desc" class="form-control"
                  placeholder="Opis Kategorije" rows="20" min="150" required></textarea>
                <p id="error-desc" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Slika Kategorije</label>
                <input type="file" class="form-control" placeholder="Slika Kategorije" name="category_img"
                  id="category_img" accept="image/*" required />
                <p id="error-img" class="error-msg text-danger"></p>
              </div>
              <div class="form-group text-center">
                <img src="../assets/images/articles/choose.png" class="image_preview" id="image_preview" />
              </div>
              <br>
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-success">Dodaj Kategoriju</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/js/admin/add-form-validate-category.js"></script>
</section>

<?php
  require('./includes/footer.inc.php')
?>