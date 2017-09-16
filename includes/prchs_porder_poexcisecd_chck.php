<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];

		$query = "SELECT cod_desc FROM catalog..codecat WHERE cod_prefix = 2 AND cod_code = $q";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);
		$rows1 = odbc_fetch_row($result);

		if (!empty(odbc_result($result, 1))) {
			print(
				json_encode(
					array(
						'cod_desc' => odbc_result($result, 1)
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'cod_desc' => ''
					)
				)
			);
		}
	}

?>