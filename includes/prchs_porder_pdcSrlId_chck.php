<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$PoFinYr = $_GET['PoFinYr'];
		$PoPoCd = $_GET['PoPoCd'];
		$PoPdcSrlNo = $_GET['PoPdcSrlNo'];
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];

		require_once('cmp_pass_actn.php');

		$query = "SELECT  pdc_tag,pdc_amt,pdc_sys_dt FROM $UserComDbf.invac.pdcomm WHERE pdc_com = $ComCd AND pdc_unit = $UntCd AND	pdc_fyr = $PoFinYr AND pdc_po_no = $PoPoCd AND pdc_po_srl = $PoPdcSrlNo AND pdc_id = $q";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);		
		//print(odbc_result_all($result, "border=1"));

		if (!empty(odbc_result($result, 1))) {
			print(
				json_encode(
					array(
						'pdc_tag' => odbc_result($result, 1),
						'pdc_amt' => odbc_result($result, 2),
						'pdc_sys_dt' => date('d-m-Y', strtotime(odbc_result($result, 3))),
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'pdc_tag' => '',
						'pdc_amt' => '',
						'pdc_sys_dt' => '',
						'passActn'=>$passActn
					)
				)
			);
		}
	}

?>