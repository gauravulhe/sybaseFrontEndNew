<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];

		$query1 = "SELECT dep_cd,dep_desc FROM catalog..deptcat WHERE dep_cd = $q AND dep_prefix = 2";
		$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result1 = odbc_exec($conn, $query1);
		//print(odbc_result_all($result1, "border=1"));

		if (!empty(odbc_result($result1, 1))) {

			print(
				json_encode(
					array(
						'dep_cd'=>odbc_result($result1, 1),
						'dep_desc'=>odbc_result($result1, 2)
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'dep_cd'=>'',
						'dep_desc'=>''
					)
				)
			);
		}
	}
?>