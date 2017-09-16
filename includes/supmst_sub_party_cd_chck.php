<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){

		$ComPass = $_GET['ComPass'];
		$FrmNm = $_GET['FrmNm'];

		$passQry = "SELECT pas_action FROM catalog..procpass WHERE pas_passwd = '$ComPass' AND pas_proc = '$FrmNm'";
		$passRslt = odbc_exec($conn, $passQry);
		$passActn = strtolower(odbc_result($passRslt, 1));

		$q=strtoupper($_GET["q"]);
		$GenLedCd = $_GET["GenLedCd"];
		$UserFduser = $_GET["UserFduser"];
		$UserComDbf = $_GET["UserComDbf"];
		$UserComCd = $_GET["UserComCd"];
		$UserUntCd = $_GET["UserUntCd"];

		$query = "SELECT * FROM $UserComDbf.$UserFduser.submast WHERE sub_com = $UserComCd AND sub_unit = $UserUntCd AND sub_accd = '$GenLedCd' AND sub_subcd = '$q'";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

		//perform the query
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
						'sub_opbal'=>odbc_result($result, 6),
						'sub_opbaldt'=>odbc_result($result, 7),
						'sub_cat'=>odbc_result($result, 8),
						'sub_agetag'=>odbc_result($result, 9),
						'sub_pancard'=>odbc_result($result, 10),
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'sub_com'=>'',
						'sub_unit'=>'',
						'sub_accd'=>'',
						'sub_subcd'=>'',
						'sub_desc'=>'',
						'sub_opbal'=>'',
						'sub_opbaldt'=>'',
						'sub_cat'=>'',
						'sub_agetag'=>'',
						'sub_pancard'=>'',
						'passActn'=>$passActn
					)
				)
			);
		}
	}
?>