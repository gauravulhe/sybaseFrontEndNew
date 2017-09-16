<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=date('Y-m-d 00:00:00', strtotime($_GET["q"]));
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];
		$GrnDt = date('Ymd', strtotime($_GET['q']));
		$GrnNo = ($_GET['GrnNo'])?$_GET['GrnNo']:0;

		require_once('cmp_pass_actn.php');

		$query = "declare @fyr smallint
	        exec catalog.dbo.finyear {$ComCd}, '{$GrnDt}', @fyr output
	        select @fyr";

		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result = odbc_exec($conn, $query);
		$finYear = odbc_result($result, 1);
		// print($finYear);

		if ($passActn == 'e') {

			$query1 = "SELECT max(par_lval) FROM $UserComDbf.invac.parinv WHERE par_com = $ComCd AND par_unit = $UntCd AND par_tbl = 'grhdr' AND par_col = 1 AND par_fyr = $finYear";
			$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
			$result1 = odbc_exec($conn, $query1);
			$rows1 = odbc_fetch_row($result1);
			$maxGrnNo = odbc_result($result1, 1)+1;

			if (!empty(odbc_result($result1, 1))) {
				print(
					json_encode(
						array(
							'finYear' => $finYear,
							'grn_no'=>$maxGrnNo,
							'passActn'=>$passActn
						)
					)
				);
			}else{
				print(
					json_encode(
						array(
							'finYear' => '',
							'grn_no'=>'',
							'passActn'=>$passActn
						)
					)
				);
			}		
		}elseif ($passActn == 'u') {

			$query1 = "SELECT grh.grh_supcd,grh.grh_chal_no,grh.grh_chal_dt,grh.grh_tran_cd,grh.grh_transporter,grh.grh_truck_no,grh.grh_lr_no,grh.grh_trans_rate,grh.grh_unloader,grh.grh_agent,grh.grh_agent_rate,grh.grh_rly,grh.grh_rly_rate,grh.grh_wvslip_no,grh.grh_wvslip_dt,grh.grh_gross_wt,grh.grh_tare_wt,grh.grh_net_wt,grh.grh_gate_no,grh.grh_gate_dt,sup.sup_name
			FROM $UserComDbf.invac.grhdr grh
			INNER JOIN catalog..supcat sup
			ON
			grh.grh_supcd = sup.sup_supcd
			WHERE grh_com = $ComCd AND grh_unit = $UntCd AND grh_no = $GrnNo AND grh_fyr = $finYear AND grh_dt = '$q'";

			$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
			$result1 = odbc_exec($conn, $query1);
			$rows1 = odbc_fetch_array($result1);
			if (!empty($rows1['grh_supcd'])) {

				$query2 = "SELECT grd_srl,grd_chal_qty,grd_rcv_qty,grd_unloader_rate FROM $UserComDbf.invac.grdet WHERE grd_com = $ComCd AND grd_unit = $UntCd AND grd_no = $GrnNo AND grd_fyr = $finYear AND grd_dt = '$q'";
				$result2 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
				$result2 = odbc_exec($conn, $query2);
				//$rows2 = odbc_fetch_array($result2);
				
				$rows = array();
				while ($myrow = odbc_fetch_array($result2)) {
					$rows[] = $myrow;
				}
				if (!empty($rows)) {
					$i = 1;
					$pod_data_upd = array();
					$pod_data_upd[] .= "<table width='100%'><tr><td colspan='8'><hr></td></tr><input type='hidden' name='pod_fyr[]'><input type='hidden' name='pod_po_no[]'><input type='hidden' name='pod_po_srl[]'><input type='hidden' name='pod_item[]'><input type='hidden' name='pod_rate[]'>";
					foreach ($rows as $row) {
						
						$pod_data_upd[] .= "<tr><th>Srl No</th><td><input type='text' name='grd_srl[]' id='".$row['grd_srl']."' value='".$row['grd_srl']."' readonly maxlength='10' size='8' readonly></td><th>Challan Qty</th><td><input type='text' name='grd_chal_qty[]' id='grd_chal_qty_".$row['grd_srl']."' value='".$row['grd_chal_qty']."' maxlength='10' size='8' placeholder='00.00' onchange='CheckGrnChalQty(this)' onblur='setNumberDecimal(this)'><span id='uom_cod_desc'></span></td><th>Received</th><td><input type='text' name='grd_rcv_qty[]' id='grd_rcv_qty_".$row['grd_srl']."' value='".$row['grd_rcv_qty']."' maxlength='10' size='8' placeholder='00.00' onchange='CheckGrnRcvdQty()'  onblur='setNumberDecimal(this)'></td><th>Unloader Rate</th><td><input type='text' name='grd_unloader_rate[]' id='grd_unloader_rate_".$row['grd_srl']."' value='".$row['grd_unloader_rate']."' maxlength='10' size='8' placeholder='00.00'></td></tr>";
					}
					$pod_data_upd[] .= "</table>";
				}

				print(
					json_encode(
						array(
							'finYear' => $finYear,
							'grh_supcd' => $rows1['grh_supcd'], 
							'grh_chal_no' => $rows1['grh_chal_no'], 
							'grh_chal_dt' => $rows1['grh_chal_dt'], 
							'grh_tran_cd' => $rows1['grh_tran_cd'], 
							'grh_transporter' => $rows1['grh_transporter'], 
							'grh_truck_no' => $rows1['grh_truck_no'], 
							'grh_lr_no' => $rows1['grh_lr_no'],
							'grh_trans_rate' => $rows1['grh_trans_rate'], 
							'grh_unloader' => $rows1['grh_unloader'], 
							'grh_agent' => $rows1['grh_agent'], 
							'grh_agent_rate' => $rows1['grh_agent_rate'], 
							'grh_rly' => $rows1['grh_rly'], 
							'grh_rly_rate' => $rows1['grh_rly_rate'], 
							'grh_wvslip_no' => $rows1['grh_wvslip_no'], 
							'grh_wvslip_dt' => $rows1['grh_wvslip_dt'], 
							'grh_gross_wt' => $rows1['grh_gross_wt'], 
							'grh_tare_wt' => $rows1['grh_tare_wt'], 
							'grh_net_wt' => $rows1['grh_net_wt'], 
							'grh_gate_no' => $rows1['grh_gate_no'], 
							'grh_gate_dt' => $rows1['grh_gate_dt'], 
							'sup_name' => $rows1['sup_name'],
							'pod_data_upd' => $pod_data_upd,
							'passActn'=>$passActn
						)
					)
				);
			}else{
				print(
					json_encode(
						array(
							'finYear' => '',
							'grh_supcd' => '', 
							'grh_chal_no' => '', 
							'grh_chal_dt' => '', 
							'grh_tran_cd' => '', 
							'grh_transporter' => '', 
							'grh_truck_no' => '', 
							'grh_lr_no' => '', 
							'grh_trans_rate' => '', 
							'grh_unloader' => '', 
							'grh_agent' => '', 
							'grh_agent_rate' => '', 
							'grh_rly' => '', 
							'grh_rly_rate' => '', 
							'grh_wvslip_no' => '', 
							'grh_wvslip_dt' => '', 
							'grh_gross_wt' => '', 
							'grh_tare_wt' => '', 
							'grh_net_wt' => '', 
							'grh_gate_no' => '', 
							'grh_gate_dt' => '',
							'sup_name' => '',
							'pod_data_upd' => '',
							'passActn'=>$passActn
						)
					)
				);
			}
		}
	}

?>