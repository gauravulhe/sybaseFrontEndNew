<?php
	
	require_once('config.php');

	if (isset($_SESSION['usr_id'])) {
		session_destroy();
		header('Location:../index.php');
	}else{
		header('Location:../dashboard.php');
	}	

	odbc_close($conn);
?>
