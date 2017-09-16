<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$UserComDbf = $_GET['UserComDbf'];
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];
		$FrmNm = $_GET['FrmNm'];
		$ComPass = $_GET['ComPass'];
		$IssFyr = $_GET['IssFyr'];
		$IssTc = $_GET['IssTc'];
		$IssNo = $_GET['IssNo'];
		$IssDt = date('Y-m-d', strtotime($_GET['IssDt']));

		require_once('cmp_pass_actn.php');

		$query1 = "SELECT * FROM $UserComDbf.invac.issue WHERE iss_com = $ComCd AND iss_unit = $UntCd AND iss_fyr = $IssFyr AND iss_dt = '$IssDt' AND iss_tc = $IssTc AND iss_no = $IssNo AND iss_srl = $q";
		$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result1 = odbc_exec($conn, $query1);
		//print(odbc_result($result1, 1));

		if (!empty(odbc_result($result1, 1)) && ($passActn == 'e' || $passActn == 'b')) {

			print(
				json_encode(
					array(
						'iss_no'=>odbc_result($result1, 1),
						'iss_item'=>odbc_result($result1, 8),
						'passActn'=>$passActn
					)
				)
			);
		}elseif (!empty(odbc_result($result1, 1)) && $passActn == 'u') {

			print(
				json_encode(
					array(
						'iss_item' => odbc_result($result1, 8),
						'iss_qty' => odbc_result($result1, 9),
						'iss_rate' => odbc_result($result1, 10),
						'iss_fcd' => odbc_result($result1, 11),
						'iss_dept' => odbc_result($result1, 12),
						'iss_cost' => odbc_result($result1, 13),
						'iss_ptycd' => odbc_result($result1, 14),
						'iss_trf_item' => odbc_result($result1, 15),
						'iss_truck_no' => odbc_result($result1, 16),
						'iss_ref_no' => odbc_result($result1, 17),
						'iss_ref_srl' => odbc_result($result1, 18),
						'iss_ref_dt' => date('d-m-Y', strtotime(odbc_result($result1, 19))),
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'iss_no'=>'',
						'iss_item'=>'',
						'passActn'=>$passActn
					)
				)
			);
		}
	}
?>