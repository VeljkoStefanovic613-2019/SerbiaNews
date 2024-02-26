<?php
  require('./includes/nav.inc.php');
  
  if (isset($_POST['submit'])) { 
    
    if(isset($_SESSION['AUTHOR_ID'])){ 
      $author_id = $_SESSION['AUTHOR_ID'];
    }
    else {
      alert("Prvo se ulogujte");
      redirect('../author-login.php');
    }  
    
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];
    
    $str_new_pass = password_hash($new_password,PASSWORD_BCRYPT);

    $sql = "SELECT * FROM author 
            WHERE author_id = {$author_id}";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    if($rows > 0) {
      $data = mysqli_fetch_assoc($result);
      $email = $data['author_email'];
      $pasword_check = password_verify($old_password,$data['author_password']);
      if($pasword_check) {
        $update_sql = " UPDATE author, user
                        SET author.author_password = '{$str_new_pass}',
                        user.user_password = '{$str_new_pass}'
                        WHERE author_id = {$author_id}
                        AND user.user_email = '{$email}'";
 
        $update_result = mysqli_query($con,$update_sql);
        if(!$update_result) {
          alert("Sorry. Try again later !");
        }
        else {
          alert("Lozinka promenjena !");
        }
      }else {
        alert("Neispravna Lozinka ! Pokusajte ponovo");
      }
    }
    else {
      alert("Neispravna Lozinka ! Pokusajte ponovo");
    }
  }
?>

<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./index.php">Početni Panel</a></li>
      <li class="active">Podešavanja</li>
      <li class="active">Promeni Lozinku</li>
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
            <h3 class="panel-title">Promeni Lozinku</h3>
          </div>
          <div class="panel-body">
            <form method="post" id="change_pass_form">
              <div class="form-group">
                <label>Stara Lozinka</label>
                <input type="password" autocomplete="off" class="form-control" placeholder="Stara Lozinka"
                  name="old_password" id="old_password" required />
                <p id="error-old" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Nova Lozinka</label>
                <input type="password" autocomplete="off" class="form-control" placeholder="Nova Lozinka"
                  name="new_password" id="new_password" required />
                <p id="error-new" class="error-msg text-danger"></p>
              </div>
              <div class="form-group">
                <label>Potvrdi Novu Lozinku</label>
                <input type="password" autocomplete="off" class="form-control" placeholder="Potvrdi Novu Lozinku"
                  name="confirm_new_password" id="confirm_new_password" required />
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
  <script src="../assets/js/admin/change-pass-validate.js"></script>
</section>

<?php
  require('./includes/footer.inc.php')
?>