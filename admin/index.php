<?php
session_start();
include('../db/connect.php');
?>
<?php 
if(isset($_POST['dangnhap'])){
    $taikhoan = $_POST['taikhoan']; 
    $matkhau = md5($_POST['matkhau']); 
    if($taikhoan =="" || $matkhau ==""){
        echo '<p>Xin nhap du</p>';
    } else{ 
        $row_select_admin = mysqli_query($mysqli,"SELECT * FROM admin WHERE email = '$taikhoan' AND password = '$matkhau' LIMIT 1 "); 
        $count = mysqli_num_rows($row_select_admin); 
        $row_dangnhap = mysqli_fetch_array($row_select_admin); 
        if($count>0){
            $_SESSION['dangnhap'] = $row_dangnhap['admin_name']; 
            $_SESSION['admin_id'] = $row_dangnhap['admin_id'];
        header('Location: dashboard.php'); 
        } else{
            echo '<p>Tai khoan hoac mat khau sai</p>';
        }
    }
}
?>
<!Doctype html>
<html>
    <head> 
        <meta charset="utf-8"> 
        <title> Dang nhap Admin</title> 
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" /> 
</head> 
<body> 
    <h2 aglin="center" >Dang nhap Admin</h2> 
    <div class="col-md-6"> 
    <div class="form group"> 
        <form action="" method="POST">
        <label>Tai khoan</label>
        <input type="text" name="taikhoan" placeholder="Dien Email" class="form-control"> 
        <label>Mat khau</label> 
        <input type="password" name="matkhau" placeholder="Dien mat khau" class="form-control"> 
        <input type="submit" name="dangnhap" class="btn btn-primary" value="Dang nhap Admin">
        </form>
    </div> 
    </div>   
</body> 
</html>