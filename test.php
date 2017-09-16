<?php

	// server configuration
	//$serverName = "SYBLINUX";
	$serverName = "SVRSYB";
	$userName = "sa";
	$password = "master";
	$conn=odbc_connect($serverName, $userName, $password) or die("Sybase Error".odbc_error());
	session_start();

	// $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
	// while($result)
	// {
	//     echo "DSN: " . $result['server'] . " - " . $result['description'] . "<br>\n";
	//     $result = @odbc_data_source( $conn, SQL_FETCH_NEXT );	    
	// }

	//odbc_close($conn);

	// $result = odbc_tables($conn);

	//    $tables = array();
	//    while (odbc_fetch_row($result)){
	//      if(odbc_result($result,"TABLE_TYPE")=="TABLE")
	//        echo"<br>".odbc_result($result,"TABLE_NAME");

	//    }

	// $checkProcLock = "select * from neco.invac.proc_lock";
	// $checkProcLockExec = odbc_exec($conn, $checkProcLock);
	// print_r(odbc_result_all($checkProcLockExec, "border=1"));exit;

	// $query = "SELECT * FROM catalog..userid";
	// $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
	// $result = odbc_exec($conn, $query);
	// print_r(odbc_result_all($result, "border=1"));exit;

	//print(odbc_field_type($result1, 14));
	
	//$query = "SELECT * FROM catalog..comcat where com_com = 1 AND com_unit = 1";
	$query = "SELECT * FROM catalog..codecat";
	//$query = "SELECT * FROM catalog..itmcat WHERE itm_item = '0101003'";
	//$query = "SELECT dep_cd,dep_desc FROM catalog..deptcat WHERE dep_cd != 0 AND dep_prefix = 2";
	//$query = "SELECT * FROM catalog..supeccmst";
	//$query = "SELECT * FROM catalog..shortage";
	//$query = "SELECT * FROM catalog..supcat";
	//$query = "SELECT * FROM catalog..gencat";
	//$query = "select * from tempdb..sysobjects";

	// $useDb = "use naca";
	// $useDbResult = @odbc_exec($conn, $useDb);

	// $setUser = "setuser 'sales'";
	// $setUserResult = @odbc_exec($conn, $setUser);

	//$query = "select * from catalog.sales.chpthead";
		
	// $query = "SELECT * FROM catalog.invac.request where req_com = 54 AND req_unit = 3 AND req_fyr = 2018 AND req_no = 57";
	
	//$query = "SELECT * FROM catalog.dbo.excrate";
	//$query = "SELECT * FROM neco.invac.parinv";
	// $query = "SELECT * FROM neco.invac.parinv WHERE par_com = 1 AND par_unit = 1 AND par_tbl = 'pohdr' AND par_fyr = 2017";
	$result = odbc_exec($conn, $query);
	print(odbc_result_all($result, "border=1"))."<br>";
	
	
	//$query = "SELECT * FROM tmppodet";
	//$query = "SELECT * FROM neco.invac.matmast where mat_item = '0101003'";
	//$query = "SELECT * FROM neco.invac.apprmk WHERE app_po_no = 10036 AND app_fyr = 2017";
	// $query = "SELECT * FROM neco.fin1.submast WHERE sub_accd = '271204' AND sub_com = 1 AND sub_unit = 1";
	//$query = "SELECT * FROM catalog..itmcat WHERE itm_item = '2304050'";
	// $query = "SELECT * FROM neco.invac.request";

	//$query = "SELECT * FROM naca.sales.challan WHERE cha_com = 41 AND cha_chal_no = 986";
	// $query = "SELECT * FROM neco.invac.pogrdfrmk WHERE pgd_com = 1 AND pgd_unit = 1";

	// $result = odbc_exec($conn, $query);
	// $dataSubmast = odbc_result($result, 4);
	// print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT * 
	// 				FROM catalog..supcat sup
	// 				LEFT JOIN neco.fin1.submast sub
	// 				ON sup.sup_supcd = sub.sub_subcd
	// 				LEFT JOIN catalog..gencat gen
	// 				ON sub.sub_accd = gen.gen_accd WHERE sub_com = 1 AND sub_unit = 1  AND sup_stct_cd = '09127009' ORDER BY sub_accd DESC";

	// $query = "SELECT * FROM neco.invac.pohdr WHERE poh_po_no = 10036 AND poh_fyr = 2017";

	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";
	
	//$query = "UPDATE catalog..procpass SET pas_passwd	= 'gpapp' WHERE pas_system = 'invac' AND pas_proc = 'gpmatent' AND pas_action = 'A'";

	//$query = "INSERT INTO catalog..procpass (pas_system, pas_proc, pas_action, pas_passwd) values ('invac','gpmatent','A','gpappnd')";
	
	//$query = "SELECT * FROM catalog..procpass WHERE pas_proc = 'supcat' AND pas_action = 'I'";

	/////////////////  finac /////////////

	//$query = "SELECT * FROM neco.fin1.submast WHERE sub_subcd = 'A002'";
	//$query = "SELECT * FROM neco.fin1.acmast";
	//$query = "SELECT * FROM neco.fin1.bkmast";
	//$query = "SELECT * FROM neco.fin1.budgmast";

	//$query = "SELECT * FROM neco.invac.podet where pod_po_no = 10036 AND pod_fyr = 2017";
	// $query = "SELECT poh.poh_po_no, poh.poh_po_dt, pod.pod_item, poh.poh_pmnt_terms, pod.pod_ord_qty, pod.pod_rate, pod.pod_chpt_id, poh.poh_supcd, poh.poh_stax_per, poh.poh_excise_cd, poh.poh_gst_per, poh.poh_igst_per, poh.poh_sgst_per, poh.poh_cgst_per
	// 					FROM neco.invac.podet pod
	// 					INNER JOIN neco.invac.pohdr poh
	// 					ON  pod.pod_po_no = poh.poh_po_no AND 
	// 						pod.pod_unit = poh.poh_unit AND
	// 						pod.pod_fyr = poh.poh_fyr
	// 					WHERE pod.pod_unit = 1 AND pod.pod_po_no = 503 AND pod.pod_fyr = 2017 AND (poh.poh_vet_tag = 01 OR poh.poh_val_tag = 01) AND poh.poh_po_type != 09
	// 					ORDER BY poh.poh_po_dt DESC, pod.pod_po_srl DESC
	// 					";

	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT poh.poh_po_no, poh.poh_po_dt, pod.pod_item, pod.pod_po_srl, pod.pod_ord_qty , pod.pod_can_qty , pod.pod_rcv_qty , pod.pod_rej_qty  
	// 			FROM neco.invac.podet pod
	// 			INNER JOIN neco.invac.pohdr poh
	// 			ON pod.pod_po_no = poh.poh_po_no AND  
	// 				pod.pod_unit = poh.poh_unit AND
	// 				pod.pod_fyr = poh.poh_fyr
	// 			WHERE pod.pod_unit = 1 AND pod.pod_item = '0101003' AND (poh.poh_vet_tag = 01 OR poh.poh_val_tag = 01) AND poh.poh_po_type != 09
	// 			ORDER BY poh.poh_po_dt DESC, pod.pod_po_srl DESC
	// 			";

	


////////////////////////////////////////////////////////////////////////////////////////////////////////////


	// $query = "SELECT * FROM catalog.invac.request where req_com = 1 AND req_unit = 1 AND req_fyr = 2016 AND req_item = '2304050'";

	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";
	
	$query = "SELECT * FROM neco.invac.pohdr WHERE poh_com = 1 AND	poh_unit =1 AND	poh_fyr = 2017 AND poh_po_no = 185";
	
	$result = odbc_exec($conn, $query);
	print(odbc_result_all($result, "border=1"))."<br>";

	$query = "SELECT * FROM neco.invac.podet WHERE pod_com = 1 AND	pod_unit =1 AND	pod_fyr = 2017 AND pod_po_no = 185";
	
	$result = odbc_exec($conn, $query);
	print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT * FROM neco.invac.pdcomm where pdc_com = 1 AND pdc_unit = 1 AND pdc_fyr = 2017 AND pdc_po_no = 571";
	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";
	
	// $query = "SELECT * FROM neco.invac.pddet where pdd_com = 1 AND pdd_unit = 1 AND pdd_fyr = 2017  AND pdd_po_no = 571";
	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT * FROM neco.invac.pdreq where pdr_com = 1 AND pdr_unit = 1 AND pdr_fyr = 2017  AND pdr_po_no = 571";
	//  $result = odbc_exec($conn, $query);
	// //$rows = odbc_num_rows($result);
	// //print(odbc_result($result, 1)+1);
	// print(odbc_result_all($result, "border=1"))."<br>";


////////////////////////////////////////////////////////////////////////////////////////////////////////////


	//$query = "SELECT req_qty, req_rmk, req_catg, req_can_qty, req_aprvd_qty, req_cons_days, req_inq_fyr, req_inq_no FROM catalog.invac.request WHERE req_com = 1 AND req_unit = 1 AND req_fyr = 2017 AND req_no = 211 AND req_srl = 1 AND req_dt = '2017-06-26' AND req_dept = 1";

	//$query = "UPDATE catalog.invac.request set req_item = '0101003', req_qty = 2.00, req_aprvd_qty = 2.000, req_can_qty = 0.000, req_rmk = 'TESTING FOR FRONT END', req_catg = 'E', req_inq_fyr = 0, req_inq_no = 0, req_cons_days = 1 where req_com = 1 AND req_unit = 1 AND req_fyr = 2017 AND req_no = 211 AND req_srl = 1 AND req_dt = '2017-06-26' AND req_dept = 1";

	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//$que = "SELECT top 5 notification FROM notification order by datetime desc";
	// $query = "SELECT req_fyr,req_no,req_srl,req_dt,req_dept,req_item,req_qty,req_aprvd_qty,req_can_qty,req_ord_qty	 FROM catalog.invac.request where req_com = 1 AND req_unit = 1 AND req_fyr = 2017 AND req_item = '0101311'";
	// $queresa = odbc_exec($conn,$query);
	// $rows = array();

	// while($myRow = odbc_fetch_array( $queresa )){ 
	//     $rows[] = $myRow;//pushing into $rows array
	// }

	// //Now iterating complete array
	// foreach($rows as $row) {
	// 	// $CrntDt = date('Ymd', strtotime(date('Y-m-d 00:00:00')));
	// 	// $PoReqDt = date('Ymd', strtotime($row['req_dt']));
	// 	// echo $date = $CrntDt - $PoReqDt;
	// echo '<table><tr>';
 //        foreach($row as $key => $value) {
 //            $result = $value;
 //            echo '<td>';
 //            echo $result;
 //            echo '</td>';
 //        }
	// echo '</tr></table>';
	// }

	//////////////////////////////////////////////////////////////////////////////////////////////////////


	// $query = "SELECT * FROM neco.invac.gpass WHERE gpa_dt = '2017-08-14'";
	// $result = odbc_exec($conn, $query);
	// for ($i=1; $i <= 17; $i++) { 
	// 	print(odbc_field_name($result, $i));echo " - ";
	// 	print(odbc_field_type($result, $i));echo "<br>";

	// }
	// print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT * FROM neco.invac.gpdet WHERE gpd_dt = '2017-08-14'";
	// $result = odbc_exec($conn, $query);	
	// for ($i=1; $i <= 15; $i++) { 
	// 	print(trim(odbc_field_name($result, $i)));echo "- ";
	// 	print(odbc_field_type($result, $i));echo "<br>";

	// }
	// print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT DISTINCT gpr_fyr FROM neco.invac.gprec";
	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT * FROM neco.invac.gptran";
	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT * FROM catalog..personnel  WHERE per_sex = 'M'";
	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";

	////////////////////////////////////////////////////////////////////////////////////////////////////

	//$query = "SELECT * FROM neco.invac.issue WHERE iss_com = 1 AND iss_unit = 1 AND iss_fyr = 2017 AND iss_dt = '2017-08-18'";
	$query = "SELECT * FROM neco.invac.issue WHERE iss_com = 1 AND iss_unit = 1 AND iss_fyr = 2017 AND iss_tc = 11 AND iss_item = '0101003'";
	$result = odbc_exec($conn, $query);
	//print(trim(odbc_field_name($result, 2)));
	// print(odbc_result($result, 1));
	// for ($i=1; $i <= 22; $i++) { 
	// 	print(odbc_field_name($result, $i));echo " - ";
	// 	print(odbc_field_type($result, $i));echo "<br>";

	// }
	print(odbc_result_all($result, "border=1"))."<br>";

	//////////////////////////////////////////////////////////////////////////////////////////////////////


	// $query = "SELECT * FROM catalog..decltds WHERE dec_fyr = 2017";
	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";

	//////////////////////////////////////////////////////////////////////////////////////////////////////


	// $query = "SELECT * FROM catalog..procpass";
	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";


	//////////////////////////////////////////////////////////////////////////////////////////////////////

	$query = "SELECT * FROM neco.invac.grhdr WHERE grh_com = 1 AND	grh_unit = 1 AND grh_no = 671 AND grh_fyr = 2017";
	$result = odbc_exec($conn, $query);
	//$rows = odbc_num_rows($result);
	// for ($i=1; $i <= 30; $i++) { 
	// 	print(odbc_field_name($result, $i));echo " - ";
	// 	print(odbc_field_type($result, $i));echo "<br>";

	// }
	//print(odbc_field_type($result, 2));
	print(odbc_result_all($result, "border=1"))."<br>";

	//$query = "UPDATE neco.invac.grdet SET grd_cbldtag = NULL WHERE grd_com = 1 AND	grd_unit = 1 AND grd_no = 1753 AND grd_fyr = 2017 AND grd_dt = '2017-08-03 00:00:00' AND grd_po_fyr = 2016 AND grd_po_no = 1911";

	$query = "SELECT * FROM neco.invac.grdet WHERE grd_com = 1 AND	grd_unit = 1 AND grd_fyr = 2017 AND grd_no = 671";
	$result = odbc_exec($conn, $query);
	//$rows = odbc_num_rows($result);
	// for ($i=1; $i <= 24; $i++) { 
	// 	print(odbc_field_name($result, $i));echo " - ";
	// 	print(odbc_field_type($result, $i));echo "<br>";

	// }
	print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT * FROM neco.invac.gradj WHERE gra_com = 1 AND	gra_unit = 1 AND gra_no = 1753 AND gra_fyr = 2017";
	// $result = odbc_exec($conn, $query);
	// //$rows = odbc_num_rows($result);
	// print(odbc_result_all($result, "border=1"))."<br>";


	// $StCtNameQry = "SELECT * FROM catalog..stctcat";
	// $StCtNameResult = odbc_exec($conn, $StCtNameQry);
	// print(odbc_result_all($StCtNameResult, 'border=1'));

	// $query = "CREATE TABLE tempdb..tmppodet_8221 (
	// 	pod_com        tinyint         not null, 
	//      pod_unit       tinyint         not null,
	//          pod_fyr        smallint        not null, 
	//      pod_po_no      numeric(6,0)    not null,
	//      pod_po_srl     tinyint         not null, 
	//      pod_item       char(7)         not null,
	//      pod_rate       numeric(10,2)       null, 
	//      pod_ord_qty    numeric(10,3)       null,
	//      pod_bal_qty    numeric(10,3)       null,
	//      pod_tech_spec  char(50)            null
	// )";
	//$query = "select * from tempdb.dbo.sysobjects where name = 'tmppodet_8221'";
	//$query = "select * from tempdb..tmppodet_8221";
	//$query = "select * from tempdb..tmppdcom_8221";
	// $query = "select * from tempdb..tmppohdr_8221";
	// $query = "SELECT 
	// 				poh.poh_fyr,poh.poh_po_no,poh.poh_supcd,
	// 				pod.pod_po_srl,pod.pod_item,pod.pod_spec_cd,pod.pod_tech_spec,pod.pod_rate,pod.pod_ord_qty,pod.pod_can_qty,pod.pod_rcv_qty,pod.pod_rej_qty,pod.pod_tolerance,
	// 				itm.itm_item,itm.itm_desc,
	// 				sup.sup_name,pod.pod_fyr,pod.pod_po_no,poh.poh_stax_cd,cod.cod_desc
	// 				FROM neco.invac.pohdr poh
	// 				INNER JOIN neco.invac.podet pod
	// 				ON
	//  				poh.poh_com = pod.pod_com AND
	//  				poh.poh_unit = pod.pod_unit AND
	// 				poh.poh_po_no = pod.pod_po_no AND  
	//  				poh.poh_fyr = pod.pod_fyr
	//  				INNER JOIN catalog..itmcat itm
	//  				ON
	//  				pod.pod_item = itm.itm_item
	//  				INNER JOIN catalog..supcat sup
	//  				ON
	//  				poh.poh_supcd = sup.sup_supcd
	//  				INNER JOIN catalog..codecat cod
	//  				ON cod.cod_code = itm.itm_uom
	// 				WHERE poh_com = 1 AND	poh_unit = 1 AND poh_fyr = 2016 AND poh_po_no = 2502 AND cod_prefix = 6 ORDER BY pod_po_srl";
	// $result = odbc_exec($conn, $query);
	// for ($i=1; $i <= 10; $i++) { 
	// 	print(odbc_field_name($result, $i));echo " - ";
	// 	print(odbc_field_type($result, $i));echo "<br>";

	// }
	//print(odbc_result_all($result, "border=1"))."<br>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////


	// $query = "SELECT * FROM tempdb.sales.bilvalue2_8221";
	// $result = odbc_exec($conn, $query);
	//$rows = odbc_num_rows($result);
	// for ($i=1; $i <= 38; $i++) { 
	// 	print(odbc_field_name($result, $i));echo " - ";
	// 	print(odbc_field_type($result, $i));echo "<br>";

	// }
	//print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT * FROM neco.sales.challan where cha_chal_no = 3049";
	// $result = odbc_exec($conn, $query);
	// //$rows = odbc_num_rows($result);
	// print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT * FROM catalog.dbo.dbtcat where dbt_ptycd = 'J287'";
	// $result = odbc_exec($conn, $query);
	// //$rows = odbc_num_rows($result);
	// print(odbc_result_all($result, "border=1"))."<br>";


/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// check if table1 exists or not
	// $tab1_check_query = "SELECT * FROM tempdb..sysobjects";
	// $tab1_result = @odbc_exec($conn, $tab1_check_query);		
	// //$tab1_name = @odbc_result($tab1_result, 1);
	// print(odbc_result_all($tab1_result, "border=1"));

////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// $queryPoGetData1 = "SELECT DISTINCT 
	// 	bil.comp,
	// 	bil.unit,
	// 	bil.chapty,
	// 	dbt.dbt_name,
	// 	dbt.dbt_add1,
	// 	dbt.dbt_add2,
	// 	dbt.dbt_add3,
	// 	dbt.dbt_stct_cd,
	// 	dbt.dbt_gstin_no,
	// 	bil.chacon,
	// 	bil.ordfyr,
	// 	bil.ordno,
	// 	itm.itm_item,
	// 	itm.itm_desc,
	// 	bil.bilno,
	// 	bil.bildt,
	// 	bil.dlvqty,
	// 	bil.actwt,
	// 	bil.rate,
	// 	bil.igst,
	// 	bil.sgst,
	// 	bil.cgst,
	// 	bil.truckno,
	// 	bil.lrno,
	// 	bil.lrdt,
	// 	cha.cha_transporter,
	// 	cha.cha_driver,
	// 	bil.ptyordno,
	// 	bil.chapt_head,
	// 	dbt.dbt_stct_cd,
	// 	bil.value,
	// 	bil.loa_no,
	// 	bil.srl,
	// 	bil.bilexcise,
	// 	bil.bilcess,
	// 	bil.bilhscs,
	// 	bil.bilstax
	// 	FROM neco.sales.bilvalue2 bil
	// 	INNER JOIN neco.sales.challan cha
	// 	ON  
	// 	bil.comp = cha.cha_com AND
	// 	bil.unit = cha.cha_unit AND
	// 	bil.bilfyr = cha.cha_fyr AND
	// 	cha.cha_chal_no = bil.bilno AND
	// 	cha.cha_chal_dt = bil.bildt
	// 	INNER JOIN catalog.dbo.dbtcat dbt
	// 	ON
	// 	dbt.dbt_ptycd = bil.chapty
	// 	INNER JOIN catalog.dbo.itmcat itm
	// 	ON
	// 	itm.itm_item = bil.item
	// 	WHERE 
	// 	bil.comp = 1 AND
	// 	bil.unit = 1 AND
	// 	bil.bilfyr = 2017 AND
	// 	bil.bildt = '201704514011' AND
	// 	bil.bilno = 47
	// ";

	// $resultGetData1 = odbc_exec($conn, $queryPoGetData1);
	// // print(odbc_result_all($resultGetData1, "border=1"));

	// $queryChal = "SELECT * FROM tempdb..blprt8221";
	// $resultChal = odbc_exec($conn, $queryChal);
	// print(odbc_result_all($resultChal, "border=1"));

	// $queryChal = "SELECT * FROM neco.sales.slhdr WHERE slh_ord_no = 3044";
	// $resultChal = odbc_exec($conn, $queryChal);
	// print(odbc_result_all($resultChal, "border=1"));

		/////////////////////////////////////////////////// digits to word //////////////

		// function foo($total_sum)
		// {
		// 	$number = $total_sum;
		// 	$str_arr = explode('.',$number);
		// 	$no = $str_arr[0];  // Before the Decimal point
		// 	$point = $str_arr[1];  // After the Decimal point
		// 	$hundred = null;
		// 	$digits_1 = strlen($no);
		// 	$i = 0;
		// 	$str = array();
		// 	$words = array('0' => '', '1' => 'ONE', '2' => 'TWO',
		// 	'3' => 'THREE', '4' => 'FOUR', '5' => 'FIVE', '6' => 'SIX',
		// 	'7' => 'SEVEN', '8' => 'EIGHT', '9' => 'NINE',
		// 	'10' => 'TEN', '11' => 'ELEVEN', '12' => 'TWELVE',
		// 	'13' => 'THIRTEEN', '14' => 'FOURTEEN',
		// 	'15' => 'FIFTEEN', '16' => 'SIXTEEN', '17' => 'SEVENTEEN',
		// 	'18' => 'EIGHTEEN', '19' =>'NINETEEN', '20' => 'TWENTY',
		// 	'30' => 'THIRTY', '40' => 'FORTY', '50' => 'FIFTY',
		// 	'60' => 'SIXTY', '70' => 'SEVENTY',
		// 	'80' => 'EIGHTY', '90' => 'NINETY');
		// 	$digits = array('', 'HUNDRED', 'THOUSAND', 'LAKH', 'CRORE');
		// 	while ($i < $digits_1) {
		// 	 $divider = ($i == 2) ? 10 : 100;
		// 	 $number = floor($no % $divider);
		// 	 $no = floor($no / $divider);
		// 	 $i += ($divider == 10) ? 1 : 2;
		// 	 if ($number) {
		// 	    $plural = (($counter = count($str)) && $number > 9) ? 'S' : null;
		// 	    $hundred = ($counter == 1 && $str[0]) ? ' AND ' : null;
		// 	    $str [] = ($number < 21) ? $words[$number] .
		// 	        " " . $digits[$counter] . $plural . " " . $hundred
		// 	        :
		// 	        $words[floor($number / 10) * 10]
		// 	        . " " . $words[$number % 10] . " "
		// 	        . $digits[$counter] . $plural . " " . $hundred;
		// 	 } else $str[] = null;
		// 	}
		// 	$str = array_reverse($str);
		// 	$result = implode('', $str);
		// 	$points = ($point) ?
		// 	" AND " . $words[$point / 10] . " " . 
		// 	      $words[$point = $point % 10] : 'ZERO';
		// 	$final_result = $result . "RUPEES  " . $points . " PAISE";
		//     return $final_result;
		// }
		
		// echo '<b>INVOICE AMOUNT : </b>'.foo(18202.50).'<br>';
		// echo '<b>CGST : </b>'.foo($total_cgst_amt).'<br>';
		// echo '<b>SGST : </b>'.foo($total_sgst_amt).'<br>';
		// echo '<b>IGST : </b>'.foo($total_igst_amt).'<br>';
		//echo '<b>TAX PAYABLE ON REVERSE CHARGE : </b>'.foo($total_taxable_amt).'<br>';

		/////////////////////////////////////////////////// digits to word //////////////


	// store procedure storetran processing....
	  $storetranProcess = "exec neco.invac.stortran '0101003','0101003', 1, 1, '20170801','2017-08-01'";
	  $storetranProcessExec = odbc_exec($conn, $storetranProcess);

	////////// store procedure for access code

	// $link=odbc_connect("SYBLINUX","sa","master") or die("Sybase Error".odbc_error());
	// $asc_cd = 'ashmita';
	// $sql = "declare @usrpwd float
	//         exec catalog..userpwd '{$asc_cd}', @usrpwd output
	//         select usr_pwd = @usrpwd";

	////////// store procedure for fin year

	// $link=odbc_connect("SYBLINUX","sa","master") or die("Sybase Error".odbc_error());
	// $sql = "declare @fyr smallint
	//         exec catalog.dbo.finyear 41, '20170623', @fyr output
	//         select @fyr";
	// echo $sql;
	// $result = odbc_exec($conn, $sql);
	// print(odbc_result_all($result, "border=1"))."<br>";

	// echo $queryAmount = "declare @amt float
 //        select @amt = round((
 //        (120*120)/
 //        150), 2)";
 //    $resultAmount = odbc_exec($conn, $queryAmount);
 //    odbc_next_result($resultAmount);
 //    //$finalAmt = odbc_result($resultAmount, 1);
 //    $finalAmt = odbc_result_all($resultAmount, "border=1");

		////////// store procedure for stock //////////////////////////

	
	// $sql = "declare @dt smalldatetime, @mm int
	// 				select @dt = convert(smalldatetime, '20170818')
	// 				exec neco.invac.stockcal '0101003', @dt, 1";
	
	// // $sql = "declare @dt smalldatetime
	// //  			select @dt = convert(smalldatetime, '20170626')
	// //  			exec neco.invac.stockcal '6206762', @dt, 1";


	// // echo $sql."</br>";
	// $result = odbc_exec($conn, $sql);
	// odbc_next_result($result);
	// //print(odbc_result($result, 1));
	// print(odbc_result_all($result, "border=1"))."<br>";

	///////////////////////////////////////////////////////////////////

	// // $itm_cd = '0101';
	// // $sql = "declare @nnum char
	// //         exec tempdb.invac.itmblnk '{$itm_cd}'
	// //         select itm_item = @nnum";

	// $sql = "select * from tempdb.invac.itmblnk";

	// echo $sql."<br>";
	// $rs = odbc_exec($link,$sql) or die("Sybase Error".odbc_error());
	// //$rsp=odbc_result($rs,1);
	// print(odbc_result_all($rs, "border=1"))."<br>";
	//echo $rsp;

	//odbc_close($conn);

	////////// store procedure for GST Uploads //////////////////////////////////

	//$conn=odbc_connect("SYBLINUX","sa","master") or die("Sybase Error".odbc_error());

	// passing parameters 
	// $com = 54;
	// $unit = 3;
	// $frdt = '20170730';
	// $todt = '20170730';
	// $uid = 8221;
	// $dbf = 'acd2';
	// $tblName = 'gstupld_sal';

	// $useDb = "use $dbf";
	// $useDbResult = odbc_exec($conn, $useDb);

	// $setUser = "setuser 'sales'";
	// $setUserResult = odbc_exec($conn, $setUser);

	// $sql = "exec gstupldsal {$com},{$unit},'{$frdt}','{$todt}',{$uid},{$dbf}";
	// odbc_exec($conn, $sql);

	// $query = "SELECT * FROM $dbf.sales.$tblName";
	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT ups_gstin_no,ups_bil_no,ups_bil_dt,ups_net_amt,ups_state_cd,ups_state_nm,ups_rev_chrg,ups_gst_rate,ups_taxable_amt,ups_cess_amt FROM $dbf.sales.$tblName";
	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT ups_gstin_no,ups_bil_no,ups_bil_dt,ups_net_amt,ups_state_cd,ups_state_nm,ups_rev_chrg,ups_gst_rate,ups_taxable_amt,ups_cess_amt FROM $dbf.sales.$tblName WHERE ups_state_cd != '27' AND ups_net_amt > 250000";
	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";

	// $query = "SELECT ups_gstin_no,ups_bil_no,ups_bil_dt,ups_net_amt,ups_state_cd,ups_state_nm,ups_rev_chrg,ups_gst_rate,ups_taxable_amt,ups_cess_amt FROM $dbf.sales.$tblName WHERE (ups_state_cd != '27' AND ups_net_amt <= 250000) OR (ups_state_cd = '27' AND ups_net_amt > 0)";
	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";


	// passing parameters 
	// $com = 1;
	// $unit = 1;
	// $frdt = '20170722';
	// $todt = '20170722';
	// $uid = 8221;
	// $dbf = 'neco';

	// $useDb = "use $dbf";
	// $useDbResult = odbc_exec($conn, $useDb);

	// $setUser = "setuser 'sales'";
	// $setUserResult = odbc_exec($conn, $setUser);

	// //$sql = "exec gstupldsal {$com},{$unit},'{$frdt}','{$todt}',{$uid},{$dbf}";

	// $sql = "exec bilvalue_proc2 {$com},{$unit},{$unit},'{$frdt}','{$todt}','0000000','9999999',000000,999999,{$uid},{$dbf}";
	// odbc_exec($conn, $sql);


	// $query = "SELECT * FROM $dbf.sales.gstupld_sal";
	// $result = odbc_exec($conn, $query);
	// print(odbc_result_all($result, "border=1"))."<br>";
?>

<?php
// /*******EDIT LINES 3-8*******/
// $DB_Server = "SVRSYB"; //MySQL Server    
// $DB_Username = "sa"; //MySQL Username     
// $DB_Password = "master";             //MySQL Password     
// $DB_DBName = "catalog";         //MySQL Database Name  
// $DB_TBLName = "catalog..comcat"; //MySQL Table Name   
// $filename = "excelfilename";         //File Name
// /*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
// //create MySQL connection   
// $sql = "Select * from $DB_TBLName";
// $Connect = odbc_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . odbc_error() . "<br>" . odbc_errno());
// $result = odbc_exec($Connect,$sql) or die("Sybase Error".odbc_error());   
// $file_ending = "xls";
// //header info for browser
// header("Content-Type: application/xls");    
// header("Content-Disposition: attachment; filename=$filename.xls");
// header("Pragma: no-cache"); 
// header("Expires: 0");
// /*******Start of Formatting for Excel*******/   
// //define separator (defines columns in excel & tabs in word)
// $sep = "\t"; //tabbed character
// //start of printing column names as names of MySQL fields
// for ($i = 1; $i < odbc_num_fields($result); $i++) {
//     echo odbc_field_name($result,$i) . "\t";
// }
// echo "\n";
// //end of printing column names  
// //start while loop to get data
//     while($row = odbc_fetch_row($result))
//     {
//         $schema_insert = "";
//         for ($i = 1; $i < odbc_num_fields($result); $i++) {
//             $schema_insert .= odbc_result($result, $i).$sep;
//         }
//         $schema_insert = str_replace($sep."$", "", $schema_insert);
//         $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
//         $schema_insert .= "\t";
//         print(trim($schema_insert));
//         print "\n";
//     }   
?>

<!-- html>
<head>
	<title></title>
	<script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css"
        href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
 
        <script type="text/javascript">
                $(document).ready(function(){
                    $("#name").autocomplete({
                        source:'includes/view_details.php',
                        minLength:1
                    });
                });
        </script>
	<style type="text/css">
		body{
			/*background-image: url('img/neco_logo.png');
			background-repeat: no-repeat;
			background-position: center;*/
		}
	</style>
</head>
<body>
	<form method="post" action="">
             Name : <input type="text" id="name" name="name" />
      </form>
</body>
</html> -->