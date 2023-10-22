<?php
if(isset($_POST['themgiohang'])){
	$tensanpham = $_POST['tensanpham']; 
	$sanpham_id = $_POST['sanpham_id']; 
	$hinhanh = $_POST['hinhanh'];
	$gia = $_POST['giasanpham'];
	$soluong = $_POST['soluong']; 
	
	 $sql_select_giohang = mysqli_query($mysqli,"SELECT * FROM giohang WHERE sanpham_id = '$sanpham_id'"); 
	 $count = mysqli_num_rows($sql_select_giohang); 
	 if($count > 0){
		$row_sanpham = mysqli_fetch_array($sql_select_giohang); 
		$soluong = $row_sanpham['soluong'] + 1; 
		$sql_giohang = "UPDATE giohang SET soluong = '$soluong' WHERE sanpham_id = '$sanpham_id'"; 
	 } else{
		$soluong = $soluong; 
		$sql_giohang = "INSERT INTO giohang(tensanpham,sanpham_id,giasanpham,hinhanh,soluong) values 
	('$tensanpham','$sanpham_id','$gia','$hinhanh','$soluong')"; 
	 }
	 $insert_row = mysqli_query($mysqli,$sql_giohang);
	if($insert_row == 0){
		header('Location:index.php?quanly=chitietsp&id='.$sanpham_id); 
	} elseif(isset($_POST['capnhatsoluong'])){  
		for($i=0;$i<count($_POST['product_id']);$i++){ 
			$sanpham_id = $_POST['product_id'][$i]; 
		    $soluong = $_POST['soluong'][$i]; 
			if($soluong = 0){
			$sql_delete = mysqli_query($mysqli,"DELETE FROM giohang WHERE sanpham_id = '$sanpham_id'");
			} else{
			$sql_update = mysqli_query($mysqli,"UPDATE giohang SET soluong = '$soluong' WHERE sanpham_id = '$sanpham_id'");
			}
		} 
	} elseif(isset($_GET['xoa'])){ 
		$id = $_GET['xoa'];
		$sql_delete = mysqli_query($mysqli,"DELETE FROM giohang WHERE giohang_id = '$id'"); 
	} elseif(isset($_POST['thanhtoan'])){
		$name = $_POST['name']; 
		$phone = $_POST['phone']; 
		$email = $_POST['email']; 
		$note = $_POST['note']; 
		$address = $_POST['address']; 
		$giaohang = $_POST['giaohang']; 
		$sql_khachhang = mysqli_query($mysqli,"INSERT INTO khachhang(khachhang_id,name,phone,address,note,email,giaohang) values
		 ('$name','$phone','$address','$note','$email','$giaohang')"); 
	} 
	if($sql_khachhang){
		$sql_select_khachhang = mysqli_query($mysqli,"SELECT * FROM khachhang ORDER BY khachhang_id DESC LIMIT 1"); 
		$mahang = rand(0,9999); 
		$row_khachhang = mysqli_fetch_array($sql_select_khachhang); 
		$khachhang_id = $row_khachhang['khachhang_id'];  
		for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){ 
			$sanpham_id = $_POST['thanhtoan_product_id'][$i]; 
		    $soluong = $_POST['thanhtoan_soluong'][$i]; 
			$sql_donghang = mysqli_query($mysqli,"INSERT INTO donhang(sanpham_id,soluong,mahang,khachhang_id) values
		 ('$sanpham_id','$khachhang_id','$soluong','$mahang')"); 
		$sql_delete_thanhtoan = mysqli_query($mysqli,"DELETE FROM giohang WHERE sanpham_id = '$sanpham_id'"); 
		}
	} 
}
?> 
<!-- checkout page -->
<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>C</span>heckout
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right"> 
				<?php
				$sql_lay_giohang = mysqli_query($mysqli,"SELECT * FROM giohang ORDER BY giohang_id DESC"); 
				?>
				<div class="table-responsive"> 
					<form action="" method="POST">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>So thu tu</th>
								<th>San pham</th>
								<th>So luong</th>
								<th>Ten san pham</th>

								<th>Gia</th> 
								<th>Gia tong</th>
								<th>Quan ly</th>
							</tr>
						</thead>
						<tbody> 
							<?php 
							$i = 0;
							$total = 0;
							while($row_fetch_giohang = mysqli_fetch_array($sql_lay_giohang)){ 
								$subtotal = $row_fetch_giohang['soluong'] * $row_fetch_giohang['giasanpham']; 
								$total += $subtotal; 
								$i++;
							?>
							<tr class="rem1">
								<td class="invert"><?php echo $i ?></td>
								<td class="invert-image">
									<a href="single.html">
										<img src="images/<?php echo $row_fetch_giohang['hinhanh'] ?>" alt=" " class="img-responsive">
									</a>
								</td>
								<td class="invert">
									<div class="quantity">
										<input type='number' min =1 name='soluong[]' value="<?php echo $row_fetch_giohang['soluong'] ?>" > 
										<input type='hidden' name='product_id[]' value="<?php echo $row_fetch_giohang['sanpham_id'] ?>" >
									</div>
								</td>
								<td class="invert"><?php echo $row_fetch_giohang['tensanpham'] ?></td>
								<td class="invert"><?php echo number_format($row_fetch_giohang['giasanpham']). 'vnd' ?></td>
								<td class="invert"><?php echo number_format($subtotal). 'vnd' ?></td>
								<td class="invert">
									<a href="?quanly=giohang&xoa=<?php echo $row_fetch_giohang['giohang_id'] ?>"> Xoa </a>
								</td>
							</tr> 
							<?php
							}
							?>
							<tr>
								<td colspan="7">Tong tien: <?php echo number_format($total) ?> </td>
							</tr> 
							<tr>
								<td colspan="7"><input type ="submit" class="btn btn-success" name="capnhatsoluong" value="Cap nhat gio hang" >
							</tr>
	
						</tbody>
					</table> 
						</form>
				</div>
			</div>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Them dia chi giao hang</h4>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Dien ten" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="So dien thoai" name="number" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Dia chi" name="address" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Email" name="city" required="">
									</div> 
									<div class="controls form-group">
										<textarea style="resize=none;" classs="form-control" placeholder="Ghi chu" name="note" require=""></textarea>
						            </div>
									<div class="controls form-group">
										<select class="option-w3ls" name="giaohang">
											<option>Chon hinh thuc giao hang</option>
											<option value="1">Thanh toan ATM</option>
											<option value="0">Nhan tien tai nha</option>

										</select>
									</div>
								</div> 
								<?php
								$sql_lay_giohang = mysqli_query($mysqli,"SELECT * FROM giohang ORDER BY giohang_id DESC"); 
								while($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang)){ 
									?> 
									<input type='hidden' name='thanhtoan_soluong[]' value="<?php echo $row_thanhtoan['soluong'] ?>" > 
										<input type='hidden' name='thanhtoan_product_id[]' value="<?php echo $row_thanhtoan['sanpham_id'] ?>" >
								 
								<?php
								}
								?>
								<input type="submit" neme="thanhtoan" class="btn btn-success" style=" width: 20%" value="Thanh toan">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> 
</div>
	<!-- //checkout page -->