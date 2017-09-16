<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$DecPanNo = strtoupper($_GET["q"]);
		$DecFyr = $_GET['DecFyr'];
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];

		require_once('cmp_pass_actn.php');

		$query1 = "SELECT dec_panno,dec_name FROM catalog..decltds WHERE dec_com = $ComCd AND dec_unit = $UntCd AND dec_panno = '$DecPanNo' AND dec_fyr = $DecFyr";

	    $result1 = odbc_exec($conn, $query1);
	    $dec_panno = odbc_result($result1, 1);
	    $dec_name = odbc_result($result1, 2);
	    //print_r(odbc_result_all($result1));exit;

	    if (!empty($dec_panno)) {
		    print(
				json_encode(
					array(
						'dec_panno' => $dec_panno,
						'dec_name' => $dec_name,
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'dec_panno' => '',
						'dec_name' => '',
						'passActn'=>$passActn
					)
				)
			);
		}
	}

?>