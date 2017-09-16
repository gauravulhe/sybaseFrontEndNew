<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["PohSupcd"])){
		$PohSupcd = $_GET['PohSupcd'];
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];


		$query1 = "SELECT 
					poh.poh_po_dt,poh.poh_supcd,poh.poh_stax_cd,poh.poh_stax_per,poh.poh_excise_cd,
					pod.pod_fyr,pod.pod_po_no,pod.pod_po_srl,pod.pod_item,pod.pod_rate,pod.pod_ord_qty,pod.pod_can_qty,pod.pod_rcv_qty,pod.pod_rej_qty,pod.pod_tolerance,
					itm.itm_desc,
					sup.sup_name,
					stcod.cod_desc AS st_desc,
					excod.cod_desc AS ex_desc
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
	  				INNER JOIN catalog..codecat stcod
	  				ON
	  				poh.poh_stax_cd = stcod.cod_code AND
	  				stcod.cod_prefix = 1
	  				INNER JOIN catalog..codecat excod
	  				ON
	  				poh.poh_excise_cd = excod.cod_code AND
	  				excod.cod_prefix = 2
					WHERE poh_supcd = '$PohSupcd' ORDER BY poh_supcd ASC
					";

	    $result1 = odbc_exec($conn, $query1);
	    //print_r(odbc_result_all($result1, "border=1"));exit;
	    $rows = array();

	    while ($myRow = odbc_fetch_array($result1)) {
	    	$rows[] = $myRow;
	    }
	    if (!empty($rows)) {		 			    

			    $pohPodData = '<table border="1" cellpadding="2px" width="100%">
			    					<tr>
			    						<th>PO Fyr</th>
			    						<th>PO No</th>
			    						<th>Item No</th>
			    						<th>Item Rate</th>
			    						<th>S Tax %</th>
			    						<th>Excise %</th>
			    					</tr>';
			    foreach ($rows as $row) {

			    	$pohPodData .= '<tr>
			    						<td><input type="text" name="pod_fyr[]" id="pod_fyr" value="'.$row['pod_fyr'].'" readonly maxlength="5" size="1" ></td>
			    						<td><input type="text" name="pod_po_no[]" id="pod_po_no" value="'.$row['pod_po_no'].'" readonly maxlength="5" size="1" ></td>
			    						<td><input type="text" name="pod_item[]" id="pod_item" value="'.$row['pod_item'].'" readonly maxlength="7" size="5" ></td>
			    						<td><input type="text" name="pod_rate[]" id="pod_rate" value="'.number_format($row['pod_rate'], 2,".","").'" readonly maxlength="7" size="5" ></td>
			    						<td><input type="text" name="poh_stax_cd[]" id="poh_stax_cd" value="'.number_format($row['poh_stax_per'], 2,".","").'" readonly maxlength="7" size="5" ></td>
			    						<td><input type="text" name="poh_excise_cd[]" id="poh_excise_cd" value="'.number_format($row['poh_excise_cd'], 2,".","").'" readonly maxlength="7" size="5" ></td>
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
							'errorMsg' => ''
						)
					)
				);
			}else{
				$pohPodData = '';
				print(
					json_encode(
						array(
							'pohPodData' => $pohPodData,
							'errorMsg' => ' PO already audited OR Records not found ....!!'
						)
					)
				);
			}
	}

?>