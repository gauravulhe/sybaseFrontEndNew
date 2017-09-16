<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];

		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];

		require_once('cmp_pass_actn.php');

		$query = "SELECT itm_desc,itm_uom FROM catalog..itmcat WHERE itm_item = '$q'";
		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);
		
		//print(odbc_result($result, 1));
		if (!empty(odbc_result($result, 1))) {
			$uom = odbc_result($result, 2);
			$query1 = "SELECT cod_desc FROM catalog..codecat WHERE cod_prefix = 6 AND cod_code = $uom";
			
			$result1 = odbc_exec($conn, $query1);
			

			$ComCd = $_GET['ComCd']; 
			$UntCd = $_GET['UntCd']; 
			$UserComDbf = $_GET['UserComDbf']; 
			$query2 = "SELECT mat_minlev,mat_maxlev FROM $UserComDbf.invac.matmast WHERE mat_com = $ComCd AND mat_unit = $UntCd AND mat_item = '$q'";
			
			$result2 = odbc_exec($conn, $query2);
			

			$ComCd = $_GET['ComCd']; 
			$UntCd = $_GET['UntCd']; 
			$UserComDbf = $_GET['UserComDbf']; 
			
			$query3 = "SELECT poh.poh_po_no, poh.poh_po_dt, pod.pod_item, pod.pod_po_srl, pod.pod_ord_qty , pod.pod_can_qty , pod.pod_rcv_qty , pod.pod_rej_qty  
				FROM $UserComDbf.invac.podet pod
				INNER JOIN $UserComDbf.invac.pohdr poh
				ON pod.pod_po_no = poh.poh_po_no AND  
					pod.pod_unit = poh.poh_unit AND
					pod.pod_fyr = poh.poh_fyr
				WHERE pod.pod_unit = $UntCd AND pod.pod_item = '$q' AND (poh.poh_vet_tag = 01 OR poh.poh_val_tag = 01) AND poh.poh_po_type != 09
				ORDER BY poh.poh_po_dt DESC, pod.pod_po_srl DESC
				";

			
			$result3 = odbc_exec($conn, $query3);
			
			$pendingQty = odbc_result($result3, 5) + odbc_result($result3, 8) - odbc_result($result3, 6) - odbc_result($result3, 7);

			$ReqDtYr = $_GET['ReqDtYr'];
			$ReqDtMth = $_GET['ReqDtMth'];
			$ReqDtDy = $_GET['ReqDtDy'];
			$ReqDt = $ReqDtYr.$ReqDtMth.$ReqDtDy;
			$query4 = "declare @dt smalldatetime, @mm int
					select @dt = convert(smalldatetime, '{$ReqDt}')
					exec $UserComDbf.invac.stockcal '{$q}', @dt, {$UntCd}";
			$result4 = odbc_exec($conn, $query4);
			odbc_next_result($result4);

			//$query5 = "SELECT max(req_srl) FROM catalog.invac.request WHERE req_com = $ComCd AND req_unit = $UntCd AND req_fyr = $finYear AND req_no = $maxReqNo";
			$ReqFyr = $_GET['ReqFyr'];
			$ReqNo = $_GET['ReqNo'];
			$ReqSrl = $_GET['ReqSrl'];
			$ReqDt = date('Y-m-d', strtotime($_GET['ReqDt']));
			$ReqDept = $_GET['ReqDept'];

			$query5 = "SELECT req_qty, req_rmk, req_catg, req_can_qty, req_aprvd_qty, req_cons_days, req_inq_fyr, req_inq_no FROM catalog.invac.request WHERE req_com = $ComCd AND req_unit = $UntCd AND req_fyr = $ReqFyr AND req_no = $ReqNo AND req_srl = $ReqSrl AND req_dt = '$ReqDt' AND req_dept = $ReqDept";

			
			$result5 = odbc_exec($conn, $query5);		
			
			//print(odbc_result($result5, 1));
			//print(odbc_result_all($result5, "border=1"));

			print(
				json_encode(
					array(
						'itm_desc'=>odbc_result($result, 1),
						'cod_desc'=>odbc_result($result1, 1),
						'mat_minlev'=>odbc_result($result2, 1),
						'mat_maxlev'=>odbc_result($result2, 2),
						'poh_po_no'=>odbc_result($result3, 1),
						'poh_po_dt'=>date('d-m-Y', strtotime(odbc_result($result3, 2))),
						'pod_item'=>odbc_result($result3, 3),
						'pod_po_srl'=>odbc_result($result3, 4),
						'pod_pen_qty'=>$pendingQty,
						'item_rate'=>odbc_result($result4, 1),
						'item_stock'=>odbc_result($result4, 2),
						'req_qty'=>odbc_result($result5, 1),
						'req_rmk'=>odbc_result($result5, 2),
						'req_catg'=>odbc_result($result5, 3),
						'req_can_qty'=>odbc_result($result5, 4),
						'req_aprvd_qty'=>odbc_result($result5, 5),
						'req_cons_days'=>odbc_result($result5, 6),
						'req_inq_fyr'=>odbc_result($result5, 7),
						'req_inq_no'=>odbc_result($result5, 8),
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
						'mat_minlev'=>'',
						'mat_maxlev'=>'',
						'poh_po_no'=>'',
						'poh_po_dt'=>'',
						'pod_item'=>'',
						'pod_po_srl'=>'',
						'pod_pen_qty'=>'',
						'item_rate'=>'',
						'item_stock'=>'',
						'req_qty'=>'',
						'req_rmk'=>'',
						'req_catg'=>'',
						'req_can_qty'=>'',
						'req_aprvd_qty'=>'',
						'req_cons_days'=>'',
						'req_inq_fyr'=>'',
						'req_inq_no'=>'',
						'passActn'=>$passActn
					)
				)
			);
		}
	}
?>