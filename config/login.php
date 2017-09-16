<?php
	
	require_once('config.php');

	if (isset($_POST['submit'])) {

		$server = $_POST['server'];
		$com_cd = $_POST['com_cd'];
		$user_id = $_POST['user_id'];
		$acc_cd = $_POST['acc_cd'];
		$pass = strtolower($_POST['pass']);
		$pass_nm = substr($pass, 0, 5);
		$pass_cd = substr($pass, 5);
		$def_cd = 96;


		// checking password for invac, sales and finac
		if (($pass_nm == 'invac' && $pass_cd == $def_cd) || ($pass_nm == 'sales' && $pass_cd == $def_cd) || ($pass_nm == 'finac' && $com_cd == $pass_cd)) 
		{

			$query = "SELECT usr_id, usr_pwd, usr_perm FROM catalog..userid WHERE usr_id = $user_id";
			$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

			//perform the query
			$result = odbc_exec($conn, $query);
			$rows = odbc_fetch_row($result);
			$usr_id = odbc_result($result, 1);
			$usr_pwd = odbc_result($result, 2);
			$usr_perm = odbc_result($result, 3);
			if (empty($usr_id) || empty($usr_pwd) || empty($usr_perm)) {
				header('Location:../logout.php');
			}else{
                        $_SESSION['server'] = $_POST['server'];
			$_SESSION['usr_id'] = $usr_id;
			$_SESSION['pass'] = $_POST['pass'];
			$_SESSION['com_cd'] = $_POST['com_cd'];                        
                        $_SESSION['com_nm'] = $_POST['com_nm'];
			$query = "SELECT com_dbf FROM catalog..comcat WHERE com_com = $com_cd";
			$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
			$result = odbc_exec($conn, $query);
			$rows = odbc_fetch_row($result);
			$_SESSION['com_dbf'] = odbc_result($result, 1);

                // if ($pass_nm == 'finac' && $com_cd == 41) {
                //     $_SESSION['ffuser'] = 'fin4';
                //     $_SESSION['fduser'] = 'fin4';
                // }elseif ($pass_nm == 'finac' && $com_cd != 41) {
                //     $_SESSION['ffuser'] = 'fin'.$com_cd;
                //     $_SESSION['fduser'] = 'fin'.$com_cd;
                // }elseif ($pass_nm == 'invac') {
                //     $_SESSION['ffuser'] = 'invac96';
                //     if($com_cd != 41){
                //     	$_SESSION['fduser'] = 'fin'.$com_cd;
                //     }else{
                //     	$_SESSION['fduser'] = 'fin4';
                //     }                
                // }elseif ($pass_nm == 'sales') {
                //     $_SESSION['ffuser'] = 'sales96';
                //     if($com_cd != 41){
                //     	$_SESSION['fduser'] = 'fin'.$com_cd;
                //     }else{
                //     	$_SESSION['fduser'] = 'fin4';
                //     }
                // }

                if ($com_cd != 41 && $com_cd != 01) {
                	if ($pass_nm == 'finac') {
                		$_SESSION['ffuser'] = 'fin'.$com_cd;
                		$_SESSION['fduser'] = 'fin'.$com_cd;
                	}elseif ($pass_nm == 'invac') {
                		$_SESSION['ffuser'] = 'invac96';
                		$_SESSION['fduser'] = 'fin'.$com_cd;
                	}elseif ($pass_nm == 'sales') {
                		$_SESSION['ffuser'] = 'sales96';
                		$_SESSION['fduser'] = 'fin'.$com_cd;
                	}
                }elseif ($com_cd == 41 && $com_cd != 01) {
                	if ($pass_nm == 'finac') {
                		$_SESSION['ffuser'] = 'fin'.$com_cd;
                		$_SESSION['fduser'] = 'fin4';
                	}elseif ($pass_nm == 'invac') {
                		$_SESSION['ffuser'] = 'invac96';
                		$_SESSION['fduser'] = 'fin4';
                	}elseif ($pass_nm == 'sales') {
                		$_SESSION['ffuser'] = 'sales96';
                		$_SESSION['fduser'] = 'fin4';
                	}
                }elseif ($com_cd == 01 && $com_cd != 41) {
                	if ($pass_nm == 'finac') {
                		$_SESSION['ffuser'] = 'fin'.$com_cd;
                		$_SESSION['fduser'] = 'fin1';
                	}elseif ($pass_nm == 'invac') {
                		$_SESSION['ffuser'] = 'invac96';
                		$_SESSION['fduser'] = 'fin1';
                	}elseif ($pass_nm == 'sales') {
                		$_SESSION['ffuser'] = 'sales96';
                		$_SESSION['fduser'] = 'fin1';
                	}
                }

				header('Location:../dashboard.php');
			}
			//header('Location:../index.php');

		}else{ ?>

		 	<script type="text/javascript">
				alert('Login Failed, Please Try Again.');
				window.location = "../index.php";
			</script>

		<?php 
		}
	}
	odbc_close($conn);
?>
