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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="row">
				<!-- halaman cari -->
					<div class="container">
						<div class="col-md-6 col-md-offset-3">
							<img src="img/SB-Logo.png" class="img-responsive" alt="">
						</div>
					</div>
					<br>
					<div class="container">
						<div class="col-lg-3"></div>
						<div class="col-lg-6">
							<form action="index.php" method="get">
								<div class="form-group">
									<input type="text" name="kata" class="form-control" placeholder="Search" required>
									<select name="urutan" class="form-control">
										<option value="1">Nama</option>
										<option value="2">Harga</option>
										<option value="3">Rating</option>
									</select>
									<input class="btn btn-default center-block" type="submit" value="Cari">
									<!-- /input-group -->
								</div>
							</form>
						</div><!-- /.col-lg-6 -->

					<br/><br/><br/>
					</div>

					<br/><br/>
				</div>

				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">

						<?php
							if(isset($_GET["kata"])){include 'index2.php';};

						?>

				<!-- isi data awal -->
<?php
include 'homepage.php';
  while($row = mysqli_fetch_array($rs)){

?>
							<div class="col-sm-4 col-lg-3 col-md-3">
					<div class="thumbnail">
						<img src="<?php echo $row["Sumber_logo"];?>" class="img-responsive" alt="">
						<img src="<?php echo $row["Barang_gambar"];?>" class="img-responsive" alt="">
						<div class="caption">
							<h4><a href="<?php echo $row["Url"];?>"><?php echo $row["Barang_nama"];?></a></h4>
							<h4><?php echo "Rp " . number_format($row["Barang_harga"], 0, ",",".");?></h4>
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
							<?php } ?>
							<!-- batas -->
						</div>
					</div>
				</div>
            </div>

        </div>
			<!-- testing -->
<?php
include 'homepage.php';
  $paging = null;
  if($total_page > 1){
   $paging .= '<ul class="pagination">';

   if($page > ($prev + 1)){
    $paging .= '<li><a href="index.php?page=1">First</a></li>';
    $paging .= '<li><a href="index.php?page='.($page - 1).'">Last</a></li>';
   }

   for($i=$start_page; $i<=$display_page; $i++){
    if($i == $page){
     $paging .= '<li class="active"><a href="#'.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
    }else{
     $paging .= '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
    }
   }

   if($total_page > $display_page){
    $paging .= '<li><a href="index.php?page='.($page + 1).'">Next</a></li>';
    $paging .= '<li><a href="index.php?page='.$total_page.'">Prev</a></li>';
   }

   $paging .= '<ul>';
  }
  echo $paging;
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
