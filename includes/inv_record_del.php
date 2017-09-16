<?php 
	
	require_once('../config/config.php');
	if(isset($_GET["q"])){
		$q = $_GET["q"];
		$FrmNm = $_GET["FrmNm"];

		if ($FrmNm == 'comcat') {
			$u = $_GET['u'];
			$query = "DELETE FROM catalog..comcat WHERE com_com = $q AND com_unit = $u";
		}

		if ($FrmNm == 'codent') {
			$u = $_GET["u"];
			$query = "DELETE FROM catalog..codecat WHERE cod_prefix = $q AND cod_code = $u";
		}

		if ($FrmNm == 'itemcat') {
			$query = "DELETE FROM catalog..itmcat WHERE itm_item = '$q'";
		}

		if ($FrmNm == 'deptent') {
			$u = $_GET["u"];
			$query = "DELETE FROM catalog..deptcat WHERE dep_prefix = $q AND dep_cd = $u";
		}

		if ($FrmNm == 'supeccmst') {			
			$q = strtoupper($_GET["q"]);
			$query = "DELETE FROM catalog..supeccmst WHERE esup_supcd = '$q'";
		}

		if ($FrmNm == 'supcat') {			
			$q = strtoupper($_GET["q"]);
			$query = "DELETE FROM catalog..supcat WHERE sup_supcd = '$q'";
		}

		if ($FrmNm == 'matmast') {			
			$q = strtoupper($_GET["q"]);
			$UserComCd = $_GET['UserComCd'];
			$UserUntCd = $_GET['UserUntCd'];
			$UserComDbf = $_GET['UserComDbf'];
			$query = "DELETE FROM $UserComDbf.invac.matmast WHERE mat_com = $UserComCd AND mat_unit = $UserUntCd AND mat_item = '$q'";
		}

		if ($FrmNm == 'submast') {			
			$q=strtoupper($_GET["q"]);
			$GenLedCd = $_GET["GenLedCd"];
			$UserFduser = $_GET["UserFduser"];
			$UserComDbf = $_GET["UserComDbf"];
			$UserComCd = $_GET["UserComCd"];
			$UserUntCd = $_GET["UserUntCd"];
			$query = "DELETE FROM $UserComDbf.$UserFduser.submast WHERE sub_com = $UserComCd AND sub_unit = $UserUntCd AND sub_accd = '$GenLedCd' AND sub_subcd = '$q'";
		}

		if ($FrmNm == 'porder') {			
			$q=strtoupper($_GET["q"]);
			$PoFinYr = $_GET["PoFinYr"];
			$UserComDbf = trim($_GET["UserComDbf"]);
			$ComCd = $_GET["ComCd"];
			$UntCd = $_GET["UntCd"];
			$queryUpdGetData = "SELECT DISTINCT pod.pod_ord_qty,pod.pod_can_qty,pod.pod_rcv_qty,pod.pod_po_srl,pod.pod_item,req.req_ord_qty,req.req_can_qty,req.req_fyr,req.req_no,req.req_srl,req.req_item
						FROM $UserComDbf.invac.podet pod
						INNER JOIN $UserComDbf.invac.pdreq pdr
						ON
						pod.pod_com = pdr.pdr_com AND
						pod.pod_unit = pdr.pdr_unit AND
						pod.pod_fyr = pdr.pdr_fyr AND
						pod.pod_po_no = pdr.pdr_po_no AND
						pod.pod_po_srl = pdr.pdr_po_srl
						INNER JOIN catalog.invac.request req
						ON
						pod.pod_com = req.req_com AND
						pod.pod_unit = req.req_unit AND
						pdr.pdr_req_fyr = req.req_fyr AND
						pdr.pdr_req_no	= req.req_no AND
						pdr.pdr_req_srl	= req.req_srl AND
						pod.pod_item = req.req_item
						WHERE pod_com = $ComCd AND pod_unit = $UntCd AND pod_fyr = $PoFinYr AND pod_po_no = $q ORDER BY pod_po_srl";

			$resultUpd1 = odbc_exec($conn, $queryUpdGetData);
			//print(odbc_result_all($resultUpd1, "border=1"));

			$rows = array();
			while($myRow = odbc_fetch_array( $resultUpd1 )){ 
			    $rows[] = $myRow;//pushing into $rows array
			}
			foreach($rows as $row) {
				$pod_ord_qty = $row['pod_ord_qty'];
				$pod_can_qty = $row['pod_can_qty'];
				$pod_rcv_qty = $row['pod_rcv_qty'];
				$req_ord_qty = $row['req_ord_qty'];
				$pod_item = $row['pod_item'];
				$pod_po_srl = $row['pod_po_srl'];			
				$req_fyr = $row['req_fyr'];
				$req_no = $row['req_no'];
				$req_item = $row['req_item'];
				$req_srl = $row['req_srl'];				

				$pod_can_qty = $pod_ord_qty - $pod_rcv_qty - $pod_can_qty;
				$req_ord_qty = $req_ord_qty - $pod_can_qty;

				$queryUpdSetData = "UPDATE $UserComDbf.invac.podet SET pod_can_qty = $pod_can_qty WHERE pod_com = $ComCd AND pod_unit = $UntCd AND pod_fyr = $PoFinYr AND pod_po_no = $q AND pod_item = '$pod_item' AND pod_po_srl = $pod_po_srl";
				$resultUpd2 = odbc_exec($conn, $queryUpdSetData);

				$query = "UPDATE catalog.invac.request SET req_ord_qty = $req_ord_qty WHERE req_com = $ComCd AND req_unit = $UntCd AND req_fyr = $req_fyr AND req_no = $req_no AND req_srl = $req_srl AND req_item = '$req_item'";
				$result = odbc_exec($conn, $query);
			}

		}

		if ($FrmNm == 'gateent') {
			$UserComDbf = trim($_GET["UserComDbf"]);
			$query = "DELETE FROM $UserComDbf.invac.gptran WHERE gp_tran_cd = $q";
		}

		if ($FrmNm == 'gpmatent') {
			$UserComDbf = trim($_GET["UserComDbf"]);
			$GpMatDt = date('Y-m-d 00:00:00', strtotime($_GET['GpMatDt']));
			$gpa_com = $_GET['ComCd'];
			$gpa_unit = $_GET['UntCd'];
			$query1 = "DELETE FROM $UserComDbf.invac.gpass WHERE gpa_com = $gpa_com AND gpa_unit = $gpa_unit AND gpa_dt = '$GpMatDt' AND gpa_no = $q";
			if (odbc_exec($conn, $query1)) {
				$query = "DELETE FROM $UserComDbf.invac.gpdet WHERE gpd_com = $gpa_com AND gpd_unit = $gpa_unit AND gpd_dt = '$GpMatDt' AND gpd_no = $q";
			}
		}

		$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );

		//perform the query
		$result = odbc_exec($conn, $query);
		//print(odbc_result_all($result, "border=1"));
	}
?>