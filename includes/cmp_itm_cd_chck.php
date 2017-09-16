<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$ComPass = $_GET['ComPass'];
		$FrmNm = $_GET['FrmNm'];
		$UserComDbf = $_GET['UserComDbf'];
		$UserComCd = $_GET['UserComCd'];
		$UserUntCd = $_GET['UserUntCd'];

		$passQry = "SELECT pas_action FROM catalog..procpass WHERE pas_passwd = '$ComPass' AND pas_proc = '$FrmNm'";
		$passRslt = odbc_exec($conn, $passQry);
		$passActn = strtolower(odbc_result($passRslt, 1));


		$query = "SELECT itm_desc,itm_uom FROM catalog..itmcat WHERE itm_item = '$q'";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		//perform the query
		$result = odbc_exec($conn, $query);
		$rows = odbc_fetch_row($result);

		//print(odbc_result($result, 1));
		if (!empty(odbc_result($result, 1))) {

			$uom = odbc_result($result, 2);
			$query1 = "SELECT cod_desc FROM catalog..codecat WHERE cod_prefix = 6 AND cod_code = $uom";
			$result1 = odbc_exec($conn, $query1);		
			$rows1 = odbc_fetch_row($result1);
			//print(odbc_result($result1, 1));
			
			if (!empty($UserComDbf)) {

				$query2 = "SELECT mat_minlev,mat_maxlev,mat_ordlev,mat_location,mat_abc,mat_typ,mat_accd,mat_opqty,mat_oprate,mat_opdate,mat_budg,mat_item FROM $UserComDbf.invac.matmast WHERE mat_com = $UserComCd AND mat_unit = $UserUntCd AND mat_item = '$q'";
				//echo $query2;
				$result2 = odbc_exec($conn, $query2);		
				$rows2 = odbc_fetch_row($result1);

				
			}

			print(
				json_encode(
					array(
						'itm_desc'=>odbc_result($result, 1),
						'cod_desc'=>odbc_result($result1, 1),
						'mat_minlev'=>odbc_result($result2, 1),
						'mat_maxlev'=>odbc_result($result2, 2),
						'mat_ordlev'=>odbc_result($result2, 3),
						'mat_location'=>odbc_result($result2, 4),
						'mat_abc'=>odbc_result($result2, 5),
						'mat_typ'=>odbc_result($result2, 6),
						'mat_accd'=>odbc_result($result2, 7),
						'mat_opqty'=>odbc_result($result2, 8),
						'mat_oprate'=>odbc_result($result2, 9),
						'mat_opdate'=>odbc_result($result2, 10),
						'mat_budg'=>odbc_result($result2, 11),
						'mat_item'=>odbc_result($result2, 12),
						'passActn'=>$passActn
					)
				)
			);			

		}else{
			print(
				json_encode(
					array(
						'itm_desc'=>'',
						'cod_desc'=>'',
						'passActn'=>$passActn
					)
				)
			);
		}
	}
?>