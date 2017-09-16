<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){

		$asc_cd = $_GET["q"];
		$query = "declare @usrpwd float
		        exec catalog..userpwd '{$asc_cd}', @usrpwd output
		        select usr_pwd = @usrpwd";
		$result = odbc_exec($conn,$query) or die("Sybase Error".odbc_error());
		$rows = odbc_fetch_row($result);
		$asc_cd_usr = odbc_result($result, 1);
		$asc_cd_usr = round((float)$asc_cd_usr, 2);

		// now check userid with access code
		$userId=$_GET["u"];
		$query = "SELECT usr_pwd FROM catalog..userid WHERE usr_id = $userId";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);
		$rows = odbc_fetch_row($result);
		$asc_cd_db = odbc_result($result, 1);
		$asc_cd_db = round((float)$asc_cd_db, 2);

		if ($asc_cd_usr != $asc_cd_db) {
			echo "0";
		}else{
			echo "1";
		}
	}
?>