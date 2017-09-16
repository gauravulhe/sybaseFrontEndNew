<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=strtoupper($_GET["q"]);
		$UserFduser = trim($_GET['UserFduser']);
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];

		$query = "SELECT sup.sup_supcd, sup.sup_name, sub.sub_accd, gen.gen_desc, sup.sup_gst_class, sup.sup_stct_cd 
					FROM catalog..supcat sup
					LEFT JOIN $UserComDbf.$UserFduser.submast sub
					ON sup.sup_supcd = sub.sub_subcd
					LEFT JOIN catalog..gencat gen
					ON sub.sub_accd = gen.gen_accd WHERE sub_com = $ComCd AND sub_unit = $UntCd AND sup.sup_gst_class >= 0 AND sub_subcd = '$q' ORDER BY sub_accd DESC";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);
		$rows1 = odbc_fetch_row($result);


		if (!empty(odbc_result($result, 1))) {
			$cntCode = substr(odbc_result($result, 6), 0,3);
			$stCode = substr(odbc_result($result, 6), 3,-3);
			$ctCode = substr(odbc_result($result, 6), 5,7);
			print(
				json_encode(
					array(
						'sup_name' => odbc_result($result, 2),
						'sup_cd' => odbc_result($result, 3),
						'gen_desc' => odbc_result($result, 4),
						'cntCode' => $cntCode,
						'stCode' => $stCode,
						'ctCode' => $ctCode
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'sup_name' => '',
						'sup_cd' => '',
						'gen_desc' => '',
						'cntCode' => '',
						'stCode' => '',
						'ctCode' => ''
					)
				)
			);
		}
	}

?>