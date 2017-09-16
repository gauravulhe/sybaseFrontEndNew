<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$query = "SELECT dep_desc FROM catalog..deptcat WHERE dep_prefix = 1 AND dep_cd = $q";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

		//perform the query
		$result = odbc_exec($conn, $query);
		$rows = odbc_fetch_row($result);
		//print(odbc_result($result, 1));
		if (!empty(odbc_result($result, 1))) {
			print(
				json_encode(
					array(
						'dep_desc'=>odbc_result($result, 1)
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'dep_desc'=>''
					)
				)
			);
		}
	}
?>