<?php 
	// database configuration
	require_once('../config/config.php');

	// variables from front user
	
	if (!empty($_POST['po_no'])) {
		$com_com = $_POST['po_com'];
		$com_unit = $_POST['po_unit'];
		$po_no = $_POST['po_no'];
		$po_fyr = $_POST['po_fyr'];
		$qtn_no = $_POST['qtn_no'];
	}
	//else{
	// 	$com_com = 54;
	// 	$com_unit = 3;
	// 	$po_no = 1012;
	// 	$po_fyr = 2018;
	// 	$qtn_no = 0;
	// }

	//variable declarations
	$j 	= 0;
	$tag = 0;
	$upd = false;
	$i 	= 0;
	$tab1 = 'tab1';
	$tab2 = 'tab2';
	$srv_amt = 0.0;
	$exc_amt = 0.0;
	$GLOBALS['Gusername'] = $_SESSION['usr_id'];
	$GLOBALS['Gpassword'] = $_SESSION['pass'];
	$GLOBALS['Guser_id'] = $_SESSION['usr_id'];
	$c_tab1;
	$c_tab2;
	$c_tab3;
	$ffmesg = NULL;
	//var_dump($ffmesg);

	// get com dbf according to user details
	$com_dbf_query = "SELECT com_dbf FROM catalog.dbo.comcat WHERE com_com = $com_com AND com_unit = $com_unit";
	$com_dbf_result = @odbc_exec($conn, $com_dbf_query);
	$com_dbf = @odbc_result($com_dbf_result, 1);

	// table 1 and 2 name
	$tab1 = 'pprt1'.'_'.substr($Guser_id, 0, 4);
	$tab2 = 'pprt2'.'_'.substr($Guser_id, 0, 4);	

	// check if table1 exists or not
	$tab1_check_query = "SELECT name FROM tempdb..sysobjects WHERE name = '$tab1'";
	$tab1_result = @odbc_exec($conn, $tab1_check_query);		
	$tab1_name = @odbc_result($tab1_result, 1);

	//checks if the table exists before dropping it and then drop.
	if (!empty($tab1_name)) {
		$tab1_drop_query = "DROP TABLE tempdb..$tab1";
		$tab1_drop_result = @odbc_exec($conn, $tab1_drop_query);
	}

	//create new table 1 
	$tab1_create_query = "CREATE TABLE tempdb..$tab1 ( 
				com 			 tinyint 	not null,
	            unit 			 tinyint 	not null,
	            year 			 smallint 	not null,
	            posupcd 		 char(6) 	not null,
	            pono 			 float       not null,
	            podt 			 datetime    not null,
	            posrl            int         default 0,
	            poupdtag         tinyint     null,
	            inqotno          char(55)    null,
	            poitem           char(7)     not null,
	            poqty            float       default 0,
	            porate           float       default 0,
	            irate            float       default 0,
	            techdesc         varchar(240) null,
	            stax_cd          float       default 0,
	            stax_per         float       default 0,
	            excise_cd        float       default 0,
	            excise_rate      float       default 0,
	            iname            char(60)    not null,
	            itm_uom          tinyint     not null,
	            excise_amt       float       null,
	            ins_amt          float       null,
	            frt_amt          float       null,
	            stax_amt         float       null,
	            load_amt         float       null,
	            pack_amt         float       null,
	            comm_amt         float       null,
	            poh_disc         float       null,
	            disc_amt         float       null,
	            others           float       null,
	            scharg           float       null,
	            tcharg           float       null,
	            payterm          char(34)    null,
	            req_no           float       null,
	            req_dt           datetime    null,
	            req_fyr          smallint    null,
	            req_unit         tinyint     null,
	            pdd_sch_dt1      datetime    null,
	            pdd_stag_qty1    float       null,
	            pdd_sch_dt2      datetime    null,
	            pdd_stag_qty2    float       null,
	            pdd_sch_dt3      datetime    null,
	            pdd_stag_qty3    float       null,
	            pdd_amen         char(20)    null,
	            pdd_anix         char(20)    null,
	            cess_amt         float       null,
	            serv_amt         float       null,
	            hsec_amt         float       null,
	            crdys            smallint    default 0,
	            addlrmk          vchar50     null,
	            sbcess_amt       float       default 0,
	            kkcess_amt       float       default 0,
	            total            float       default 0,
	            gst_cd     		 float       null,
	            gst_per    		 float       null,
	            gst_amt    		 float       null,
	            igst_per   		 float       null,
	            igst_amt   		 float       null,
	            sgst_per   		 float       null,
	            sgst_amt   		 float       null,
	            cgst_per   		 float       null,
	            cgst_amt   		 float       null,
	            ugst_per   		 float       null,
	            ugst_amt   		 float       null,
	            chpt_id    		 tinyint     null,
	            chpt_head  		 char(8)     null
            )";
	$tab1_create_result = @odbc_exec($conn, $tab1_create_query);

	// check if table2 exists or not
	$tab2_check_query = "SELECT name FROM tempdb..sysobjects WHERE name = $tab2";
	if (@odbc_exec($conn, $tab2_check_query)) {
		$tab2_result = @odbc_exec($conn, $tab2_check_query);		
		$tab2_name = @odbc_result($tab2_result, 1);

		//checks if the table exists before dropping it and then drop.
		if (!empty($tab2_name)) {
			$tab2_drop_query = "DROP TABLE tempdb..$tab2";
			$tab2_drop_result = @@odbc_exec($conn, $tab2_drop_query);
		}
	}

	// fetch data according to parameters provided
	$queryPoGetData1 = "SELECT 
	pod.pod_com,
	pod.pod_unit,
	pod.pod_fyr,
	poh.poh_supcd,
	pod.pod_po_no,
	poh.poh_po_dt,
	pod.pod_po_srl,
	pod.pod_item,
	pod.pod_ord_qty,
	pod.pod_rate,
	pod.pod_ord_qty,
	pod.pod_rate,
	pod.pod_tech_spec,
	poh.poh_stax_cd,
	poh.poh_stax_per,
	poh.poh_excise_cd,
	exc.exc_rate,
	itm.itm_desc,
	itm.itm_part,
	itm.itm_uom,
	poh.poh_disc,
	poh.poh_pmnt_terms,
	poh.poh_upd_tag,
	poh.poh_paycr_days,
	poh.poh_addl_rmk,
	poh.poh_gst_cd,
	poh.poh_gst_per,
	poh.poh_igst_per,
	poh.poh_sgst_per,
	poh.poh_cgst_per,
	poh.poh_ugst_per,
	pod.pod_chpt_id
	FROM $com_dbf.invac.podet pod
	INNER JOIN $com_dbf.invac.pohdr poh
	ON  
	pod.pod_com = poh.poh_com AND
	pod.pod_unit = poh.poh_unit AND
	pod.pod_fyr = poh.poh_fyr AND
	pod.pod_po_no = poh.poh_po_no
	INNER JOIN catalog.dbo.itmcat itm
	ON
	pod.pod_item = itm.itm_item
	INNER JOIN catalog.dbo.excrate exc
	ON
	poh.poh_excise_cd=exc.exc_code
	WHERE 
	pod.pod_com = $com_com AND 
	pod.pod_unit = $com_unit AND 
	pod.pod_fyr = $po_fyr AND 
	pod.pod_po_no = $po_no AND
	(pod.pod_ord_qty - pod.pod_can_qty) > 0
	ORDER BY 
	pod.pod_po_srl,
	pod.pod_po_no";

	$resultGetData1 = odbc_exec($conn, $queryPoGetData1);
	//print(odbc_result_all($resultPO, "border=1"));
	$rows1 = array();
	while ($myRow1 = odbc_fetch_array($resultGetData1)) {
		$rows1[] = $myRow1;
	}
	foreach ($rows1 as $data1) {

		$pod_com = $data1['pod_com'];
		$pod_unit = $data1['pod_unit'];
		$pod_fyr = $data1['pod_fyr'];
		$poh_supcd = $data1['poh_supcd'];
		$pod_po_no = $data1['pod_po_no'];
		$poh_po_dt = $data1['poh_po_dt'];
		$pod_po_srl = $data1['pod_po_srl'];
		$pod_item = $data1['pod_item'];
		$pod_ord_qty = $data1['pod_ord_qty'];
		$pod_rate = $data1['pod_rate'];
		$irate = $pod_ord_qty * $pod_rate;
		$pod_tech_spec = $data1['pod_tech_spec'];
		$poh_stax_cd = $data1['poh_stax_cd'];
		$poh_stax_per = $data1['poh_stax_per'];
		$poh_excise_cd = $data1['poh_excise_cd'];
		$excise_rate = $data1['exc_rate'];
		$itm_desc = $data1['itm_desc'];
		$itm_part = $data1['itm_part'];
		$iname = $itm_desc." + ".$itm_part;
		$itm_uom = $data1['itm_uom'];
		$poh_disc = $data1['poh_disc'];
		$poh_pmnt_terms = $data1['poh_pmnt_terms'];
		$poh_upd_tag = $data1['poh_upd_tag'];
		$poh_paycr_days = $data1['poh_paycr_days'];
		$poh_addl_rmk = $data1['poh_addl_rmk'];
		$poh_gst_cd = $data1['poh_gst_cd'];
		$poh_gst_per = $data1['poh_gst_per'];
		$poh_igst_per = $data1['poh_igst_per'];
		$poh_sgst_per = $data1['poh_sgst_per'];
		$poh_cgst_per = $data1['poh_cgst_per'];
		$poh_ugst_per = $data1['poh_ugst_per'];
		$pod_chpt_id = $data1['pod_chpt_id'];

		$queryPoInsertData1 = "INSERT INTO tempdb..$tab1 (
		com,
		unit,
		year,
		posupcd,
		pono,
		podt,
		posrl,
		poitem,
		poqty,
		porate,
		irate,
		techdesc,
		stax_cd,
		stax_per,
		excise_cd,
		excise_rate,
		iname,
		itm_uom,
		excise_amt,
		ins_amt,
		frt_amt,
		stax_amt,
		load_amt,
		pack_amt,
		comm_amt,
		poh_disc,
		disc_amt,
		others,
		scharg,
		tcharg,
		payterm,
		req_no,
		req_dt,
		req_fyr,
		req_unit,
		pdd_anix,
		cess_amt,
		serv_amt,
		hsec_amt,
		pdd_amen,
		poupdtag,
		crdys,
		addlrmk,
		gst_cd,
		gst_per,
		gst_amt,
		igst_per,
		igst_amt,
		sgst_per,
		sgst_amt,
		cgst_per,
		cgst_amt,
		ugst_per,
		ugst_amt,
		chpt_id,
		chpt_head)
		VALUES (
		$pod_com,
		$pod_unit,
		$pod_fyr,
		'$poh_supcd',
		$pod_po_no,
		'$poh_po_dt',
		$pod_po_srl,
		'$pod_item',
		$pod_ord_qty,
		$pod_rate,
		$irate,
		'$pod_tech_spec',
		$poh_stax_cd,
		$poh_stax_per,
		$poh_excise_cd,
		$excise_rate,
		'$iname',
		$itm_uom,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		$poh_disc,
		0,
		0,
		0,
		0,
		'$poh_pmnt_terms',
		0,
		'',
		0,
		0,
		'0',
		0,
		0,
		0,
		'',
		$poh_upd_tag,
		$poh_paycr_days,
		'$poh_addl_rmk',
		$poh_gst_cd,
		$poh_gst_per,
		0,
		$poh_igst_per,
		0,
		$poh_sgst_per,
		0,
		$poh_cgst_per,
		0,
		$poh_ugst_per,
		0,
		$pod_chpt_id,
		'null')";
		$resultqueryPoInsertData1 = odbc_exec($conn, $queryPoInsertData1);
		if ($resultqueryPoInsertData1) {
			
			////////////////////////////////////////////////  pdreq data ////////////////////////////////////////

			// fetch pdreq table data and update in tab1
			$fetchTab1FrmPdrQuery = "SELECT 
				pdr.pdr_req_no, pdr.pdr_req_fyr, pdr.pdr_unit, pdr.pdr_com, pdr.pdr_po_srl
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.pdreq pdr
                ON
                tab1.pono = pdr.pdr_po_no AND
                tab1.unit = pdr.pdr_unit AND
                tab1.year = pdr.pdr_fyr AND
                tab1.posrl = pdr.pdr_po_srl
                WHERE
                pdr.pdr_po_no = $po_no AND
				pdr.pdr_unit = $com_unit AND
				pdr.pdr_fyr =  $po_fyr AND
				pdr.pdr_po_srl = $pod_po_srl
            ";
            $fetchTab1FrmPdrResult = odbc_exec($conn, $fetchTab1FrmPdrQuery);
            // update tab1 with fetch data from pdreq table
            $pdr_req_no = odbc_result($fetchTab1FrmPdrResult, 1);
            $pdr_req_fyr = odbc_result($fetchTab1FrmPdrResult, 2);
            $pdr_unit = odbc_result($fetchTab1FrmPdrResult, 3);            
            $updTab1WithPdreqData = "UPDATE tempdb..$tab1 SET req_no = $pdr_req_no, req_fyr = $pdr_req_fyr, req_unit = $pdr_unit WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND posrl = $pod_po_srl";
            $updTab1WithPdreqDataResult = odbc_exec($conn, $updTab1WithPdreqData);


            ////////////////////////////////////////////////  request data ////////////////////////////////////////

            // fetch request table data and update in tab1
			$fetchTab1FrmReqQuery = "SELECT 
				req.req_dt
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.request req
                ON
                tab1.req_no = req.req_no AND
                tab1.unit = req.req_unit AND
                tab1.com = req.req_com AND
                tab1.posrl = req.req_srl AND
                tab1.req_fyr = req.req_fyr
                WHERE
                req.req_no = $pdr_req_no AND
				req.req_unit = $pdr_unit AND
				req.req_com =  $com_com AND
				req.req_srl =  $pod_po_srl AND
				req.req_fyr = $pdr_req_fyr
            ";
            $fetchTab1FrmReqResult = odbc_exec($conn, $fetchTab1FrmReqQuery);
            // update tab1 with fetch data from request table
            $req_dt = odbc_result($fetchTab1FrmReqResult, 1);            
            $updTab1WithReqData = "UPDATE tempdb..$tab1 SET req_dt = '$req_dt' WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithReqDataResult = odbc_exec($conn, $updTab1WithReqData); 

            ////////////////////////////////////////////////  Quotation no update ////////////////////////            

            $updTab1WithQtnoData = "UPDATE tempdb..$tab1 SET inqotno = '$qtn_no' WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithQtnoDataResult = odbc_exec($conn, $updTab1WithQtnoData); 

			////////////////////////////  AMANDMENT DETAILS ////////////////////////            



            ///////////////////////////  pdcomm data //////////////////////////////

            // fetch pdcomm table data and update in tab1
			$fetchTab1FrmPdcommQuery = "SELECT 
				pdc.pdc_amt
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.pdcomm pdc
                ON
                tab1.pono = pdc.pdc_po_no AND
                tab1.posrl = pdc.pdc_po_srl AND
                tab1.com = pdc.pdc_com AND
                tab1.unit = pdc.pdc_unit AND
                tab1.year = pdc.pdc_fyr
                WHERE
                pdc.pdc_po_no = $po_no AND
                pdc.pdc_po_srl = $pod_po_srl AND
				pdc.pdc_unit = $com_unit AND
				pdc.pdc_com =  $com_com AND
				pdc.pdc_fyr = $po_fyr AND
				pdc.pdc_id = 30
            ";
            $fetchTab1FrmPdcommResult = odbc_exec($conn, $fetchTab1FrmPdcommQuery);
            // update tab1 with fetch data from request table
            $pack_amt = odbc_result($fetchTab1FrmPdcommResult, 1);
            $pack_amt = ($pack_amt)?$pack_amt:'0';            
            $updTab1WithPdcommData = "UPDATE tempdb..$tab1 SET pack_amt = $pack_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithPdcommDataResult = odbc_exec($conn, $updTab1WithPdcommData);


            /////////////////////  DISCOUNT FOR EXCISE, STAX CALCULATION PURPOSE ONLY  ////////////////

            // discount amount calculation
            $disc_amt = ($irate*$poh_disc)/100;
            $updTab1WithDiscAmtData = "UPDATE tempdb..$tab1 SET disc_amt = $disc_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithDiscAmtDataResult = odbc_exec($conn, $updTab1WithDiscAmtData);
            // excise amount calculation
            $excise_amt = (($irate+$pack_amt)-($disc_amt))*($excise_rate)/100;
            $updTab1WithExciseAmtData = "UPDATE tempdb..$tab1 SET excise_amt = $excise_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl AND excise_cd NOT IN (49,78)";
            $updTab1WithExciseAmtDataResult = odbc_exec($conn, $updTab1WithExciseAmtData);


            /////////////////////////// SERVICE TAX  pdcomm data ////////////////////////////////////////

            // fetch sbcess pdcomm table data and update in tab1
			$fetchTab1FrmSbcessPdcommQuery = "SELECT 
				pdc.pdc_amt
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.pdcomm pdc
                ON
                tab1.pono = pdc.pdc_po_no AND
                tab1.com = pdc.pdc_com AND
                tab1.unit = pdc.pdc_unit AND
                tab1.year = pdc.pdc_fyr
                WHERE
                pdc.pdc_po_no = $po_no AND
                pdc.pdc_po_srl = 01 AND
				pdc.pdc_unit = $com_unit AND
				pdc.pdc_com =  $com_com AND
				pdc.pdc_fyr = $po_fyr AND
				pdc.pdc_id = 89
            ";
            $fetchTab1FrmSbcessPdcommResult = odbc_exec($conn, $fetchTab1FrmSbcessPdcommQuery);
            // update tab1 with fetch data from request table
            $pdc_amt = odbc_result($fetchTab1FrmSbcessPdcommResult, 1);
            $pdc_amt = ($pdc_amt)?$pdc_amt:'0';
            $sbcess_amt = (($irate-$disc_amt)*$pdc_amt)/100;            
            $updTab1WithSbcessPdcommData = "UPDATE tempdb..$tab1 SET sbcess_amt = $sbcess_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithSbcessPdcommDataResult = odbc_exec($conn, $updTab1WithSbcessPdcommData);


            // fetch kkcess pdcomm table data and update in tab1
			$fetchTab1FrmKkcessPdcommQuery = "SELECT 
				pdc.pdc_amt
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.pdcomm pdc
                ON
                tab1.pono = pdc.pdc_po_no AND
                tab1.com = pdc.pdc_com AND
                tab1.unit = pdc.pdc_unit AND
                tab1.year = pdc.pdc_fyr
                WHERE
                pdc.pdc_po_no = $po_no AND
                pdc.pdc_po_srl = 01 AND
				pdc.pdc_unit = $com_unit AND
				pdc.pdc_com =  $com_com AND
				pdc.pdc_fyr = $po_fyr AND
				pdc.pdc_id = 88
            ";
            $fetchTab1FrmKkcessPdcommResult = odbc_exec($conn, $fetchTab1FrmKkcessPdcommQuery);
            // update tab1 with fetch data from request table
            $pdc_amt = odbc_result($fetchTab1FrmKkcessPdcommResult, 1);
            $pdc_amt = ($pdc_amt)?$pdc_amt:'0';
            $kkcess_amt = (($irate-$disc_amt)*$pdc_amt)/100;            
            $updTab1WithKkcessPdcommData = "UPDATE tempdb..$tab1 SET kkcess_amt = $kkcess_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithKkcessPdcommDataResult = odbc_exec($conn, $updTab1WithKkcessPdcommData);

            // fetch serv_amt pdcomm table data and update in tab1
			$fetchTab1FrmServAmt1PdcommQuery = "SELECT 
				pdc.pdc_amt
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.pdcomm pdc
                ON
                tab1.pono = pdc.pdc_po_no AND
                tab1.com = pdc.pdc_com AND
                tab1.unit = pdc.pdc_unit AND
                tab1.year = pdc.pdc_fyr
                WHERE
                pdc.pdc_po_no = $po_no AND
                pdc.pdc_po_srl = 01 AND
				pdc.pdc_unit = $com_unit AND
				pdc.pdc_com =  $com_com AND
				pdc.pdc_fyr = $po_fyr AND
				pdc.pdc_id = 93 AND
				pdc.pdc_tag != 02
            ";
            $fetchTab1FrmServAmt1PdcommResult = odbc_exec($conn, $fetchTab1FrmServAmt1PdcommQuery);
            // update tab1 with fetch data from request table
            $pdc_amt1 = odbc_result($fetchTab1FrmServAmt1PdcommResult, 1);
            $pdc_amt1 = ($pdc_amt1)?$pdc_amt1:'0';
            $serv_amt1 = (($irate+$pack_amt-$disc_amt)*$pdc_amt1)/100;            
            $updTab1WithServAmt1PdcommData = "UPDATE tempdb..$tab1 SET serv_amt = $serv_amt1 WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithServAmt1PdcommDataResult = odbc_exec($conn, $updTab1WithServAmt1PdcommData);


            // fetch serv_amt pdcomm table data and update in tab1
			$fetchTab1FrmServAmt2PdcommQuery = "SELECT 
				pdc.pdc_amt, tab1.serv_amt
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.pdcomm pdc
                ON
                tab1.pono = pdc.pdc_po_no AND
                tab1.posrl = pdc.pdc_po_srl AND
                tab1.com = pdc.pdc_com AND
                tab1.unit = pdc.pdc_unit AND
                tab1.year = pdc.pdc_fyr
                WHERE
                pdc.pdc_po_no = $po_no AND
                pdc.pdc_po_srl = 01 AND
				pdc.pdc_unit = $com_unit AND
				pdc.pdc_com =  $com_com AND
				pdc.pdc_fyr = $po_fyr AND
				pdc.pdc_id = 93 AND
				pdc.pdc_tag = 02
            ";
            $fetchTab1FrmServAmt2PdcommResult = odbc_exec($conn, $fetchTab1FrmServAmt2PdcommQuery);
            // update tab1 with fetch data from request table
            $pdc_amt2 = odbc_result($fetchTab1FrmServAmt2PdcommResult, 1);
            $serv_amt = odbc_result($fetchTab1FrmServAmt2PdcommResult, 2);
            $pdc_amt2 = ($pdc_amt2)?$pdc_amt2:'0';
            $serv_amt2 = $serv_amt + $pdc_amt2;            
            $updTab1WithServAmt2PdcommData = "UPDATE tempdb..$tab1 SET serv_amt = $serv_amt2 WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithServAmt2PdcommDataResult = odbc_exec($conn, $updTab1WithServAmt2PdcommData);


            //////////////////////////////////// CESS TAX ON EXCISE ADDITION ///////////////////////////////

            // fetch serv_amt and excise_amt from tab1
			$fetchTab1ServAmtExciseAmtQuery = "SELECT serv_amt, excise_amt FROM tempdb..$tab1 WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $fetchTab1ServAmtExciseAmtResult = odbc_exec($conn, $fetchTab1ServAmtExciseAmtQuery);
            $cess_serv_amt = odbc_result($fetchTab1ServAmtExciseAmtResult, 1);
            $cess_excise_amt = odbc_result($fetchTab1ServAmtExciseAmtResult, 2);

            if ($cess_excise_amt > 0) {

            		// fetch Cess data and update in tab1
					$fetchTab1FrmCessAmtQuery = "SELECT 
						pdc.pdc_amt
		                FROM tempdb..$tab1 tab1
		                INNER JOIN $com_dbf.invac.pdcomm pdc
		                ON
		                tab1.pono = pdc.pdc_po_no AND
		                tab1.com = pdc.pdc_com AND
		                tab1.unit = pdc.pdc_unit AND
		                tab1.year = pdc.pdc_fyr
		                WHERE
		                pdc.pdc_po_no = $po_no AND
		                pdc.pdc_po_srl = 01 AND
						pdc.pdc_unit = $com_unit AND
						pdc.pdc_com =  $com_com AND
						pdc.pdc_fyr = $po_fyr AND
						pdc.pdc_id = 92
		            ";
		            $fetchTab1FrmCessAmtResult = odbc_exec($conn, $fetchTab1FrmCessAmtQuery);
		            // update tab1 with fetch data from pdcomm table
		            $pdc_amt = odbc_result($fetchTab1FrmCessAmtResult, 1);
		            $pdc_amt = ($pdc_amt)?$pdc_amt:'0';
		            $cess_excise_amt = ($cess_excise_amt)?$cess_excise_amt:'0';
		            $cess_amt = ($cess_excise_amt*$pdc_amt)/100;            
		            $updTab1WithCessAmtData = "UPDATE tempdb..$tab1 SET cess_amt = $cess_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
		            $updTab1WithCessAmtDataResult = odbc_exec($conn, $updTab1WithCessAmtData);


		            // fetch hsec data and update in tab1
					$fetchTab1FrmHsecAmtQuery = "SELECT 
						pdc.pdc_amt
		                FROM tempdb..$tab1 tab1
		                INNER JOIN $com_dbf.invac.pdcomm pdc
		                ON
		                tab1.pono = pdc.pdc_po_no AND
		                tab1.com = pdc.pdc_com AND
		                tab1.unit = pdc.pdc_unit AND
		                tab1.year = pdc.pdc_fyr
		                WHERE
		                pdc.pdc_po_no = $po_no AND
		                pdc.pdc_po_srl = 01 AND
						pdc.pdc_unit = $com_unit AND
						pdc.pdc_com =  $com_com AND
						pdc.pdc_fyr = $po_fyr AND
						pdc.pdc_id = 97
		            ";
		            $fetchTab1FrmHsecAmtResult = odbc_exec($conn, $fetchTab1FrmHsecAmtQuery);
		            // update tab1 with fetch data from pdcomm table
		            $pdc_amt = odbc_result($fetchTab1FrmHsecAmtResult, 1);
		            $pdc_amt = ($pdc_amt)?$pdc_amt:'0';
		            $cess_excise_amt = ($cess_excise_amt)?$cess_excise_amt:'0';
		            $hsec_amt = ($cess_excise_amt*$pdc_amt)/100;            
		            $updTab1WithHsecAmtData = "UPDATE tempdb..$tab1 SET hsec_amt = $hsec_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
		            $updTab1WithHsecAmtDataResult = odbc_exec($conn, $updTab1WithHsecAmtData);
            }else if ($cess_serv_amt > 0) {

            		// fetch Cess data and update in tab1
					$fetchTab1FrmCessAmtQuery = "SELECT 
						pdc.pdc_amt
		                FROM tempdb..$tab1 tab1
		                INNER JOIN $com_dbf.invac.pdcomm pdc
		                ON
		                tab1.pono = pdc.pdc_po_no AND
		                tab1.com = pdc.pdc_com AND
		                tab1.unit = pdc.pdc_unit AND
		                tab1.year = pdc.pdc_fyr
		                WHERE
		                pdc.pdc_po_no = $po_no AND
		                pdc.pdc_po_srl = 01 AND
						pdc.pdc_unit = $com_unit AND
						pdc.pdc_com =  $com_com AND
						pdc.pdc_fyr = $po_fyr AND
						pdc.pdc_id = 92
		            ";
		            $fetchTab1FrmCessAmtResult = odbc_exec($conn, $fetchTab1FrmCessAmtQuery);
		            // update tab1 with fetch data from pdcomm table
		            $pdc_amt = odbc_result($fetchTab1FrmCessAmtResult, 1);
		            $pdc_amt = ($pdc_amt)?$pdc_amt:'0';
		            $cess_serv_amt = ($cess_serv_amt)?$cess_serv_amt:'0';
		            $cess_amt = ($cess_serv_amt*$pdc_amt)/100;            
		            $updTab1WithCessAmtData = "UPDATE tempdb..$tab1 SET cess_amt = $cess_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
		            $updTab1WithCessAmtDataResult = odbc_exec($conn, $updTab1WithCessAmtData);


		            // fetch hsec data and update in tab1
					$fetchTab1FrmHsecAmtQuery = "SELECT 
						pdc.pdc_amt
		                FROM tempdb..$tab1 tab1
		                INNER JOIN $com_dbf.invac.pdcomm pdc
		                ON
		                tab1.pono = pdc.pdc_po_no AND
		                tab1.com = pdc.pdc_com AND
		                tab1.unit = pdc.pdc_unit AND
		                tab1.year = pdc.pdc_fyr
		                WHERE
		                pdc.pdc_po_no = $po_no AND
		                pdc.pdc_po_srl = 01 AND
						pdc.pdc_unit = $com_unit AND
						pdc.pdc_com =  $com_com AND
						pdc.pdc_fyr = $po_fyr AND
						pdc.pdc_id = 97
		            ";
		            $fetchTab1FrmHsecAmtResult = odbc_exec($conn, $fetchTab1FrmHsecAmtQuery);
		            // update tab1 with fetch data from pdcomm table
		            $pdc_amt = odbc_result($fetchTab1FrmHsecAmtResult, 1);
		            $pdc_amt = ($pdc_amt)?$pdc_amt:'0';
		            $cess_serv_amt = ($cess_serv_amt)?$cess_serv_amt:'0';
		            $hsec_amt = ($cess_serv_amt*$pdc_amt)/100;            
		            $updTab1WithHsecAmtData = "UPDATE tempdb..$tab1 SET hsec_amt = $hsec_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
		            $updTab1WithHsecAmtDataResult = odbc_exec($conn, $updTab1WithHsecAmtData);
            }


            /////////////////////////// insurance charges ///////////////////////////////////

            // fetch ins_amt data and update in tab1
			$fetchTab1InsAmtQuery = "SELECT 
				pdc.pdc_amt
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.pdcomm pdc
                ON
                tab1.pono = pdc.pdc_po_no AND
                tab1.com = pdc.pdc_com AND
                tab1.unit = pdc.pdc_unit AND
                tab1.year = pdc.pdc_fyr
                WHERE
                pdc.pdc_po_no = $po_no AND
                pdc.pdc_po_srl = 01 AND
				pdc.pdc_unit = $com_unit AND
				pdc.pdc_com =  $com_com AND
				pdc.pdc_fyr = $po_fyr AND
				pdc.pdc_id = 91
            ";
            $fetchTab1InsAmtResult = odbc_exec($conn, $fetchTab1InsAmtQuery);
            // update tab1 with fetch data from pdcomm table
            $pdc_amt = odbc_result($fetchTab1InsAmtResult, 1);
            $pdc_amt = ($pdc_amt)?$pdc_amt:'0';
            $ins_amt = ($irate*$pdc_amt)/100;            
            $updTab1WithInsAmtData = "UPDATE tempdb..$tab1 SET ins_amt = $ins_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithInsAmtDataResult = odbc_exec($conn, $updTab1WithInsAmtData);


		    // update excise amount where excise code not in 49 and 78
		    $excise_amt = (($irate-$disc_amt)*$excise_rate)/100;
            $updTab1WithExciseAmtData = "UPDATE tempdb..$tab1 SET excise_amt = $excise_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl AND excise_cd NOT IN (49,78)";
            $updTab1WithExciseAmtDataResult = odbc_exec($conn, $updTab1WithExciseAmtData);


		    // update excise amount where excise code not in 49 and 78
		    $excise_amt = ($pod_ord_qty*$excise_rate);
            $updTab1WithExciseAmtData = "UPDATE tempdb..$tab1 SET excise_amt = $excise_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl AND excise_cd IN (49,78)";
            $updTab1WithExciseAmtDataResult = odbc_exec($conn, $updTab1WithExciseAmtData);


            // fetch stax_amt data and update in tab1
			$fetchTab1StaxAmtQuery = "SELECT irate, excise_amt, cess_amt, pack_amt, hsec_amt, disc_amt, stax_per FROM  tempdb..$tab1 WHERE  pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $fetchTab1StaxAmtResult = odbc_exec($conn, $fetchTab1StaxAmtQuery);
            // update tab1 with fetch data from pdcomm table
            $irate = odbc_result($fetchTab1StaxAmtResult, 1);
            $excise_amt = odbc_result($fetchTab1StaxAmtResult, 2);
            $cess_amt = odbc_result($fetchTab1StaxAmtResult, 3);
            $pack_amt = odbc_result($fetchTab1StaxAmtResult, 4);
            $hsec_amt = odbc_result($fetchTab1StaxAmtResult, 5);
            $disc_amt = odbc_result($fetchTab1StaxAmtResult, 6);
            $stax_per = odbc_result($fetchTab1StaxAmtResult, 7);
            $stax_amt = (($irate+$excise_amt+$cess_amt+$pack_amt+$hsec_amt-$disc_amt)*$stax_per)/100;
            $updTab1WithStaxAmtData = "UPDATE tempdb..$tab1 SET stax_amt = $stax_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithStaxAmtDataResult = odbc_exec($conn, $updTab1WithStaxAmtData);


            /*** sbcess_amt added in cess_amt due to no space left on pre-printed format of po ***/

            // fetch sbcess_amt data and update in tab1
			$fetchTab1SbcessAmtQuery = "SELECT cess_amt, sbcess_amt FROM tempdb..$tab1 WHERE  pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $fetchTab1SbcessAmtResult = odbc_exec($conn, $fetchTab1SbcessAmtQuery);
            // update tab1 with fetch data from pdcomm table
            $cess_amt = odbc_result($fetchTab1SbcessAmtResult, 1);
            $sbcess_amt = odbc_result($fetchTab1SbcessAmtResult, 2);
            $cess_amt = $cess_amt+$cess_amt;
            $updTab1WithSbcessAmtData = "UPDATE tempdb..$tab1 SET cess_amt = $cess_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithSbcessAmtDataResult = odbc_exec($conn, $updTab1WithSbcessAmtData);



            /*** kkcess_amt added in hsec_amt due to no space left on pre-printed format of po ***/

            // fetch kkcess_amt data and update in tab1
			$fetchTab1KkcessAmtQuery = "SELECT hsec_amt, kkcess_amt FROM tempdb..$tab1 WHERE  pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $fetchTab1KkcessAmtResult = odbc_exec($conn, $fetchTab1KkcessAmtQuery);
            // update tab1 with fetch data from pdcomm table
            $hsec_amt = odbc_result($fetchTab1KkcessAmtResult, 1);
            $kkcess_amt = odbc_result($fetchTab1KkcessAmtResult, 2);
            $hsec_amt = $hsec_amt+$kkcess_amt;
            $updTab1WithKkcessAmtData = "UPDATE tempdb..$tab1 SET hsec_amt = $hsec_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithKkcessAmtDataResult = odbc_exec($conn, $updTab1WithKkcessAmtData);



            /********FREIGHT, LOADING, OTHER, PACKING  -   COMMERCIAL DETAIL ***********/

            // fetch frt_amt data and update in tab1
			$fetchTab1FrtAmtQuery = "SELECT 
				pdc.pdc_amt
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.pdcomm pdc
                ON
                tab1.pono = pdc.pdc_po_no AND
                tab1.posrl = pdc.pdc_po_srl AND
                tab1.com = pdc.pdc_com AND
                tab1.unit = pdc.pdc_unit AND
                tab1.year = pdc.pdc_fyr
                WHERE
                pdc.pdc_po_no = $po_no AND
                pdc.pdc_po_srl = $pod_po_srl AND
				pdc.pdc_unit = $com_unit AND
				pdc.pdc_com =  $com_com AND
				pdc.pdc_fyr = $po_fyr AND
				pdc.pdc_id = 55
            ";
            $fetchTab1FrtAmtResult = odbc_exec($conn, $fetchTab1FrtAmtQuery);
            // update tab1 with fetch data from pdcomm table
            $pdc_amt = odbc_result($fetchTab1FrtAmtResult, 1);
            $frt_amt = ($pdc_amt)?$pdc_amt:'0';          
            $updTab1WithFrtAmtData = "UPDATE tempdb..$tab1 SET frt_amt = $frt_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithFrtAmtDataResult = odbc_exec($conn, $updTab1WithFrtAmtData);



            // fetch load_amt data and update in tab1
			$fetchTab1LoadAmtQuery = "SELECT 
				pdc.pdc_amt
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.pdcomm pdc
                ON
                tab1.pono = pdc.pdc_po_no AND
                tab1.posrl = pdc.pdc_po_srl AND
                tab1.com = pdc.pdc_com AND
                tab1.unit = pdc.pdc_unit AND
                tab1.year = pdc.pdc_fyr
                WHERE
                pdc.pdc_po_no = $po_no AND
                pdc.pdc_po_srl = $pod_po_srl AND
				pdc.pdc_unit = $com_unit AND
				pdc.pdc_com =  $com_com AND
				pdc.pdc_fyr = $po_fyr AND
				pdc.pdc_id = 50
            ";
            $fetchTab1LoadAmtResult = odbc_exec($conn, $fetchTab1LoadAmtQuery);
            // update tab1 with fetch data from pdcomm table
            $pdc_amt = odbc_result($fetchTab1LoadAmtResult, 1);
            $load_amt = ($pdc_amt)?$pdc_amt:'0';          
            $updTab1WithLoadAmtData = "UPDATE tempdb..$tab1 SET load_amt = $load_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithLoadAmtDataResult = odbc_exec($conn, $updTab1WithLoadAmtData);



            // fetch others data and update in tab1
			$fetchTab1OthersQuery = "SELECT 
				pdc.pdc_amt
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.pdcomm pdc
                ON
                tab1.pono = pdc.pdc_po_no AND
                tab1.posrl = pdc.pdc_po_srl AND
                tab1.com = pdc.pdc_com AND
                tab1.unit = pdc.pdc_unit AND
                tab1.year = pdc.pdc_fyr
                WHERE
                pdc.pdc_po_no = $po_no AND
                pdc.pdc_po_srl = $pod_po_srl AND
				pdc.pdc_unit = $com_unit AND
				pdc.pdc_com =  $com_com AND
				pdc.pdc_fyr = $po_fyr AND
				pdc.pdc_id = 80
            ";
            $fetchTab1OthersResult = odbc_exec($conn, $fetchTab1OthersQuery);
            // update tab1 with fetch data from pdcomm table
            $pdc_amt = odbc_result($fetchTab1OthersResult, 1);
            $others = ($pdc_amt)?$pdc_amt:'0';          
            $updTab1WithOthersData = "UPDATE tempdb..$tab1 SET others = $others WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithOthersDataResult = odbc_exec($conn, $updTab1WithOthersData);



            // fetch comm_amt data and update in tab1
			$fetchTab1CommAmtQuery = "SELECT 
				pdc.pdc_amt
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.pdcomm pdc
                ON
                tab1.pono = pdc.pdc_po_no AND
                tab1.posrl = pdc.pdc_po_srl AND
                tab1.com = pdc.pdc_com AND
                tab1.unit = pdc.pdc_unit AND
                tab1.year = pdc.pdc_fyr
                WHERE
                pdc.pdc_po_no = $po_no AND
                pdc.pdc_po_srl = $pod_po_srl AND
				pdc.pdc_unit = $com_unit AND
				pdc.pdc_com =  $com_com AND
				pdc.pdc_fyr = $po_fyr AND
				pdc.pdc_id = 70
            ";
            $fetchTab1CommAmtResult = odbc_exec($conn, $fetchTab1CommAmtQuery);
            // update tab1 with fetch data from pdcomm table
            $pdc_amt = odbc_result($fetchTab1CommAmtResult, 1);
            $comm_amt = ($pdc_amt)?$pdc_amt:'0';          
            $updTab1WithCommAmtData = "UPDATE tempdb..$tab1 SET comm_amt = $comm_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithCommAmtDataResult = odbc_exec($conn, $updTab1WithCommAmtData);



            /* T charge & T charge cal. */

            // fetch scharg data and update in tab1
			$fetchTab1SchargQuery = "SELECT 
				pdc.pdc_amt, tab1.stax_amt
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.pdcomm pdc
                ON
                tab1.pono = pdc.pdc_po_no AND
                tab1.posrl = pdc.pdc_po_srl AND
                tab1.com = pdc.pdc_com AND
                tab1.unit = pdc.pdc_unit AND
                tab1.year = pdc.pdc_fyr
                WHERE
                pdc.pdc_po_no = $po_no AND
                pdc.pdc_po_srl = $pod_po_srl AND
				pdc.pdc_unit = $com_unit AND
				pdc.pdc_com =  $com_com AND
				pdc.pdc_fyr = $po_fyr AND
				pdc.pdc_id = 26
            ";
            $fetchTab1SchargResult = odbc_exec($conn, $fetchTab1SchargQuery);
            // update tab1 with fetch data from pdcomm table
            $pdc_amt = odbc_result($fetchTab1SchargResult, 1);
            $pdc_amt = ($pdc_amt)?$pdc_amt:'0';
            $stax_amt = odbc_result($fetchTab1SchargResult, 2);
            $stax_amt = ($stax_amt)?$stax_amt:'0';
            $scharg = ($stax_amt*$pdc_amt)/100;
            $updTab1WithSchargData = "UPDATE tempdb..$tab1 SET scharg = $scharg WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithSchargDataResult = odbc_exec($conn, $updTab1WithSchargData);


            // fetch tcharg data and update in tab1
			$fetchTab1TchargQuery = "SELECT 
				pdc.pdc_amt, tab1.irate, tab1.excise_amt, tab1.cess_amt, tab1.hsec_amt
                FROM tempdb..$tab1 tab1
                INNER JOIN $com_dbf.invac.pdcomm pdc
                ON
                tab1.pono = pdc.pdc_po_no AND
                tab1.posrl = pdc.pdc_po_srl AND
                tab1.com = pdc.pdc_com AND
                tab1.unit = pdc.pdc_unit AND
                tab1.year = pdc.pdc_fyr
                WHERE
                pdc.pdc_po_no = $po_no AND
                pdc.pdc_po_srl = $pod_po_srl AND
				pdc.pdc_unit = $com_unit AND
				pdc.pdc_com =  $com_com AND
				pdc.pdc_fyr = $po_fyr AND
				pdc.pdc_id = 36
            ";
            $fetchTab1TchargResult = odbc_exec($conn, $fetchTab1TchargQuery);
            // update tab1 with fetch data from pdcomm table
            $pdc_amt = odbc_result($fetchTab1TchargResult, 1);
            $pdc_amt = ($pdc_amt)?$pdc_amt:'0';
            $irate = odbc_result($fetchTab1TchargResult, 1);
            $irate = ($irate)?$irate:'0';
            $excise_amt = odbc_result($fetchTab1TchargResult, 1);
            $excise_amt = ($excise_amt)?$excise_amt:'0';
            $cess_amt = odbc_result($fetchTab1TchargResult, 1);
            $cess_amt = ($cess_amt)?$cess_amt:'0';
            $hsec_amt = odbc_result($fetchTab1TchargResult, 2);
            $hsec_amt = ($hsec_amt)?$hsec_amt:'0';
            $tcharg = (($irate+$excise_amt+$cess_amt+$hsec_amt)*$pdc_amt)/100;
            $updTab1WithTchargData = "UPDATE tempdb..$tab1 SET tcharg = $tcharg WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithTchargDataResult = odbc_exec($conn, $updTab1WithTchargData);


            // update chapter id and chapter head

            // fetch chpt_id data
			$fetchTab1ChptIdQuery = "SELECT chpt_id FROM tempdb..$tab1 WHERE  pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $fetchTab1ChptIdResult = odbc_exec($conn, $fetchTab1ChptIdQuery);
            $chpt_id = odbc_result($fetchTab1ChptIdResult, 1);

            // fetch chp_subhd1 data
            $fetchTab1ChpSubhdQuery = "SELECT chp_subhd1 FROM catalog.sales.chpthead WHERE  chp_id = $chpt_id";
            $fetchTab1ChpSubhdResult = odbc_exec($conn, $fetchTab1ChpSubhdQuery);
            $chp_subhd1 = odbc_result($fetchTab1ChpSubhdResult, 1);
            $updTab1WithChpSubhdData = "UPDATE tempdb..$tab1 SET chpt_head = '$chp_subhd1' WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithChpSubhdDataResult = odbc_exec($conn, $updTab1WithChpSubhdData);


            // fetch gst data and update in tab1
			$fetchTab1GSTQuery = "SELECT irate, disc_amt, gst_per, igst_per, sgst_per, cgst_per, ugst_per, pack_amt FROM tempdb..$tab1  WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $fetchTab1GSTResult = odbc_exec($conn, $fetchTab1GSTQuery);

            $irate = odbc_result($fetchTab1GSTResult, 1);
            $irate = ($irate)?$irate:'0';
            $disc_amt = odbc_result($fetchTab1GSTResult, 2);
            $disc_amt = ($disc_amt)?$disc_amt:'0';
            $gst_per = odbc_result($fetchTab1GSTResult, 3);
            $gst_per = ($gst_per)?$gst_per:'0';
            $igst_per = odbc_result($fetchTab1GSTResult, 4);
            $igst_per = ($igst_per)?$igst_per:'0';
            $sgst_per = odbc_result($fetchTab1GSTResult, 5);
            $sgst_per = ($sgst_per)?$sgst_per:'0';
            $cgst_per = odbc_result($fetchTab1GSTResult, 6);
            $cgst_per = ($cgst_per)?$cgst_per:'0';
            $ugst_per = odbc_result($fetchTab1GSTResult, 7);
            $ugst_per = ($ugst_per)?$ugst_per:'0';
            $pack_amt = odbc_result($fetchTab1GSTResult, 8);
            $pack_amt = ($pack_amt)?$pack_amt:'0';
            
            // $gst_amt  = (($irate-$disc_amt) * $gst_per)/100;
            // $sgst_amt = (($irate-$disc_amt) * $sgst_per)/100;
            // $cgst_amt = (($irate-$disc_amt) * $cgst_per)/100;

            $gst_amt  = (($irate+$pack_amt-$disc_amt) * $gst_per)/100;
            $sgst_amt = (($irate+$pack_amt-$disc_amt) * $sgst_per)/100;
            $cgst_amt = (($irate+$pack_amt-$disc_amt) * $cgst_per)/100;
            
            $igst_amt = (($irate+$pack_amt-$disc_amt) * $igst_per)/100;
            $ugst_amt = (($irate+$pack_amt-$disc_amt) * $ugst_per)/100;

            $updTab1WithGSTData = "UPDATE tempdb..$tab1 SET gst_amt = $gst_amt, igst_amt = $igst_amt, sgst_amt = $sgst_amt, cgst_amt = $cgst_amt, ugst_amt = $ugst_amt WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithGSTDataResult = odbc_exec($conn, $updTab1WithGSTData);

            // update disc_amt field
            $updTab1WithDiscAmtData = "UPDATE tempdb..$tab1 SET disc_amt = 0 WHERE poh_disc = 0 AND pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithDiscAmtDataResult = odbc_exec($conn, $updTab1WithDiscAmtData);


            // update total
            // fetch gst data and update in tab1
			$fetchTotalQuery = "SELECT irate, disc_amt, excise_amt, ins_amt, frt_amt, stax_amt, load_amt, pack_amt, comm_amt, others, scharg, tcharg, cess_amt, hsec_amt, serv_amt, igst_amt, sgst_amt, cgst_amt, ugst_amt FROM tempdb..$tab1  WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $fetchTotalResult = odbc_exec($conn, $fetchTotalQuery);
            // update tab1 with fetch data from pdcomm table
            $irate = odbc_result($fetchTotalResult, 1);
            $irate = ($irate)?$irate:'0';
            $disc_amt = odbc_result($fetchTotalResult, 2);
            $disc_amt = ($disc_amt)?$disc_amt:'0';
            $excise_amt = odbc_result($fetchTotalResult, 3);
            $excise_amt = ($excise_amt)?$excise_amt:'0';
            $ins_amt = odbc_result($fetchTotalResult, 4);
            $ins_amt = ($ins_amt)?$ins_amt:'0';
            $frt_amt = odbc_result($fetchTotalResult, 5);
            $frt_amt = ($frt_amt)?$frt_amt:'0';
            $stax_amt = odbc_result($fetchTotalResult, 6);
            $stax_amt = ($stax_amt)?$stax_amt:'0';
            $load_amt = odbc_result($fetchTotalResult, 7);
            $load_amt = ($load_amt)?$load_amt:'0';
            $pack_amt = odbc_result($fetchTotalResult, 8);
            $pack_amt = ($pack_amt)?$pack_amt:'0';
            $comm_amt = odbc_result($fetchTotalResult, 9);
            $comm_amt = ($comm_amt)?$comm_amt:'0';
            $others = odbc_result($fetchTotalResult, 10);
            $others = ($others)?$others:'0';
            $scharg = odbc_result($fetchTotalResult, 11);
            $scharg = ($scharg)?$scharg:'0';
            $tcharg = odbc_result($fetchTotalResult, 12);
            $tcharg = ($tcharg)?$tcharg:'0';
            $cess_amt = odbc_result($fetchTotalResult, 13);
            $cess_amt = ($cess_amt)?$cess_amt:'0';
            $hsec_amt = odbc_result($fetchTotalResult, 14);
            $hsec_amt = ($hsec_amt)?$hsec_amt:'0';
            $serv_amt = odbc_result($fetchTotalResult, 15);
            $serv_amt = ($serv_amt)?$serv_amt:'0';
            $igst_amt = odbc_result($fetchTotalResult, 16);
            $igst_amt = ($igst_amt)?$igst_amt:'0';
            $sgst_amt = odbc_result($fetchTotalResult, 17);
            $sgst_amt = ($sgst_amt)?$sgst_amt:'0';
            $cgst_amt = odbc_result($fetchTotalResult, 18);
            $cgst_amt = ($cgst_amt)?$cgst_amt:'0';
            $ugst_amt = odbc_result($fetchTotalResult, 19);
            $ugst_amt = ($ugst_amt)?$ugst_amt:'0';
            
            $total = ($irate+$excise_amt+$ins_amt+$frt_amt+$stax_amt+$load_amt+$pack_amt+$comm_amt+$others+$scharg+$tcharg+$cess_amt+$hsec_amt+$serv_amt+$igst_amt+$sgst_amt+$cgst_amt+$ugst_amt)-$disc_amt;

            $updTab1WithTotalData = "UPDATE tempdb..$tab1 SET total = $total WHERE pono = $po_no AND unit = $com_unit AND year =  $po_fyr AND com = $com_com AND posrl = $pod_po_srl";
            $updTab1WithTotalDataResult = odbc_exec($conn, $updTab1WithTotalData);
		}
	}

	$queryPO = "SELECT com,unit,year,posupcd,pono,podt,posrl,poupdtag,inqotno,poitem,poqty,porate,irate,techdesc,stax_cd,stax_per,excise_cd,excise_rate,iname,itm_uom,excise_amt,ins_amt,frt_amt,stax_amt,load_amt,pack_amt,comm_amt,poh_disc,disc_amt,others,scharg,tcharg,payterm,req_no,req_dt,req_fyr,req_unit,pdd_sch_dt1,pdd_stag_qty1,pdd_sch_dt2,pdd_stag_qty2,pdd_sch_dt3,pdd_stag_qty3,pdd_amen,pdd_anix,cess_amt,serv_amt,hsec_amt,crdys,addlrmk,sbcess_amt,kkcess_amt,total,gst_cd,gst_per,gst_amt,igst_per,igst_amt,sgst_per,sgst_amt,cgst_per,cgst_amt,ugst_per,ugst_amt,chpt_id,chpt_head FROM tempdb..$tab1";
	$result = @odbc_exec($conn, $queryPO);
	//print(@odbc_result_all($result, "border=1"));
?>