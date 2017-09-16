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

		$query = "SELECT * FROM catalog..comcat WHERE com_com = $q AND com_unit = $u";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

		//perform the query
		$result = odbc_exec($conn, $query);
		//print(odbc_result($result, 1));
		//print(odbc_result($result, 3));
		if (!empty(odbc_result($result, 1))) {
			print(
				json_encode(
					array(
						'a'=>odbc_result($result, 1),
						'b'=>odbc_result($result, 2),
						'c'=>odbc_result($result, 3),
						'd'=>odbc_result($result, 4),
						'e'=>odbc_result($result, 5),
						'f'=>odbc_result($result, 6),
						'g'=>odbc_result($result, 7),
						'h'=>odbc_result($result, 8),
						'i'=>odbc_result($result, 9),
						'j'=>odbc_result($result, 10),
						'k'=>odbc_result($result, 11),
						'l'=>odbc_result($result, 12),
						'm'=>odbc_result($result, 13),
						'n'=>odbc_result($result, 14),
						'o'=>odbc_result($result, 15),
						'p'=>odbc_result($result, 16),
						'q'=>odbc_result($result, 17),
						'r'=>odbc_result($result, 18),
						's'=>odbc_result($result, 19),
						't'=>odbc_result($result, 20),
						'u'=>odbc_result($result, 21),
						'v'=>odbc_result($result, 22),
						'w'=>odbc_result($result, 23),
						'x'=>odbc_result($result, 24),
						'y'=>odbc_result($result, 25),
						'z'=>odbc_result($result, 26),
						'passActn' => $passActn 
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'a'=>'',
						'b'=>'',
						'c'=>'',
						'd'=>'',
						'e'=>'',
						'f'=>'',
						'g'=>'',
						'h'=>'',
						'i'=>'',
						'j'=>'',
						'k'=>'',
						'l'=>'',
						'm'=>'',
						'n'=>'',
						'o'=>'',
						'p'=>'',
						'q'=>'',
						'r'=>'',
						's'=>'',
						't'=>'',
						'u'=>'',
						'v'=>'',
						'w'=>'',
						'x'=>'',
						'y'=>'',
						'z'=>'',
						'passActn' => $passActn 
					)
				)
			);
		}

	}
?>