<?php
require_once('simple_html_dom.php');

function loadBL() {
  $datasource2 = array(array());

  $j = 0;
  for ($i=1; $i < 2; $i++) {
    $bukalapak = file_get_html("https://www.bukalapak.com/c/komputer/laptop?page=" . $i);
    $bl_div = $bukalapak->find('div[class=basic-products]',0);
    $bl_ul = $bl_div->find('ul[class=products]',0);
    $bl_products = $bl_ul->find('li');
    foreach($bl_products as $element) {
      $product_name = $element->children(0)->children(0)->getAttribute("data-name");
      $isInstallment = $element->find('div[class=product-price]',0)->getAttribute('installment');
      if ($isInstallment == true) {
          $product_harga = $element->find('span[class=product-price__installment]',0)->find('span[class=amount]',0)->innertext;
      } else {
        if ($element->find('span[product-price__reduced]',0) != null) {
          $product_harga = $element->find('div[class=product-price]',0)->find('span[product-price__reduced]',0)->find('span[class=amount]',0)->innertext;
        } else {
          $product_harga = $element->find('div[class=product-price]',0)->find('span[class=amount]',0)->innertext;
        }
      }
      $product_gambar = $element->children(0)->children(0)->children(0)->children(0)->innertext;
      $product_url = $element->children(0)->children(0)->children(0)->children(0)->getAttribute("href");
      $product_rating = $element->find('div[class=product__rating]',0)->children(0);
      $product_ulasan = $element->find('div[class=product__rating]',0);
      if ($product_rating == null) {
          $product_rating = "0.0";
          $product_ulasan = "0";
      } else {
          $product_rating = $product_rating->getAttribute("title");
          $product_ulasan = $product_ulasan->find('a[class=review__aggregate]',0)->children(0)->innertext;
      }

      $datasource2[$j][0] = $product_name;
      $datasource2[$j][1] = $product_harga;
      $datasource2[$j][2] = $product_gambar;
      $datasource2[$j][3] = $product_rating;
      $datasource2[$j][4] = $product_ulasan;
      $datasource2[$j][5] = "http://www.klikforedi.com/wp-content/uploads/2016/08/logobukalapak-01.png";
      $datasource2[$j][6] = "https://bukalapak.com" . $product_url;

      $j++;
    }
  }

  return $datasource2;
}

function loadElevenia() {
  $datasource = array();
  $datasource2 = array(array());

  $j = 0;
  for ($i=1; $i < 2; $i++) {
    $elevenia = file_get_html("http://www.elevenia.co.id/ctg-laptop-notebook-1?pageNum=" . $i);

    $lz_div = $lazada->find('div[id=product_listing]',0);
    $lz_ul = $lz_div->find('ul[class=albumList]');
    foreach($lz_ul as $element1) {
      $lz_products = $element1->find('li',0);
      $product = $lz_products->children(3)->innertext;
      $product_name = $lz_products->children(3)->innertext;
//      array_push($datasource, $product);
      $datasource2[$j][0] = $product;
      $datasource2[$j][1] = "test";
      // echo $lz_products[0]->children(3)->innertext . "<br>";
      // foreach($lz_products as $element) {
      //   // $product = $element->children(3)->innertext;
      //   // array_push($datasource, $product);
      //   // $txt = $product . "\n";
      //   // fwrite($myfile, $txt);
      // }
      $j++;
    }

    $lz_div = $elevenia->find('div[id=product_listing]',0);
    $lz_ul = $lz_div->find('div[class=product-card]');
    foreach($lz_ul as $element1) {
      $product_name = $element1->find('div[class=product-card__name-wrap]',0)->children(0)->innertext;

      $datasource2[$j][0] = "<a target='_blank' href='https://bukalapak.com'>" . $product_name . "</a>";
      $datasource2[$j][1] = "";
      $datasource2[$j][2] = "";
      $datasource2[$j][3] = 1; //stock
      $datasource2[$j][4] = "";
      $datasource2[$j][5] = "";
      $datasource2[$j][6] = "http://www.elevenia.co.id/img_11ia/h1_logo_ver2.png";
      // echo $lz_products[0]->children(3)->innertext . "<br>";
      // foreach($lz_products as $element) {
      //   // $product = $element->children(3)->innertext;
      //   // array_push($datasource, $product);
      //   // $txt = $product . "\n";
      //   // fwrite($myfile, $txt);
      // }
      $j++;
    }
  }

  return $datasource2;
}

function loadData() {
//  $dataElevenia = loadElevenia();
//  return $dataElevenia;
  $dataBL = loadBL();
  return $dataBL;

  $datasource = array_merge($dataBL, $dataElevenia);

  return $datasource;
}

//
// // GRAB Tokopedia
// echo "<b>TOKOPEDIA</b>" . "<br>";
// $tokopedia = file_get_html("https://ace.tokopedia.com/search/v1/product?q=" . $keywords);
// $toped_products = json_decode($tokopedia);
// foreach($toped_products->data as $element)
//       echo $element->name . '<br>';
// //        echo $element . '<br>';
//       //  echo $element->children(1)->find('div[class=detail]',0)->children(0) . '<br>';
