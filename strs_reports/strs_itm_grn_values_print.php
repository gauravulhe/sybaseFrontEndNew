<html>
<head>
    <title>Stores Reports</title>
    <style type="text/css">
        .bg-color{
            background-color: skyblue;
        }
        .float-left{
            text-align: left;
        }
        .float-right{
            text-align: right;
        }
        .float-center{
            text-align: center;
        }
    </style>
</head>
<body>

<?php

require_once('../config/config.php');
$conn=odbc_connect("SYBLINUX","sa","master") or die("Sybase Error".odbc_error());
$tblName = "gstupld_sal"; //ODBC Table Name   
$com_cd = $_GET['grh_com'];
$unit_cd = $_GET['grh_unit'];
$fr_grh_dt = $_GET['fr_grh_dt'];
$to_grh_dt = $_GET['to_grh_dt'];
$fr_grd_item = $_GET['fr_grd_item'];
$to_grd_item = $_GET['to_grd_item'];
$fr_grh_supcd = strtoupper($_GET['fr_grh_supcd']);
$to_grh_supcd = strtoupper($_GET['to_grh_supcd']);
$poh_po_type = strtoupper($_GET['poh_po_type']);
$file = $_GET['file'];
//print_r($_GET);exit;
// get com dbf according to user details
$com_dbf_query = "SELECT com_dbf FROM catalog.dbo.comcat WHERE com_com = $com_cd AND com_unit = $unit_cd";
$com_dbf_result = @odbc_exec($conn, $com_dbf_query);
$dbnm = trim(@odbc_result($com_dbf_result, 1));
    
$UserId = $_SESSION['usr_id'];

if ($poh_po_type == 'Y') {
	$wo = '--';
}else{
	$wo = ' ';
}

$grdlst = 'grdlst'.$UserId;

// check for table exists and drop
$checkTableQuery = "if exists (select * from tempdb..sysobjects where name = '{$grdlst}')
				drop table tempdb..{$grdlst}";
$checkTableExec = odbc_exec($conn, $checkTableQuery);

// select insert query
$selectInsertQuery = "select a.grd_com, a.grd_unit, a.grd_fyr, a.grd_no, a.grd_dt, a.grd_item, a.grd_srl, qty=a.grd_rcv_qty-grd_rej_qty, a.grd_po_no, c.grh_chal_no, c.grh_chal_dt, b.itm_desc, c.grh_supcd, c.grh_gate_no, c.grh_gate_dt, a.grd_po_fyr, pod_tech_spec into tempdb..{$grdlst} 
	    from {$dbnm}.invac.grdet a, catalog.dbo.itmcat b, 
		{$dbnm}.invac.grhdr c, {$dbnm}.invac.podet
	    where a.grd_unit  between {$unit_cd} and {$unit_cd}
	      and a.grd_item  = b.itm_item
	      and a.grd_dt    between '{$fr_grh_dt}' and '{$to_grh_dt}'
	      and a.grd_item  between '{$fr_grd_item}' and '{$to_grd_item}'
	      and c.grh_supcd between '{$fr_grh_supcd}' and '{$to_grh_supcd}'
	      and a.grd_com   = c.grh_com
	      and a.grd_unit  = c.grh_unit
	      and a.grd_no    = c.grh_no
	      and a.grd_dt    = c.grh_dt
	      and a.grd_fyr   = c.grh_fyr
	      and a.grd_unit  = pod_unit
	      and a.grd_po_fyr= pod_fyr
	      and a.grd_po_no = pod_po_no
	      and a.grd_po_srl= pod_po_srl
	  	{$wo}and a.grd_item  not like '04%'
	      order by a.grd_item,grd_no,grd_dt";
$selectInsertExec = odbc_exec($conn, $selectInsertQuery);

$alterTableQuery = "alter table tempdb..{$grdlst}
	    add rate float null,value float null,avgrate float null,
	    name char(7) null,stax float null,excise float null,
	    frt float null,ld float null, pack float null,disc float null,
	    mat_accd char(6) null,insu float null,cess float null,
	    serv float null,valueb float null, entry_no int null, 
	    entry_dt smalldatetime null,hscs float null, odisc float null,
	    othr float null, igst float null, sgst float null, cgst float null";
$alterTableExec = odbc_exec($conn, $alterTableQuery);

$updateTableQuery1 = "update tempdb..{$grdlst}
	    set rate = 0,   value   = 0, avgrate = 0,
                name = ' ', stax    = 0, excise  = 0,
	        insu = 0,   cess    = 0, serv    = 0,
	        frt  = 0,   ld      = 0, pack    = 0,
	        disc = 0,  mat_accd = ' ',valueb = 0,
		hscs = 0,  odisc    = 0, othr    = 0,
		igst = 0,  sgst     = 0, cgst    = 0";
$updateTableExec1 = odbc_exec($conn, $updateTableQuery1);

$updateTableQuery2 = "update tempdb..{$grdlst}
            set rate = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 10";
$updateTableExec2 = odbc_exec($conn, $updateTableQuery2);

$deleteTableQuery = "delete from tempdb..{$grdlst} where qty = 0";
$deleteTableExec = odbc_exec($conn, $deleteTableQuery);

$updateTableQuery3 = "update tempdb..{$grdlst} set value  = rate*qty , valueb = rate*qty";
$updateTableExec3 = odbc_exec($conn, $updateTableQuery3);

$updateTableQuery4 = "update tempdb..{$grdlst}
            set stax = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 45";
$updateTableExec4 = odbc_exec($conn, $updateTableQuery4);

$updateTableQuery5 = "update tempdb..{$grdlst}
            set excise = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 40";
$updateTableExec5 = odbc_exec($conn, $updateTableQuery5);

$updateTableQuery6 = "update tempdb..{$grdlst}
            set insu = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 91";
$updateTableExec6 = odbc_exec($conn, $updateTableQuery6);

$updateTableQuery7 = "update tempdb..{$grdlst}
            set cess = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 92";
$updateTableExec7 = odbc_exec($conn, $updateTableQuery7);

$updateTableQuery8 = "update tempdb..{$grdlst}
            set hscs = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 97";
$updateTableExec8 = odbc_exec($conn, $updateTableQuery8);

$updateTableQuery9 = "update tempdb..{$grdlst}
            set serv = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 93";
$updateTableExec9 = odbc_exec($conn, $updateTableQuery9);

$updateTableQuery10 = "update tempdb..{$grdlst}
            set frt = frt + b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   =  55";
$updateTableExec10 = odbc_exec($conn, $updateTableQuery10);

$updateTableQuery11 = "update tempdb..{$grdlst}
            set frt = frt + b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   =  56";
$updateTableExec11 = odbc_exec($conn, $updateTableQuery11);

$updateTableQuery12 = "update tempdb..{$grdlst}
            set frt = frt + b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   =  57";
$updateTableExec12 = odbc_exec($conn, $updateTableQuery12);

$updateTableQuery13 = "update tempdb..{$grdlst}
            set ld = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 50";
$updateTableExec13 = odbc_exec($conn, $updateTableQuery13);

$updateTableQuery14 = "update tempdb..{$grdlst}
            set pack = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 30";
$updateTableExec14 = odbc_exec($conn, $updateTableQuery14);

$updateTableQuery15 = "update tempdb..{$grdlst}
            set disc = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 85";
$updateTableExec15 = odbc_exec($conn, $updateTableQuery15);

$updateTableQuery16 = "update tempdb..{$grdlst}
            set odisc = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 20";
$updateTableExec16 = odbc_exec($conn, $updateTableQuery16);

$updateTableQuery17 = "update tempdb..{$grdlst}
            set odisc = odisc + b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 15";
$updateTableExec17 = odbc_exec($conn, $updateTableQuery17);

$updateTableQuery18 = "update tempdb..{$grdlst}
            set othr = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 25";
$updateTableExec18 = odbc_exec($conn, $updateTableQuery18);

$updateTableQuery19 = "update tempdb..{$grdlst}
            set othr = othr + b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 35";
$updateTableExec19 = odbc_exec($conn, $updateTableQuery19);

$updateTableQuery20 = "update tempdb..{$grdlst}
            set othr = othr + b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 70";
$updateTableExec20 = odbc_exec($conn, $updateTableQuery20);

$updateTableQuery21 = "update tempdb..{$grdlst}
            set othr = othr + b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 80";
$updateTableExec21 = odbc_exec($conn, $updateTableQuery21);

$updateTableQuery22 = "update tempdb..{$grdlst}
            set othr = othr + b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 67";
$updateTableExec22 = odbc_exec($conn, $updateTableQuery22);

$updateTableQuery23 = "update tempdb..{$grdlst}
            set othr = othr + b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 75";
$updateTableExec23 = odbc_exec($conn, $updateTableQuery23);

$updateTableQuery24 = "update tempdb..{$grdlst}
            set othr = othr + b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 98";
$updateTableExec24 = odbc_exec($conn, $updateTableQuery24);

$updateTableQuery25 = "update tempdb..{$grdlst}
            set othr = othr + b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 99";
$updateTableExec25 = odbc_exec($conn, $updateTableQuery25);

$updateTableQuery26 = "update tempdb..{$grdlst}
            set igst = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 51";
$updateTableExec26 = odbc_exec($conn, $updateTableQuery26);

$updateTableQuery27 = "update tempdb..{$grdlst}
            set sgst = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 52";
$updateTableExec27 = odbc_exec($conn, $updateTableQuery27);

$updateTableQuery28 = "update tempdb..{$grdlst}
            set cgst = b.gra_forced_amt
            from tempdb..{$grdlst} a, {$dbnm}.invac.gradj b 
            where a.grd_unit = b.gra_unit
              and a.grd_fyr  = b.gra_fyr
              and a.grd_dt   = b.gra_dt
              and a.grd_no   = b.gra_no
              and a.grd_srl  = b.gra_srl
              and b.gra_id   = 53";
$updateTableExec28 = odbc_exec($conn, $updateTableQuery28);

$updateTableQuery29 = "update tempdb..{$grdlst}
            set value=round((value+stax+excise+cess+hscs+serv+insu+frt+ld+pack+othr-disc-odisc+igst+sgst+cgst),0)";
$updateTableExec29 = odbc_exec($conn, $updateTableQuery29);

$updateTableQuery30 = "update tempdb..{$grdlst}
            set name = substring(grd_item,1,4)+'0000'";
$updateTableExec30 = odbc_exec($conn, $updateTableQuery30);

$updateTableQuery31 = "update tempdb..{$grdlst}
            set mat_accd = a.mat_accd
            from  {$dbnm}.invac.matmast a, tempdb..{$grdlst} b,
		  {$dbnm}.invac.grdet c
	    where b.grd_com  = a.mat_com
	    and   b.grd_unit = a.mat_unit
	    and   b.grd_item = a.mat_item
	    and   c.grd_com  = b.grd_com
	    and   c.grd_unit = b.grd_unit
	    and   c.grd_fyr  = b.grd_fyr
	    and   c.grd_no   = b.grd_no
	    and   c.grd_dt   = b.grd_dt
	    and   c.grd_srl  = 01";
$updateTableExec31 = odbc_exec($conn, $updateTableQuery31);

$updateTableQuery32 = "update tempdb..{$grdlst}
	    set entry_no = e_entry_no,
		entry_dt = e_entry_dt
            from {$dbnm}.invac.excicg
	    where grd_no   = e_grd_no
	    and   grd_dt   = e_grd_dt
	    and   grd_srl  = e_grd_srl
	    and   grd_unit = e_grd_unit";
$updateTableExec32 = odbc_exec($conn, $updateTableQuery32);

// $sql = "SELECT * FROM tempdb..{$grdlst}";
// $result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
// print_r(odbc_result_all($result, "border=1"));exit;



/////////////////////////////////////////////////// print file /////////////////////////////////////////

if ($file == 'pf') {

//create ODBC connection   
$sql = "SELECT DISTINCT grd.grd_item,grd.itm_desc, com.com_name, com.com_uname
		FROM tempdb..{$grdlst} AS grd
		INNER JOIN catalog..comcat AS com
		ON
		grd.grd_com = com.com_com AND
		grd.grd_unit = com.com_unit
		";
$result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
//print_r(odbc_result_all($result, "border=1"));exit;
$rows = array();
while ($myRow = odbc_fetch_array($result)) {
    $rows[] = $myRow;
}

$file_ending = "xls";
//header info for browser
header("Content-Type: application/$file_ending");
header("Pragma: no-cache"); 
header("Expires: 0");
$filename = 'Print_File_'.strtotime(date('Y-m-d h:m:s'));         //File Name
header("Content-Disposition: attachment; filename=$filename.$file_ending");


	/*******Start of Formatting for Excel*******/   

	echo '<table border="1">';
		echo '<tr class="bg-color">';
			echo '<th colspan="4">NECO GROUP OF INDUSTRIES</th>';
			echo '<th class="float-left" colspan="24">Date : '.date('d.m.Y').'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Company Name : </th>';
			echo '<th class="float-left" colspan="24">'.$rows[0]['com_name'].'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Unit Name : </th>';
			echo '<th class="float-left" colspan="24">'.$rows[0]['com_uname'].'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">GRNS With Values : </th>';
			echo '<th class="float-left" colspan="24">From '.date('d.m.Y', strtotime($fr_grh_dt)).' To '.date('d.m.Y', strtotime($to_grh_dt)).'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Item Number : </th>';
			echo '<th class="float-left" colspan="24">From '.$fr_grd_item.' To '.$to_grd_item.'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Party : </th>';
			echo '<th class="float-left" colspan="24">From '.$fr_grh_supcd.' To '.$to_grh_supcd.'</th>';
		echo '</tr>';
	echo '</table>';
	 
	echo '<table border="1">';	
		echo '<tr>';
			echo '<th class="float-right" colspan="4">File Name :</th>';
			echo '<th class="float-left" colspan="24">Print File - Item Wise GRN With Values</th>';
		echo '</tr>';
		echo '<tr class="bg-color">';
			echo '<th>Item Code</th>';
			echo '<th class="float-left" colspan="27">Item Name</th>';
		echo '</tr>';

		echo '<tr class="bg-color">';
			echo '<th>&nbsp;</th>';
			echo '<th>GRN NO</th>';
			echo '<th>GRN DT</th>';
			echo '<th>CHAL NO</th>';					
			echo '<th>CHAL DT</th>';
			echo '<th>PO NO</th>';
			echo '<th>SUP CD</th>';
			echo '<th>SUP NAME</th>';
			echo '<th>GATE NO</th>';					
			echo '<th>GATE DT</th>';
			echo '<th>ACCEPT QTY</th>';
			echo '<th>B.VALUE</th>';
			echo '<th>S.TAX</th>';
			echo '<th>EXCISE</th>';
			echo '<th>CESS</th>';
			echo '<th>FREIGHT</th>';
			echo '<th>LOADING</th>';
			echo '<th>PACKING</th>';
			echo '<th>DISC.</th>';
			echo '<th>ISNU.</th>';
			echo '<th>SERV</th>';
			echo '<th>VALUE</th>';
			echo '<th>HSCS</th>';
			echo '<th>O.DISC</th>';
			echo '<th>OTHER</th>';
			echo '<th>IGST</th>';
			echo '<th>SGST</th>';
			echo '<th>CGST</th>';
		echo '</tr>';
	echo '</table>';

	echo '<table border="1">';

	//end of printing column names  
	//start while loop to get data
		
	    
	    if (!empty($rows)) {
	        foreach ($rows as $row) {
	            echo '<tr>';
	                echo '<td class="float-center"><b>'.$row['grd_item'].'</b></td>';
	                echo '<td class="float-left" colspan="27"><b>'.$row['itm_desc'].'</b></td>';
	            echo '</tr>';

	            $grd_item = $row['grd_item'];

	            $sql2 = "SELECT grd.*, sup.sup_name
				        FROM tempdb..{$grdlst} AS grd
				        INNER JOIN catalog..supcat AS sup
				        ON
				        grd.grh_supcd = sup.sup_supcd 
				        WHERE grd_item = '$grd_item'";

				$result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

				$rows2 = array();
			    while ($myRow2 = odbc_fetch_array($result2)) {
			        $rows2[] = $myRow2;
			    }
			    if (!empty($rows2)) {

			        	$totalQty = 0;
    						$totalBValue = 0;
    						$totalStax = 0;
    						$totalExcise = 0;
    						$totalCess = 0;
    						$totalFreight = 0;
    						$totalLoading = 0;
    						$totalPacking = 0;
    						$totalDisc = 0;
    						$totalIns = 0;
    						$totalServ = 0;
    						$totalValue = 0;
    						$totalHscs = 0;
    						$totalOdisc = 0;
    						$totalOther = 0;
    						$totalIgst = 0;
    						$totalSgst = 0;
    						$totalCgst = 0;
			        foreach ($rows2 as $row2) {
			        	echo '<tr>';
							echo '<td>&nbsp;</td>';
			                echo '<td class="float-center">'.$row2['grd_no'].'</td>';
			                echo '<td class="float-center">'.date('d.m.Y', strtotime($row2['grd_dt'])).'</td>';
			                echo '<td class="float-center">'.$row2['grh_chal_no'].'</td>';
			                echo '<td>'.date('d.m.Y', strtotime($row2['grh_chal_dt'])).'</td>';
			                echo '<td class="float-center">'.$row2['grd_po_no'].'</td>';
			                echo '<td class="float-center">'.$row2['grh_supcd'].'</td>';
			                echo '<td>'.$row2['sup_name'].'</td>';
			                echo '<td class="float-center">'.$row2['grh_gate_no'].'</td>';
			                echo '<td>'.date('d.m.Y', strtotime($row2['grh_gate_dt'])).'</td>';
			                $rcvQty = $row2['qty'];
			                echo '<td>'.number_format($rcvQty,3).'</td>';
			                $bvalue = $row2['valueb'];
			                echo '<td>'.number_format($bvalue,2).'</td>';
			                $stax = $row2['stax'];
			                echo '<td>'.$stax.'</td>';
			                $excise = $row2['excise'];
			                echo '<td>'.$excise.'</td>';
			                $cess = $row2['cess'];
			                echo '<td>'.$cess.'</td>';
			                $frt = $row2['frt'];
			                echo '<td>'.$frt.'</td>';
			                $ld = $row2['ld'];
			                echo '<td>'.$ld.'</td>';
			                $pack = $row2['pack'];
			                echo '<td>'.$pack.'</td>';
			                $disc = $row2['disc'];
			                echo '<td>'.$disc.'</td>';
			                $insu = $row2['insu'];
			                echo '<td>'.$insu.'</td>';
			                $serv = $row2['serv'];
			                echo '<td>'.$serv.'</td>';
			                $value = $row2['value'];
			                echo '<td>'.$value.'</td>';
			                $hscs = $row2['hscs'];
			                echo '<td>'.$hscs.'</td>';
			                $odisc = $row2['odisc'];
			                echo '<td>'.$odisc.'</td>';
			                $othr = $row2['othr'];
			                echo '<td>'.$othr.'</td>';
			                $igst = $row2['igst'];
			                echo '<td>'.$igst.'</td>';
			                $sgst = $row2['sgst'];
			                echo '<td>'.$sgst.'</td>';
			                $cgst = $row2['cgst'];
			                echo '<td>'.$cgst.'</td>';
			            echo '</tr>';
			            $totalQty = $totalQty + $rcvQty;
			            $totalBValue = $totalBValue + $bvalue;
			            $totalStax = $totalStax + $stax;
      						$totalExcise = $totalExcise + $excise;
      						$totalCess = $totalCess + $cess;
      						$totalFreight = $totalFreight + $frt;
      						$totalLoading = $totalLoading + $ld;
      						$totalPacking = $totalPacking + $pack;
      						$totalDisc = $totalDisc + $disc;
      						$totalIns = $totalIns + $insu;
      						$totalServ = $totalServ + $serv;
      						$totalValue = $totalValue + $value;
      						$totalHscs = $totalHscs + $hscs;
      						$totalOdisc = $totalOdisc + $odisc;
      						$totalOther = $totalOther + $othr;
      						$totalIgst = $totalIgst + $igst;
      						$totalSgst = $totalSgst + $sgst;
      						$totalCgst = $totalCgst + $cgst;
			        }
			    }
			    echo '<tr class="bg-color">';
					echo '<th colspan="10"></th>';
					echo '<th>TOTAL QTY</th>';
					echo '<th>TOTAL B.VALUE</th>';
					echo '<th>TOTAL S.TAX</th>';
					echo '<th>TOTAL EXCISE</th>';
					echo '<th>TOTAL CESS</th>';
					echo '<th>TOTAL FREIGHT</th>';
					echo '<th>TOTAL LOADING</th>';
					echo '<th>TOTAL PACKING</th>';
					echo '<th>TOTAL DISC.</th>';
					echo '<th>TOTAL ISNU.</th>';
					echo '<th>TOTAL SERV</th>';
					echo '<th>TOTAL VALUE</th>';
					echo '<th>TOTAL HSCS</th>';
					echo '<th>TOTAL O.DISC</th>';
					echo '<th>TOTAL OTHER</th>';
					echo '<th>TOTAL IGST</th>';
					echo '<th>TOTAL SGST</th>';
					echo '<th>TOTAL CGST</th>';
				echo '</tr>';
			    echo '<tr>';
					echo '<td colspan="10"></td>';
					echo '<td><b>'.number_format($totalQty,3).'</b></td>';
					echo '<td><b>'.number_format($totalBValue,2).'</b></td>';
					echo '<td><b>'.number_format($totalStax,2).'</b></td>';
					echo '<td><b>'.number_format($totalExcise,2).'</b></td>';
					echo '<td><b>'.number_format($totalCess,2).'</b></td>';
					echo '<td><b>'.number_format($totalFreight,2).'</b></td>';
					echo '<td><b>'.number_format($totalLoading,2).'</b></td>';
					echo '<td><b>'.number_format($totalPacking,2).'</b></td>';
					echo '<td><b>'.number_format($totalDisc,2).'</b></td>';
					echo '<td><b>'.number_format($totalIns,2).'</b></td>';
					echo '<td><b>'.number_format($totalServ,2).'</b></td>';
					echo '<td><b>'.number_format($totalValue,2).'</b></td>';
					echo '<td><b>'.number_format($totalHscs,2).'</b></td>';
					echo '<td><b>'.number_format($totalOdisc,2).'</b></td>';
					echo '<td><b>'.number_format($totalOther,2).'</b></td>';
					echo '<td><b>'.number_format($totalIgst,2).'</b></td>';
					echo '<td><b>'.number_format($totalSgst,2).'</b></td>';
					echo '<td><b>'.number_format($totalCgst,2).'</b></td>';
				echo '</tr>';
	        }
	    }else{
	        echo '<tr><th style="color:red;" colspan="28">No records found.</th></tr>';
	    }
	echo '</table>';	
}


/////////////////////////////////////////////////// Group file /////////////////////////////////////////

if ($file == 'gf') {

	//create ODBC connection   
	$sql = "SELECT DISTINCT grd.grd_item,grd.itm_desc, com.com_name, com.com_uname
			FROM tempdb..{$grdlst} AS grd
			INNER JOIN catalog..comcat AS com
			ON
			grd.grd_com = com.com_com AND
			grd.grd_unit = com.com_unit
			";
	$result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
	//print_r(odbc_result_all($result, "border=1"));exit;
	$rows = array();
	while ($myRow = odbc_fetch_array($result)) {
	    $rows[] = $myRow;
	}

	$file_ending = "xls";
	//header info for browser
	header("Content-Type: application/$file_ending");
	header("Pragma: no-cache"); 
	header("Expires: 0");
	$filename = 'Group_File_'.strtotime(date('Y-m-d h:m:s'));         //File Name
	header("Content-Disposition: attachment; filename=$filename.$file_ending");


	/*******Start of Formatting for Excel*******/   

	echo '<table border="1">';
		echo '<tr class="bg-color">';
			echo '<th colspan="4">NECO GROUP OF INDUSTRIES</th>';
			echo '<th class="float-left" colspan="22">Date : '.date('d.m.Y').'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Company Name : </th>';
			echo '<th class="float-left" colspan="22">'.$rows[0]['com_name'].'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Unit Name : </th>';
			echo '<th class="float-left" colspan="22">'.$rows[0]['com_uname'].'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">GRNS With Values : </th>';
			echo '<th class="float-left" colspan="22">From '.date('d.m.Y', strtotime($fr_grh_dt)).' To '.date('d.m.Y', strtotime($to_grh_dt)).'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Item Number : </th>';
			echo '<th class="float-left" colspan="22">From '.$fr_grd_item.' To '.$to_grd_item.'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Party : </th>';
			echo '<th class="float-left" colspan="22">From '.$fr_grh_supcd.' To '.$to_grh_supcd.'</th>';
		echo '</tr>';
	echo '</table>';
	 
	echo '<table border="1">';	
		echo '<tr>';
			echo '<th class="float-right" colspan="4">File Name :</th>';
			echo '<th class="float-left" colspan="22">Group File  - Group Wise GRN With Values</th>';
		echo '</tr>';
		echo '<tr class="bg-color">';
			echo '<th>Item Code</th>';
			echo '<th class="float-left" colspan="25">Item Name</th>';
		echo '</tr>';

		echo '<tr class="bg-color">';
			echo '<th>&nbsp;</th>';
			echo '<th>Fyr</th>';
			echo '<th>GRN NO</th>';
			echo '<th>SRL</th>';
			echo '<th>GRN DT</th>';
			echo '<th>QTY</th>';
			echo '<th>PO NO</th>';
			echo '<th>CHAL NO</th>';
			echo '<th>CHAL DT</th>';
			echo '<th>SUP CD</th>';
			echo '<th>SUP NAME</th>';
			echo '<th>RATE</th>';
			echo '<th>B.VALUE</th>';
			echo '<th>AVG RATE</th>';
			echo '<th>S.TAX</th>';
			echo '<th>EXCISE</th>';
			echo '<th>HSCS</th>';
			echo '<th>FREIGHT</th>';
			echo '<th>LOADING</th>';
			echo '<th>PACKING</th>';
			echo '<th>DISC.</th>';
			echo '<th>OTHER</th>';
			echo '<th>IGST</th>';
			echo '<th>SGST</th>';
			echo '<th>CGST</th>';
			echo '<th>VALUE</th>';

		echo '</tr>';
	echo '</table>';

	echo '<table border="1">';

	//end of printing column names  
	//start while loop to get data
		
	    
	    if (!empty($rows)) {
	        foreach ($rows as $row) {
	            echo '<tr>';
	                echo '<td class="float-center"><b>'.$row['grd_item'].'</b></td>';
	                echo '<td class="float-left" colspan="25"><b>'.$row['itm_desc'].'</b></td>';
	            echo '</tr>';

	            $grd_item = $row['grd_item'];

	            $sql2 = "SELECT grd.*, sup.sup_name
				        FROM tempdb..{$grdlst} AS grd
				        INNER JOIN catalog..supcat AS sup
				        ON
				        grd.grh_supcd = sup.sup_supcd 
				        WHERE grd_item = '$grd_item'";

				$result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

				$rows2 = array();
			    while ($myRow2 = odbc_fetch_array($result2)) {
			        $rows2[] = $myRow2;
			    }
			    if (!empty($rows2)) {

			        	$totalQty = 0;
						$totalBValue = 0;
						$totalStax = 0;
						$totalExcise = 0;
						$totalCess = 0;
						$totalFreight = 0;
						$totalLoading = 0;
						$totalPacking = 0;
						$totalDisc = 0;
						$totalIns = 0;
						$totalServ = 0;
						$totalValue = 0;
						$totalHscs = 0;
						$totalOdisc = 0;
						$totalOther = 0;
						$totalIgst = 0;
						$totalSgst = 0;
						$totalCgst = 0;
			        foreach ($rows2 as $row2) {
			        	echo '<tr>';
							echo '<td>&nbsp;</td>';
			                echo '<td class="float-center">'.$row2['grd_fyr'].'</td>';
			                echo '<td class="float-center">'.$row2['grd_no'].'</td>';
			                echo '<td class="float-center">'.$row2['grd_srl'].'</td>';
			                echo '<td class="float-center">'.date('d.m.Y', strtotime($row2['grd_dt'])).'</td>';
			                $rcvQty = $row2['qty'];
			                echo '<td>'.number_format($rcvQty,3).'</td>';
			                echo '<td class="float-center">'.$row2['grd_po_no'].'</td>';
			                echo '<td class="float-center">'.$row2['grh_chal_no'].'</td>';
			                echo '<td>'.date('d.m.Y', strtotime($row2['grh_chal_dt'])).'</td>';
			                echo '<td class="float-center">'.$row2['grh_supcd'].'</td>';
			                echo '<td>'.$row2['sup_name'].'</td>';
			                echo '<td>'.$row2['rate'].'</td>';
			                $bvalue = $row2['valueb'];
			                echo '<td>'.number_format($bvalue,2).'</td>';
			                echo '<td>'.$row2['avgrate'].'</td>';
			                $stax = $row2['stax'];
			                echo '<td>'.$stax.'</td>';
			                $excise = $row2['excise'];
			                echo '<td>'.$excise.'</td>';
			                $hscs = $row2['hscs'];
			                echo '<td>'.$hscs.'</td>';
			                $frt = $row2['frt'];
			                echo '<td>'.$frt.'</td>';
			                $ld = $row2['ld'];
			                echo '<td>'.$ld.'</td>';
			                $pack = $row2['pack'];
			                echo '<td>'.$pack.'</td>';
			                $disc = $row2['disc'];
			                echo '<td>'.$disc.'</td>';
			                $othr = $row2['othr'];
			                echo '<td>'.$othr.'</td>';
			                $igst = $row2['igst'];
			                echo '<td>'.$igst.'</td>';
			                $sgst = $row2['sgst'];
			                echo '<td>'.$sgst.'</td>';
			                $cgst = $row2['cgst'];
			                echo '<td>'.$cgst.'</td>';
			                $value = $row2['value'];
			                echo '<td>'.$value.'</td>';
			            echo '</tr>';
						$totalOther = $totalOther + $othr;
						$totalIgst = $totalIgst + $igst;
						$totalSgst = $totalSgst + $sgst;
						$totalCgst = $totalCgst + $cgst;
			        }
			    }
			    echo '<tr class="bg-color">';
					echo '<th colspan="22"></th>';
					echo '<th>TOTAL IGST</th>';
					echo '<th>TOTAL SGST</th>';
					echo '<th>TOTAL CGST</th>';
					echo '<th>&nbsp;</th>';
				echo '</tr>';
			    echo '<tr>';
					echo '<td colspan="22"></td>';
					echo '<td><b>'.number_format($totalIgst,2).'</b></td>';
					echo '<td><b>'.number_format($totalSgst,2).'</b></td>';
					echo '<td><b>'.number_format($totalCgst,2).'</b></td>';
					echo '<td>&nbsp;</td>';
				echo '</tr>';
	        }
	    }else{
	        echo '<tr><th style="color:red;" colspan="26">No records found.</th></tr>';
	    }
	echo '</table>';	
}


/////////////////////////////////////////////////// Account Wise file /////////////////////////////////////

if ($file == 'aw') {

	//create ODBC connection   
	$sql = "SELECT DISTINCT grd.mat_accd, com.com_name, com.com_uname
			FROM tempdb..{$grdlst} AS grd
			INNER JOIN catalog..comcat AS com
			ON
			grd.grd_com = com.com_com AND
			grd.grd_unit = com.com_unit
			";
	$result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
	//print_r(odbc_result_all($result, "border=1"));exit;
	$rows = array();
	while ($myRow = odbc_fetch_array($result)) {
	    $rows[] = $myRow;
	}

	$file_ending = "xls";
	//header info for browser
	header("Content-Type: application/$file_ending");
	header("Pragma: no-cache"); 
	header("Expires: 0");
	$filename = 'Account_Wise_File_'.strtotime(date('Y-m-d h:m:s'));         //File Name
	header("Content-Disposition: attachment; filename=$filename.$file_ending");


	/*******Start of Formatting for Excel*******/   

	echo '<table border="1">';
		echo '<tr class="bg-color">';
			echo '<th colspan="4">NECO GROUP OF INDUSTRIES</th>';
			echo '<th class="float-left" colspan="15">Date : '.date('d.m.Y').'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Company Name : </th>';
			echo '<th class="float-left" colspan="15">'.$rows[0]['com_name'].'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Unit Name : </th>';
			echo '<th class="float-left" colspan="15">'.$rows[0]['com_uname'].'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">GRNS With Values : </th>';
			echo '<th class="float-left" colspan="15">From '.date('d.m.Y', strtotime($fr_grh_dt)).' To '.date('d.m.Y', strtotime($to_grh_dt)).'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Item Number : </th>';
			echo '<th class="float-left" colspan="15">From '.$fr_grd_item.' To '.$to_grd_item.'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Party : </th>';
			echo '<th class="float-left" colspan="15">From '.$fr_grh_supcd.' To '.$to_grh_supcd.'</th>';
		echo '</tr>';
	echo '</table>';
	 
	echo '<table border="1">';	
		echo '<tr>';
			echo '<th class="float-right" colspan="4">File Name :</th>';
			echo '<th class="float-left" colspan="15">Account Wise File  - Account Wise GRN With Values</th>';
		echo '</tr>';
		echo '<tr class="bg-color">';
			echo '<th>Material Acc Code</th>';
			echo '<th class="float-left" colspan="18">Item Name</th>';
		echo '</tr>';

		echo '<tr class="bg-color">';
			echo '<th>&nbsp;</th>';
			echo '<th>ACCEPT QTY</th>';
			echo '<th>B.VALUE</th>';
			echo '<th>S.TAX</th>';
			echo '<th>EXCISE</th>';
			echo '<th>CESS</th>';
			echo '<th>FREIGHT</th>';
			echo '<th>LOADING</th>';
			echo '<th>PACKING</th>';
			echo '<th>DISC.</th>';
			echo '<th>ISNU.</th>';
			echo '<th>SERV</th>';
			echo '<th>VALUE</th>';
			echo '<th>HSCS</th>';
			echo '<th>O.DISC</th>';
			echo '<th>OTHER</th>';
			echo '<th>IGST</th>';
			echo '<th>SGST</th>';
			echo '<th>CGST</th>';
		echo '</tr>';
	echo '</table>';

	echo '<table border="1">';

	//end of printing column names  
	//start while loop to get data
		
	    
	    if (!empty($rows)) {
	    	$finalQty = 0;
			$finalBValue = 0;
			$finalStax = 0;
			$finalExcise = 0;
			$finalCess = 0;
			$finalFreight = 0;
			$finalLoading = 0;
			$finalPacking = 0;
			$finalDisc = 0;
			$finalIns = 0;
			$finalServ = 0;
			$finalValue = 0;
			$finalHscs = 0;
			$finalOdisc = 0;
			$finalOther = 0;
			$finalIgst = 0;
			$finalSgst = 0;
			$finalCgst = 0;
	        foreach ($rows as $row) {
	            echo '<tr>';
	                echo '<td class="float-center"><b>'.$row['mat_accd'].'</b></td>';
	                echo '<td class="float-left" colspan="18">&nbsp;</td>';
	            echo '</tr>';

	            $mat_accd = $row['mat_accd'];

	            $sql2 = "SELECT grd.*, sup.sup_name
				        FROM tempdb..{$grdlst} AS grd
				        INNER JOIN catalog..supcat AS sup
				        ON
				        grd.grh_supcd = sup.sup_supcd 
				        WHERE mat_accd = '$mat_accd'";

				$result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

				$rows2 = array();
			    while ($myRow2 = odbc_fetch_array($result2)) {
			        $rows2[] = $myRow2;
			    }
			    if (!empty($rows2)) {

			        	$totalQty = 0;
						$totalBValue = 0;
						$totalStax = 0;
						$totalExcise = 0;
						$totalCess = 0;
						$totalFreight = 0;
						$totalLoading = 0;
						$totalPacking = 0;
						$totalDisc = 0;
						$totalIns = 0;
						$totalServ = 0;
						$totalValue = 0;
						$totalHscs = 0;
						$totalOdisc = 0;
						$totalOther = 0;
						$totalIgst = 0;
						$totalSgst = 0;
						$totalCgst = 0;
			        foreach ($rows2 as $row2) {
			        	echo '<tr>';
							echo '<td>&nbsp;</td>';
			                $rcvQty = $row2['qty'];
			                echo '<td>'.number_format($rcvQty,3).'</td>';
			                $bvalue = $row2['valueb'];
			                echo '<td>'.number_format($bvalue,2).'</td>';
			                $stax = $row2['stax'];
			                echo '<td>'.$stax.'</td>';
			                $excise = $row2['excise'];
			                echo '<td>'.$excise.'</td>';
			                $cess = $row2['cess'];
			                echo '<td>'.$cess.'</td>';
			                $frt = $row2['frt'];
			                echo '<td>'.$frt.'</td>';
			                $ld = $row2['ld'];
			                echo '<td>'.$ld.'</td>';
			                $pack = $row2['pack'];
			                echo '<td>'.$pack.'</td>';
			                $disc = $row2['disc'];
			                echo '<td>'.$disc.'</td>';
			                $insu = $row2['insu'];
			                echo '<td>'.$insu.'</td>';
			                $serv = $row2['serv'];
			                echo '<td>'.$serv.'</td>';
			                $value = $row2['value'];
			                echo '<td>'.$value.'</td>';
			                $hscs = $row2['hscs'];
			                echo '<td>'.$hscs.'</td>';
			                $odisc = $row2['odisc'];
			                echo '<td>'.$odisc.'</td>';
			                $othr = $row2['othr'];
			                echo '<td>'.$othr.'</td>';
			                $igst = $row2['igst'];
			                echo '<td>'.$igst.'</td>';
			                $sgst = $row2['sgst'];
			                echo '<td>'.$sgst.'</td>';
			                $cgst = $row2['cgst'];
			                echo '<td>'.$cgst.'</td>';
			            echo '</tr>';
			            $totalQty = $totalQty + $rcvQty;
			            $totalBValue = $totalBValue + $bvalue;
			            $totalStax = $totalStax + $stax;
      						$totalExcise = $totalExcise + $excise;
      						$totalCess = $totalCess + $cess;
      						$totalFreight = $totalFreight + $frt;
      						$totalLoading = $totalLoading + $ld;
      						$totalPacking = $totalPacking + $pack;
      						$totalDisc = $totalDisc + $disc;
      						$totalIns = $totalIns + $insu;
      						$totalServ = $totalServ + $serv;
      						$totalValue = $totalValue + $value;
      						$totalHscs = $totalHscs + $hscs;
      						$totalOdisc = $totalOdisc + $odisc;
      						$totalOther = $totalOther + $othr;
      						$totalIgst = $totalIgst + $igst;
      						$totalSgst = $totalSgst + $sgst;
      						$totalCgst = $totalCgst + $cgst;

						      /// final total

						      $finalQty = $finalQty + $rcvQty;
			            $finalBValue = $finalBValue + $bvalue;
			            $finalStax = $finalStax + $stax;
      						$finalExcise = $finalExcise + $excise;
      						$finalCess = $finalCess + $cess;
      						$finalFreight = $finalFreight + $frt;
      						$finalLoading = $finalLoading + $ld;
      						$finalPacking = $finalPacking + $pack;
      						$finalDisc = $finalDisc + $disc;
      						$finalIns = $finalIns + $insu;
      						$finalServ = $finalServ + $serv;
      						$finalValue = $finalValue + $value;
      						$finalHscs = $finalHscs + $hscs;
      						$finalOdisc = $finalOdisc + $odisc;
      						$finalOther = $finalOther + $othr;
      						$finalIgst = $finalIgst + $igst;
      						$finalSgst = $finalSgst + $sgst;
      						$finalCgst = $finalCgst + $cgst;
      					}
			    }
			    echo '<tr class="bg-color">';
  					echo '<th>&nbsp;</th>';
  					echo '<th>TOTAL QTY</th>';
  					echo '<th>TOTAL B.VALUE</th>';
  					echo '<th>TOTAL S.TAX</th>';
  					echo '<th>TOTAL EXCISE</th>';
  					echo '<th>TOTAL CESS</th>';
  					echo '<th>TOTAL FREIGHT</th>';
  					echo '<th>TOTAL LOADING</th>';
  					echo '<th>TOTAL PACKING</th>';
  					echo '<th>TOTAL DISC.</th>';
  					echo '<th>TOTAL ISNU.</th>';
  					echo '<th>TOTAL SERV</th>';
  					echo '<th>TOTAL VALUE</th>';
  					echo '<th>TOTAL HSCS</th>';
  					echo '<th>TOTAL O.DISC</th>';
  					echo '<th>TOTAL OTHER</th>';
  					echo '<th>TOTAL IGST</th>';
  					echo '<th>TOTAL SGST</th>';
  					echo '<th>TOTAL CGST</th>';
  				echo '</tr>';
			    echo '<tr>';
  					echo '<td>&nbsp;</td>';
  					echo '<td><b>'.number_format($totalQty,3).'</b></td>';
  					echo '<td><b>'.number_format($totalBValue,2).'</b></td>';
  					echo '<td><b>'.number_format($totalStax,2).'</b></td>';
  					echo '<td><b>'.number_format($totalExcise,2).'</b></td>';
  					echo '<td><b>'.number_format($totalCess,2).'</b></td>';
  					echo '<td><b>'.number_format($totalFreight,2).'</b></td>';
  					echo '<td><b>'.number_format($totalLoading,2).'</b></td>';
  					echo '<td><b>'.number_format($totalPacking,2).'</b></td>';
  					echo '<td><b>'.number_format($totalDisc,2).'</b></td>';
  					echo '<td><b>'.number_format($totalIns,2).'</b></td>';
  					echo '<td><b>'.number_format($totalServ,2).'</b></td>';
  					echo '<td><b>'.number_format($totalValue,2).'</b></td>';
  					echo '<td><b>'.number_format($totalHscs,2).'</b></td>';
  					echo '<td><b>'.number_format($totalOdisc,2).'</b></td>';
  					echo '<td><b>'.number_format($totalOther,2).'</b></td>';
  					echo '<td><b>'.number_format($totalIgst,2).'</b></td>';
  					echo '<td><b>'.number_format($totalSgst,2).'</b></td>';
  					echo '<td><b>'.number_format($totalCgst,2).'</b></td>';
  				echo '</tr>';
	        }
	    }else{
	        echo '<tr><th style="color:red;" colspan="19">No records found.</th></tr>';
	    }
	    echo '<tr><th colspan="19">&nbsp;</th></tr>';
	    echo '<tr class="bg-color">';
			echo '<th>&nbsp;</th>';
			echo '<th>FINAL QTY</th>';
			echo '<th>FINAL B.VALUE</th>';
			echo '<th>FINAL S.TAX</th>';
			echo '<th>FINAL EXCISE</th>';
			echo '<th>FINAL CESS</th>';
			echo '<th>FINAL FREIGHT</th>';
			echo '<th>FINAL LOADING</th>';
			echo '<th>FINAL PACKING</th>';
			echo '<th>FINAL DISC.</th>';
			echo '<th>FINAL ISNU.</th>';
			echo '<th>FINAL SERV</th>';
			echo '<th>FINAL VALUE</th>';
			echo '<th>FINAL HSCS</th>';
			echo '<th>FINAL O.DISC</th>';
			echo '<th>FINAL OTHER</th>';
			echo '<th>FINAL IGST</th>';
			echo '<th>FINAL SGST</th>';
			echo '<th>FINAL CGST</th>';
		echo '</tr>';
	    echo '<tr>';
			echo '<td>&nbsp;</td>';
			echo '<td><b>'.number_format($finalQty,3).'</b></td>';
			echo '<td><b>'.number_format($finalBValue,2).'</b></td>';
			echo '<td><b>'.number_format($finalStax,2).'</b></td>';
			echo '<td><b>'.number_format($finalExcise,2).'</b></td>';
			echo '<td><b>'.number_format($finalCess,2).'</b></td>';
			echo '<td><b>'.number_format($finalFreight,2).'</b></td>';
			echo '<td><b>'.number_format($finalLoading,2).'</b></td>';
			echo '<td><b>'.number_format($finalPacking,2).'</b></td>';
			echo '<td><b>'.number_format($finalDisc,2).'</b></td>';
			echo '<td><b>'.number_format($finalIns,2).'</b></td>';
			echo '<td><b>'.number_format($finalServ,2).'</b></td>';
			echo '<td><b>'.number_format($finalValue,2).'</b></td>';
			echo '<td><b>'.number_format($finalHscs,2).'</b></td>';
			echo '<td><b>'.number_format($finalOdisc,2).'</b></td>';
			echo '<td><b>'.number_format($finalOther,2).'</b></td>';
			echo '<td><b>'.number_format($finalIgst,2).'</b></td>';
			echo '<td><b>'.number_format($finalSgst,2).'</b></td>';
			echo '<td><b>'.number_format($finalCgst,2).'</b></td>';
		echo '</tr>';
	echo '</table>';	
}


/////////////////////////////////////////////////// Date/Grn Wise file ////////////////////////////////////

if ($file == 'dgw') {

//create ODBC connection   
$sql = "SELECT DISTINCT grd.grd_no, com.com_name, com.com_uname
    FROM tempdb..{$grdlst} AS grd
    INNER JOIN catalog..comcat AS com
    ON
    grd.grd_com = com.com_com AND
    grd.grd_unit = com.com_unit
    ";
$result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
//print_r(odbc_result_all($result, "border=1"));exit;
$rows = array();
while ($myRow = odbc_fetch_array($result)) {
    $rows[] = $myRow;
}

$file_ending = "xls";
//header info for browser
header("Content-Type: application/$file_ending");
header("Pragma: no-cache"); 
header("Expires: 0");
$filename = 'Date_Grn_File_'.strtotime(date('Y-m-d h:m:s'));         //File Name
header("Content-Disposition: attachment; filename=$filename.$file_ending");


  /*******Start of Formatting for Excel*******/   

  echo '<table border="1">';
    echo '<tr class="bg-color">';
      echo '<th colspan="4">NECO GROUP OF INDUSTRIES</th>';
      echo '<th class="float-left" colspan="28">Date : '.date('d.m.Y').'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">Company Name : </th>';
      echo '<th class="float-left" colspan="28">'.$rows[0]['com_name'].'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">Unit Name : </th>';
      echo '<th class="float-left" colspan="28">'.$rows[0]['com_uname'].'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">GRNS With Values : </th>';
      echo '<th class="float-left" colspan="28">From '.date('d.m.Y', strtotime($fr_grh_dt)).' To '.date('d.m.Y', strtotime($to_grh_dt)).'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">Item Number : </th>';
      echo '<th class="float-left" colspan="28">From '.$fr_grd_item.' To '.$to_grd_item.'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">Party : </th>';
      echo '<th class="float-left" colspan="28">From '.$fr_grh_supcd.' To '.$to_grh_supcd.'</th>';
    echo '</tr>';
  echo '</table>';
   
  echo '<table border="1">';  
    echo '<tr>';
      echo '<th class="float-right" colspan="4">File Name :</th>';
      echo '<th class="float-left" colspan="28">Date/Grn File - Date/Grn For GRN With Values</th>';
    echo '</tr>';
    echo '<tr class="bg-color">';
      echo '<th>GRN NO</th>';
      echo '<th class="float-left" colspan="31">&nbsp;</th>';
    echo '</tr>';

    echo '<tr class="bg-color">';
      echo '<th>&nbsp;</th>';
      echo '<th>SRL</th>';
      echo '<th>GRN DT</th>';
      echo '<th>PO NO</th>';
      echo '<th>CHAL NO</th>';
      echo '<th>CHAL DT</th>';
      echo '<th>SUP CD</th>';
      echo '<th>SUP NAME</th>';
      echo '<th>ITEM CD</th>';
      echo '<th>ITEM DESC</th>';
      echo '<th>GATE NO</th>';
      echo '<th>GATE DT</th>';
      echo '<th>ENTRY NO</th>';
      echo '<th>ENTRY DT</th>';
      echo '<th>ACCEPT QTY</th>';
      echo '<th>B.VALUE</th>';
      echo '<th>S.TAX</th>';
      echo '<th>EXCISE</th>';
      echo '<th>CESS</th>';
      echo '<th>FREIGHT</th>';
      echo '<th>LOADING</th>';
      echo '<th>PACKING</th>';
      echo '<th>DISC.</th>';
      echo '<th>ISNU.</th>';
      echo '<th>SERV</th>';
      echo '<th>VALUE</th>';
      echo '<th>HSCS</th>';
      echo '<th>O.DISC</th>';
      echo '<th>OTHER</th>';
      echo '<th>IGST</th>';
      echo '<th>SGST</th>';
      echo '<th>CGST</th>';
    echo '</tr>';
  echo '</table>';

  echo '<table border="1">';

  //end of printing column names  
  //start while loop to get data
    
      
      if (!empty($rows)) {

                $totalQty = 0;
                $totalBValue = 0;
                $totalStax = 0;
                $totalExcise = 0;
                $totalCess = 0;
                $totalFreight = 0;
                $totalLoading = 0;
                $totalPacking = 0;
                $totalDisc = 0;
                $totalIns = 0;
                $totalServ = 0;
                $totalValue = 0;
                $totalHscs = 0;
                $totalOdisc = 0;
                $totalOther = 0;
                $totalIgst = 0;
                $totalSgst = 0;
                $totalCgst = 0;
          foreach ($rows as $row) {
              echo '<tr>';
                  echo '<td class="float-center"><b>'.$row['grd_no'].'</b></td>';
                  echo '<td class="float-left" colspan="31">&nbsp;</td>';
              echo '</tr>';

              $grd_no = $row['grd_no'];

              $sql2 = "SELECT grd.*, sup.sup_name
                FROM tempdb..{$grdlst} AS grd
                INNER JOIN catalog..supcat AS sup
                ON
                grd.grh_supcd = sup.sup_supcd
                WHERE grd_no = $grd_no";

        $result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

        $rows2 = array();
          while ($myRow2 = odbc_fetch_array($result2)) {
              $rows2[] = $myRow2;
          }
          if (!empty($rows2)) {
              foreach ($rows2 as $row2) {
                echo '<tr>';
                      echo '<td>&nbsp;</td>';
                      echo '<td class="float-center">'.$row2['grd_srl'].'</td>';
                      echo '<td class="float-center">'.$row2['grd_dt'].'</td>';
                      echo '<td class="float-center">'.$row2['grd_po_no'].'</td>';
                      echo '<td class="float-center">'.$row2['grh_chal_no'].'</td>';
                      echo '<td class="float-center">'.date('d.m.Y', strtotime($row2['grh_chal_dt'])).'</td>';
                      echo '<td class="float-center">'.$row2['grh_supcd'].'</td>';
                      echo '<td>'.$row2['sup_name'].'</td>';
                      echo '<td class="float-center">'.$row2['grd_item'].'</td>';
                      echo '<td>'.$row2['itm_desc'].'</td>';
                      echo '<td class="float-center">'.$row2['grh_gate_no'].'</td>';
                      echo '<td class="float-center">'.date('d.m.Y', strtotime($row2['grh_gate_dt'])).'</td>';
                      echo '<td class="float-center">'.$row2['entry_no'].'</td>';
                      echo '<td class="float-center">'.$row2['entry_dt'].'</td>';
                      $rcvQty = $row2['qty'];
                      echo '<td>'.number_format($rcvQty,3).'</td>';
                      $bvalue = $row2['valueb'];
                      echo '<td>'.number_format($bvalue,2).'</td>';
                      $stax = $row2['stax'];
                      echo '<td>'.$stax.'</td>';
                      $excise = $row2['excise'];
                      echo '<td>'.$excise.'</td>';
                      $cess = $row2['cess'];
                      echo '<td>'.$cess.'</td>';
                      $frt = $row2['frt'];
                      echo '<td>'.$frt.'</td>';
                      $ld = $row2['ld'];
                      echo '<td>'.$ld.'</td>';
                      $pack = $row2['pack'];
                      echo '<td>'.$pack.'</td>';
                      $disc = $row2['disc'];
                      echo '<td>'.$disc.'</td>';
                      $insu = $row2['insu'];
                      echo '<td>'.$insu.'</td>';
                      $serv = $row2['serv'];
                      echo '<td>'.$serv.'</td>';
                      $value = $row2['value'];
                      echo '<td>'.$value.'</td>';
                      $hscs = $row2['hscs'];
                      echo '<td>'.$hscs.'</td>';
                      $odisc = $row2['odisc'];
                      echo '<td>'.$odisc.'</td>';
                      $othr = $row2['othr'];
                      echo '<td>'.$othr.'</td>';
                      $igst = $row2['igst'];
                      echo '<td>'.$igst.'</td>';
                      $sgst = $row2['sgst'];
                      echo '<td>'.$sgst.'</td>';
                      $cgst = $row2['cgst'];
                      echo '<td>'.$cgst.'</td>';
                  echo '</tr>';
                  $totalQty = $totalQty + $rcvQty;
                  $totalBValue = $totalBValue + $bvalue;
                  $totalStax = $totalStax + $stax;
                  $totalExcise = $totalExcise + $excise;
                  $totalCess = $totalCess + $cess;
                  $totalFreight = $totalFreight + $frt;
                  $totalLoading = $totalLoading + $ld;
                  $totalPacking = $totalPacking + $pack;
                  $totalDisc = $totalDisc + $disc;
                  $totalIns = $totalIns + $insu;
                  $totalServ = $totalServ + $serv;
                  $totalValue = $totalValue + $value;
                  $totalHscs = $totalHscs + $hscs;
                  $totalOdisc = $totalOdisc + $odisc;
                  $totalOther = $totalOther + $othr;
                  $totalIgst = $totalIgst + $igst;
                  $totalSgst = $totalSgst + $sgst;
                  $totalCgst = $totalCgst + $cgst;
              }
          }
          }
          echo '<tr class="bg-color">';
          echo '<th colspan="14">&nbsp;</th>';
          echo '<th>TOTAL QTY</th>';
          echo '<th>TOTAL B.VALUE</th>';
          echo '<th>TOTAL S.TAX</th>';
          echo '<th>TOTAL EXCISE</th>';
          echo '<th>TOTAL CESS</th>';
          echo '<th>TOTAL FREIGHT</th>';
          echo '<th>TOTAL LOADING</th>';
          echo '<th>TOTAL PACKING</th>';
          echo '<th>TOTAL DISC.</th>';
          echo '<th>TOTAL ISNU.</th>';
          echo '<th>TOTAL SERV</th>';
          echo '<th>TOTAL VALUE</th>';
          echo '<th>TOTAL HSCS</th>';
          echo '<th>TOTAL O.DISC</th>';
          echo '<th>TOTAL OTHER</th>';
          echo '<th>TOTAL IGST</th>';
          echo '<th>TOTAL SGST</th>';
          echo '<th>TOTAL CGST</th>';
        echo '</tr>';
          echo '<tr>';
          echo '<td colspan="14">&nbsp;</td>';
          echo '<td><b>'.number_format($totalQty,3).'</b></td>';
          echo '<td><b>'.number_format($totalBValue,2).'</b></td>';
          echo '<td><b>'.number_format($totalStax,2).'</b></td>';
          echo '<td><b>'.number_format($totalExcise,2).'</b></td>';
          echo '<td><b>'.number_format($totalCess,2).'</b></td>';
          echo '<td><b>'.number_format($totalFreight,2).'</b></td>';
          echo '<td><b>'.number_format($totalLoading,2).'</b></td>';
          echo '<td><b>'.number_format($totalPacking,2).'</b></td>';
          echo '<td><b>'.number_format($totalDisc,2).'</b></td>';
          echo '<td><b>'.number_format($totalIns,2).'</b></td>';
          echo '<td><b>'.number_format($totalServ,2).'</b></td>';
          echo '<td><b>'.number_format($totalValue,2).'</b></td>';
          echo '<td><b>'.number_format($totalHscs,2).'</b></td>';
          echo '<td><b>'.number_format($totalOdisc,2).'</b></td>';
          echo '<td><b>'.number_format($totalOther,2).'</b></td>';
          echo '<td><b>'.number_format($totalIgst,2).'</b></td>';
          echo '<td><b>'.number_format($totalSgst,2).'</b></td>';
          echo '<td><b>'.number_format($totalCgst,2).'</b></td>';
        echo '</tr>';
      }else{
          echo '<tr><th style="color:red;" colspan="31">No records found.</th></tr>';
      }
  echo '</table>';  
}


/////////////////////////////////////////////////// Inter Company file /////////////////////////////////////

if ($file == 'ic') {

	//create ODBC connection   
	$sql = "SELECT DISTINCT grd.grd_item, grd.itm_desc,grd.grh_supcd, com.com_name, com.com_uname, sup.sup_name
			FROM tempdb..{$grdlst} AS grd
			INNER JOIN catalog..comcat AS com
			ON
			grd.grd_com = com.com_com AND
			grd.grd_unit = com.com_unit
      INNER JOIN catalog..supcat AS sup
      ON
      grd.grh_supcd = sup.sup_supcd 
			";
	$result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
	//print_r(odbc_result_all($result, "border=1"));exit;
	$rows = array();
	while ($myRow = odbc_fetch_array($result)) {
	    $rows[] = $myRow;
	}

	$file_ending = "xls";
	//header info for browser
	header("Content-Type: application/$file_ending");
	header("Pragma: no-cache"); 
	header("Expires: 0");
	$filename = 'Inter_Company_File_'.strtotime(date('Y-m-d h:m:s'));         //File Name
	header("Content-Disposition: attachment; filename=$filename.$file_ending");


	/*******Start of Formatting for Excel*******/   

	echo '<table border="1">';
		echo '<tr class="bg-color">';
			echo '<th colspan="4">NECO GROUP OF INDUSTRIES</th>';
			echo '<th class="float-left" colspan="10">Date : '.date('d.m.Y').'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Company Name : </th>';
			echo '<th class="float-left" colspan="10">'.$rows[0]['com_name'].'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Unit Name : </th>';
			echo '<th class="float-left" colspan="10">'.$rows[0]['com_uname'].'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">GRNS With Values : </th>';
			echo '<th class="float-left" colspan="10">From '.date('d.m.Y', strtotime($fr_grh_dt)).' To '.date('d.m.Y', strtotime($to_grh_dt)).'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Item Number : </th>';
			echo '<th class="float-left" colspan="10">From '.$fr_grd_item.' To '.$to_grd_item.'</th>';
		echo '</tr>';
		echo '<tr>';
			echo '<th class="float-right" colspan="4">Party : </th>';
			echo '<th class="float-left" colspan="10">From '.$fr_grh_supcd.' To '.$to_grh_supcd.'</th>';
		echo '</tr>';
	echo '</table>';
	 
	echo '<table border="1">';	
		echo '<tr>';
			echo '<th class="float-right" colspan="4">File Name :</th>';
			echo '<th class="float-left" colspan="10">Inter Company File  - Inter Company GRN With Values</th>';
		echo '</tr>';
		echo '<tr class="bg-color">';
			echo '<th>Supplier Code</th>';
			echo '<th class="float-left" colspan="13">Supplier Name</th>';
		echo '</tr>';
    echo '<tr class="bg-color">';
      echo '<th>Item Code</th>';
      echo '<th class="float-left" colspan="13">Item Name</th>';
    echo '</tr>';

		echo '<tr class="bg-color">';
			echo '<th>&nbsp;</th>';
			echo '<th>GRN NO</th>';
			echo '<th>GRN DT</th>';
			echo '<th>SRL</th>';
			echo '<th>ACCEPT QTY</th>';
			echo '<th>RATE</th>';
			echo '<th>VALUE</th>';
			echo '<th>S.TAX</th>';
			echo '<th>EXCISE</th>';
			echo '<th>OTHER</th>';
			echo '<th>IGST</th>';
			echo '<th>SGST</th>';
			echo '<th>CGST</th>';
			echo '<th>BILL VALUE</th>';
		echo '</tr>';
	echo '</table>';

	echo '<table border="1">';

	//end of printing column names  
	//start while loop to get data
		
	    
	    if (!empty($rows)) {

			$finalValue = 0;
			$finalStax = 0;
			$finalExcise = 0;
			$finalOther = 0;
			$finalIgst = 0;
			$finalSgst = 0;
			$finalCgst = 0;
			$finalBValue = 0;
	        foreach ($rows as $row) {
	            echo '<tr>';
	                echo '<td class="float-center"><b>'.$row['grh_supcd'].'</b></td>';
	                echo '<td class="float-left" colspan="13"><b>'.$row['sup_name'].'</b></td>';
	            echo '</tr>';
              echo '<tr>';
                  echo '<td class="float-center"><b>'.$row['grd_item'].'</b></td>';
                  echo '<td class="float-left" colspan="13"><b>'.$row['itm_desc'].'</b></td>';
              echo '</tr>';

	            $grd_item = $row['grd_item'];

	            $sql2 = "SELECT grd.*
				        FROM tempdb..{$grdlst} AS grd
				        WHERE grd_item = '$grd_item'";

				$result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

				$rows2 = array();
			    while ($myRow2 = odbc_fetch_array($result2)) {
			        $rows2[] = $myRow2;
			    }
			    if (!empty($rows2)) {

						$totalValue = 0;
						$totalStax = 0;
						$totalExcise = 0;
						$totalOther = 0;
						$totalIgst = 0;
						$totalSgst = 0;
						$totalCgst = 0;
						$totalBValue = 0;
			        foreach ($rows2 as $row2) {
			        	echo '<tr>';
							       echo '<td>&nbsp;</td>';
			                echo '<td class="float-center">'.$row2['grd_no'].'</td>';
			                echo '<td class="float-center">'.date('d.m.Y', strtotime($row2['grd_dt'])).'</td>';
			                echo '<td class="float-center">'.$row2['grd_srl'].'</td>';
			                $rcvQty = $row2['qty'];
			                echo '<td>'.number_format($rcvQty,3).'</td>';
							         echo '<td>'.$row2['rate'].'</td>';
                      $bvalue = $row2['valueb'];
                      echo '<td>'.number_format($bvalue,2).'</td>';
			                $stax = $row2['stax'];
			                echo '<td>'.$stax.'</td>';
			                $excise = $row2['excise'];
			                echo '<td>'.$excise.'</td>';
			                $othr = $row2['othr'];
			                echo '<td>'.$othr.'</td>';
			                $igst = $row2['igst'];
			                echo '<td>'.$igst.'</td>';
			                $sgst = $row2['sgst'];
			                echo '<td>'.$sgst.'</td>';
			                $cgst = $row2['cgst'];
			                echo '<td>'.$cgst.'</td>';
                      $value = $row2['value'];
                      echo '<td>'.number_format($value,2).'</td>';
			            echo '</tr>';

			            $totalValue = $totalValue + $value;
			            $totalStax = $totalStax + $stax;
      						$totalExcise = $totalExcise + $excise;
      						$totalOther = $totalOther + $othr;
      						$totalIgst = $totalIgst + $igst;
      						$totalSgst = $totalSgst + $sgst;
      						$totalCgst = $totalCgst + $cgst;
			            $totalBValue = $totalBValue + $bvalue;

						/// final total

			            $finalValue = $finalValue + $value;
			            $finalStax = $finalStax + $stax;
      						$finalExcise = $finalExcise + $excise;
      						$finalOther = $finalOther + $othr;
      						$finalIgst = $finalIgst + $igst;
      						$finalSgst = $finalSgst + $sgst;
      						$finalCgst = $finalCgst + $cgst;
			            $finalBValue = $finalBValue + $bvalue;
					}
			    }
			    echo '<tr class="bg-color">';
					echo '<th>&nbsp;</th>';
					echo '<th>&nbsp;</th>';
					echo '<th>&nbsp;</th>';
					echo '<th>&nbsp;</th>';
					echo '<th>&nbsp;</th>';
					echo '<th>&nbsp;</th>';
					echo '<th>TOTAL VALUE</th>';
					echo '<th>TOTAL S.TAX</th>';
					echo '<th>TOTAL EXCISE</th>';
					echo '<th>TOTAL OTHER</th>';
					echo '<th>TOTAL IGST</th>';
					echo '<th>TOTAL SGST</th>';
					echo '<th>TOTAL CGST</th>';
					echo '<th>TOTAL B.VALUE</th>';
				echo '</tr>';
			    echo '<tr>';
					echo '<td>&nbsp;</td>';
					echo '<td>&nbsp;</td>';
					echo '<td>&nbsp;</td>';
					echo '<td>&nbsp;</td>';
					echo '<td>&nbsp;</td>';
					echo '<td>&nbsp;</td>';
          echo '<td><b>'.number_format($totalBValue,2).'</b></td>';
					echo '<td><b>'.number_format($totalStax,2).'</b></td>';
					echo '<td><b>'.number_format($totalExcise,2).'</b></td>';
					echo '<td><b>'.number_format($totalOther,2).'</b></td>';
					echo '<td><b>'.number_format($totalIgst,2).'</b></td>';
					echo '<td><b>'.number_format($totalSgst,2).'</b></td>';
					echo '<td><b>'.number_format($totalCgst,2).'</b></td>';
          echo '<td><b>'.number_format($totalValue,2).'</b></td>';
				echo '</tr>';
	        }
	    }else{
	        echo '<tr><th style="color:red;" colspan="13">No records found.</th></tr>';
	    }
	    echo '<tr><th colspan="13">&nbsp;</th></tr>';
	    echo '<tr class="bg-color">';
			echo '<th>&nbsp;</th>';
			echo '<th>&nbsp;</th>';
			echo '<th>&nbsp;</th>';
			echo '<th>&nbsp;</th>';
			echo '<th>&nbsp;</th>';
			echo '<th>&nbsp;</th>';
			echo '<th>FINAL VALUE</th>';
			echo '<th>FINAL S.TAX</th>';
			echo '<th>FINAL EXCISE</th>';
			echo '<th>FINAL OTHER</th>';
			echo '<th>FINAL IGST</th>';
			echo '<th>FINAL SGST</th>';
			echo '<th>FINAL CGST</th>';
			echo '<th>FINAL B.VALUE</th>';
		echo '</tr>';
	    echo '<tr>';
			echo '<td>&nbsp;</td>';
			echo '<td>&nbsp;</td>';
			echo '<td>&nbsp;</td>';
			echo '<td>&nbsp;</td>';
			echo '<td>&nbsp;</td>';
			echo '<td>&nbsp;</td>';
      echo '<td><b>'.number_format($finalBValue,2).'</b></td>';
			echo '<td><b>'.number_format($finalStax,2).'</b></td>';
			echo '<td><b>'.number_format($finalExcise,2).'</b></td>';
			echo '<td><b>'.number_format($finalOther,2).'</b></td>';
			echo '<td><b>'.number_format($finalIgst,2).'</b></td>';
			echo '<td><b>'.number_format($finalSgst,2).'</b></td>';
			echo '<td><b>'.number_format($finalCgst,2).'</b></td>';
      echo '<td><b>'.number_format($finalValue,2).'</b></td>';
		echo '</tr>';
	echo '</table>';	
}


///////////////////////////////////////////// Intercomp Summary file ////////////////////////////////

if ($file == 'is') {

  //create ODBC connection   
  $sql = "SELECT DISTINCT grd.grh_supcd, com.com_name, com.com_uname, sup.sup_name
      FROM tempdb..{$grdlst} AS grd
      INNER JOIN catalog..comcat AS com
      ON
      grd.grd_com = com.com_com AND
      grd.grd_unit = com.com_unit
      INNER JOIN catalog..supcat AS sup
      ON
      grd.grh_supcd = sup.sup_supcd
      ";
  $result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
  //print_r(odbc_result_all($result, "border=1"));exit;
  $rows = array();
  while ($myRow = odbc_fetch_array($result)) {
      $rows[] = $myRow;
  }

  $file_ending = "xls";
  //header info for browser
  header("Content-Type: application/$file_ending");
  header("Pragma: no-cache"); 
  header("Expires: 0");
  $filename = 'Intercomp_Summary_File_'.strtotime(date('Y-m-d h:m:s'));         //File Name
  header("Content-Disposition: attachment; filename=$filename.$file_ending");


  /*******Start of Formatting for Excel*******/   

  echo '<table border="1">';
    echo '<tr class="bg-color">';
      echo '<th colspan="4">NECO GROUP OF INDUSTRIES</th>';
      echo '<th class="float-left" colspan="9">Date : '.date('d.m.Y').'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">Company Name : </th>';
      echo '<th class="float-left" colspan="9">'.$rows[0]['com_name'].'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">Unit Name : </th>';
      echo '<th class="float-left" colspan="9">'.$rows[0]['com_uname'].'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">GRNS With Values : </th>';
      echo '<th class="float-left" colspan="9">From '.date('d.m.Y', strtotime($fr_grh_dt)).' To '.date('d.m.Y', strtotime($to_grh_dt)).'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">Item Number : </th>';
      echo '<th class="float-left" colspan="9">From '.$fr_grd_item.' To '.$to_grd_item.'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">Party : </th>';
      echo '<th class="float-left" colspan="9">From '.$fr_grh_supcd.' To '.$to_grh_supcd.'</th>';
    echo '</tr>';
  echo '</table>';
   
  echo '<table border="1">';  
    echo '<tr>';
      echo '<th class="float-right" colspan="4">File Name :</th>';
      echo '<th class="float-left" colspan="9">Intercomp Summary File  - Intercomp Summary GRN With Values</th>';
    echo '</tr>';
    echo '<tr class="bg-color">';
      echo '<th>Supplier Code</th>';
      echo '<th class="float-left" colspan="12">Supplier Name</th>';
    echo '</tr>';

    echo '<tr class="bg-color">';
      echo '<th>&nbsp;</th>';
      echo '<th>ITEM NO</th>';
      echo '<th>ITEM DESC</th>';
      echo '<th>ACCEPT QTY</th>';
      echo '<th>RATE</th>';
      echo '<th>VALUE</th>';
      echo '<th>S.TAX</th>';
      echo '<th>EXCISE</th>';
      echo '<th>OTHER</th>';
      echo '<th>IGST</th>';
      echo '<th>SGST</th>';
      echo '<th>CGST</th>';
      echo '<th>BILL VALUE</th>';
    echo '</tr>';
  echo '</table>';

  echo '<table border="1">';

  //end of printing column names  
  //start while loop to get data
    
      
      if (!empty($rows)) {

      $finalValue = 0;
      $finalStax = 0;
      $finalExcise = 0;
      $finalOther = 0;
      $finalIgst = 0;
      $finalSgst = 0;
      $finalCgst = 0;
      $finalBValue = 0;
          foreach ($rows as $row) {
              echo '<tr>';
                  echo '<td class="float-center"><b>'.$row['grh_supcd'].'</b></td>';
                  echo '<td class="float-left" colspan="12"><b>'.$row['sup_name'].'</b></td>';
              echo '</tr>';

              $grh_supcd = $row['grh_supcd'];

              $sql2 = "SELECT grd.*
                FROM tempdb..{$grdlst} AS grd 
                WHERE grh_supcd = '$grh_supcd'";

        $result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

        $rows2 = array();
          while ($myRow2 = odbc_fetch_array($result2)) {
              $rows2[] = $myRow2;
          }
          if (!empty($rows2)) {

            $totalValue = 0;
            $totalStax = 0;
            $totalExcise = 0;
            $totalOther = 0;
            $totalIgst = 0;
            $totalSgst = 0;
            $totalCgst = 0;
            $totalBValue = 0;
              foreach ($rows2 as $row2) {
                  echo '<tr>';
                      echo '<td>&nbsp;</td>';
                      echo '<td class="float-center">'.$row2['grd_item'].'</td>';
                      echo '<td class="float-left">'.$row2['itm_desc'].'</td>';
                      $rcvQty = $row2['qty'];
                      echo '<td>'.number_format($rcvQty,3).'</td>';
                      echo '<td>'.$row2['rate'].'</td>';
                      $bvalue = $row2['valueb'];
                      echo '<td>'.number_format($bvalue,2).'</td>';
                      $stax = $row2['stax'];
                      echo '<td>'.$stax.'</td>';
                      $excise = $row2['excise'];
                      echo '<td>'.$excise.'</td>';
                      $othr = $row2['othr'];
                      echo '<td>'.$othr.'</td>';
                      $igst = $row2['igst'];
                      echo '<td>'.$igst.'</td>';
                      $sgst = $row2['sgst'];
                      echo '<td>'.$sgst.'</td>';
                      $cgst = $row2['cgst'];
                      echo '<td>'.$cgst.'</td>';
                      $value = $row2['value'];
                      echo '<td>'.number_format($value,2).'</td>';
                  echo '</tr>';

                  $totalValue = $totalValue + $value;
                  $totalStax = $totalStax + $stax;
                  $totalExcise = $totalExcise + $excise;
                  $totalOther = $totalOther + $othr;
                  $totalIgst = $totalIgst + $igst;
                  $totalSgst = $totalSgst + $sgst;
                  $totalCgst = $totalCgst + $cgst;
                  $totalBValue = $totalBValue + $bvalue;

            /// final total

                  $finalValue = $finalValue + $value;
                  $finalStax = $finalStax + $stax;
                  $finalExcise = $finalExcise + $excise;
                  $finalOther = $finalOther + $othr;
                  $finalIgst = $finalIgst + $igst;
                  $finalSgst = $finalSgst + $sgst;
                  $finalCgst = $finalCgst + $cgst;
                  $finalBValue = $finalBValue + $bvalue;
          }
          }
          echo '<tr class="bg-color">';
            echo '<th>&nbsp;</th>';
            echo '<th>&nbsp;</th>';
            echo '<th>&nbsp;</th>';
            echo '<th>&nbsp;</th>';
            echo '<th>&nbsp;</th>';
            echo '<th>TOTAL VALUE</th>';
            echo '<th>TOTAL S.TAX</th>';
            echo '<th>TOTAL EXCISE</th>';
            echo '<th>TOTAL OTHER</th>';
            echo '<th>TOTAL IGST</th>';
            echo '<th>TOTAL SGST</th>';
            echo '<th>TOTAL CGST</th>';
            echo '<th>TOTAL B.VALUE</th>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td><b>'.number_format($totalBValue,2).'</b></td>';
            echo '<td><b>'.number_format($totalStax,2).'</b></td>';
            echo '<td><b>'.number_format($totalExcise,2).'</b></td>';
            echo '<td><b>'.number_format($totalOther,2).'</b></td>';
            echo '<td><b>'.number_format($totalIgst,2).'</b></td>';
            echo '<td><b>'.number_format($totalSgst,2).'</b></td>';
            echo '<td><b>'.number_format($totalCgst,2).'</b></td>';
            echo '<td><b>'.number_format($totalValue,2).'</b></td>';
          echo '</tr>';
          }
      }else{
          echo '<tr><th style="color:red;" colspan="13">No records found.</th></tr>';
      }
      echo '<tr><th colspan="12">&nbsp;</th></tr>';
      echo '<tr class="bg-color">';
        echo '<th>&nbsp;</th>';
        echo '<th>&nbsp;</th>';
        echo '<th>&nbsp;</th>';
        echo '<th>&nbsp;</th>';
        echo '<th>&nbsp;</th>';
        echo '<th>FINAL VALUE</th>';
        echo '<th>FINAL S.TAX</th>';
        echo '<th>FINAL EXCISE</th>';
        echo '<th>FINAL OTHER</th>';
        echo '<th>FINAL IGST</th>';
        echo '<th>FINAL SGST</th>';
        echo '<th>FINAL CGST</th>';
        echo '<th>FINAL B.VALUE</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<td>&nbsp;</td>';
        echo '<td>&nbsp;</td>';
        echo '<td>&nbsp;</td>';
        echo '<td>&nbsp;</td>';
        echo '<td>&nbsp;</td>';
        echo '<td><b>'.number_format($finalBValue,2).'</b></td>';
        echo '<td><b>'.number_format($finalStax,2).'</b></td>';
        echo '<td><b>'.number_format($finalExcise,2).'</b></td>';
        echo '<td><b>'.number_format($finalOther,2).'</b></td>';
        echo '<td><b>'.number_format($finalIgst,2).'</b></td>';
        echo '<td><b>'.number_format($finalSgst,2).'</b></td>';
        echo '<td><b>'.number_format($finalCgst,2).'</b></td>';
        echo '<td><b>'.number_format($finalValue,2).'</b></td>';        
      echo '</tr>';
  echo '</table>';  
}


/////////////////////////////////////////////////// Summary file /////////////////////////////////////////

if ($file == 'sf') {

//create ODBC connection   
$sql = "SELECT DISTINCT grd.grd_item,grd.itm_desc, com.com_name, com.com_uname
    FROM tempdb..{$grdlst} AS grd
    INNER JOIN catalog..comcat AS com
    ON
    grd.grd_com = com.com_com AND
    grd.grd_unit = com.com_unit
    ";
$result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
//print_r(odbc_result_all($result, "border=1"));exit;
$rows = array();
while ($myRow = odbc_fetch_array($result)) {
    $rows[] = $myRow;
}

$file_ending = "xls";
//header info for browser
header("Content-Type: application/$file_ending");
header("Pragma: no-cache"); 
header("Expires: 0");
$filename = 'Summary_File_'.strtotime(date('Y-m-d h:m:s'));         //File Name
header("Content-Disposition: attachment; filename=$filename.$file_ending");


  /*******Start of Formatting for Excel*******/   

  echo '<table border="1">';
    echo '<tr class="bg-color">';
      echo '<th colspan="4">NECO GROUP OF INDUSTRIES</th>';
      echo '<th class="float-left" colspan="15">Date : '.date('d.m.Y').'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">Company Name : </th>';
      echo '<th class="float-left" colspan="15">'.$rows[0]['com_name'].'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">Unit Name : </th>';
      echo '<th class="float-left" colspan="15">'.$rows[0]['com_uname'].'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">GRNS With Values : </th>';
      echo '<th class="float-left" colspan="15">From '.date('d.m.Y', strtotime($fr_grh_dt)).' To '.date('d.m.Y', strtotime($to_grh_dt)).'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">Item Number : </th>';
      echo '<th class="float-left" colspan="15">From '.$fr_grd_item.' To '.$to_grd_item.'</th>';
    echo '</tr>';
    echo '<tr>';
      echo '<th class="float-right" colspan="4">Party : </th>';
      echo '<th class="float-left" colspan="15">From '.$fr_grh_supcd.' To '.$to_grh_supcd.'</th>';
    echo '</tr>';
  echo '</table>';
   
  echo '<table border="1">';  
    echo '<tr>';
      echo '<th class="float-right" colspan="4">File Name :</th>';
      echo '<th class="float-left" colspan="15">Summary File - Summary For GRN With Values</th>';
    echo '</tr>';
    echo '<tr class="bg-color">';
      echo '<th>Item Code</th>';
      echo '<th class="float-left" colspan="18">Item Name</th>';
    echo '</tr>';

    echo '<tr class="bg-color">';
      echo '<th>&nbsp;</th>';
      echo '<th>ACCEPT QTY</th>';
      echo '<th>B.VALUE</th>';
      echo '<th>S.TAX</th>';
      echo '<th>EXCISE</th>';
      echo '<th>CESS</th>';
      echo '<th>FREIGHT</th>';
      echo '<th>LOADING</th>';
      echo '<th>PACKING</th>';
      echo '<th>DISC.</th>';
      echo '<th>ISNU.</th>';
      echo '<th>SERV</th>';
      echo '<th>VALUE</th>';
      echo '<th>HSCS</th>';
      echo '<th>O.DISC</th>';
      echo '<th>OTHER</th>';
      echo '<th>IGST</th>';
      echo '<th>SGST</th>';
      echo '<th>CGST</th>';
    echo '</tr>';
  echo '</table>';

  echo '<table border="1">';

  //end of printing column names  
  //start while loop to get data
    
      
      if (!empty($rows)) {

                $totalQty = 0;
                $totalBValue = 0;
                $totalStax = 0;
                $totalExcise = 0;
                $totalCess = 0;
                $totalFreight = 0;
                $totalLoading = 0;
                $totalPacking = 0;
                $totalDisc = 0;
                $totalIns = 0;
                $totalServ = 0;
                $totalValue = 0;
                $totalHscs = 0;
                $totalOdisc = 0;
                $totalOther = 0;
                $totalIgst = 0;
                $totalSgst = 0;
                $totalCgst = 0;
          foreach ($rows as $row) {
              echo '<tr>';
                  echo '<td class="float-center"><b>'.$row['grd_item'].'</b></td>';
                  echo '<td class="float-left" colspan="18"><b>'.$row['itm_desc'].'</b></td>';
              echo '</tr>';

              $grd_item = $row['grd_item'];

              $sql2 = "SELECT grd.*
                FROM tempdb..{$grdlst} AS grd
                WHERE grd_item = '$grd_item'";

        $result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

        $rows2 = array();
          while ($myRow2 = odbc_fetch_array($result2)) {
              $rows2[] = $myRow2;
          }
          if (!empty($rows2)) {
              foreach ($rows2 as $row2) {
                echo '<tr>';
                      echo '<td>&nbsp;</td>';
                      $rcvQty = $row2['qty'];
                      echo '<td>'.number_format($rcvQty,3).'</td>';
                      $bvalue = $row2['valueb'];
                      echo '<td>'.number_format($bvalue,2).'</td>';
                      $stax = $row2['stax'];
                      echo '<td>'.$stax.'</td>';
                      $excise = $row2['excise'];
                      echo '<td>'.$excise.'</td>';
                      $cess = $row2['cess'];
                      echo '<td>'.$cess.'</td>';
                      $frt = $row2['frt'];
                      echo '<td>'.$frt.'</td>';
                      $ld = $row2['ld'];
                      echo '<td>'.$ld.'</td>';
                      $pack = $row2['pack'];
                      echo '<td>'.$pack.'</td>';
                      $disc = $row2['disc'];
                      echo '<td>'.$disc.'</td>';
                      $insu = $row2['insu'];
                      echo '<td>'.$insu.'</td>';
                      $serv = $row2['serv'];
                      echo '<td>'.$serv.'</td>';
                      $value = $row2['value'];
                      echo '<td>'.$value.'</td>';
                      $hscs = $row2['hscs'];
                      echo '<td>'.$hscs.'</td>';
                      $odisc = $row2['odisc'];
                      echo '<td>'.$odisc.'</td>';
                      $othr = $row2['othr'];
                      echo '<td>'.$othr.'</td>';
                      $igst = $row2['igst'];
                      echo '<td>'.$igst.'</td>';
                      $sgst = $row2['sgst'];
                      echo '<td>'.$sgst.'</td>';
                      $cgst = $row2['cgst'];
                      echo '<td>'.$cgst.'</td>';
                  echo '</tr>';
                  $totalQty = $totalQty + $rcvQty;
                  $totalBValue = $totalBValue + $bvalue;
                  $totalStax = $totalStax + $stax;
                  $totalExcise = $totalExcise + $excise;
                  $totalCess = $totalCess + $cess;
                  $totalFreight = $totalFreight + $frt;
                  $totalLoading = $totalLoading + $ld;
                  $totalPacking = $totalPacking + $pack;
                  $totalDisc = $totalDisc + $disc;
                  $totalIns = $totalIns + $insu;
                  $totalServ = $totalServ + $serv;
                  $totalValue = $totalValue + $value;
                  $totalHscs = $totalHscs + $hscs;
                  $totalOdisc = $totalOdisc + $odisc;
                  $totalOther = $totalOther + $othr;
                  $totalIgst = $totalIgst + $igst;
                  $totalSgst = $totalSgst + $sgst;
                  $totalCgst = $totalCgst + $cgst;
              }
          }
          }
          echo '<tr class="bg-color">';
          echo '<th>&nbsp;</th>';
          echo '<th>TOTAL QTY</th>';
          echo '<th>TOTAL B.VALUE</th>';
          echo '<th>TOTAL S.TAX</th>';
          echo '<th>TOTAL EXCISE</th>';
          echo '<th>TOTAL CESS</th>';
          echo '<th>TOTAL FREIGHT</th>';
          echo '<th>TOTAL LOADING</th>';
          echo '<th>TOTAL PACKING</th>';
          echo '<th>TOTAL DISC.</th>';
          echo '<th>TOTAL ISNU.</th>';
          echo '<th>TOTAL SERV</th>';
          echo '<th>TOTAL VALUE</th>';
          echo '<th>TOTAL HSCS</th>';
          echo '<th>TOTAL O.DISC</th>';
          echo '<th>TOTAL OTHER</th>';
          echo '<th>TOTAL IGST</th>';
          echo '<th>TOTAL SGST</th>';
          echo '<th>TOTAL CGST</th>';
        echo '</tr>';
          echo '<tr>';
          echo '<td>&nbsp;</td>';
          echo '<td><b>'.number_format($totalQty,3).'</b></td>';
          echo '<td><b>'.number_format($totalBValue,2).'</b></td>';
          echo '<td><b>'.number_format($totalStax,2).'</b></td>';
          echo '<td><b>'.number_format($totalExcise,2).'</b></td>';
          echo '<td><b>'.number_format($totalCess,2).'</b></td>';
          echo '<td><b>'.number_format($totalFreight,2).'</b></td>';
          echo '<td><b>'.number_format($totalLoading,2).'</b></td>';
          echo '<td><b>'.number_format($totalPacking,2).'</b></td>';
          echo '<td><b>'.number_format($totalDisc,2).'</b></td>';
          echo '<td><b>'.number_format($totalIns,2).'</b></td>';
          echo '<td><b>'.number_format($totalServ,2).'</b></td>';
          echo '<td><b>'.number_format($totalValue,2).'</b></td>';
          echo '<td><b>'.number_format($totalHscs,2).'</b></td>';
          echo '<td><b>'.number_format($totalOdisc,2).'</b></td>';
          echo '<td><b>'.number_format($totalOther,2).'</b></td>';
          echo '<td><b>'.number_format($totalIgst,2).'</b></td>';
          echo '<td><b>'.number_format($totalSgst,2).'</b></td>';
          echo '<td><b>'.number_format($totalCgst,2).'</b></td>';
        echo '</tr>';
      }else{
          echo '<tr><th style="color:red;" colspan="18">No records found.</th></tr>';
      }
  echo '</table>';  
}

// drop temp table
$dropTableQuery1 = "drop table tempdb..{$grdlst}";
$dropTableExec1 = odbc_exec($conn, $dropTableQuery1);

?>