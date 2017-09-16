<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$query = "SELECT gen_desc FROM catalog..gencat WHERE gen_accd = '$q'";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

		//perform the query
		$result = odbc_exec($conn, $query);
		$rows = odbc_fetch_row($result);
		//print(odbc_result($result, 1));
		if (!empty(odbc_result($result, 1))) {
			print(
				json_encode(
					array(
						'gen_desc'=>odbc_result($result, 1)
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'gen_desc'=>''
					)
				)
			);
		}
	}
?>