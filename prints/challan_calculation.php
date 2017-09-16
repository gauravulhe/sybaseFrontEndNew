<?php 
	// database configuration
	require_once('../config/config.php');

	// variables from front user
	
	if (!empty($_POST['chal_bil_frno'])) {
		$chal_com = $_POST['chal_com'];
		$chal_unit = $_POST['chal_unit'];
		$chal_bil_frno = $_POST['chal_bil_frno'];
		$chal_bil_tono = $_POST['chal_bil_tono'];
		$chal_bil_frdt = date('Ymd', strtotime($_POST['chal_bil_frdt']));
		$chal_bil_todt = date('Ymd', strtotime($_POST['chal_bil_todt']));
		$chal_bil_fyr = $_POST['chal_bil_fyr'];
	}else{
		$chal_com = 1;
		$chal_unit = 1;
		$chal_bil_frno = 3051;
		$chal_bil_tono = 3051;
		$chal_bil_frdt = date('Ymd', strtotime('2017-07-11'));
		$chal_bil_todt = date('Ymd', strtotime('2017-07-11'));
		$chal_bil_fyr = '2017';
	}

	// get com dbf according to user details
	$com_dbf_query = "SELECT com_dbf FROM catalog.dbo.comcat WHERE com_com = $chal_com AND com_unit = $chal_unit";
	$com_dbf_result = @odbc_exec($conn, $com_dbf_query);
	$com_dbf = trim(@odbc_result($com_dbf_result, 1));

	//variable declarations
	$GLOBALS['Guser_id'] = $_SESSION['usr_id'];

	// table 1 name
	$tab1 = 'blprt'.substr($Guser_id, 0, 4);


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
				comp      	tinyint,
				unit      	tinyint,
				vouyr     	smallint,
				vouno     	int,
				voudt     	smalldatetime,
				voutc     	tinyint,
				tcname    	char(20)      	null,
				ptycd     	char(4),
				d_name    	char(35),
				d_add1    	char(35),
				d_add2    	char(35),
				d_add3    	char(35),
				d_statecd 	char(5),
				d_gstin   	char(15)      	null,
				concd     	char(4)       	not null,
				c_name    	char(35)      	null,
				c_add1    	char(35)      	null,
				c_add2    	char(35)      	null,
				c_add3    	char(35)      	null,
				c_statecd 	char(5)       	null,
				c_gstin   	char(15)      	null,
				grnyr     	smallint,
				grndt     	smalldatetime,
				grnno     	int,
				grnsrl    	tinyint        	identity,
				itemcd    	char(7),
				itemnm    	varchar(60)    	null,
				itemuom   	tinyint        	null,
				chptid    	smallint       	null,
				qty       	numeric(12,3)  	default 0,
				actwt     	numeric(12,3)  	default 0,
				rate      	numeric(12,2)  	default 0,
				disc      	numeric(12,2)  	default 0,
				taxval    	numeric(12,2)  	default 0,
				igstval   	numeric(12,2)  	default 0,
				igstrt    	numeric(5,2)   	default 0,
				sgstval   	numeric(12,2)  	default 0,
				sgstrt    	numeric(5,2)   	default 0,
				cgstval   	numeric(12,2)  	default 0,
				cgstrt    	numeric(5,2)   	default 0,
				othchrgs  	numeric(12,2)  	default 0,
				packing   	numeric(12,2)  	default 0,
				billno    	int,
				billdt    	smalldatetime,
				truck_no  	char(30)       	null,
				lr_no       char(10)      	null,
				lr_dt       smalldatetime  	null,
				transporter varchar(35)  	null,
				driver      varchar(35)  	null,
				pty_ordno   varchar(35)  	null,
				p_contry_cd char(3)      	null,
				frtcd       tinyint      	default 0,
				frtnm       char(30)     	null,
				insu        numeric(12,2) 	default 0,
				loano       int          	null,
				loasrl      tinyint      	null,				
				bilexcise   numeric(5,2)   	default 0,
				bilcess    	numeric(5,2)   	default 0,
				bilhscs    	numeric(5,2)   	default 0,
				bilstax    	numeric(5,2)   	default 0
            )";
	$tab1_create_result = @odbc_exec($conn, $tab1_create_query);

	$useDb = "use $com_dbf";
	$useDbResult = @odbc_exec($conn, $useDb);

	$setUser = "setuser 'sales'";
	$setUserResult = @odbc_exec($conn, $setUser);

	// execute store procedure
	$sqlChal = "exec $com_dbf.sales.bilvalue_proc2
			$chal_com, $chal_unit, $chal_unit, '$chal_bil_frdt', '$chal_bil_todt', '0000000', '9999999', $chal_bil_frno, $chal_bil_tono";
	
	$resultSqlChal = @odbc_exec($conn, $sqlChal);
	@odbc_next_result($resultSqlChal);

	$sqlDeleteBilvalue2 = "DELETE FROM $com_dbf..bilvalue2 WHERE bilno != $chal_bil_frno";
	$resultDeleteBilvalue2 = @odbc_exec($conn, $sqlDeleteBilvalue2);
	
	// fetch data according to parameters provided
	$queryPoGetData1 = "SELECT DISTINCT 
		bil.comp,
		bil.unit,
		bil.chapty,
		dbt.dbt_name,
		dbt.dbt_add1,
		dbt.dbt_add2,
		dbt.dbt_add3,
		dbt.dbt_stct_cd,
		dbt.dbt_gstin_no,
		bil.chacon,
		bil.ordfyr,
		bil.ordno,
		itm.itm_item,
		itm.itm_desc,
		bil.bilno,
		bil.bildt,
		bil.dlvqty,
		bil.actwt,
		bil.rate,
		bil.igst,
		bil.sgst,
		bil.cgst,
		bil.truckno,
		bil.lrno,
		bil.lrdt,
		cha.cha_transporter,
		cha.cha_driver,
		bil.ptyordno,
		bil.chapt_head,
		dbt.dbt_stct_cd,
		bil.value,
		bil.loa_no,
		bil.srl,
		bil.bilexcise,
		bil.bilcess,
		bil.bilhscs,
		bil.bilstax
		FROM $com_dbf.sales.bilvalue2 bil
		INNER JOIN $com_dbf.sales.challan cha
		ON  
		bil.comp = cha.cha_com AND
		bil.unit = cha.cha_unit AND
		bil.bilfyr = cha.cha_fyr AND
		cha.cha_chal_no = bil.bilno AND
		cha.cha_chal_dt = bil.bildt
		INNER JOIN catalog.dbo.dbtcat dbt
		ON
		dbt.dbt_ptycd = bil.chapty
		INNER JOIN catalog.dbo.itmcat itm
		ON
		itm.itm_item = bil.item
		WHERE 
		bil.comp = $chal_com AND
		bil.unit = $chal_unit AND
		bil.bilfyr = $chal_bil_fyr AND
		bil.bildt = '$chal_bil_frdt' AND
		bil.bilno = $chal_bil_frno
	";

	$resultGetData1 = odbc_exec($conn, $queryPoGetData1);
	//print(@odbc_result_all($resultGetData1, "border=1"));



	$rows1 = array();
	while ($myRow1 = @odbc_fetch_array($resultGetData1)) {
		$rows1[] = $myRow1;
	}
	foreach ($rows1 as $data1) {

		$comp = $data1['comp'];
		$unit = $data1['unit'];
		$chapty = $data1['chapty'];
		$dbt_name = $data1['dbt_name'];
		$dbt_add1 = $data1['dbt_add1'];
		$dbt_add2 = $data1['dbt_add2'];
		$dbt_add3 = $data1['dbt_add3'];
		$dbt_stct_cd = substr($data1['dbt_stct_cd'], 1,5);
		$dbt_gstin_no = $data1['dbt_gstin_no'];
		$chacon = $data1['chacon'];
		$ordfyr = $data1['ordfyr'];
		$ordno = $data1['ordno'];
		$itm_item = $data1['itm_item'];
		$itm_desc = $data1['itm_desc'];
		$bilno = $data1['bilno'];
		$bildt = $data1['bildt'];
		$dlvqty = $data1['dlvqty'];
		$actwt = $data1['actwt'];
		$rate = $data1['rate'];
		$igst = $data1['igst'];
		$sgst = $data1['sgst'];
		$cgst = $data1['cgst'];
		$truckno = $data1['truckno'];
		$lrno = $data1['lrno'];
		$lrdt = $data1['lrdt'];
		$cha_transporter = $data1['cha_transporter'];
		$cha_driver = $data1['cha_driver'];
		$ptyordno = $data1['ptyordno'];
		$chapt_head = $data1['chapt_head'];
		$dbt_stct_cd = substr($data1['dbt_stct_cd'], 1,5);
		$value = $data1['value'];
		$loa_no = $data1['loa_no'];
		$srl = $data1['srl'];
		$bilexcise = $data1['bilexcise'];
		$bilcess = $data1['bilcess'];
		$bilhscs = $data1['bilhscs'];
		$bilstax = $data1['bilstax'];

		$queryChallanInsertData = "INSERT INTO tempdb..$tab1 (
		comp,
		unit,
		vouyr,
		vouno,
		voudt,
		voutc,
		ptycd,
		d_name,
		d_add1,
		d_add2,
		d_add3,
		d_statecd,
		d_gstin,
		concd,
		grnyr,
		grndt,
		grnno,
		itemcd,
		itemnm,
		billno,
		billdt,
		qty,
		actwt,
		rate,
		disc,
		igstval,
		sgstval,
		cgstval,
		othchrgs,
		packing,
		truck_no,
		lr_no,
		lr_dt,
		transporter,
		driver,
		pty_ordno,
		chptid,
		p_contry_cd,
		insu,
		taxval,
		loano,
		loasrl,		
		bilexcise,
		bilcess,
		bilhscs,
		bilstax
		)
		VALUES (
		$comp,
		$unit,
		0,
		0,
		getdate(),
		0,
		'$chapty',
		'$dbt_name',
		'$dbt_add1',
		'$dbt_add2',
		'$dbt_add3',
		'$dbt_stct_cd',
		'$dbt_gstin_no',
		'$chacon',
		0,
		'$ordfyr',
		$ordno,
		'$itm_item',
		'$itm_desc',
		$bilno,
		'$bildt',
		$dlvqty,
		$actwt,
		$rate,
		0,
		$igst,
		$sgst,
		$cgst,
		0,
		0,
		'$truckno',
		'$lrno',
		'$lrdt',
		'$cha_transporter',
		'$cha_driver',
		'$ptyordno',
		$chapt_head,
		'$dbt_stct_cd',
		0,
		$value,
		$loa_no,
		$srl,
		$bilexcise,
		$bilcess,
		$bilhscs,
		$bilstax
		)";
		$resultQueryChallanInsertData = @odbc_exec($conn, $queryChallanInsertData);

		//fetch sldet and despinfo table data and update in tab1
		$fetchSldetDespinfoQuery = "SELECT 
			sld.sld_tech_spec, sld.sld_bil_unit
            FROM $com_dbf.sales.sldet sld
            INNER JOIN $com_dbf.sales.despinfo desp
            ON
            desp.des_com     = sld.sld_com AND
		    desp.des_unit    = sld.sld_unit AND
		    desp.des_ord_fyr = sld.sld_fyr AND
		    desp.des_ord_no  = sld.sld_ord_no AND
		    desp.des_ord_srl = sld.sld_ord_srl AND
		    desp.des_item    = sld.sld_item
            WHERE
            desp.des_com = $chal_com AND
			desp.des_unit = $chal_unit AND
			desp.des_ord_no = $ordno AND
			desp.des_item = '$itm_item'
        ";
        $fetchSldetDespResult = @odbc_exec($conn, $fetchSldetDespinfoQuery);

        // update tab1 with fetch data from Sldet DespInfo table
        $sld_tech_spec = @odbc_result($fetchSldetDespResult, 1);
        if(!empty($sld_tech_spec) || $sld_tech_spec != ''){
        	$itemnm = $itm_desc.' '.$sld_tech_spec;
    	}else{
    		$itemnm = $itm_desc;
    	}
        $sld_bil_unit = @odbc_result($fetchSldetDespResult, 2); 
        $itemuom = $sld_bil_unit;
       	$updTab1WithSldetDespData = "UPDATE tempdb..$tab1 SET itemnm = '$itemnm', itemuom = $itemuom WHERE comp = $chal_com AND unit = $chal_unit AND pty_ordno =  '$ptyordno' AND itemcd = '$itm_item'";
        $updTab1WithSldetDespDataResult = @odbc_exec($conn, $updTab1WithSldetDespData);



        // fetch consmast table data and update in tab1
		$fetchConsmastinfoQuery = "SELECT con_name, con_add1, con_add2, con_add3, con_stct_cd, con_gstin_no FROM $com_dbf.sales.consmast WHERE con_com = $chal_com AND con_unit = $chal_unit AND con_concd = '$chacon'";
        $fetchConsmastResult = @odbc_exec($conn, $fetchConsmastinfoQuery);
        // update tab1 with fetch data from consmast table
        $con_name = @odbc_result($fetchConsmastResult, 1);
        $con_add1 = @odbc_result($fetchConsmastResult, 2);
        $con_add2 = @odbc_result($fetchConsmastResult, 3);
        $con_add3 = @odbc_result($fetchConsmastResult, 4);
        $con_stct_cd = @odbc_result($fetchConsmastResult, 5); 
        $con_gstin_no = @odbc_result($fetchConsmastResult, 6);        
        $updTab1WithConsmastData = "UPDATE tempdb..$tab1 SET c_name = '$con_name', c_add1 = '$con_add1', c_add2 = '$con_add2', c_add3 = '$con_add3', c_statecd = '$con_stct_cd', c_gstin = '$con_gstin_no' WHERE comp = $chal_com AND unit = $chal_unit AND concd =  '$chacon' AND itemcd = '$itm_item'";
        $updTab1WithConsmastDataResult = @odbc_exec($conn, $updTab1WithConsmastData);


        // fetch Bldet table data and update in tab1
		$fetchBldetinfoQuery = "SELECT bld_amt FROM $com_dbf.sales.bldet WHERE bld_com = $chal_com AND bld_unit = $chal_unit AND bld_bil_no = $bilno AND bld_dt = '$bildt' AND bld_col_id = 15";
        $fetchBldetResult = @odbc_exec($conn, $fetchBldetinfoQuery);
        // update tab1 with fetch data from Bldet table
        $bld_amt = @odbc_result($fetchBldetResult, 1);
        $bld_amt = ($bld_amt)?$bld_amt:'0';
        $updTab1WithBldetData = "UPDATE tempdb..$tab1 SET disc = $bld_amt WHERE comp = $chal_com AND unit = $chal_unit AND billno = $bilno AND billdt = '$bildt' AND itemcd = '$itm_item'";
        $updTab1WithBldetDataResult = @odbc_exec($conn, $updTab1WithBldetData);


        // fetch Slhdr table data and update in tab1
		$fetchSlhdrQuery = "SELECT 
			slh.slh_frt_cd, code.cod_desc
            FROM $com_dbf.sales.slhdr slh
            INNER JOIN catalog..codecat code
            ON
		    slh.slh_frt_cd  = code.cod_code
            WHERE            
            slh.slh_unit = $chal_unit AND
		    slh.slh_ord_no = $ordno AND
		    slh.slh_ord_dt = '$ordfyr' AND
		    code.cod_prefix = 209
        ";
        $fetchSlhdrResult = @odbc_exec($conn, $fetchSlhdrQuery);
        // update tab1 with fetch data from Slhdr table
        $slh_frt_cd = @odbc_result($fetchSlhdrResult, 1);
        $cod_desc = @odbc_result($fetchSlhdrResult, 2);
        $updTab1WithSlhdrData = "UPDATE tempdb..$tab1 SET frtcd = $slh_frt_cd, frtnm = '$cod_desc' WHERE comp = $chal_com AND unit = $chal_unit AND grnno = $ordno AND grndt = '$ordfyr' AND itemcd = '$itm_item'";
        $updTab1WithSlhdrDataResult = @odbc_exec($conn, $updTab1WithSlhdrData);


        //update tab1 with taxval
        $qty = $dlvqty;
        $rate = $rate;
        $taxval = $dlvqty * $rate;
        $updTab1WithTaxValData = "UPDATE tempdb..$tab1 SET taxval = $taxval WHERE comp = $chal_com AND unit = $chal_unit AND grnno = $ordno AND grndt = '$ordfyr' AND itemcd = '$itm_item'";
        $updTab1WithTaxValDataResult = @odbc_exec($conn, $updTab1WithTaxValData);


        // fetch Bldet table data and update in tab1
		$fetchBldetColId65Query = "SELECT bld_amt FROM $com_dbf.sales.bldet WHERE bld_com = $chal_com AND bld_unit = $chal_unit AND bld_bil_no = $bilno AND bld_dt = '$bildt' AND bld_col_id = 65";
        $fetchBldetResult = @odbc_exec($conn, $fetchBldetColId65Query);
        // update tab1 with fetch data from Bldet table
        $bld_amt = @odbc_result($fetchBldetResult, 1);
        $bld_amt = ($bld_amt)?$bld_amt:'0';
        $updTab1WithBldetColId65Data = "UPDATE tempdb..$tab1 SET packing = $bld_amt WHERE comp = $chal_com AND unit = $chal_unit AND billno = $bilno AND billdt = '$bildt' AND itemcd = '$itm_item'";
        $updTab1WithBldetColId65DataResult = @odbc_exec($conn, $updTab1WithBldetColId65Data);

        // fetch Bldet table data and update in tab1
		$fetchBldetColId80Query = "SELECT bld_amt FROM $com_dbf.sales.bldet WHERE bld_com = $chal_com AND bld_unit = $chal_unit AND bld_bil_no = $bilno AND bld_dt = '$bildt' AND bld_col_id = 80";
        $fetchBldetResult = @odbc_exec($conn, $fetchBldetColId80Query);
        // update tab1 with fetch data from Bldet table
        $bld_amt = @odbc_result($fetchBldetResult, 1);
        $bld_amt = ($bld_amt)?$bld_amt:'0';
        $updTab1WithBldetColId80Data = "UPDATE tempdb..$tab1 SET othchrgs = $bld_amt WHERE comp = $chal_com AND unit = $chal_unit AND billno = $bilno AND billdt = '$bildt' AND itemcd = '$itm_item'";
        $updTab1WithBldetColId80DataResult = @odbc_exec($conn, $updTab1WithBldetColId80Data);

        // fetch Bldet table data and update in tab1
		$fetchBldetColId91Query = "SELECT bld_amt FROM $com_dbf.sales.bldet WHERE bld_com = $chal_com AND bld_unit = $chal_unit AND bld_bil_no = $bilno AND bld_dt = '$bildt' AND bld_col_id = 91";
        $fetchBldetResult = @odbc_exec($conn, $fetchBldetColId91Query);
        // update tab1 with fetch data from Bldet table
        $bld_amt = @odbc_result($fetchBldetResult, 1);
        $bld_amt = ($bld_amt)?$bld_amt:'0';
        $updTab1WithBldetColId91Data = "UPDATE tempdb..$tab1 SET insu = $bld_amt WHERE comp = $chal_com AND unit = $chal_unit AND billno = $bilno AND billdt = '$bildt' AND itemcd = '$itm_item'";
        $updTab1WithBldetColId91DataResult = @odbc_exec($conn, $updTab1WithBldetColId91Data);


        // update igstrt, sgstrt, cgstrt in tab1
		// $fetchIgstrtQuery = "SELECT igstval,sgstval,cgstval,taxval,disc,packing FROM tempdb..$tab1 WHERE comp = $chal_com AND unit = $chal_unit AND billno = $bilno AND billdt = '$bildt' AND itemcd = '$itm_item'";
  //       $fetchIgstrtResult = @odbc_exec($conn, $fetchIgstrtQuery);
  //       // update tab1 
  //       $igstval = @odbc_result($fetchIgstrtResult, 1);
  //       $sgstval = @odbc_result($fetchIgstrtResult, 2);
  //       $cgstval = @odbc_result($fetchIgstrtResult, 3);
  //       $taxval = @odbc_result($fetchIgstrtResult, 4);
  //       $disc = @odbc_result($fetchIgstrtResult, 5);
  //       $packing = @odbc_result($fetchIgstrtResult, 6);

  //       $igstrt=@round(($igstval/($taxval-$disc+$packing))*100,2);
  //       $sgstrt=@round(($sgstval/($taxval-$disc+$packing))*100,2);
  //      	$cgstrt=@round(($cgstval/($taxval-$disc+$packing))*100,2);

  //       $updTab1WithIgstvalData = "UPDATE tempdb..$tab1 SET igstrt = $igstrt, sgstrt = $sgstrt, cgstrt = $cgstrt WHERE comp = $chal_com AND unit = $chal_unit AND billno = $bilno AND billdt = '$bildt' AND itemcd = '$itm_item'";
  //       $updTab1WithIgstvalDataResult = @odbc_exec($conn, $updTab1WithIgstvalData);


        // update igstrt, sgstrt, cgstrt in tab1
		$fetchIgstrtSlhQuery = "SELECT slh_igst_per,slh_sgst_per,slh_cgst_per,slh_com,slh_unit,slh_ord_dt,slh_ord_no FROM $com_dbf.sales.slhdr WHERE slh_com = $chal_com AND slh_unit = $chal_unit AND slh_ptycd = '$chapty' AND slh_ord_no = $ordno";
        $fetchIgstrtSlhResult = @odbc_exec($conn, $fetchIgstrtSlhQuery);
        // update tab1 
        $igstrt = @odbc_result($fetchIgstrtSlhResult, 1);
       	$sgstrt = @odbc_result($fetchIgstrtSlhResult, 2);
       	$cgstrt = @odbc_result($fetchIgstrtSlhResult, 3);
       	$slh_com = @odbc_result($fetchIgstrtSlhResult, 4);
       	$slh_unit = @odbc_result($fetchIgstrtSlhResult, 5);
       	$slh_ord_dt = @odbc_result($fetchIgstrtSlhResult, 6);
       	$slh_ord_no = @odbc_result($fetchIgstrtSlhResult, 7);
        $updTab1WithIgstrtSlhData = "UPDATE tempdb..$tab1 SET igstrt = $igstrt, sgstrt = $sgstrt, cgstrt = $cgstrt WHERE comp = $slh_com AND unit = $slh_unit AND grnno = $slh_ord_no";
        $updTab1WithIgstrtSlhDataResult = @odbc_exec($conn, $updTab1WithIgstrtSlhData);
		
	}

	$queryChal = "SELECT DISTINCT comp,unit,vouyr,vouno,voudt,voutc,tcname,ptycd,d_name,d_add1,d_add2,d_add3,d_statecd,d_gstin,concd,c_name,c_add1,c_add2,c_add3,c_statecd,c_gstin,grnyr,grndt,grnno,grnsrl,itemcd,itemnm,itemuom,chptid,qty,actwt,rate,disc,taxval,igstval,igstrt,sgstval,sgstrt,cgstval,cgstrt,othchrgs,packing,billno,billdt,truck_no,lr_no,lr_dt,transporter,driver,pty_ordno,p_contry_cd,frtcd,frtnm,insu,loano,loasrl,bilexcise,bilcess,bilhscs,bilstax FROM tempdb..$tab1";
	$resultChal = @odbc_exec($conn, $queryChal);
	//@odbc_next_result($resultChal);
	//print(@odbc_result_all($resultChal, "border=1"));
	
?>