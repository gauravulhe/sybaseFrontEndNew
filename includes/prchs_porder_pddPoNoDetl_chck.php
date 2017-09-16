<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$PoFinYr = $_GET['PoFinYr'];
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];

		require_once('cmp_pass_actn.php');

		$query = "SELECT  pdd_po_srl,pdd_sch_dt,pdd_stag_qty FROM $UserComDbf.invac.pddet WHERE pdd_com = $ComCd AND pdd_unit = $UntCd AND	pdd_fyr = $PoFinYr AND pdd_po_no = $q";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);		
		//print(odbc_result_all($result, "border=1"));

		$rows = array();

		while ($myRow = odbc_fetch_array($result)) {
			$rows[] = $myRow;
		}

		$pdd_data = '<table><tr><th>Srl</th><th>Sch. Date</th><th>Sch. Qty</th><th>S(Y/N)</th></tr>';
		foreach ($rows as $row) {
			$pdd_data .= '<tr>';
			$pdd_data .= '<td><input type="text" name="pdd_po_srl[]" id="pdd_po_srl" value="'.$row['pdd_po_srl'].'" readonly maxlength="5" size="1" ></td>';
			$pdd_data .= '<td><input type="text" name="pdd_sch_dt[]" id="pdd_sch_dt" value="'.date('d-m-Y', strtotime($row['pdd_sch_dt'])).'" maxlength="10" size="10"></td>';
			$pdd_data .= '<td><input type="text" name="pdd_stag_qty[]" id="pdd_stag_qty" value="'.$row['pdd_stag_qty'].'" maxlength="10" size="3"></td>';
			$pdd_data .= '<td><input type="text" name="pdd_con[]" id="pdd_con" placeholder="Y/N" style="text-transform: uppercase" maxlength="1" size="1"></td>';
			$pdd_data .= '<tr>';
		}
		$pdd_data .= '<table>';

		//print($pdd_data);

		if (!empty(odbc_result($result, 1))) {
			print(
				json_encode(
					array(
						'pdd_po_srl' => odbc_result($result, 1),
						'pdd_sch_dt' => odbc_result($result, 2),
						'pdd_stag_qty' => odbc_result($result, 3),
						'pddData' => $pdd_data,
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'pdd_po_srl' => '',
						'pdd_sch_dt' => '',
						'pdd_stag_qty' => '',
						'pddData' => '',
						'passActn'=>$passActn
					)
				)
			);
		}
	}

?>