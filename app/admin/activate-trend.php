<?php
  require('./includes/nav.inc.php');
  
  if(isset($_GET['id'])) {
    $article_id = $_GET['id'];
  }else {
    header("Location: {$_SERVER['HTTP_REFERER']}");
exit();

  }
  if($article_id == '' || $article_id == null) {
    header("Location: {$_SERVER['HTTP_REFERER']}");
exit();

  } 

  $sql = "UPDATE article 
          SET article_trend = 1 
          WHERE article_id = {$article_id}";
          
  $result = mysqli_query($con, $sql);
 
  if($result) {
    alert("Article made trending");
    header("Location: {$_SERVER['HTTP_REFERER']}");
exit();

  }
  else {
    alert("Error, Please try again later");
    header("Location: {$_SERVER['HTTP_REFERER']}");
exit();

  }
?>

<?php
  require('./includes/footer.inc.php')
?>