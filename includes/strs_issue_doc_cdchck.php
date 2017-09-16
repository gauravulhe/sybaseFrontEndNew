<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$UserComDbf = $_GET['UserComDbf'];
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];
		$FrmNm = $_GET['FrmNm'];
		$ComPass = $_GET['ComPass'];
		$IssDt1 = date('Ymd', strtotime($_GET['IssDt']));
		$IssDt2 = date('Y-m-d 00:00:00', strtotime($_GET['IssDt']));

		require_once('cmp_pass_actn.php');

		$query = "declare @fyr smallint
	        exec catalog.dbo.finyear {$ComCd}, '{$IssDt1}', @fyr output
	        select @fyr";

		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);
		$finYear = odbc_result($result, 1);
		//print($finYear);

		$query1 = "SELECT max(par_lval) FROM $UserComDbf.invac.parinv WHERE par_com = $ComCd AND par_unit = $UntCd AND par_tbl = 'issue' AND par_col = $q AND par_fyr = $finYear";
		$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result1 = odbc_exec($conn, $query1);
		$rows1 = odbc_fetch_row($result1);
		$maxIssNo = odbc_result($result1, 1)+1;


		if (!empty(odbc_result($result, 1))) {

			$query2 = "SELECT max(iss_srl) FROM $UserComDbf.invac.issue WHERE iss_com = $ComCd AND iss_unit = $UntCd AND iss_fyr = $finYear AND iss_dt = '$IssDt2' AND iss_tc = $q AND iss_no = $maxIssNo";
			$result2 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
			$result2 = odbc_exec($conn, $query2);
			$rows2 = odbc_fetch_row($result2);
			$maxIssSrlNo = odbc_result($result2, 1)+1;

			print(
				json_encode(
					array(
						'iss_no'=>$maxIssNo,
						'iss_srl'=>$maxIssSrlNo,
						'iss_fyr'=>$finYear,
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'iss_no'=>'',
						'iss_srl'=>'',
						'iss_fyr'=>'',
						'passActn'=>$passActn
					)
				)
			);
		}
	}
?>