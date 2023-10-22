<?php
include('../db/connect.php');
?>
<?php
if(isset($_POST['themdanhmuc'])){
    $themdanhmuc = $_POST['danhmuc']; 
    $sql_insert = mysqli_query($mysqli,"INSERT INTO category(name) values('$themdanhmuc')");
} elseif(isset($_POST['capnhatdanhmuc'])){ 
    $id_post = $_POST['id_danhmuc'];
    $tendanhmuc = $_POST['danhmuc']; 
    $sql_update = mysqli_query($mysqli,"UPDATE category SET name ='$tendanhmuc' WHERE id='$id_post'"); 
    header('Location:xulydanhmuc.php'); 
}
if(isset($_GET['xoa'])){
    $id = $_GET['xoa']; 
    $sql_xoa = mysqli_query($mysqli,"DELETE FROM category WHERE id ='$id'"); 
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
    <div class="container"> 
        <div class="row"> 
            <?php
            if(isset($_GET['quanly'])=='capnhat'){ 
                $id_capnhat = $_GET['id']; 
                $sql_capnhat = mysqli_query($mysqli,"SELECT * FROM category WHERE id='$id_capnhat'"); 
                $row_capnhat = mysqli_fetch_array($sql_capnhat); 
                ?>
                <div class="col-md-4"> 
        <h4>Cap nhat danh muc<h4> 
        <label>Ten danh muc</label>
        <form action="" method="POST">
        <input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhat['name'] ?>"> 
        <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['id'] ?>"> 
        <input type="submit" name="capnhatdanhmuc" value="Cap nhat danh muc" class="btn btn-default">
        </form>
    </div> 
            
    <?php
            } else{
                ?>
                <div class="col-md-4"> 
        <h4>Them danh muc<h4> 
        <label>Ten danh muc</label>
        <form action="" method="POST">
        <input type="text" class="form-control" name="danhmuc" placeholder="Ten danh muc"> 
        <input type="submit" name="themdanhmuc" value="Them danh muc" class="btn btn-default">
        </form>
    </div> 
            <?php
            }
            ?>
            
    <div class="col=md-8"> 
        <h4>Liet ke danh muc<h4> 
            <?php
            $sql_select = mysqli_query($mysqli,"SELECT * FROM category ORDER BY id DESC"); 
            ?> 
            <table>
                <tr>
                    <th>Thu tu</th> 
                    <th>Ten danh muc</th>
                    <th>Quan ly</th>
                </tr>
                <tr> 
                <?php
                $i = 0;
                while($row_category = mysqli_fetch_array($sql_select)){
                    $i++;
                ?>
                    <td><?php echo $i; ?></td> 
                    <td><?php echo $row_category['name'] ?></td>
                    <td><a href="?xoa=<?php echo $row_category['id'] ?>">Xoa</a> ||
                    <a href="?quanly=capnhat&id=<?php echo $row_category['id'] ?>">Cap nhat</a>
                </td>
                </tr>
                <?php
                }
                ?> 
            </table>
    </div> 
</div>
</div>
    
</body> 
</html>