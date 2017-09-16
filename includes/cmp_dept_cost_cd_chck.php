<?php 
	
	require_once('../config/config.php');


	if (isset($_GET['ComPass'])) {
		$ComPass = $_GET['ComPass'];
		$FrmNm = $_GET['FrmNm'];

		$passQry = "SELECT pas_action FROM catalog..procpass WHERE pas_passwd = '$ComPass' AND pas_proc = '$FrmNm'";
		$passRslt = odbc_exec($conn, $passQry);
		$passActn = strtolower(odbc_result($passRslt, 1));

		if(isset($_GET["q"])){
			$q=$_GET["q"];
			$query = "SELECT max(dep_cd) FROM catalog..deptcat WHERE dep_prefix = $q";
			$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

			//perform the query
			$result = odbc_exec($conn, $query);
			$rows = odbc_fetch_row($result);
			//print(odbc_result($result, 1) + 1);
			print(
				json_encode(
					array(
						'a'=>odbc_result($result, 1) + 1,
						'passActn' => $passActn 
					)
				)
			);

		}elseif(isset($_GET["u"])){
			$q=$_GET['t'];
			$u=$_GET["u"];
			$query = "SELECT dep_cd,dep_desc FROM catalog..deptcat WHERE dep_prefix = $q AND dep_cd = $u";
			$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

			//perform the query
			$result = odbc_exec($conn, $query);
			$rows = odbc_fetch_row($result);
			//print(odbc_result($result, 1));
			print(
				json_encode(
					array(
						'a'=>odbc_result($result, 1),
						'b'=>odbc_result($result, 2),
						'passActn' => $passActn 
					)
				)
			);
		}
	}

	
?>