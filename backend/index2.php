<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>SHOPBACK</title>

      <!-- Bootstrap Core CSS -->
      <link href="../css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="../css/shop-homepage.css" rel="stylesheet">
  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Shopback</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Frontend</a>
                    </li>
                    <li>
                        <a href="#">Backend</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <?php
      if (isset($_POST['nama'])) {
        require_once('../connection.php');

        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $gambar = $_POST['gambar'];
        $rating = $_POST['rating'];
        $ulasan = $_POST['ulasan'];
        $url = $_POST['url'];
        $sumber = $_POST['sumber'];
        $logo = $_POST['logo'];

        foreach( $nama as $key => $n ) {
          // check sumber
          $sCountSumber = "SELECT Sumber_ID
              FROM sumber
              where Sumber_nama = '" . $sumber[$key] . "'";

        	$result = mysqli_query($conn, $sCountSumber);
          if (mysqli_num_rows($result) == 0){
            $sCreateSumber = "INSERT INTO sumber (Sumber_nama, Sumber_logo, Last_update) VALUES (" .
            "'" . $sumber[$key] . "'," .
            "'" . $logo[$key] . "'," .
            "now()" .
            ")";

            if (mysqli_query($conn, $sCreateSumber)) {
              $sumber_id = mysqli_insert_id($conn);
            }
          } else {
            $sumber_id = mysqli_fetch_array($result)[0];
          }
          // selesai check sumber

          // insert barang
          $sCountBarang = "SELECT Barang_ID
              FROM barang
              where Barang_gambar = '" . $gambar[$key] . "'";

        	$result = mysqli_query($conn, $sCountBarang);
          $final_harga = str_replace("Rp ","",$harga[$key]);
          $final_harga = str_replace(".","",$final_harga);
          echo $harga[$key] . "\n";
          if (mysqli_num_rows($result) == 0){
            $sCreateBarang = "INSERT INTO barang (Barang_nama, Barang_harga, Barang_gambar, Barang_rating, Barang_ulasan) VALUES (" .
            "'" . $nama[$key] . "'," .
            "'" . $final_harga . "'," .
            "'" . $gambar[$key] . "'," .
            "'" . $rating[$key] . "'," .
            "'" . $ulasan[$key] . "'" .
            ")";
            if (mysqli_query($conn, $sCreateBarang)) {
              $barang_id = mysqli_insert_id($conn);
            }
          } else {
            $barang_id = mysqli_fetch_array($result)[0];

            $sUpdateBarang = "UPDATE barang SET Barang_harga = " . $final_harga . ", Barang_rating = " . $rating[$key] . ", Barang_ulasan = " . $ulasan[$key] .
            " WHERE Barang_ID = " . $barang_id;

            mysqli_query($conn, $sUpdateBarang);
          }
          // selesai insert barang

          // link barang dengan sumber
          $sCountLink = "SELECT Barang_ID
              FROM sumber_barang
              where Barang_ID = '" . $barang_id . "' AND " .
              "Sumber_ID = '" . $sumber_id . "'";

        	$result = mysqli_query($conn, $sCountLink);
          if (mysqli_num_rows($result) == 0){
            $sCreateLink = "INSERT INTO sumber_barang (Sumber_ID, Barang_ID, Url) VALUES (" .
            "'" . $sumber_id . "'," .
            "'" . $barang_id . "'," .
            "'" . $url[$key] . "'" .
            ")";
            mysqli_query($conn, $sCreateLink);
          }
        }
      } else {
        require_once('grab.php');
        $datasource = loadData();
      }
    ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="row">
                    <!-- barang -->
                    <?php
                      $i = 0;
                      foreach($datasource as $product) {
                    ?>
                          <div class="col-sm-4 col-lg-3 col-md-3">
                            <div class="thumbnail">
                              <img src="<?php echo $datasource[$i][5]; ?>">
                              <img src="<?php echo $datasource[$i][2]; ?>">
                              <div class="caption">
                                <h4><a target="_blank" href="<?php echo $datasource[$i][6]; ?>"><?php echo $datasource[$i][0]; ?></a></h4>
                                <h4><?php echo $datasource[$i][1]; ?></h4>
                              </div>
                              <div class="ratings">
                                <?php echo $datasource[$i][3]; ?> / 5.0
                                (<?php echo $datasource[$i][4]; ?>)
                              </div>
                            </div>
                          </div>
                    <?php
                          $i++;
                        }
                    ?>
                    <form method="post">
                      <?php
                          $i = 0;
                          foreach($datasource as $product) {
                      ?>
                      <input type="hidden" name="nama[]" value="<?php echo $datasource[$i][0]; ?>" />
                      <input type="hidden" name="harga[]" value="<?php echo $datasource[$i][1]; ?>" />
                      <input type="hidden" name="gambar[]" value="<?php echo $datasource[$i][2]; ?>" />
                      <input type="hidden" name="rating[]" value="<?php echo $datasource[$i][3]; ?>" />
                      <input type="hidden" name="ulasan[]" value="<?php echo $datasource[$i][4]; ?>" />
                      <input type="hidden" name="url[]" value="<?php echo $datasource[$i][6]; ?>" />
                      <input type="hidden" name="sumber[]" value="<?php echo $datasource[$i][7]; ?>" />
                      <input type="hidden" name="logo[]" value="<?php echo $datasource[$i][5]; ?>" />
                      <?php
                            $i++;
                          }
                      ?>
                      <center><input type="submit" class="btn btn-primary" value="Masukkan ke Database"></center>
                    </form>
                    <!-- batas -->
                  </div>
                </div>
              </div>
            </div>
        </div>
			<!-- testing -->
<?php
//include 'homepage.php';
//  $paging = null;
//  if($total_page > 1){
//   $paging .= '<ul class="pagination">';

//   if($page > ($prev + 1)){
//    $paging .= '<li><a href="index.php?page=1">First</a></li>';
//    $paging .= '<li><a href="index.php?page='.($page - 1).'">Last</a></li>';
//   }

//   for($i=$start_page; $i<=$display_page; $i++){
//    if($i == $page){
//     $paging .= '<li class="active"><a href="#'.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
//    }else{
//     $paging .= '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
//    }
//   }

//   if($total_page > $display_page){
//    $paging .= '<li><a href="index.php?page='.($page + 1).'">Next</a></li>';
//    $paging .= '<li><a href="index.php?page='.$total_page.'">Prev</a></li>';
//   }

//   $paging .= '<ul>';
//  }
//  echo $paging;
 ?>
    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; UAS INTEGRASI DATA 2016</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

	<script>
		$('#myTabs a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		})
	</script>

</body>

</html>
