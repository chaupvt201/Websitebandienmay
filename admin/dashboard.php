<?php
session_start();
if(!isset($_SESSION['dangnhap'])){
    header('Location: index.php'); 
}
?> 
<?php
if(isset($_GET['login'])){
    $dangxuat = $_GET['login']; 
} else{
    $dangxuat =""; 
}
if($dangxuat=='dangxuat'){
    unset($_SESSION['dangnhap']); 
    header('Location: index.php'); 
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"> 
        <title>WElcome Admin</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    </head> 
<body> 
    <p>Xin chao <?php echo $_SESSION['dangnhap'] ?><a href="?login=dangxuat">Dang xuat</a></p>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
    <a class="nav-item nav-link active" href="xulydonhang.php">Don hang <span class="sr-only">(current)</span></a> 
      <a class="nav-item nav-link" href="xulydanhmuc.php">Danh muc</a>
      <a class="nav-item nav-link" href="xulysanpham.php">San pham</a> 
      <a class="nav-item nav-link" href="#">Khach hang</a>
    </div>
  </div>
</nav>
</body> 
</html>