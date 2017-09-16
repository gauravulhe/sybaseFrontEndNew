<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q = $_GET["q"];
		$u = $_GET["u"];

		$query = "SELECT pas_action FROM catalog..procpass WHERE pas_passwd = '$q' AND pas_proc = '$u'";
		
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

		//perform the query
		$result = odbc_exec($conn, $query);
		print(strtolower(odbc_result($result, 1)));
		// while(odbc_fetch_row($result)){
		// 	print(odbc_result_all($result, "border=1"))."<br>";
		// }
	}
?>