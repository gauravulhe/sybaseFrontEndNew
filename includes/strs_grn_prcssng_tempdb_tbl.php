<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["PodArray"])){

		$Count = $_GET['Count'];
		$ComCd = $_GET['ComCd'];
		$UntCd = $_GET['UntCd'];
		$ComPass = $_GET['ComPass'];
		$FrmNm = $_GET['FrmNm'];
		$UserComDbf = $_GET['UserComDbf'];
		$PodArray = explode(',', $_GET['PodArray']);
		$PodFyr = $PodArray[2];
		$PodPoNo = $PodArray[3];
		$PodPoSrl = $PodArray[4];
		$PodItem = $PodArray[5];
		$PodRate = $PodArray[6];
		$PodOrdQty = $PodArray[7];
		$PodBalQty = $PodArray[8];
		echo $PodTechSpec = $PodArray[9];

		//require_once('cmp_pass_actn.php');

		//variable declarations
		$GLOBALS['Guser_id'] = $_SESSION['usr_id'];

		// table1 name
		$tab1 = 'tmppodet_'.substr($Guser_id, 0, 4);
		// check if table1 exists or not
		$tab1_check_query = "SELECT name FROM tempdb..sysobjects WHERE name = '$tab1'";
		$tab1_result = odbc_exec($conn, $tab1_check_query);		
		$tab1_name = @odbc_result($tab1_result, 1);
		//checks if the table1 exists before dropping it and then drop.
		if (!empty($tab1_name)) {
			$tab1_drop_query = "DROP TABLE tempdb..$tab1";
			$tab1_drop_result = odbc_exec($conn, $tab1_drop_query);
		}
		// create table1 
		$queryTab1 = "CREATE TABLE tempdb..$tab1 (
			pod_com        tinyint         not null, 
		    pod_unit       tinyint         not null,
		    pod_fyr        smallint        not null, 
		    pod_po_no      numeric(6,0)    not null,
		    pod_po_srl     tinyint         not null, 
		    pod_item       char(7)         not null,
		    pod_rate       numeric(10,2)       null, 
		    pod_ord_qty    numeric(10,3)       null,
		    pod_bal_qty    numeric(10,3)       null,
		    pod_tech_spec  char(50)            null
		)";
		odbc_exec($conn, $queryTab1);

		//$PodArray = $_GET['PodArray'];
		$queryPodetInsertData = "INSERT INTO tempdb..$tab1 (pod_com,pod_unit,pod_fyr,pod_po_no,pod_po_srl,pod_item,pod_rate,pod_ord_qty,pod_bal_qty,pod_tech_spec) VALUES ($ComCd, $UntCd, $PodFyr, $PodPoNo, $PodPoSrl, $PodItem, $PodRate, $PodOrdQty, $PodBalQty, $PodTechSpec)";
		odbc_exec($conn, $queryPodetInsertData);


		// table2 name
		$tab2 = 'tmppohdr_'.substr($Guser_id, 0, 4);
		// check if table2 exists or not
		$tab2_check_query = "SELECT name FROM tempdb..sysobjects WHERE name = '$tab2'";
		$tab2_result = odbc_exec($conn, $tab2_check_query);		
		$tab2_name = @odbc_result($tab2_result, 1);
		//checks if the table2 exists before dropping it and then drop.
		if (!empty($tab2_name)) {
			$tab2_drop_query = "DROP TABLE tempdb..$tab2";
			$tab2_drop_result = odbc_exec($conn, $tab2_drop_query);
		}
		// create table2 
		$queryTab2 = "CREATE TABLE tempdb..$tab2 (
			poh_com        tinyint,
		    poh_unit       tinyint,
		    poh_fyr        smallint,
		    poh_po_no      numeric (6,0),
		    poh_po_dt      datetime,
		    poh_supcd      ptycd,
		    poh_excise_cd  tinyint,
		    poh_stax_per   numeric(10,2),
		    poh_disc       numeric(10,2),
		    poh_igst_per   numeric(10,2),
		    poh_sgst_per   numeric(10,2),
		    poh_cgst_per   numeric(10,2)
		)";
		odbc_exec($conn, $queryTab2);

		$queryGetPohdrData = "SELECT poh_com, poh_unit, poh_fyr, poh_po_no, poh_po_dt, poh_supcd, poh_excise_cd, poh_stax_per, poh_disc, poh_igst_per, poh_sgst_per, poh_cgst_per FROM $UserComDbf.invac.pohdr WHERE poh_unit = $UntCd AND poh_fyr = $PodFyr AND poh_po_no = $PodPoNo";
	    $resultGetPohdrData = odbc_exec($conn, $queryGetPohdrData);	    
	    //print(odbc_result_all($resultGetPohdrData, "border=1"));
	    $poh_com = odbc_result($resultGetPohdrData, 1);
		$poh_unit = odbc_result($resultGetPohdrData, 2);
		$poh_fyr = odbc_result($resultGetPohdrData, 3);
		$poh_po_no = odbc_result($resultGetPohdrData, 4);
		$poh_po_dt = odbc_result($resultGetPohdrData, 5);
		$poh_supcd = odbc_result($resultGetPohdrData, 6);
		$poh_excise_cd = odbc_result($resultGetPohdrData, 7);
		$poh_stax_per = odbc_result($resultGetPohdrData, 8);
		$poh_disc = odbc_result($resultGetPohdrData, 9);
		$poh_igst_per = odbc_result($resultGetPohdrData, 10);
		$poh_sgst_per = odbc_result($resultGetPohdrData, 11);
		$poh_cgst_per = odbc_result($resultGetPohdrData, 12);
	    $queryPohdrInsertData = "INSERT INTO tempdb..$tab2 (poh_com, poh_unit, poh_fyr, poh_po_no, poh_po_dt, poh_supcd, poh_excise_cd, poh_stax_per, poh_disc, poh_igst_per, poh_sgst_per, poh_cgst_per) VALUES ($poh_com, $poh_unit, $poh_fyr, $poh_po_no, '$poh_po_dt', '$poh_supcd', $poh_excise_cd, $poh_stax_per, $poh_disc, $poh_igst_per, $poh_sgst_per, $poh_cgst_per)";
		odbc_exec($conn, $queryPohdrInsertData);



		// table3 name
		$tab3 = 'tmppdcom_'.substr($Guser_id, 0, 4);
		// check if table3 exists or not
		$tab3_check_query = "SELECT name FROM tempdb..sysobjects WHERE name = '$tab3'";
		$tab3_result = odbc_exec($conn, $tab3_check_query);		
		$tab3_name = @odbc_result($tab3_result, 1);
		//checks if the table3 exists before dropping it and then drop.
		if (!empty($tab3_name)) {
			$tab3_drop_query = "DROP TABLE tempdb..$tab3";
			$tab3_drop_result = odbc_exec($conn, $tab3_drop_query);
		}
		// create table3 
		$queryTab3 = "CREATE TABLE tempdb..$tab3 (
			pdc_unit       tinyint,
		    pdc_fyr        smallint,
		    pdc_po_no      numeric(6,0),
		    pdc_po_srl     tinyint,
		    pdc_id         tinyint,
		    pdc_tag        tinyint,
		    pdc_amt        numeric(10,2) 
		)";
		odbc_exec($conn, $queryTab3);

		$queryGetPdcomData = "SELECT pdc_unit, pdc_fyr, pdc_po_no, pdc_po_srl, pdc_id,
	               pdc_tag, pdc_amt FROM $UserComDbf.invac.pdcomm WHERE pdc_unit = $UntCd AND pdc_fyr = $PodFyr AND pdc_po_no = $PodPoNo AND pdc_po_srl = $PodPoSrl";
	    $resultGetPdcomData = odbc_exec($conn, $queryGetPdcomData);
	    //print(odbc_result_all($resultGetPdcomData, "border=1"));
	    $pdc_unit = odbc_result($resultGetPdcomData, 1);
		$pdc_fyr = odbc_result($resultGetPdcomData, 2);
		$pdc_po_no = odbc_result($resultGetPdcomData, 3);
		$pdc_po_srl = odbc_result($resultGetPdcomData, 4);
		$pdc_id = odbc_result($resultGetPdcomData, 5);
		$pdc_tag = odbc_result($resultGetPdcomData, 6);
		$pdc_amt = odbc_result($resultGetPdcomData, 7);
		if (!empty($pdc_unit)) {			
		    $queryPdcommInsertData = "INSERT INTO tempdb..$tab3 (pdc_unit,pdc_fyr,pdc_po_no,pdc_po_srl,pdc_id,pdc_tag,pdc_amt) VALUES ($pdc_unit,$pdc_fyr,$pdc_po_no,$pdc_po_srl,$pdc_id,$pdc_tag,$pdc_amt)";
			odbc_exec($conn, $queryPdcommInsertData);
		}
	}

?>