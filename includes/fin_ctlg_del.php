<?php 
	
	require_once('../config/config.php');
	if(isset($_GET["q"])){
		$q = $_GET["q"];
		$FrmNm = $_GET["FrmNm"];

		// if ($FrmNm == 'comcat') {
		// 	$u = $_GET['u'];
		// 	$query = "DELETE FROM catalog..comcat WHERE com_com = $q AND com_unit = $u";
		// }

		if ($FrmNm == 'gencat') {
			$query = "DELETE FROM catalog..gencat WHERE gen_accd = '$q'";
		}

		if ($FrmNm == 'acmast') {			
			$q = strtoupper($_GET["q"]);
			$UserComCd = $_GET['UserComCd'];
			$UserUntCd = $_GET['UserUntCd'];
			$UserFduser = $_GET["UserFduser"];
			$UserComDbf = $_GET['UserComDbf'];
			$query = "DELETE FROM $UserComDbf.$UserFduser.acmast WHERE acm_com = $UserComCd AND acm_unit = $UserUntCd AND acm_accd = '$q'";
		}

		if ($FrmNm == 'bkmast') {			
			$q = strtoupper($_GET["q"]);
			$UserComCd = $_GET['UserComCd'];
			$UserUntCd = $_GET['UserUntCd'];
			$UserFduser = $_GET["UserFduser"];
			$UserComDbf = $_GET['UserComDbf'];
			$query = "DELETE FROM $UserComDbf.$UserFduser.bkmast WHERE bkm_com = $UserComCd AND bkm_unit = $UserUntCd AND bkm_code = $q";
		}

		if ($FrmNm == 'budgmast') {			
			$q = strtoupper($_GET["q"]);
			$UserComCd = $_GET['UserComCd'];
			$UserUntCd = $_GET['UserUntCd'];
			$UserFduser = $_GET["UserFduser"];
			$UserComDbf = $_GET['UserComDbf'];
			$query = "DELETE FROM $UserComDbf.$UserFduser.budgmast WHERE bud_com = $UserComCd AND bud_unit = $UserUntCd AND bud_accd = '$q'";
		}

		// if ($FrmNm == 'itemcat') {
		// 	$query = "DELETE FROM catalog..itmcat WHERE itm_item = '$q'";
		// }

		// if ($FrmNm == 'deptent') {
		// 	$u = $_GET["u"];
		// 	$query = "DELETE FROM catalog..deptcat WHERE dep_prefix = $q AND dep_cd = $u";
		// }

		// if ($FrmNm == 'supeccmst') {			
		// 	$q = strtoupper($_GET["q"]);
		// 	$query = "DELETE FROM catalog..supeccmst WHERE esup_supcd = '$q'";
		// }

		// if ($FrmNm == 'supcat') {			
		// 	$q = strtoupper($_GET["q"]);
		// 	$query = "DELETE FROM catalog..supcat WHERE sup_supcd = '$q'";
		// }		

		// if ($FrmNm == 'submast') {			
		// 	$q=strtoupper($_GET["q"]);
		// 	$GenLedCd = $_GET["GenLedCd"];
		// 	$UserFduser = $_GET["UserFduser"];
		// 	$UserComDbf = $_GET["UserComDbf"];
		// 	$UserComCd = $_GET["UserComCd"];
		// 	$UserUntCd = $_GET["UserUntCd"];
		// 	$query = "DELETE FROM $UserComDbf.$UserFduser.submast WHERE sub_com = $UserComCd AND sub_unit = $UserUntCd AND sub_accd = '$GenLedCd' AND sub_subcd = '$q'";
		// }

		
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

		//perform the query
		$result = odbc_exec($conn, $query);
	}
?>