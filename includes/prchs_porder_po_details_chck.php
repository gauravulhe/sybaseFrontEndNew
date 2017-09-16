<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
		$q=$_GET["q"];
		$PoInqNo = $_GET['PoInqNo'];
		$PoFinYr = $_GET['PoFinYr'];
		$PoPoDt = date('Y-m-d', strtotime($_GET['PoPoDt']));
		$UserComDbf = trim($_GET['UserComDbf']);
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];

		require_once('cmp_pass_actn.php');

		$query1 = "SELECT * FROM $UserComDbf.invac.pohdr poh
					INNER JOIN $UserComDbf.invac.podet pod
					ON
	 				poh.poh_com = pod.pod_com AND
	 				poh.poh_unit = pod.pod_unit AND
					poh.poh_po_no = pod.pod_po_no AND  
	 				poh.poh_fyr = pod.pod_fyr

					WHERE poh_com = $ComCd AND	poh_unit = $UntCd AND poh_po_dt = '$PoPoDt' AND poh_fyr = $PoFinYr AND poh_po_no = $q AND poh_vet_tag = 0";

		$result1 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		$result1 = odbc_exec($conn, $query1);


		if (!empty(odbc_result($result1, 1))) {

			// pdcomm table data 
			$query2 = "SELECT * FROM $UserComDbf.invac.pdcomm WHERE pdc_com = $ComCd AND	pdc_unit = $UntCd AND pdc_fyr = $PoFinYr AND pdc_po_no = $q";
			$result2 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
			$result2 = odbc_exec($conn, $query2);		
			$rows = array();
			while($myRow = odbc_fetch_array( $result2 )){ 
			    $rows[] = $myRow;//pushing into $rows array
			}
			$pdcData = "<table class='form-table'>";
				//Now iterating complete array
				foreach($rows as $row) {
						$pdcData .= "<tr><td><input type='text' name='pdc_sr[]' id='pdc_sr' maxlength='4' size='1' value='".$row['pdc_po_srl']."' readonly>
						<input type='text' name='pdc_id[]' id='pdc_id' maxlength='4' size='1' value='".$row['pdc_id']."'>
						<input type='text' name='pdc_tag[]' id='pdc_tag' maxlength='4' size='1' value='".$row['pdc_tag']."'>
						<input type='text' name='pdc_amt[]' id='pdc_amt' maxlength='4' size='8' value='".$row['pdc_amt']."'></td></tr>";
				}
			$pdcData .= "<table>";

			// pddet table data
			$query3 = "SELECT * FROM $UserComDbf.invac.pddet WHERE pdd_com = $ComCd AND	pdd_unit = $UntCd AND pdd_fyr = $PoFinYr AND pdd_po_no = $q";
			$result3 = @odbc_data_source( $conn, SQL_FETCH_FIRST );
			$result3 = odbc_exec($conn, $query3);
			$rows = array();
			while($myRow = odbc_fetch_array( $result3 )){ 
			    $rows[] = $myRow;//pushing into $rows array
			}
			$pddData = "<table class='form-table'>";
				//Now iterating complete array
				foreach($rows as $row) {
						$pddData .= "<tr><td><input type='text' name='pdd_sr[]' id='pdd_sr' maxlength='4' size='1' value='".$row['pdd_po_srl']."' readonly>
						<input type='text' name='pdd_sch_dt[]' id='pdd_sch_dt' maxlength='4' size='17' value='".$row['pdd_sch_dt']."'>
						<input type='text' name='pdd_stag_qty[]' id='pdd_stag_qty' maxlength='4' size='9' value='".$row['pdd_stag_qty']."'></td></tr>";
				}
			$pddData .= "<table>";


			print(
				json_encode(
					array(
						'poh_com' => odbc_result($result1, 1),
						'poh_unit' => odbc_result($result1, 2),
						'poh_fyr' => odbc_result($result1, 3),
						'poh_po_no' => odbc_result($result1, 4),
						'poh_po_dt' => odbc_result($result1, 5),
						'poh_supcd' => odbc_result($result1, 6),
						'poh_sup_accd' => odbc_result($result1, 7),
						'poh_stax_cd' => odbc_result($result1, 8),
						'poh_stax_per' => odbc_result($result1, 9),
						'poh_excise_cd' => odbc_result($result1, 10),
						'poh_gst_cd' => odbc_result($result1, 11),
						'poh_gst_per' => odbc_result($result1, 12),
						'poh_igst_per' => odbc_result($result1, 13),
						'poh_sgst_per' => odbc_result($result1, 14),
						'poh_cgst_per' => odbc_result($result1, 15),
						'poh_ugst_per' => odbc_result($result1, 16),
						'poh_dlv_dest' => odbc_result($result1, 17),
						'poh_disc' => odbc_result($result1, 18),
						'poh_paycr_days' => odbc_result($result1, 19),
						'poh_crdisc' => odbc_result($result1, 20),
						'poh_bank' => odbc_result($result1, 21),
						'poh_pmnt_terms' => odbc_result($result1, 22),
						'poh_upd_tag' => odbc_result($result1, 23),
						'poh_vet_tag' => odbc_result($result1, 24),
						'poh_val_tag' => odbc_result($result1, 25),
						'poh_inq_fyr' => odbc_result($result1, 26),
						'poh_inq_no' => odbc_result($result1, 27),
						'poh_po_type' => odbc_result($result1, 28),
						'poh_addl_rmk' => odbc_result($result1, 29),
						'poh_exp_dt' => odbc_result($result1, 30),
						'poh_sys_dt' => odbc_result($result1, 31),
						'poh_userid' => odbc_result($result1, 32),
						'poh_updid' => odbc_result($result1, 33),
						'pod_com' => odbc_result($result1, 34),
						'pod_unit' => odbc_result($result1, 35),
						'pod_fyr' => odbc_result($result1, 36),
						'pod_po_no' => odbc_result($result1, 37),
						'pod_po_srl' => odbc_result($result1, 38),
						'pod_item' => odbc_result($result1, 39),
						'pod_spec_cd' => odbc_result($result1, 40),
						'pod_tech_spec' => odbc_result($result1, 41),
						'pod_rate' => odbc_result($result1, 42),
						'pod_ord_qty' => odbc_result($result1, 43),
						'pod_can_qty' => odbc_result($result1, 44),
						'pod_rcv_qty' => odbc_result($result1, 45),
						'pod_rej_qty' => odbc_result($result1, 46),
						'pod_tolerance' => odbc_result($result1, 47),
						'pod_chpt_id' => odbc_result($result1, 48),
						'pod_comp_dt' => odbc_result($result1, 49),
						'pod_sys_dt' => odbc_result($result1, 50),
						'passActn' =>$passActn,
						'pdc_data' => $pdcData,
						'pdd_data' => $pddData
					)
				)
			);
		}else{
			print(
				json_encode(
					array(
						'poh_com' => '',
						'poh_unit' => '',
						'poh_fyr' => '',
						'poh_po_no' => '',
						'poh_po_dt' => '',
						'poh_supcd' => '',
						'poh_sup_accd' => '',
						'poh_stax_cd' => '',
						'poh_stax_per' => '',
						'poh_excise_cd' => '',
						'poh_gst_cd' => '',
						'poh_gst_per' => '',
						'poh_igst_per' => '',
						'poh_sgst_per' => '',
						'poh_cgst_per' => '',
						'poh_ugst_per' => '',
						'poh_dlv_dest' => '',
						'poh_disc' => '',
						'poh_paycr_days' => '',
						'poh_crdisc' => '',
						'poh_bank' => '',
						'poh_pmnt_terms' => '',
						'poh_upd_tag' => '',
						'poh_vet_tag' => '',
						'poh_val_tag' => '',
						'poh_inq_fyr' => '',
						'poh_inq_no' => '',
						'poh_po_type' => '',
						'poh_addl_rmk' => '',
						'poh_exp_dt' => '',
						'poh_sys_dt' => '',
						'poh_userid' => '',
						'poh_updid' => '',
						'pod_com' => '',
						'pod_unit' => '',
						'pod_fyr' => '',
						'pod_po_no' => '',
						'pod_po_srl' => '',
						'pod_item' => '',
						'pod_spec_cd' => '',
						'pod_tech_spec' => '',
						'pod_rate' => '',
						'pod_ord_qty' => '',
						'pod_can_qty' => '',
						'pod_rcv_qty' => '',
						'pod_rej_qty' => '',
						'pod_tolerance' => '',
						'pod_chpt_id' => '',
						'pod_comp_dt' => '',
						'pod_sys_dt' => '',
						'passActn'=>$passActn
					)
				)
			);
		}		
	}

?>