<form method="get">
  <?php
    if (isset($_GET['keywords'])) {
      echo '<input type="text" placeholder="Kata Kunci" name="keywords" value="' . $_GET['keywords'] . '">';
    }
    else {
      echo '<input type="text" placeholder="Kata Kunci" name="keywords">';
    }
  ?>
  <button>search</button>
</form>
<br>
<table border="1">
  <tr>
    <th>Nama</th>
    <th>Similiarity</th>
  </tr>
<?php
  require_once('grab.php');
  require_once('needleman.php');

  if (isset($_GET['keywords'])) {

    $datasource = loadData();
    $datasource2 = array(array());

//    $i = 0;
//    foreach($datasource as $product) {
//      $datasource2[$i][0] = $product;
//      $datasource2[$i][1] = checkWords(isset($_GET['keywords']), $product);
//      $i++;
//    }

    $i = 0;
    foreach($datasource as $product) {
      echo '<tr>';
        echo '<td>' . $datasource[$i][6] . '</td>';
        echo '<td>' . $datasource[$i][2] . '</td>';
        echo '<td>' . $datasource[$i][0] . '</td>';
        echo '<td>' . $datasource[$i][1] . '</td>';
        echo '<td>' . $datasource[$i][4] . '</td>';
        echo '<td>' . $datasource[$i][5] . '</td>';
      echo '</tr>';
      $i++;
    }
  }
  else {
    echo '<td colspan=2>&nbsp;&nbsp;Silakan Masukkan "kata kunci" Terlebih dahulu&nbsp;&nbsp;</td>';
  }
?>
</table>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
