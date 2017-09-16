<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];
		$PoDt = date('Ymd', strtotime($_GET['PoDt']));

		require_once('cmp_pass_actn.php');

		$query = "declare @fyr smallint
	        exec catalog.dbo.finyear {$ComCd}, '{$PoDt}', @fyr output
	        select @fyr";

		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);
		$finYear = odbc_result($result, 1);
		// print($finYear);

		$query1 = "SELECT max(par_lval) FROM $UserComDbf.invac.parinv WHERE par_com = $ComCd AND par_unit = $UntCd AND par_tbl = 'pohdr' AND par_col = 1 AND par_fyr = $finYear";
		$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result1 = odbc_exec($conn, $query1);
		$rows1 = odbc_fetch_row($result1);
		$maxPoNo = odbc_result($result1, 1)+1;

		if (!empty(odbc_result($result1, 1))) {
			print(
				json_encode(
					array(
						'finYear' => $finYear,
						'poh_po_no'=>$maxPoNo,
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'finYear' => '',
						'poh_po_no'=>'',
						'passActn'=>$passActn
					)
				)
			);
		}
	}

?>