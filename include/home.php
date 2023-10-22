<!-- product right -->
<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
					<div class="side-bar p-sm-4 p-3">
						<div class="search-hotel border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Tim kiem</h3>
							<form action="#" method="post">
								<input type="search" placeholder="San pham" name="search" required="">
								<input type="submit" value=" ">
							</form>
						</div>
						<!-- price -->
						<div class="range border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Gia</h3>
							<div class="w3l-range">
								<ul>
									<li>
										<a href="#">Duoi 1000000Vnd</a>
									</li>

								</ul>
							</div>
						</div>
						<!-- //price -->
						<!-- discounts -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Giam gia</h3>
							<ul>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">5% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">10% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">20% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">30% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">50% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">60% or More</span>
								</li>
							</ul>
						</div>
						<!-- //discounts -->
						<!-- reviews -->
						<div class="customer-rev border-bottom left-side py-2">
							<h3 class="agileits-sear-head mb-3">Khach hang Review</h3>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>5.0</span>
									</a>
								</li>
								
							</ul>
						</div>
						<!-- //reviews -->
						<!-- electronics -->
						<div class="left-side border-bottom py-2"> 
							<h3 class="agileits-sear-head mb-3">Danh muc san pham</h3>
							<ul> 
								<?php
								$mysql_category_sidebar = mysqli_query($mysqli,"SELECT * FROM category ORDER BY id DESC");
								while($row_category_sidebar = mysqli_fetch_array($mysql_category_sidebar)){
								?>
								<li>
									<!-- <input type="checkbox" class="checked"> -->
									<span class="span"><a href="danhmucsanpham.php?id=<?php echo $row_category_sidebar['id'] ?>" ><?php echo $row_category_sidebar['name'] ?> </a></span> 
								</li> 
								<?php
								}
								?>
							</ul>
						</div>
						<!-- //electronics -->
						<!-- delivery -->
						<div class="left-side border-bottom py-2"> 
							
						</div>
						<!-- //delivery -->
						<!-- arrivals -->
						<div class="left-side border-bottom py-2">
							
						</div>
						<!-- //arrivals -->
						<!-- best seller -->
						<div class="f-grid py-2">
							<h3 class="agileits-sear-head mb-3">San pham ban chay</h3>
							<div class="box-scroll">
								<div class="scroll"> 
									<?php 
									$sql_product_sidebar = mysqli_query($mysqli,"SELECT * FROM sanpham WHERE sanpham_hot = '0' ORDER BY sanpham_id DESC "); 
									while($row_product_sidebar = mysqli_fetch_array($sql_product_sidebar)){
									?>
									<div class="row">
										<div class="col-lg-3 col-sm-2 col-3 left-mar">
											<img src="images/k1.jpg" alt="" class="img-fluid">
										</div>
										<div class="col-lg-9 col-sm-10 col-9 w3_mvd">
											<a href=""><?php echo $row_product_sidebar['sanpham_name'] ?></a>
											<a href="" class="price-mar mt-2"><?php echo number_format($row_product_sidebar['sanpham_giakhuyenmai']), "vnd" ?></a>
										</div>
									</div> 
									<?php
									}
									?>
								         

								</div>
							</div>
						</div>
						<!-- //best seller -->
					</div>
					<!-- //product right -->