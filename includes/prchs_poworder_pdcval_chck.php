<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		//unset($_SESSION['powo']);
		if (!empty($_SESSION['powo']['PdcVal']) && $_SESSION['powo']['PdcVal'] == $q) {
			print(
				json_encode(
					array(
						'PdcVal' => $q,
						'PdcArr' => $_SESSION['powo']['PdcVal']
					)
				)
			);
		}else{
			$_SESSION['powo']['PdcVal'] = $q;
			print(
				json_encode(
					array(
						'PdcVal' => ''
					)
				)
			);
		}
	}elseif(isset($_GET["qdt"])){
		$q=$_GET["qdt"];
		//unset($_SESSION['powo']);
		if (!empty($_SESSION['powo']['PddVal']) && $_SESSION['powo']['PddVal'] == $q) {
			print(
				json_encode(
					array(
						'PddVal' => $q,
						'PddArr' => $_SESSION['powo']['PddVal']
					)
				)
			);
		}else{
			$_SESSION['powo']['PddVal'] = $q;
			print(
				json_encode(
					array(
						'PddVal' => ''
					)
				)
			);
		}
	}

?>