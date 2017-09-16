<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$PoPoNo = $_GET['PoPoNo'];
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];

		require_once('cmp_pass_actn.php');

		$query1 = "SELECT poh.poh_supcd,poh.poh_stax_cd,poh.poh_stax_per,poh.poh_excise_cd,poh.poh_dlv_dest,poh.poh_disc,poh.poh_paycr_days,poh.poh_pmnt_terms,poh.poh_vet_tag,
			sup.sup_name,poh.poh_po_dt
			FROM $UserComDbf.invac.pohdr as poh
			INNER JOIN catalog..supcat as sup
			ON
			poh.poh_supcd = sup.sup_supcd
			WHERE poh_com = $ComCd AND poh_unit = $UntCd AND poh_po_no = $PoPoNo AND poh_fyr = $q AND poh_vet_tag != 1";
		$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result1 = odbc_exec($conn, $query1);		
		//print(odbc_result_all($result1, "border=1"));

		if (!empty(odbc_result($result1, 1))) {

			$query2 = "SELECT  * FROM $UserComDbf.invac.podet WHERE pod_com = $ComCd AND pod_unit = $UntCd AND pod_po_no = $PoPoNo AND pod_fyr = $q";
			$result2 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
			$result2 = odbc_exec($conn, $query2);		
			//print(odbc_result_all($result2, "border=1"));

			$rows = array();

			while ($myRow = odbc_fetch_array($result2)) {
				$rows[] = $myRow;
			}

			$pod_data = '<table>
							<tr><td colspan="11"><hr></td></tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<th>Srl</th>
								<th>Item Cd</th>
								<th>PO Qty</th>
								<th>PO Rate</th>
								<th>Value</th>
								<th>STCD</th>
								<th>ST %</th>
								<th>DELIV DEST</th>
								<th>EXCD</th>
								<th>Disc.</th>
								<th>S(Y/N)</th>
							</tr>';
			$total_value = 0;
			foreach ($rows as $row) {
				$value = $row['pod_rate']*$row['pod_ord_qty'];
				$total_value = $total_value + $value;
				$pod_data .= '
							<tr>
								<td>
									<input type="text" name="pod_po_srl[]" id="pod_po_srl" value="'.$row['pod_po_srl'].'" readonly readonly maxlength="5" size="1" >
								</td>
								<td>
									<input type="text" name="pod_item[]" id="pod_item" value="'.$row['pod_item'].'" readonly maxlength="10" size="10">
								</td>
								<td>
									<input type="text" name="pod_ord_qty[]" id="pod_ord_qty" value="'.$row['pod_ord_qty'].'" readonly maxlength="10" size="3">
								</td>
								<td>
									<input type="text" name="pod_rate[]" id="pod_rate" value="'.$row['pod_rate'].'" readonly maxlength="10" size="3">
								</td>
								<td>
									<input type="text" name="pod_value[]" id="pod_value" value="'.number_format($value, 2).'" readonly maxlength="10" size="3">
								</td>
								<td>
									<input type="text" name="poh_stax_cd[]" id="poh_stax_cd" value="'.odbc_result($result1, 2).'" readonly maxlength="10" size="3">
								</td>
								<td>
									<input type="text" name="poh_stax_per[]" id="poh_stax_per" value="'.odbc_result($result1, 3).'" readonly maxlength="10" size="3">
								</td>
								<td>
									<input type="text" name="poh_dlv_dest[]" id="poh_dlv_dest" value="'.odbc_result($result1, 5).'" readonly maxlength="10" size="5">
								</td>
								<td>
									<input type="text" name="poh_excise_cd[]" id="poh_excise_cd" value="'.odbc_result($result1, 4).'" readonly maxlength="10" size="3">
								</td>
								<td>
									<input type="text" name="poh_disc[]" id="poh_disc" value="'.odbc_result($result1, 6).'" readonly maxlength="10" size="3">
								</td>
								<td>
									<input type="text" name="pdd_con[]" id="pdd_con" placeholder="Y/N" style="text-transform: uppercase" maxlength="1" size="1">
								</td>
							<tr>';
			}
			$pod_data .= '
						<tr>
							<th colspan="4" style="text-align:right;">Total Value : </th>
							<th colspan="7">'.number_format($total_value, 2).'</th>
						</tr>
						<tr><td colspan="11"><hr></td></tr>
						</table><br>';

			$pod_data .= '<table>
							<tr>
								<th>Auditors Remark </th>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
								<td>
									<input type="text" name="app_aud_rmk" id="app_aud_rmk" value="" maxlength="36" size="20">
									<input type="hidden" name="poh_po_dt" id="poh_po_dt" value="'.odbc_result($result1, 11).'" maxlength="36" size="20">
								</td>
								<th>Supplier Cd / Name </th>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
								<td>'.odbc_result($result1, 1).' '.odbc_result($result1, 10).'</td>
							</tr>';

			$pod_data .= '
							<tr>
								<th>Credit Days </th>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
								<td>
									<input type="text" name="poh_paycr_days" id="poh_paycr_days" value="'.odbc_result($result1, 7).'" maxlength="10" size="3">
								</td>
								<th>Pymnt Terms 
									<small>
                          				<a href="includes/view_details.php?q=payterms" onclick="window.open(this.href,"mywin","left=200,top=150,width=500,height=500,toolbar=1,resizable=0"); return false;" target="_blank">(Help)
                          				</a>
                                    </small>
                                </th>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
								<td>
									<input type="text" name="poh_pmnt_terms" id="poh_pmnt_terms" value="'.odbc_result($result1, 8).'" maxlength="10" size="3">
								</td>
							</tr>';
			$pod_data .= '</table>';

			//print($pod_data);

			if (!empty(odbc_result($result2, 1))) {
				print(
					json_encode(
						array(
							'poh_supcd' => odbc_result($result1, 1),
							'podData' => $pod_data,
							'passActn'=>$passActn
						)
					)
				);
			}
		}else{
			print(
				json_encode(
					array(
						'poh_supcd' => '',
						'podData' => '',
						'passActn'=>$passActn
					)
				)
			);
		}
	}

?>