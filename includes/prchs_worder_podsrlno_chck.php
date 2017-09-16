<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$PoFinYr = $_GET['PoFinYr'];
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];

		require_once('cmp_pass_actn.php');

		$query = "SELECT  max(pod_po_srl) FROM $UserComDbf.invac.podet WHERE pod_com = $ComCd AND pod_unit = $UntCd AND	pod_fyr = $PoFinYr AND pod_po_no = $q";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);
		$PodSrlNo = odbc_result($result, 1) + 1;
		//print(odbc_result_all($result, "border=1"));

		if (!empty(odbc_result($result, 1))) {
			print(
				json_encode(
					array(
						'PodSrlNo' => $PodSrlNo,
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'PodSrlNo' => $PodSrlNo,
						'passActn'=>$passActn
					)
				)
			);
		}
	}

?>