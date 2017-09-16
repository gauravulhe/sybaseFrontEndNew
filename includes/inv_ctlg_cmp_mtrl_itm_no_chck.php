<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q = $_GET["q"];
		
		require_once('cmp_pass_actn.php');

		$query = "SELECT * FROM catalog..itmcat WHERE itm_item = '$q'";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

		//perform the query
		$result = odbc_exec($conn, $query);
		//print(odbc_result($result, 1));
		//print(odbc_result($result, 3));
		if (!empty(odbc_result($result, 1))) {
			print(
				json_encode(
					array(
						'itm_item'=>odbc_result($result, 1),
						'itm_desc'=>odbc_result($result, 2),
						'itm_part'=>odbc_result($result, 3),
						'itm_uom'=>odbc_result($result, 4),
						'itm_crossitm'=>odbc_result($result, 5),
						'itm_modvat'=>odbc_result($result, 6),
						'itm_type'=>odbc_result($result, 7),
						'itm_cr_days'=>odbc_result($result, 8),
						'itm_del_tag'=>odbc_result($result, 9),
						'itm_chpt_id'=>odbc_result($result, 10),
						'passActn' => $passActn 
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'itm_item'=>'',
						'itm_desc'=>'',
						'itm_part'=>'',
						'itm_uom'=>'',
						'itm_crossitm'=>'',
						'itm_modvat'=>'',
						'itm_type'=>'',
						'itm_cr_days'=>'',
						'itm_del_tag'=>'',
						'itm_chpt_id'=>'',
						'passActn' => $passActn 
					)
				)
			);
		}
	}
?>