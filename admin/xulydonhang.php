<?php
include('../db/connect.php');
?> 
<?php
if(isset($_POST['capnhatdonhang'])){
    $xuly = $_POST['xuly']; 
    $mahang = $_POST['mahang_xuly']; 
    $sql_update_donhang = mysqli_query($mysqli,"UPDATE donhang SET tinhtrang ='$xuly' WHERE mahang ='$mahang'");  
}
?> 
<?php
if(isset($_GET['xoadonhang'])){
    $mahang = $_GET['xoadonhang']; 
    $sql_delete = mysqli_query($mysqli,"DELETE FROM donhang WHERE mahang='$mahang'"); 
    header('Location:xulydonhang.php'); 
}
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
            if(isset($_GET['quanly'])=='xemdonhang'){ 
                $mahang = $_GET['mahang']; 
                $sql_chitiet = mysqli_query($mysqli,"SELECT * FROM donhang,sanpham WHERE donhang.sanpham_id = sanpham.sanpham_id AND donhang.mahang='$mahang'"); 
                // $row_chitiet = mysqli_fetch_array($sql_chitiet); 
                ?> 
                <p>Xem chi tiet don hang</p> 
                <table> 
                    <form action=''>
                <tr>
                    <th>Thu tu</th> 
                    <th>Ma hang</th>  
                    <th>Ten san pham</th>
                    <th>So luong</th> 
                    <th>Gia</th> 
                    <th>Tong tien</th>   
                    <th>Ngay dat</th> 
                    <th>Quan ly</th>
                </tr>
                <tr> 
                <?php
                $i = 0;
                while($row_donhang = mysqli_fetch_array($sql_chitiet)){
                    $i++;
                ?>
                    <td><?php echo $i; ?></td> 
                    <td><?php echo $row_donhang['mahang'] ?></td> 
                    <td><?php echo $row_donhang['sanpham_name'] ?></td> 
                    <td><?php echo $row_donhang['soluong'] ?></td> 
                    <td><?php echo $row_donhang['sanpham.giakhuyenmai'] ?></td> 
                    <td><?php echo number_format($row_donhang['soluong']* $row_donhang['sanpham.giakhuyenmai']) ?></td> 
                    <td><?php echo $row_donhang['name'] ?> </td>
                    <td><?php echo $row_donhang['ngaythang'] ?></td>
                    <td><a href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Xoa</a> ||
                    <a href="?quanly=xemdonhang&mahang=<?php echo $row_donnhang['mahang'] ?>">Xem don hang</a>
                </td>
                </tr>
                <?php
                }
                ?> 
            </table> 
            <select class="form-control">
                <option value="1">Da xu ly</option> 
                <option value="0">Chua xu ly</option>
            </select> 
            <input type="submit" value="cap nhat don hang" name="capnhatdonhang" class="btn btn-success"> 
            </form>
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
                     <p>Don hang</p>
                     
        <!-- <h4>Them danh muc<h4> 
        <label>Ten danh muc</label>
        <form action="" method="POST">
        <input type="text" class="form-control" name="danhmuc" placeholder="Ten danh muc"> 
        <input type="submit" name="themdanhmuc" value="Them danh muc" class="btn btn-default">
        </form>
    </div>   -->
            <?php
            }
            ?>
            
    <div class="col=md-8"> 
        <h4>Liet ke don hang<h4> 
            <?php
            $sql_select = mysqli_query($mysqli,"SELECT * FROM sanpham,khachhang,donhang
             WHERE donhang.sanpham_id = sanpham.sanpham_id AND donhang.khachhang_id = khachhang.khachhang_id ORDER BY donhang.donhang_id DESC"); 
            ?> 
            <table>
                <tr>
                    <th>Thu tu</th>  
                    <th>Ma hang</th> 
                    <th>Tinh trang don hang</th> 
                    <th>Ten khach hang</th> 
                    <th>Ngay dat</th>
                </tr>
                <tr> 
                <?php
                $i = 0;
                while($row_donhang = mysqli_fetch_array($sql_select)){
                    $i++;
                ?>
                    <td><?php echo $i; ?></td> 
                    <td><?php echo $row_donhang['mahang'] ?></td> 
                    <th><?php
                    if($row_donhang['tinhtrang']==0){
                        echo 'Chua xu ly';
                    } else{
                        echo 'Da xy ly'; 
                    }
                    ?> 
                    <td><?php echo $row_donhang['name'] ?> </td>
                    <td><?php echo $row_donhang['ngaythang'] ?></td> 
                    <input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['mahang'] ?>">
                    <td><a href="?xoa=<?php echo $row_donhang['donhang_id'] ?>">Xoa</a> ||
                    <a href="?quanly=xemdonhang&mahang=<?php echo $row_donnhang['mahang'] ?>">Xem don hang</a>
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