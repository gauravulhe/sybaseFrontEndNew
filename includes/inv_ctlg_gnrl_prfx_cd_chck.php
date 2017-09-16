<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){

		$q = $_GET["q"];
		$u = $_GET["u"];
		$FrmNm = $_GET['FrmNm'];		
		$ComPass = $_GET['ComPass'];
		$passQry = "SELECT pas_action FROM catalog..procpass WHERE pas_passwd = '$ComPass' AND pas_proc = '$FrmNm'";
		$passRslt = odbc_exec($conn, $passQry);
		$passActn = strtolower(odbc_result($passRslt, 1));
		//print($passActn);

		if($_GET["u"] == ''){

			$query = "SELECT max(cod_code) FROM catalog..codecat WHERE cod_prefix = $q";
			$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

			//perform the query
			$result = odbc_exec($conn, $query);
			if (!empty(odbc_result($result, 1))) {
				
					if ($passActn == 'e') {
						print(
							json_encode(
								array(
									'a'=>odbc_result($result, 1) + 1,
									'passActn' => $passActn 
								)
							)
						);
					}elseif ($passActn == 'u') {
						print(
							json_encode(
								array(
									'a'=> '',
									'passActn' => $passActn 
								)
							)
						);
					}elseif ($passActn == 'd') {
						print(
							json_encode(
								array(
									'a'=> '',
									'passActn' => $passActn 
								)
							)
						);
					}
			}
		}elseif($_GET["u"] != ''){
			
			$query = "SELECT cod_desc FROM catalog..codecat WHERE cod_prefix = $q AND cod_code = $u";
			
			$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

			//perform the query
			$result = odbc_exec($conn, $query);
			//print(odbc_result($result, 1));
			if (!empty(odbc_result($result, 1))) {
				print(
					json_encode(
						array(
							'a'=>odbc_result($result, 1),
							'passActn' => $passActn 
						)
					)
				);
			}
		}
	}
?>