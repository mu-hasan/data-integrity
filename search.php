<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "inta_shopback";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$urutan="";
	if($_GET["urutan"]==1){$urutan="b.Barang_nama";}
	else if($_GET["urutan"]==2){$urutan="b.Barang_harga";}
	else{$urutan="b.Barang_rating";}
	
	echo $_GET["kata"];
	echo '<br>';
	echo $_GET["urutan"];
	
	$sql = "SELECT b.Barang_nama, b.Barang_harga, b.Barang_gambar, b.Barang_stok, b.Barang_rating, b.Barang_ulasan,
			sb.Url, s.Sumber_nama, s.Sumber_logo, s.Last_update
			FROM barang b join sumber_barang sb on b.Barang_ID=sb.Barang_ID join sumber s on sb.Sumber_ID=s.Sumber_ID
			where b.Barang_nama like '%".$_GET["kata"]."%' order by ".$urutan." ASC";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0){
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			echo "";
		}
	} else {
		echo "0 results";
	}

	mysqli_close($conn);
?>