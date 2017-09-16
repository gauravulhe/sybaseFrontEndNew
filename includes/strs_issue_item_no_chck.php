<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$UserComDbf = $_GET['UserComDbf'];
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];
		$FrmNm = $_GET['FrmNm'];
		$ComPass = $_GET['ComPass'];
		$IssDt = date('Ymd', strtotime($_GET['IssDt']));

		require_once('cmp_pass_actn.php');

		$query1 = "SELECT itm.itm_desc,itm.itm_uom, cod.cod_desc
					FROM catalog..itmcat AS itm
					INNER JOIN catalog..codecat AS cod
					ON
					itm.itm_uom = cod.cod_code
					WHERE itm_item = '$q' AND cod_prefix = 6";
		$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result1 = odbc_exec($conn, $query1);
		//print(odbc_result_all($result1, "border=1"));

		if (!empty(odbc_result($result1, 1))) {

			$sql = "declare @dt smalldatetime, @mm int
					select @dt = convert(smalldatetime, '$IssDt')
					exec neco.invac.stockcal '$q', @dt, $UntCd";

			$result2 = odbc_exec($conn, $sql);
			odbc_next_result($result2);
			//print(odbc_result_all($result2, "border=1"))."<br>";

			print(
				json_encode(
					array(
						'itm_desc'=>odbc_result($result1, 1),
						'itm_uom'=>odbc_result($result1, 2),
						'cod_desc'=>odbc_result($result1, 3),
						'iss_itm_rate'=>round(odbc_result($result2, 1),2),
						'iss_itm_stock'=>round(odbc_result($result2, 2),3),
						'passActn'=>$passActn
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'itm_desc'=>'',
						'itm_uom'=>'',
						'cod_desc'=>'',
						'iss_itm_rate'=>'0.00',
						'iss_itm_stock'=>'0.00',
						'passActn'=>$passActn
					)
				)
			);
		}
	}
?>