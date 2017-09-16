<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$UserComDbf = $_GET['UserComDbf'];
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];		
		$ReqDt = date('Ymd', strtotime($_GET['CrntDt']));
		
		require_once('cmp_pass_actn.php');

		$query = "declare @fyr smallint
	        exec catalog.dbo.finyear {$ComCd}, '{$ReqDt}', @fyr output
	        select @fyr";

		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);
		$finYear = odbc_result($result, 1);
		//print($finYear);

		$query1 = "SELECT max(par_lval) FROM $UserComDbf.invac.parinv WHERE par_com = $ComCd AND par_unit = $UntCd AND par_tbl = 'request' AND par_fyr = $finYear";
		$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result1 = odbc_exec($conn, $query1);
		$rows1 = odbc_fetch_row($result1);
		$maxReqNo = odbc_result($result1, 1)+1;

		if (!empty(odbc_result($result1, 1))) {

			$query2 = "SELECT max(req_srl) FROM catalog.invac.request WHERE req_com = $ComCd AND req_unit = $UntCd AND req_fyr = $finYear AND req_no = $maxReqNo";
			$result2 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
			$result2 = odbc_exec($conn, $query2);		
			$rows2 = odbc_fetch_row($result2);


			print(
				json_encode(
					array(
						'finYear' => $finYear,
						'req_no'=>$maxReqNo,
						'req_srl'=>odbc_result($result2, 1)+1,
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'finYear' => '',
						'req_no'=>'',
						'req_srl'=>odbc_result($result2, 1),
						'passActn'=>$passActn
					)
				)
			);
		}
	}

?>