<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){

		$q = $_GET["q"];

		require_once('cmp_pass_actn.php');

		$query = "SELECT * FROM catalog..gencat WHERE gen_accd = '$q'";
			
			$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

			//perform the query
			$result = odbc_exec($conn, $query);
			//print(odbc_result($result, 1));
			if (!empty(odbc_result($result, 1))) {
				print(
					json_encode(
						array(
							'gen_accd'=>odbc_result($result, 1),							
							'gen_desc'=>odbc_result($result, 2),
							'passActn' => $passActn 
						)
					)
				);
			}elseif (empty(odbc_result($result, 1))) {
				print(
					json_encode(
						array(
							'gen_accd'=>'',
							'gen_desc'=>'',
							'passActn' => $passActn 
						)
					)
				);
			}
	}
?>