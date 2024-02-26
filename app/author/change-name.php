<?php
  require('./includes/nav.inc.php');
  
  if (isset($_POST['submit'])) { 
    
    if(isset($_SESSION['AUTHOR_ID'])){ 
      $author_id = $_SESSION['AUTHOR_ID'];
    }
    else {
      alert("Prvo se prijavite");
      redirect('../author-login.php');
    }  
    
    $old_name = $_POST['old_name'];
    $new_name = $_POST['new_name'];
    $confirm_name = $_POST['confirm_name'];

    $sql = "SELECT author_name FROM author 
            WHERE author_id = {$author_id}
            AND author_name = '{$old_name}'";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    if($rows > 0) {
      $update_sql = " UPDATE author 
                      SET author_name = '{$new_name}'
                      WHERE author_id = {$author_id}";
      $update_result = mysqli_query($con,$update_sql);
      if(!$update_result) {
        alert("Sorry. Try again later !");
      }
      else {
        $_SESSION['AUTHOR_NAME'] = $new_name;
        alert("Ime je promenjeno !");
      }
    }
    else {
      alert("Wrong Name. Try again !");
    }
  }
?>

<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Početni Panel</a></li>
      <li class="active">Podešavanja</li>
      <li class="active">Promeni Ime</li>
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
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Promeni Ime</h3>
          </div>
          <div class="panel-body">
            <form method="post" id="change_name_form">
              <div class="form-group">
                <label>Staro Ime</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Staro Ime" name="old_name"
                  id="old_name" required />
                <p id="error-old" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Novo Ime</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Novo Ime" name="new_name"
                  id="new_name" required />
                <p id="error-new" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Potvrdi Novo Ime</label>
                <input type="text" autocomplete="off" class="form-control" placeholder="Potvrdi Novo Ime"
                  name="confirm_name" id="confirm_name" required />
                <p id="error-confirm" class="error-msg text-danger"></p>
                <p id="error-common" class="error-msg text-danger"></p>
              </div>
              <br>
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-success">Promeni</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/js/admin/change-name-validate.js"></script>
</section>

<?php
  require('./includes/footer.inc.php')
?>