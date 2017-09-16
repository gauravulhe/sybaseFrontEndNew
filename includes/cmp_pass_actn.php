<?php 

	if (isset($_POST['comm_pass']) && isset($_POST['frm_nm'])) {
		$ComPass = $_POST['comm_pass'];
	    $FrmNm = $_POST['frm_nm'];
	}elseif (isset($_GET['ComPass']) && isset($_GET['FrmNm'])) {
		$ComPass = $_GET['ComPass'];
	    $FrmNm = $_GET['FrmNm'];		
	}

	$passQry = "SELECT pas_action FROM catalog..procpass WHERE pas_passwd = '$ComPass' AND pas_proc = '$FrmNm'";
	$passRslt = odbc_exec($conn, $passQry);
	$passActn = strtolower(odbc_result($passRslt, 1));
	//print($passActn);
?>