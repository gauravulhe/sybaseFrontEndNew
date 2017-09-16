<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){

		$q = $_GET["q"];

		$query = "SELECT sup_supcd, sup_name FROM catalog..supcat WHERE sup_supcd = '$q'";
		// execute the query
        $result = odbc_exec($conn, $query);
        //print(odbc_result_all($result, "border=1"));
        if (!empty(odbc_result($result, 1))) {
        	print(
        		json_encode(
        			array(
        				'sup_supcd' => odbc_result($result, 1),
        				'sup_name' => odbc_result($result, 2)
        			)
        		)
        	);
        }
	}
?>