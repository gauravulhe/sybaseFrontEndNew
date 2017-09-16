<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){

		$q=$_GET["q"];
		$PoFinYr = $_GET['PoFinYr'];
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];
		$UserComDbf = $_GET['UserComDbf'];

		require_once('cmp_pass_actn.php');

		$query = "SELECT max(pod_po_srl) FROM $UserComDbf.invac.podet where pod_com = $ComCd AND pod_unit = $UntCd AND	pod_fyr = $PoFinYr AND pod_po_no = $q";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);
		$rows1 = odbc_fetch_row($result);
		print(
			json_encode(
				array(
					'pod_po_srl' => odbc_result($result, 1)+1,
					'passActn'=>$passActn
				)
			)
		);
	}

?>