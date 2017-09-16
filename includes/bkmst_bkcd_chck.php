<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];

		require_once('cmp_pass_actn.php');

		if (!empty($_GET['UserComCd'])) {

			$UserFduser = $_GET["UserFduser"];
			$UserComDbf = $_GET["UserComDbf"];
			$UserComCd = $_GET["UserComCd"];
			$UserUntCd = $_GET["UserUntCd"];

			$query = "SELECT * FROM $UserComDbf.$UserFduser.bkmast WHERE bkm_com = $UserComCd AND bkm_unit	= $UserUntCd AND bkm_code = $q";
			$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
			$result = odbc_exec($conn, $query);
			$rows = odbc_fetch_row($result);
			//print(odbc_result($result, 1));
			if (!empty(odbc_result($result, 1))) {
				print(
					json_encode(
						array(
							'bkm_com'=>odbc_result($result, 1),
							'bkm_unit'=>odbc_result($result, 2),
							'bkm_code'=>odbc_result($result, 3),
							'bkm_desc'=>odbc_result($result, 4),
							'bkm_accd'=>odbc_result($result, 5),
							'bkm_opbal'=>odbc_result($result, 6),
							'bkm_baldt'=>odbc_result($result, 7),
							'bkm_prefix'=>odbc_result($result, 8),
							'passActn'=>$passActn
						)
					)
				);
			}else{
				print(
					json_encode(
						array(
							'bkm_com'=>"",
							'bkm_unit'=>"",
							'bkm_code'=>"",
							'bkm_desc'=>"",
							'bkm_accd'=>"",
							'bkm_opbal'=>"",
							'bkm_baldt'=>"",
							'bkm_prefix'=>"",
							'passActn'=>$passActn
						)
					)
				);
			}
		}else{
			$q = $_GET['q'];
			$query = "SELECT gen_desc FROM catalog..gencat WHERE gen_accd = '$q'";
			$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

			//perform the query
			$result = odbc_exec($conn, $query);
			$rows = odbc_fetch_row($result);
			//print(odbc_result($result, 1));
			if (!empty(odbc_result($result, 1))) {
				print(
					json_encode(
						array(
							'gen_desc'=>odbc_result($result, 1),
							'passActn'=>$passActn
						)
					)
				);
			}else{
				print(
					json_encode(
						array(
							'gen_desc'=>'',
							'passActn'=>$passActn
						)
					)
				);
			}
		}
	}

?>