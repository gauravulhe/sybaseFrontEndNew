<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$StCd=$_GET['StCd'];

		$query = "SELECT cod_desc,cod_code FROM catalog..codecat WHERE cod_prefix = 19 AND cod_code = $q";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);
		$rows1 = odbc_fetch_row($result);

		if (!empty(odbc_result($result, 1))) {
			$gstCd = odbc_result($result, 2);
			if ($gstCd == 1) {
				$gstPer = '18';
			}elseif ($gstCd == 2) {
				$gstPer = '05';
			}elseif ($gstCd == 3) {
				$gstPer = '12';
			}elseif ($gstCd == 4) {
				$gstPer = '28';
			}elseif ($gstCd == 0 || $gstCd == 50) {
				$gstPer = '0';
			}

			if ($StCd != 27) {
				$igstPer = $gstPer;
				$sgst = '0';
				$cgst = '0';
				$ugst = '0';
			}elseif ($StCd == 27) {
				$igstPer = '0';
				$sgstPer = $gstPer/2;
				$cgstPer = $gstPer/2;
				$ugstPer = '0';
			}

			print(
				json_encode(
					array(
						'cod_desc' => odbc_result($result, 1),
						'gstPer' => number_format($gstPer, 2),
						'igstPer' => number_format($igstPer, 2),
						'sgstPer' => number_format($sgstPer, 2),
						'cgstPer' => number_format($cgstPer, 2),
						'ugstPer' => number_format($ugstPer, 2)
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'cod_desc' => '',
						'gstPer' =>  '',
						'igstPer' => '',
						'sgstPer' => '',
						'cgstPer' => '',
						'ugstPer' => ''
					)
				)
			);
		}
	}

?>