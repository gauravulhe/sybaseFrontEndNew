<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$GrnDt = date('Ymd', strtotime($_GET['GrnDt']));
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];

		require_once('cmp_pass_actn.php');

		$query1 = "select ffsupcd = grh_supcd, ffsupnm = sup_name, grd_fyr = grh_fyr
	        from catalog.dbo.supcat, $UserComDbf.invac.grhdr
	        where grh_unit  = $UntCd
	        and   grh_no    = $q
	        and   grh_dt    = '$GrnDt'
	        and   grh_supcd = sup_supcd";

	    $result1 = odbc_exec($conn, $query1);
	    //print_r(odbc_result_all($result1, "border=1"));
	    $grd_fyr = odbc_result($result1, 3);

	    if (!empty(odbc_result($result1, 1))) {

		    	$query2 = "select ffpono   = pod_po_no,
		           ffpofyr  = poh_fyr,
		           ffposrl  = pod_po_srl,
		           ffitmcd  = grd_item,
		           ffitmnm  = itm_desc,
		           ffgrnsrl = grd_srl,
		           ffporate = round(pod_rate,2),
		           ffgrnrt  = round(gra_forced_amt,2)
		            from $UserComDbf.invac.podet, $UserComDbf.invac.pohdr,
		         $UserComDbf.invac.grdet, $UserComDbf.invac.gradj, catalog.dbo.itmcat
		            where grd_unit     = $UntCd
		            and   grd_fyr      = $grd_fyr
			        and   grd_no       = $q
			        and   grd_dt       = '$GrnDt'

		            and   grd_unit     = pod_unit
		            and   grd_po_fyr   = pod_fyr
		            and   grd_po_no    = pod_po_no
		            and   grd_po_srl   = pod_po_srl
			        and   grd_cbldtag  is null

			        and   pod_unit     = poh_unit
			        and   pod_fyr      = poh_fyr
			        and   pod_po_no    = poh_po_no		            
		            and   grd_unit     = gra_unit
		            and   grd_fyr      = gra_fyr
		            and   grd_no       = gra_no
		            and   grd_srl      = gra_srl
		            and   gra_id       = 10
		            and   round(pod_rate,2) < round(gra_forced_amt,2)
		        	and   grd_item     = itm_item";

		    $result2 = odbc_exec($conn, $query2);
		    //print_r(odbc_result_all($result2, "border=1"));

		    $rows = array();

		    while ($myRow = odbc_fetch_array($result2)) {
		    	$rows[] = $myRow;
		    }

		    $grnPodData = '<table border="1" cellpadding="2px" width="100%">
		    					<tr>
		    						<th>PO No</th>
		    						<th>PO Fyr</th>
		    						<th>PO SRL</th>
		    						<th>Item No</th>
		    						<th>Desc</th>
		    						<th>GRN SRL</th>
		    						<th>PO Rate</th>
		    						<th>GRN Rate</th>
		    						<th>S(Y/N)</th>
		    					</tr>';
		    foreach ($rows as $row) {
		    	//print_r($row);
		    	$grnPodData .= '<tr>
		    						<td><input type="text" name="grd_po_no[]" id="grd_po_no" value="'.$row['ffpono'].'" readonly maxlength="7" size="2" ></td>
		    						<td><input type="text" name="grd_po_fyr[]" id="grd_po_fyr" value="'.$row['ffpofyr'].'" readonly maxlength="5" size="1" ></td>
		    						<td><input type="text" name="grd_po_srl[]" id="grd_po_srl" value="'.$row['ffposrl'].'" readonly maxlength="5" size="1" ></td>
		    						<td><input type="text" name="grd_item[]" id="grd_item" value="'.$row['ffitmcd'].'" readonly maxlength="7" size="5" ></td>
		    						<td><input type="text" name="grd_item_desc[]" id="grd_item_desc" value="'.$row['ffitmnm'].'" readonly maxlength="36" size="15" ></td>
		    						<td><input type="text" name="grd_srl[]" id="grd_srl" value="'.$row['ffgrnsrl'].'" readonly maxlength="5" size="1" ></td>
		    						<td><input type="text" name="po_rate[]" id="po_rate" value="'.$row['ffporate'].'" readonly maxlength="10" size="5" ></td>
		    						<td><input type="text" name="grn_rate[]" id="grn_rate" value="'.$row['ffgrnrt'].'" readonly maxlength="10" size="5" ></td>
		    						<td><input type="text" name="grn_con[]" id="grn_con" required placeholder="Y/N" style="text-transform: uppercase" maxlength="1" size="1"></td>
		    					</tr>';

		    }
		    $grnPodData .= '</table>';
				
				if (!empty(odbc_result($result2, 1))) {

					$query3 = "select pgd_rmk
					    from $UserComDbf.invac.pogrdfrmk
				            where pgd_unit   = $UntCd
				            and   pgd_fyr    = $grd_fyr
						    and   pgd_grn_no = $q
						    and   pgd_grn_dt = '$GrnDt'";

				    $result3 = odbc_exec($conn, $query3);
					//print_r(odbc_result_all($result3, "border=1"));    

					if (odbc_result($result3, 1) == '') {
						print(
							json_encode(
								array(
							        'grh_supcd' => odbc_result($result1, 1),
									'sup_name' => odbc_result($result1, 2),
									'grh_fyr' => odbc_result($result1, 3),
									'pod_po_no' => odbc_result($result2, 1),
						            'poh_fyr' => odbc_result($result2, 2),
						            'pod_po_srl' => odbc_result($result2, 3),
						            'grd_item' => odbc_result($result2, 4),
						            'itm_desc' => odbc_result($result2, 5),
						            'grd_srl' => odbc_result($result2, 6),
						            'pod_rate' => odbc_result($result2, 7),
						            'gra_forced_amt' => odbc_result($result2, 8),
						            'grnPodData' => $grnPodData,
									'errorMsg' => '',
									'passActn'=>$passActn
								)
							)
						);
					}else{
						print(
							json_encode(
								array(
									'pgd_rmk' => odbc_result($result3, 1),
									'errorMsg' => ' GRN Already Audited ...',
									'passActn'=>$passActn
								)
							)
						);
					}

				}else{
					print(
						json_encode(
							array(
								'pgd_rmk' => '',
						        'grh_supcd' => '',
								'sup_name' => '',
								'grh_fyr' => '',
								'pod_po_no' => '',
					            'poh_fyr' => '',
					            'pod_po_srl' => '',
					            'grd_item' => '',
					            'itm_desc' => '',
					            'grd_srl' => '',
					            'pod_rate' => '',
					            'gra_forced_amt' => '',
						        'grnPodData' => '',
								'errorMsg' => ' No Such GRN / GRN Already Audited ...!!',
								'passActn'=>$passActn
							)
						)
					);
				}
			}else{
				print(
					json_encode(
						array(
							'pgd_rmk' => '',
							'grh_supcd' => '',
							'sup_name' => '',
							'grh_fyr' => '',
							'errorMsg' => ' Invalid Grn No / Grn Date ....!!',
							'passActn'=>$passActn
						)
					)
				);
			}
	}

?>