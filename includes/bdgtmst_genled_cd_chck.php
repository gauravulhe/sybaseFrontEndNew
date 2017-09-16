<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];

		require_once('cmp_pass_actn.php');

		$query = "SELECT gen_desc FROM catalog..gencat WHERE gen_accd = '$q'";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

		//perform the query
		$result = odbc_exec($conn, $query);
		$rows = odbc_fetch_row($result);
		//print(odbc_result($result, 1));
		if (!empty(odbc_result($result, 1))) {

			$UserFduser = $_GET["UserFduser"];
			$UserComDbf = $_GET["UserComDbf"];
			$UserComCd = $_GET["UserComCd"];
			$UserUntCd = $_GET["UserUntCd"];

			$query1 = "SELECT * FROM $UserComDbf.$UserFduser.budgmast WHERE bud_com = $UserComCd AND bud_unit	= $UserUntCd AND bud_accd = '$q'";
			$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
			$result1 = odbc_exec($conn, $query1);
			print(
				json_encode(
					array(
						'gen_desc'=>odbc_result($result, 1),
						'bud_com'=>odbc_result($result1, 1),
						'bud_unit'=>odbc_result($result1, 2),
						'bud_yy'=>odbc_result($result1, 3),
						'bud_mm'=>odbc_result($result1, 4),
						'bud_accd'=>odbc_result($result1, 5),
						'bud_subcd'=>odbc_result($result1, 6),
						'bud_bud_amt'=>odbc_result($result1, 7),
						'bud_act_amt'=>odbc_result($result1, 8),
						'bud_entid'=>odbc_result($result1, 9),
						'bud_entdt'=>odbc_result($result1, 10),
						'bud_updid'=>odbc_result($result1, 11),
						'bud_upddt'=>odbc_result($result1, 12),
						'bud_sublink'=>odbc_result($result1, 13),
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'gen_desc'=>'',
						'bud_com'=>'',
						'bud_unit'=>'',
						'bud_yy'=>'',
						'bud_mm'=>'',
						'bud_accd'=>'',
						'bud_subcd'=>'',
						'bud_bud_amt'=>'',
						'bud_act_amt'=>'',
						'bud_entid'=>'',
						'bud_entdt'=>'',
						'bud_updid'=>'',
						'bud_upddt'=>'',
						'bud_sublink'=>'',
						'passActn'=>$passActn
					)
				)
			);
		}
	}
?>