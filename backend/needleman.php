<?php


function checkWords($t1, $t2) {

	$text1=strtolower($t1);
	$text2=strtolower($t2);

	//echo $text1.'<br>';
	//echo $text2.'<br>';

	$match=5;
	$mismatch=-1;
	$gap=-2;

	$panjang1=strlen($text1);
    $panjang2=strlen($text2);
	$matriks[$panjang1+1][$panjang2+1]=array();

	$x=0;
	$y=0;
	while($x<=$panjang2){
		$y=0;
		while($y<=$panjang1){
			if($x==0){
				if($y==0){$matriks[0][0]=0;}
				else{$matriks[0][$y]=$y*$gap;}
			}
			else{
				if($y==0){$matriks[$x][0]=$x*$gap;}
				/* mulai perhitungan */
				else{
					$p_up=0;$p_left=0;$p_diag=0;
					if(ord(substr($text2,$x-1,1))==ord(substr($text1,$y-1,1))){
						$matriks[$x][$y]=$matriks[$x-1][$y-1]+$match;
					}else{
						$p_diag=$matriks[$x-1][$y-1];
						$p_up=$matriks[$x-1][$y];
						$p_left=$matriks[$x][$y-1];
						if($p_diag>=$p_up and $p_diag>=$p_left){
							$matriks[$x][$y]=$matriks[$x-1][$y-1]+$mismatch;
						}elseif($p_up>=$p_left){
							$matriks[$x][$y]=$matriks[$x-1][$y]+$gap;
						}elseif($p_left>=$p_up){
							$matriks[$x][$y]=$matriks[$x][$y-1]+$gap;
						}
					}
				}
			}
			$y++;
		}
		$x++;
	}

	//print_r($matriks);


	$a=$panjang2;
	$b=$panjang1;
	$w1='';
	$w2='';
	while($a>0 and $b>0){
		if($matriks[$a-1][$b-1]>=$matriks[$a-1][$b] and $matriks[$a-1][$b-1]>=$matriks[$a][$b-1]){
			$w1=$w1.substr($text2,$a-1,1);
			$w2=$w2.substr($text1,$b-1,1);
			$a--;
			$b--;
		}elseif($matriks[$a-1][$b]>=$matriks[$a][$b-1]){
			$w1=$w1.substr($text2,$a-1,1);
			$w2=$w2."-";
			$a--;
		}else{
			$w2=$w2.substr($text1,$b-1,1);
			$w1=$w1."-";
			$b--;
		}
	}

	//echo '<br>'.$w1;
	//echo '<br>'.$w2;

	$z=strlen($w1);
	// echo $z . '<br>';
	$podo=0;
	while($z>0){
		if(substr($w1,$z,1)==substr($w2,$z,1)){
			$podo++;
		}
	$z--;
	}
	// echo $w1 . '<br>';
	// echo $w2 . '<br>';
	// echo $podo;
	// exit;

	return number_format($podo/strlen($w1), 3);
	// return number_format($podo/strlen($w1), 3);
}

//$a='tress';
//$b='tess';

//checkWords($a,$b);
?>
