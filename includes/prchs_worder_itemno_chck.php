<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];

		require_once('cmp_pass_actn.php');

		$query = "SELECT  
					itm.itm_desc,itm.itm_uom,itm.itm_chpt_id,
					cod.cod_desc
					FROM $UserComDbf.invac.matmast as mat
					INNER JOIN catalog..itmcat as itm
					ON
					mat.mat_item = itm.itm_item
					INNER JOIN catalog..codecat as cod
					ON
					itm.itm_uom = cod.cod_code AND
					cod.cod_prefix = 6
					WHERE mat_com = $ComCd AND mat_unit = $UntCd AND mat_item = '$q'";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);
		//print(odbc_result_all($result, "border=1"));

		if (!empty(odbc_result($result, 1))) {
			print(
				json_encode(
					array(
						'itm_desc' => odbc_result($result, 1),
						'itm_uom' => odbc_result($result, 2),
						'itm_chpt_id' => odbc_result($result, 3),
						'cod_desc' => odbc_result($result, 4),
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'itm_desc' => '',
						'itm_uom' => '',
						'itm_chpt_id' => '',
						'cod_desc' => '',
						'passActn'=>$passActn
					)
				)
			);
		}
	}

?>