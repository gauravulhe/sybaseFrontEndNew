<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];

		require_once('cmp_pass_actn.php');

		$UserFduser = $_GET["UserFduser"];
		$UserComDbf = $_GET["UserComDbf"];
		$UserComCd = $_GET["UserComCd"];
		$UserUntCd = $_GET["UserUntCd"];
		$AccCd = $_GET["AccCd"];

		$query = "SELECT * FROM $UserComDbf.$UserFduser.submast WHERE sub_com = $UserComCd AND sub_unit	= $UserUntCd AND sub_accd = '$AccCd' AND sub_subcd = '$q'";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);
		$rows = odbc_fetch_row($result);
		//print(odbc_result($result, 1));
		if (!empty(odbc_result($result, 1))) {
			print(
				json_encode(
					array(
						'sub_com'=>odbc_result($result, 1),
						'sub_unit'=>odbc_result($result, 2),
						'sub_accd'=>odbc_result($result, 3),
						'sub_subcd'=>odbc_result($result, 4),
						'sub_desc'=>odbc_result($result, 5),
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'sub_com'=>"",
						'sub_unit'=>"",
						'sub_accd'=>"",
						'sub_subcd'=>"",
						'sub_desc'=>"",
						'passActn'=>$passActn
					)
				)
			);
		}
	}

?>