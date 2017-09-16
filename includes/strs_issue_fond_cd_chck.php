<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];

		$query1 = "SELECT cod_code, cod_desc FROM catalog..codecat WHERE cod_prefix = 16 AND cod_code = $q";
		$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result1 = odbc_exec($conn, $query1);
		//print(odbc_result_all($result1, "border=1"));

		if (!empty(odbc_result($result1, 1))) {

			print(
				json_encode(
					array(
						'cod_code'=>odbc_result($result1, 1),
						'cod_desc'=>odbc_result($result1, 2)
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'cod_code'=>'',
						'cod_desc'=>''
					)
				)
			);
		}
	}
?>