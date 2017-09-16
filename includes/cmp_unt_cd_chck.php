<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$u=$_GET["u"];
		$query = "SELECT com_name,com_uname FROM catalog..comcat WHERE com_com = $q AND com_unit = $u";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

		//perform the query
		$result = odbc_exec($conn, $query);
		$rows = odbc_fetch_row($result);
		//print(odbc_result($result, 1));
		if (!empty(odbc_result($result, 1))) {
			print(
				json_encode(
					array(
						'com_name'=>odbc_result($result, 1),
						'com_uname'=>odbc_result($result, 2)
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'com_name'=>'',
						'com_uname'=>''
					)
				)
			);
		}
	}
?>