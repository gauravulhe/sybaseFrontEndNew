<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$query = "SELECT * FROM catalog..userid WHERE usr_id = $q";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

		//perform the query
		$result = odbc_exec($conn, $query);
		$rows = odbc_fetch_row($result);
		print(odbc_result($result, 1));
	}
?>