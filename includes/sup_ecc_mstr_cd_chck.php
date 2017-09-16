<?php 
	
	require_once('../config/config.php');


	if (isset($_GET['ComPass'])) {
		$ComPass = $_GET['ComPass'];
		$FrmNm = $_GET['FrmNm'];

		$passQry = "SELECT pas_action FROM catalog..procpass WHERE pas_passwd = '$ComPass' AND pas_proc = '$FrmNm'";
		$passRslt = odbc_exec($conn, $passQry);
		$passActn = strtolower(odbc_result($passRslt, 1));

		if(isset($_GET["q"])){
			$q=strtoupper($_GET["q"]);
			$query = "SELECT * FROM catalog..supeccmst WHERE esup_supcd = '$q'";
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
						'c'=>odbc_result($result, 3),
						'passActn' => $passActn 
					)
				)
			);
		}
	}

	
?>