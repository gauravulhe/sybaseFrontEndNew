<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
        	$q = $_GET["q"];
            $GpMatDt = date('Y-m-d 00:00:00', strtotime($_GET["GpMatDt"]));
            $UserComDbf = trim($_GET["UserComDbf"]);
        
            require_once('cmp_pass_actn.php');

        	$query = "SELECT * FROM $UserComDbf.invac.gpass WHERE gpa_no = $q AND gpa_dt = '$GpMatDt'";
        	// execute the query
            $result = odbc_exec($conn, $query);
            //print(odbc_result_all($result, "border=1"));
            if (!empty(odbc_result($result, 1))) {
                $query2 = "SELECT * FROM $UserComDbf.invac.gpdet WHERE gpd_no = $q AND gpd_dt = '$GpMatDt'";
                $result2 = odbc_exec($conn, $query2);
                $rows = array();
                while ($myRow = odbc_fetch_array($result2)) {
                    $rows[] = $myRow;
                }

                $gpdData = "<table class='form-table'>                    
                                        <tr>
                                            <th>Srl</th>
                                            <th>Item Code</th>
                                            <th>Item Desc</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th>UOM</th>
                                            <th>Exp. Dt</th>
                                        </tr>";
                    //Now iterating complete array
                    foreach($rows as $row) {
                            $gpdData .= "<tr><td><input type='text' name='gpd_srl[]' value='".$row['gpd_srl']."' id='gpd_srl' maxlength='2' size='1' required></td><td><input type='text' name='gpd_item[]' value='".$row['gpd_item']."' id='gpd_item' maxlength='7' size='7' required></td><td><input type='text' name='gpd_itm_desc[]' value='".$row['gpd_itm_desc']."' id='gpd_itm_desc' maxlength='36' size='20' required style='text-transform: uppercase'></td><td><input type='text' name='gpd_qty[]' value='".$row['gpd_qty']."' id='gpd_qty' maxlength='10' size='5' required></td><td><input type='text' name='gpd_rate[]' value='".$row['gpd_rate']."' id='gpd_rate' maxlength='10' size='8' required></td><td><input type='text' name='gpd_uom[]' value='".$row['gpd_uom']."' id='gpd_uom' maxlength='10' size='5' required></td><td><input type='text' name='gpd_expected_dt[]' value='".date('d-m-Y', strtotime($row['gpd_expected_dt']))."' id='gpd_expected_dt' placeholder='dd/mm/yyyy' maxlength='10' size='8' required></td></tr>";
                    }
                $gpdData .= "<table>";
            	print(
            		json_encode(
            			array(
                            'gpa_com' => odbc_result($result, 1),
                            'gpa_unit' => odbc_result($result, 2),
                            'gpa_dt' => odbc_result($result, 3),
                            'gpa_no' => odbc_result($result, 4),
                            'gpa_ryn' => odbc_result($result, 5),
                            'gpa_tc' => odbc_result($result, 6),
                            'gpa_ptycd' => odbc_result($result, 7),
                            'gpa_pty_rep' => odbc_result($result, 8),
                            'gpa_truck_no' => odbc_result($result, 9),
                            'gpa_ref_no' => odbc_result($result, 10),
                            'gpa_ref_dt' => date('d-m-Y', strtotime(odbc_result($result, 11))),
                            'gpa_dept' => odbc_result($result, 12),
                            'gpa_sys_dt' => odbc_result($result, 13),
                            'gpa_upd_dt' => odbc_result($result, 14),
                            'gpa_remarks' => odbc_result($result, 15),
                            'gpa_userid' => odbc_result($result, 16),
                            'gpa_can_tag' => odbc_result($result, 17),
                            'gpdData' => $gpdData,
                            'passActn' => $passActn
            			)
            		)
            	);
            }else{
                print(
                    json_encode(
                        array(
                            'gpa_com' => '',
                            'gpa_unit' => '',
                            'gpa_dt' => '',
                            'gpa_no' => '',
                            'gpa_ryn' => '',
                            'gpa_tc' => '',
                            'gpa_ptycd' => '',
                            'gpa_pty_rep' => '',
                            'gpa_truck_no' => '',
                            'gpa_ref_no' => '',
                            'gpa_ref_dt' => '',
                            'gpa_dept' => '',
                            'gpa_sys_dt' => '',
                            'gpa_upd_dt' => '',
                            'gpa_remarks' => '',
                            'gpa_userid' => '',
                            'gpa_can_tag' => '',
                            'passActn' => $passActn
                        )
                    )
                );
            }
	}
?>