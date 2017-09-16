<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$PoFinYr = $_GET['PoFinYr'];
		$PoPoCd = $_GET['PoPoCd'];
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];

		require_once('cmp_pass_actn.php');

		$query = "SELECT  pod_item,pod_tech_spec,pod_rate,pod_ord_qty,pod_tolerance FROM $UserComDbf.invac.podet WHERE pod_com = $ComCd AND pod_unit = $UntCd AND	pod_fyr = $PoFinYr AND pod_po_no = $PoPoCd AND pod_po_srl = $q";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);		
		//print(odbc_result_all($result, "border=1"));

		if (!empty(odbc_result($result, 1))) {
			print(
				json_encode(
					array(
						'pod_item' => odbc_result($result, 1),
						'pod_tech_spec' => odbc_result($result, 2),
						'pod_rate' => odbc_result($result, 3),
						'pod_ord_qty' => odbc_result($result, 4),
						'pod_tolerance' => odbc_result($result, 5),
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'pod_item' => '',
						'pod_tech_spec' => '',
						'pod_rate' => '',
						'pod_ord_qty' => '',
						'pod_tolerance' => '',
						'passActn'=>$passActn
					)
				)
			);
		}
	}

?>