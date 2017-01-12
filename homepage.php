<?php
 include_once("connection.php");
 // set page
 $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

 // data akan di tampilkan 10 baris perhalaman
 $perpage = 10;

 // metentukan offset
 // offset sendiri menentukan data yang akan di lewati setiap baris
 $limit = ($page - 1) * $perpage;

 $prev = 1;
 $next = 2;

 // menentukan angka awal untuk paging
 $start_page = ($page - $prev) < 1 ? 1 : ($page - $prev);

 // set query
 $sql = 'SELECT * FROM barang';

 // menentukan jumlah data yang ada di table users
 $rs = mysqli_query($conn,$sql);
 $record = mysqli_num_rows($rs);

 // menentukan total paging
 $total_page = ceil($record / $perpage);

 // menentukan jumlah angka yang akan di tampilkan
 $display_page = $start_page + $prev + $next;
 if($display_page > $total_page){
  $display_page = $total_page;
 }

 // memecah data berdasarkan :
 // $limit : data awal yang akan di lewati
 // $perpage : jumlah data yang akan di tampilkan
 $sql .= ' LIMIT '.$limit.','.$perpage;
 $rs = mysqli_query($conn,$sql);
?>	
