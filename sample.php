<?php
    session_start();
    $q = array(1,5,3);
	$w = array(1,2,3);
	$e = array();
	$r = array();
	$flg = false;
	for($i = 0; $i < count($q); $i++){
		$e[$i] = $q;
		if($r[$i] == null){
			$flg = true;
		}
	}
	var_dump($q);
	var_dump("<br>");
	var_dump($w);
	var_dump("<br>");
	var_dump($e);
	var_dump("<br>");
	var_dump($r);
	var_dump("<br>");
	var_dump($flg);
	var_dump("<br>");
?>

<!DOCTYPE html>
<html>
<body>
	
</body>
</html>
