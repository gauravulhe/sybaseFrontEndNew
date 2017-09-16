<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$PoFinYr = $_GET['PoFinYr'];
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];

		require_once('cmp_pass_actn.php');

		$query1 = "SELECT 
					poh.poh_fyr,poh.poh_po_no,poh.poh_supcd,
					pod.pod_po_srl,pod.pod_item,pod.pod_spec_cd,pod.pod_tech_spec,pod.pod_rate,pod.pod_ord_qty,pod.pod_can_qty,pod.pod_rcv_qty,pod.pod_rej_qty,pod.pod_tolerance,
					itm.itm_item,itm.itm_desc,
					sup.sup_name,pod.pod_fyr,pod.pod_po_no,poh.poh_stax_cd,cod.cod_desc
					FROM $UserComDbf.invac.pohdr poh
					INNER JOIN $UserComDbf.invac.podet pod
					ON
	 				poh.poh_com = pod.pod_com AND
	 				poh.poh_unit = pod.pod_unit AND
					poh.poh_po_no = pod.pod_po_no AND  
	 				poh.poh_fyr = pod.pod_fyr
	 				INNER JOIN catalog..itmcat itm
	 				ON
	 				pod.pod_item = itm.itm_item
	 				INNER JOIN catalog..supcat sup
	 				ON
	 				poh.poh_supcd = sup.sup_supcd
	 				INNER JOIN catalog..codecat cod
	 				ON cod.cod_code = itm.itm_uom
					WHERE poh_com = $ComCd AND	poh_unit = $UntCd AND poh_fyr = $PoFinYr AND poh_po_no = $q AND cod_prefix = 6";

		$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result1 = odbc_exec($conn, $query1);
		//print(odbc_result_all($result1, "border=1"));

		$rows = array();

		while ($myRow = odbc_fetch_array($result1)) {
			$rows[] = $myRow;
		}
		if (!empty($rows)) {
				$i = 1;
				$pod_data = array();
				$pod_data[] .= "<table width='100%'><tr><th width='5%'>Fyr</th><th width='10%'>PO No</th><th width='5%'>Sr</th><th width='10%'>Item</th><th width='20%'>Description</th><th width='15%'>Rate</th><th width='15%'>Ord Qty.</th><th width='15%'>Bal Qty.</th><th width='5%'>Y / N</th></tr>";
			foreach ($rows as $row) {
				$pod_ord_qty = $row['pod_ord_qty'];
				$pod_can_qty = $row['pod_can_qty'];
				$pod_rcv_qty = $row['pod_rcv_qty'];
				$pod_rej_qty = $row['pod_rej_qty'];
				$pod_tolerance = $row['pod_tolerance'];

				$pod_bal_qty = number_format(($pod_ord_qty - $pod_rcv_qty - $pod_can_qty + $pod_rej_qty) + ( ($pod_ord_qty * $pod_tolerance)/100 ),3);
				
				// if (($pod_ord_qty - $pod_rcv_qty - $pod_can_qty + $pod_rej_qty) > 0) {			
				if ($pod_bal_qty > 0) {			
					$pod_data[] .= "<tr><td><input name='pod_fyr[]' id='pod_fyr_".$i."' value='".$row['pod_fyr']."' maxlength='4' size='3' readonly></td><td><input name='pod_po_no[]' id='pod_po_no_".$i."' value='".$row['pod_po_no']."' maxlength='4' size='8' readonly></td><td><input name='pod_po_srl[]' id='pod_po_srl_".$i."' value='".$row['pod_po_srl']."' maxlength='4' size='3' readonly></td><td><input name='pod_item[]' id='pod_item_".$i."' value='".$row['pod_item']."' maxlength='7' size='8' readonly></td><td><input name='itm_desc[]' id='itm_desc_".$i."' value='".$row['itm_desc']."' maxlength='36' size='22' readonly></td><td><input name='pod_rate[]' id='pod_rate_".$i."' value='".$row['pod_rate']."' maxlength='10' size='10' style='text-align:right;'></td><td><input name='pod_ord_qty[]' id='pod_ord_qty_".$i."' value='".$row['pod_ord_qty']."' maxlength='10' size='10' style='text-align:right;' readonly></td><td><input name='pod_bal_qty[]' id='pod_bal_qty_".$i."' value='".$pod_bal_qty."' maxlength='10' size='10' style='text-align:right;' readonly></td><td><input name='grn_actn1[]' id='grn_actn1_".$i."' onblur='toggleGrnForm2(this)' maxlength='1' size='1' style='text-transform: uppercase'></td>
					</tr>";
					$i++;
				}else{
					$pod_data[] .= '';
				}
				
			}
			$pod_data[] .= "<tr><td colspan='8' align='right'>Sure ( Y / N ) </td><td><input name='grn_actn2[]' id='grn_actn2_".$i."' maxlength='1' size='1' onblur='toggleGrnForm1(this)' style='text-transform: uppercase' form='pod_data_ajax'></td></tr></table>";

			print(
					json_encode(
						array(
							'pod_data' => $pod_data,
							'poh_fyr' => $row['poh_fyr'],
							'poh_po_no' => $row['poh_po_no'],
							'poh_supcd' => $row['poh_supcd'],
							'pod_spec_cd' => $row['pod_spec_cd'],
							'pod_tech_spec' => $row['pod_tech_spec'],
							'itm_item' => $row['itm_item'],
							'sup_name' => $row['sup_name'],
							'poh_stax_cd' => $row['poh_stax_cd'],
							'uom_cod_desc' => $row['cod_desc'],
							'passActn' =>$passActn
						)
					)
				);
		}else{
			print(
				json_encode(
					array(
						'poh_fyr' => '',
						'poh_po_no' => '',
						'poh_supcd' => '',
						'pod_spec_cd' => '',
						'pod_tech_spec' => '',
						'itm_item' => '',
						'sup_name' => '',
						'poh_stax_cd' => '',
						'uom_cod_desc' => '',
						'passActn' =>$passActn,
					)
				)
			);
		}

		// if (!empty(odbc_result($result1, 1))) {

		// 	$pod_ord_qty = odbc_result($result1, 9);
		// 	$pod_can_qty = odbc_result($result1, 10);
		// 	$pod_rcv_qty = odbc_result($result1, 11);
		// 	$pod_rej_qty = odbc_result($result1, 12);
		// 	$pod_tolerance = odbc_result($result1, 13);

		// 	$pod_bal_qty = ($pod_ord_qty - $pod_rcv_qty - $pod_can_qty) + ( ($pod_ord_qty * $pod_tolerance)/100 );

		// 	print(
		// 		json_encode(
		// 			array(
		// 				'poh_fyr' => odbc_result($result1, 1),
		// 				'poh_po_no' => odbc_result($result1, 2),
		// 				'poh_supcd' => odbc_result($result1, 3),
		// 				'pod_po_srl' => odbc_result($result1, 4),
		// 				'pod_item' => odbc_result($result1, 5),
		// 				'pod_spec_cd' => odbc_result($result1, 6),
		// 				'pod_tech_spec' => odbc_result($result1, 7),
		// 				'pod_rate' => odbc_result($result1, 8),
		// 				'pod_ord_qty' => $pod_ord_qty,
		// 				'pod_bal_qty' => $pod_bal_qty,
		// 				'itm_item' => odbc_result($result1, 14),
		// 				'itm_desc' => odbc_result($result1, 15),
		// 				'sup_name' => odbc_result($result1, 16),
		// 				'pod_fyr' => odbc_result($result1, 17),
		// 				'pod_po_no' => odbc_result($result1, 18),
		// 				'poh_stax_cd' => odbc_result($result1, 19),
		// 				'uom_cod_desc' => odbc_result($result1, 20),
		// 				'passActn' =>$passActn,
		// 			)
		// 		)
		// 	);
		// }else{
		// 	print(
		// 		json_encode(
		// 			array(
		// 				'poh_fyr' => '',
		// 				'poh_po_no' => '',
		// 				'poh_supcd' => '',
		// 				'pod_po_srl' => '',
		// 				'pod_item' => '',
		// 				'pod_spec_cd' => '',
		// 				'pod_tech_spec' => '',
		// 				'pod_rate' => '',
		// 				'pod_ord_qty' => '',
		// 				'pod_bal_qty' => '',
		// 				'itm_item' => '',
		// 				'itm_desc' => '',
		// 				'sup_name' => '',
		// 				'pod_fyr' => '',
		// 				'pod_po_no' => '',
		// 				'poh_stax_cd' => '',
		// 				'uom_cod_desc' => '',
		// 				'passActn' =>$passActn,
		// 			)
		// 		)
		// 	);
		// }		
	}

?>