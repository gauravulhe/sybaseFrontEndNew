<?php

	// server configuration

	// //$serverName = "SYBLINUX";
	// $serverName = "SVRSYB";
	// $userName = "sa";
	// $password = "master";

	// $conn=odbc_connect($serverName, $userName, $password) or die("Sybase Error".odbc_error());
	// session_start();
	
	session_start();
	//unset($_SESSION['pass']);
	
	if (isset($_SESSION['pass'])) {
		$server = $_SESSION['server'];
	    $pass = strtolower($_SESSION['pass']);  
	    $user = substr($pass, 0, 5);
	    $code = substr($pass, 5, 7);

	    //$serverName = "SYBLINUX";
		$serverName = $server;
		$userName = $user;
		$password = $pass;

	}elseif (!isset($_SESSION['pass'])) {

		$serverName = "SYBLINUX";
		//$serverName = "SVRSYB";
		$userName = "sa";
		$password = "master";
	}
	$conn=odbc_connect($serverName, $userName, $password) or die("Sybase Error".odbc_error());

?>
