<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$PohFrDt = date('Y-m-d', strtotime($_GET["q"]));
		$PohToDt = date('Y-m-d', strtotime($_GET['PohToDt']));
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];

		require_once('cmp_pass_actn.php');

		$query1 = "SELECT 
					poh.poh_po_dt,poh.poh_supcd,
					pod.pod_fyr,pod.pod_po_no,pod.pod_po_srl,pod.pod_item,pod.pod_ord_qty,pod.pod_can_qty,pod.pod_rcv_qty,pod.pod_rej_qty,pod.pod_tolerance,
					itm.itm_desc,
					sup.sup_name
					FROM $UserComDbf.invac.pohdr AS poh
					INNER JOIN $UserComDbf.invac.podet AS pod
					ON
					poh.poh_com = pod.pod_com AND
					poh.poh_unit = pod.pod_unit AND
					poh.poh_fyr = pod.pod_fyr AND
					poh.poh_po_no = pod.pod_po_no AND
					pod.pod_ord_qty > pod.pod_can_qty
	  				INNER JOIN catalog..itmcat itm
	  				ON
	  				pod.pod_item = itm.itm_item
	  				INNER JOIN catalog..supcat sup
	  				ON
	  				poh.poh_supcd = sup.sup_supcd
					WHERE poh_po_dt BETWEEN '$PohFrDt' AND '$PohToDt' AND poh_vet_tag != 1
					";

	    $result1 = odbc_exec($conn, $query1);
	    //print_r(odbc_result_all($result1, "border=1"));exit;
	    $result_data = odbc_result($result1, 1);
	    if (!empty($result_data)) {		 

			    $rows = array();

			    while ($myRow = odbc_fetch_array($result1)) {
			    	$rows[] = $myRow;
			    }

			    $pohPodData = '<table border="1" cellpadding="2px" width="100%">
			    					<tr>
			    						<th>Sup Cd</th>
			    						<th>PO No</th>
			    						<th>PO Dt</th>
			    						<th>PO Fyr</th>
			    						<th>PO SRL</th>
			    						<th>Item No</th>
			    						<th>Po Qty</th>
			    						<th>Rec Qty</th>
			    						<th>Bal Qty</th>
			    						<th>S(Y/N)</th>
			    					</tr>';
			    foreach ($rows as $row) {
			    	$pod_ord_qty = $row['pod_ord_qty'];
			    	$pod_rcv_qty = $row['pod_rcv_qty'];
			    	$pod_can_qty = $row['pod_can_qty'];
			    	$pod_tolerance = $row['pod_tolerance'];
			    	$pod_bal_qty = round(($pod_ord_qty - $pod_rcv_qty - $pod_can_qty) + ($pod_ord_qty * $pod_tolerance)/100, 1);
			    	$pohPodData .= '<tr>
			    						<td><input type="text" name="poh_supcd[]" id="poh_supcd" value="'.$row['poh_supcd'].'" readonly maxlength="7" size="2" ></td>
			    						<td><input type="text" name="pod_po_no[]" id="pod_po_no" value="'.$row['pod_po_no'].'" readonly maxlength="5" size="1" ></td>
			    						<td><input type="text" name="poh_po_dt[]" id="poh_po_dt" value="'.date('d-m-Y', strtotime($row['poh_po_dt'])).'" readonly maxlength="10" size="10" ></td>
			    						<td><input type="text" name="pod_fyr[]" id="pod_fyr" value="'.$row['pod_fyr'].'" readonly maxlength="5" size="1" ></td>
			    						<td><input type="text" name="pod_po_srl[]" id="pod_po_srl" value="'.$row['pod_po_srl'].'" readonly maxlength="5" size="1" ></td>
			    						<td><input type="text" name="pod_item[]" id="pod_item" value="'.$row['pod_item'].'" readonly maxlength="7" size="5" ></td>
			    						<td><input type="text" name="pod_ord_qty[]" id="pod_ord_qty" value="'.number_format($pod_ord_qty, 3,".","").'" readonly maxlength="10" size="5" ></td>
			    						<td><input type="text" name="pod_rcv_qty[]" id="pod_rcv_qty" value="'.number_format($pod_rcv_qty, 3,".","").'" readonly maxlength="10" size="5" ></td>
			    						<td><input type="text" name="pod_bal_qty[]" id="pod_bal_qty" value="'.number_format($pod_bal_qty, 3,".","").'" readonly maxlength="10" size="5" ></td>
			    						<td><input type="text" name="pod_con[]" id="pod_con" required placeholder="Y/N" style="text-transform: uppercase" maxlength="1" size="1"></td>
			    					</tr>';

			    }

			    $pohPodData .= '</table>';
			    $pohPodData .= '<table>';
			    $pohPodData .= '<tr><td colspan="3">&nbsp;</td></tr>';
			    $pohPodData .= '<tr>';
			    $pohPodData .= '<td>Supplier Name </td><td>&nbsp; : &nbsp;</td><td><input type="text" value="'.$row['sup_name'].'" readonly></td>';
			    $pohPodData .= '</tr>';
			    $pohPodData .= '<tr><td colspan="3">&nbsp;</td></tr>';
			    $pohPodData .= '<tr>';
			    $pohPodData .= '<td>Item Description </td><td>&nbsp; : &nbsp;</td><td><input type="text" value="'.$row['itm_desc'].'" readonly></td>';
			    $pohPodData .= '</tr>';
			    $pohPodData .= '</table>';
			    print(
					json_encode(
						array(
							'pohPodData' => $pohPodData,
							'errorMsg' => '',
							'passActn'=>$passActn
						)
					)
				);
			}else{
				$pohPodData = '';
				print(
					json_encode(
						array(
							'pohPodData' => $pohPodData,
							'errorMsg' => ' PO already audited OR Records not found ....!!',
							'passActn'=>$passActn
						)
					)
				);
			}
	}

?>