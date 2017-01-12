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
    //include 'homepage.php';
    //  while($row = mysqli_fetch_array($rs)){
      require_once('grab.php');
      $datasource = loadData();
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
                              <?php echo $datasource[$i][2]; ?>
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
                    <center><button class="btn btn-primary">Masukkan ke Database</buton></center>
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
