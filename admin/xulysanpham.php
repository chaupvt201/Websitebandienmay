<?php
include('../db/connect.php');
?>
<?php
if(isset($_POST['themsanpham'])){
    $tensanpham = $_POST['tensanpham'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $soluong = $_POST['soluong'];
    $gia = $_POST['giasanpham'];
    $giakhuyenmai = $_POST['giakhuyenmai'];
    $danhmuc = $_POST['danhmuc'];
    $chitiet = $_POST['chitiet'];
    $mota = $_POST['mota']; 
    $path ='../upload/';
    $sql_insert_product = mysqli_query($mysqli,"INSERT INTO sanpham(sanpham_name,
    sanpham_chitiet,sanpham_mota,sanpham_gia,sanpham_giakhuyenmai,sanpham_soluong,sanpham_image,category_id) values('$tensanpham','$chitiet','$mota','$gia','$giakhuyenmai','$soluong','$hinhanh','$danhmuc')"); 
    move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
} elseif(isset($_POST['capnhatsanpham'])){ 
    $id_update = $_POST['id_update'];
    $tensanpham = $_POST['tensanpham'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $soluong = $_POST['soluong'];
    $gia = $_POST['giasanpham'];
    $giakhuyenmai = $_POST['giakhuyenmai'];
    $danhmuc = $_POST['danhmuc'];
    $chitiet = $_POST['chitiet'];
    $mota = $_POST['mota']; 
    $path ='../upload/'; 
    if($hinhanh==''){
        $sql_update_image = "UPDATE sanpham SET sanpham_name='$tensanpham',
        sanpham_chitiet='$chitiet',sanpham_mota='$mota',sanpham_gia='$gia',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_soluong='$soluong', category_id='$danhmuc' WHERE sanpham_id='$id_update'"; 
    }else{
        move_uploaded_file($hinhanh_tmp,$path.$hinhanh); 
        $sql_update_image = "UPDATE sanpham SET sanpham_name='$tensanpham',
        sanpham_chitiet='$chitiet',sanpham_mota='$mota',sanpham_gia='$gia',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_soluong='$soluong',sanpham_image='$hinhanh', category_id='$danhmuc' WHERE sanpham_id='$id_update'";
    }
    mysqli_query($mysqli,$sql_update_image);
}
// } elseif(isset($_POST['capnhatdanhmuc'])){ 
//     $id_post = $_POST['id_danhmuc'];
//     $tendanhmuc = $_POST['danhmuc']; 
//     $sql_update = mysqli_query($mysqli,"UPDATE category SET name ='$tendanhmuc' WHERE id='$id_post'"); 
//     header('Location:xulydanhmuc.php'); 
// }
// if(isset($_GET['xoa'])){
//     $id = $_GET['xoa']; 
//     $sql_xoa = mysqli_query($mysqli,"DELETE FROM category WHERE id ='$id'"); 
// } 
?>
<?php
if(isset($_GET['xoa'])){
    $id = $_GET['xoa']; 
    $sql_xoa = mysqli_query($mysqli,"DELETE FROM sanpham WHERE sanpham_id = '$id'"); 
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
      <a class="nav-item nav-link active" href="#">Don hang <span class="sr-only">(current)</span></a>
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
                $id_capnhat = $_GET['capnhat_id']; 
                $sql_capnhat = mysqli_query($mysqli,"SELECT * FROM sanpham WHERE sanpham_id='$id_capnhat'"); 
                $row_capnhat = mysqli_fetch_array($sql_capnhat); 
                $id_category_1 = $row_capnhat['category_id']; 
                ?>
                <!-- <div class="col-md-4"> 
        <h4>Cap nhat danh muc<h4> 
        <label>Ten danh muc</label>
        <form action="" method="POST">
        <input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhat['name'] ?>"> 
        <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['id'] ?>"> 
        <input type="submit" name="capnhatdanhmuc" value="Cap nhat danh muc" class="btn btn-default">
        </form>
    </div>  -->
    <div class="col-md-4"> 
        <h4>Cap nhat san pham<h4> 
        <form action="" method="POST" enctype="multipart/form-data"> 
        <label>Ten san pham</label>    
        <input type="text" class="form-control" name="tensanpham" value="<?php echo $row_capnhat['sanpham_name'] ?>"><br> 
        <input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['sanpham_id'] ?>"><br> 
        <label>Hinh anh</label>
        <input type="file" class="form-control" name="hinhanh"><br> 
        <img src="../uploads/<?php echo $row_capnhat['sanpham_image'] ?>" height="80" width="80" ><br> 
        <label>Gia</label> 
        <input type="text" class="form-control" name="giasanpham" value="<?php echo $row_capnhat['sanpham_gia'] ?>"><br> 
        <label>Gia khuyen mai</label> 
        <input type="text" class="form-control" name="giakhuyenmai" value="<?php echo $row_capnhat['sanpham_giakhuyenmai'] ?>"><br> 
        <label>So luong</label> 
        <input type="text" class="form-control" name="soluong" value="<?php echo $row_capnhat['sanpham_soluong'] ?>"><br> 
        <label>Mo ta</label> 
        <textarea class="form-control" name="mota"> <?php echo $row_capnhat['sanpham_mota'] ?></textarea><br> 
        <label>Chi tiet</label> 
        <textarea class="form-control" name="chitiet"> <?php echo $row_capnhat['sanpham_chitiet'] ?></textarea><br> 
        <label>Danh muc</label>
        <?php
        $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM category ORDER BY id DESC"); 
        ?> 
        <select name="danhmuc" class="form-control"> 
            <option value="">-----Chon danh muc-----</option> 
            <?php
            while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){ 
                if($id_category_1 == $row_danhmuc['id']){
            ?> 
            <option selected value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['name'] ?></option> 
            <?php
            } else{
            ?> 
             <option value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['name'] ?></option> 
            <?php
            } 
        }
            ?>
            </select> 
        <input type="submit" name="capnhatsanpham" value="Cap nhat san pham" class="btn btn-default">
        </form>
    </div> 
    <?php
            } else{
                ?>
                <div class="col-md-4"> 
        <h4>Them san pham<h4> 
        <form action="" method="POST" enctype="multipart/form-data"> 
        <label>Ten san pham</label>    
        <input type="text" class="form-control" name="tensanpham" placeholder="Ten san pham"><br> 
        <label>Hinh anh</label>
        <input type="file" class="form-control" name="hinhanh"><br> 
        <label>Gia</label> 
        <input type="text" class="form-control" name="giasanpham" placeholder="Gia san pham"><br> 
        <label>Gia khuyen mai</label> 
        <input type="text" class="form-control" name="giakhuyenmai" placeholder="Gia khuyen mai"><br> 
        <label>So luong</label> 
        <input type="text" class="form-control" name="soluong" placeholder="Soluong"><br> 
        <label>Mo ta</label> 
        <textarea class="form-control" name="mota"></textarea><br> 
        <label>Chi tiet</label> 
        <textarea class="form-control" name="chitiet"></textarea><br> 
        <label>Danh muc</label>
        <?php
        $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM category ORDER BY id DESC"); 
        ?> 
        <select name="danhmuc" class="form-control"> 
            <option value="">-----Chon danh muc-----</option> 
            <?php
            while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
            ?> 
            <option value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['name'] ?></option> 
            <?php
            }
            ?>
            </select> 
        <input type="submit" name="themsanpham" value="Them san pham" class="btn btn-default">
        </form>
    </div> 
            <?php
            }
            ?>
            
    <div class="col=md-8"> 
        <h4>Liet ke danh muc<h4> 
            <?php
            $sql_select_sp = mysqli_query($mysqli,"SELECT * FROM sanpham, category WHERE 
            sanpham.category_id = category.id ORDER BY sanpham.sanpham_id DESC"); 
            ?> 
            <table>
                <tr>
                    <th>Thu tu</th> 
                    <th>Ten san pham</th>
                    <th>Hinh anh</th>
                    <th>So luong</th> 
                    <th>Danh muc</th>
                    <th>Gia san pham</th>
                    <th>Gia khuyen mai</th>
                    <th>Quan ly</th>
                </tr>
                <tr> 
                <?php
                $i = 0;
                while($row_sp = mysqli_fetch_array($sql_select_sp)){
                    $i++;
                ?>
                    <td><?php echo $i; ?></td> 
                    <td><?php echo $row_sp['sanpham_name'] ?></td> 
                    <td><img src="../upload/<?php echo $row_sp['sanpham_image'] ?>" height="80", width="80"></td>
                    <td><?php echo $row_sp['sanpham_soluong'] ?></td>
                    <td><?php echo $row_sp['name'] ?></td>
                    <td><?php echo number_format($row_sp['sanpham_gia']).'vnd' ?></td>
                    <td><?php echo number_format($row_sp['sanpham_giakhuyenmai']).'vnd' ?></td>
                    <td><a href="?xoa=<?php echo $row_sp['sanpham_id'] ?>">Xoa</a> ||
                    <a href="xulysanpham.php?quanly=capnhat&capnhat_id=<?php echo $row_sp['sanpham_id'] ?>">Cap nhat</a>
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