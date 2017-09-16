<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){

		$q=$_GET["q"];
		$PoFinYr = $_GET['PoFinYr'];
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];
		$UserComDbf = $_GET['UserComDbf'];

		$query = "SELECT req_fyr,req_no,req_srl,req_dt,req_dept,req_item,req_qty,req_aprvd_qty,req_can_qty,req_ord_qty	 FROM catalog.invac.request where req_com = $ComCd AND req_unit = $UntCd AND req_fyr = $PoFinYr AND req_item = '$q'";
		// $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
		// $result = odbc_exec($conn, $query);
		// $rows1 = odbc_fetch_row($result);
		// //print(odbc_result($result, 4));
		// //print(odbc_result_all($result, "border=1"));
		// print(
		// 	json_encode(
		// 		array(
		// 			'req_fyr' => odbc_result($result, 1),
		// 			'req_no' => odbc_result($result, 2),
		// 			'req_srl' => odbc_result($result, 3),
		// 			'req_dt' => odbc_result($result, 4),
		// 			'req_dept' => odbc_result($result, 5),
		// 			'req_item' => odbc_result($result, 6),
		// 			'req_qty' => odbc_result($result, 7),
		// 			'req_aprvd_qty' => odbc_result($result, 8),
		// 			'req_can_qty' => odbc_result($result, 9),
		// 			'req_ord_qty' => odbc_result($result, 10)
		// 		)
		// 	)
		// );


		$queresa = odbc_exec($conn,$query);
		$rows = array();

		while($myRow = odbc_fetch_array( $queresa )){ 
		    $rows[] = $myRow;//pushing into $rows array
		}

		echo '<table><tr><th>Fyr</th><th>Req</th><th>Srl</th><th>Dept</th><th>Item</th><th>Qty</th><th>Yes/No</th></tr>';
			//Now iterating complete array
			foreach($rows as $row) {

				$CrntDt=date_create(date('Y-m-d', strtotime(date('Y-m-d 00:00:00'))));
				$PoReqDt=date_create(date('Y-m-d', strtotime($row['req_dt'])));
				$diff=date_diff($CrntDt,$PoReqDt);
				$diff = $diff->format("%a");

		        $qty = number_format($row['req_aprvd_qty'] - $row['req_ord_qty'], 2, '.', '');
		        if ($qty > 0 && $diff <= 300) {
					echo '<tr>';
			        echo '<td><input type="text" name="pdr_req_fyr[]" id="pdr_req_fyr_'.$row['req_no'].'" readonly maxlength="4" size="1" value="'.$row['req_fyr'].'"></td>';
			        echo '<td><input type="text" name="pdr_req_no[]" id="pdr_req_no_'.$row['req_no'].'" readonly maxlength="4" size="1" value="'.$row['req_no'].'"></td>';
			        echo '<td><input type="text" name="pdr_req_srl[]" id="pdr_req_srl_'.$row['req_no'].'" readonly maxlength="4" size="1" value="'.$row['req_srl'].'"></td>';
			        echo '<td><input type="text" name="req_dept[]" id="req_dept_'.$row['req_no'].'" readonly maxlength="4" size="1" value="'.$row['req_dept'].'"></td>';
			        echo '<td><input type="text" name="req_item[]" id="req_item_'.$row['req_no'].'" readonly maxlength="4" size="1" value="'.$row['req_item'].'"></td>';
			        echo '<td><input type="text" name="req_qty[]" id="req_qty_'.$row['req_no'].'" readonly maxlength="10" size="6" value="'.$qty.'"></td>';
			        echo '<td>
			        		<select name="req_qty" id="req_qty_select_'.$row['req_no'].'" onchange="ChangePoOrdQty(this.value)">
			        			<option value="0">No</option>
			        			<option value="'.$qty.'">Yes</option>
			        		</select>
			        	</td>';
			        echo '</tr>';
		        }
			}
		echo '</table>';
	}

?>