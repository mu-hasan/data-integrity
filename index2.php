<?php

	include_once("connection.php");


	//$urutan="";
	if($_GET["urutan"]==1){$urutan="b.Barang_nama";}
	else if($_GET["urutan"]==2){$urutan="b.Barang_harga";}
	else{$urutan="b.Barang_rating";}
	
	$sql = "SELECT b.Barang_nama, b.Barang_harga, b.Barang_gambar, b.Barang_stok, b.Barang_rating, b.Barang_ulasan,
			sb.Url, s.Sumber_nama, s.Sumber_logo, s.Last_update
			FROM barang b join sumber_barang sb on b.Barang_ID=sb.Barang_ID join sumber s on sb.Sumber_ID=s.Sumber_ID
			where b.Barang_nama like '%".$_GET["kata"]."%' order by ".$urutan." ASC";
	
	
	$result = mysqli_query($conn, $sql);
 
 	
	if (mysqli_num_rows($result) > 0){
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			//--------------------------------------------------------------------------------------------------------------------------------------
				?>
			
				<div class="col-sm-4 col-lg-3 col-md-3">
					<div class="thumbnail">
						<img src="<?php echo $row["Barang_gambar"];?>" style="weight:320px; height:150px" class="img-responsive" alt="">
						<div class="caption">
							<h4><a href="<?php echo $row["Url"];?>"><?php echo $row["Barang_nama"];?></a></h4>
							<h4><?php echo $row["Barang_harga"];?></h4>								
							<p><?php echo $row["Barang_stok"];?></p>
						
						</div>
						<div class="ratings">                                
							<p>
								<?php 
									$x=$row["Barang_rating"];
									while($x>0){
										echo '<span class="glyphicon glyphicon-star"></span>';
										$x=$x-1;
									}
								?>
							</p>(<?php echo $row["Barang_ulasan"];?>)
						</div>
					</div>
				</div>
					
			<?php
			//--------------------------------------------------------------------------------------------------------------------------------------
			
		}
	} else {
		echo "0 results";
	}
	
	mysqli_close($conn);
?>
