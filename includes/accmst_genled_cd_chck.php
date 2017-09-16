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

			$query1 = "SELECT * FROM $UserComDbf.$UserFduser.acmast WHERE acm_com = $UserComCd AND acm_unit	= $UserUntCd AND acm_accd = '$q'";
			$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
			$result1 = odbc_exec($conn, $query1);
			print(
				json_encode(
					array(
						'gen_desc'=>odbc_result($result, 1),
						'acm_com'=>odbc_result($result1, 1),
						'acm_unit'=>odbc_result($result1, 2),
						'acm_accd'=>odbc_result($result1, 3),
						'acm_opbal'=>odbc_result($result1, 4),
						'acm_baldt'=>odbc_result($result1, 5),
						'acm_sublink'=>odbc_result($result1, 6),
						'acm_prtag'=>odbc_result($result1, 7),
						'acm_bal'=>odbc_result($result1, 8),
						'acm_sch'=>odbc_result($result1, 9),
						'acm_schsrl'=>odbc_result($result1, 10),
						'acm_budget'=>odbc_result($result1, 11),
						'acm_userid'=>odbc_result($result1, 12),
						'acm_updid'=>odbc_result($result1, 13),
						'acm_sysdt'=>odbc_result($result1, 14),
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'gen_desc'=>'',
						'acm_com'=>'',
						'acm_unit'=>'',
						'acm_accd'=>'',
						'acm_opbal'=>'',
						'acm_baldt'=>'',
						'acm_sublink'=>'',
						'acm_prtag'=>'',
						'acm_bal'=>'',
						'acm_sch'=>'',
						'acm_schsrl'=>'',
						'acm_budget'=>'',
						'acm_userid'=>'',
						'acm_updid'=>'',
						'acm_sysdt'=>'',
						'passActn'=>$passActn
					)
				)
			);
		}
	}
?>