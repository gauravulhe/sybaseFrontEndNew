<html>
<head>
    <title>Stores Reports</title>
    <style type="text/css">
        .bg-color{
            background-color: skyblue;
        }
        .seperater{
            background-color: #EDAB1E;
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
//$conn=odbc_connect("SYBLINUX","sa","master") or die("Sybase Error".odbc_error());

$ffcom = $_GET['iss_com'];
$ffunit = $_GET['iss_unit'];
$fffdate = $_GET['fr_iss_dt'];
$fftdate = $_GET['to_iss_dt'];
$fftype = $_GET['iss_tc'];
$fffrom = $_GET['fr_iss_item'];
$ffto = $_GET['to_iss_item'];
$fd1 = $_GET['fr_iss_dept'];
$fd2 = $_GET['to_iss_dept'];
$fc1 = $_GET['fr_iss_cost'];
$fc2 = $_GET['to_iss_cost'];
$fraccd = $_GET['fr_mat_accd'];
$toaccd = $_GET['to_mat_accd'];
$pfile = $_GET['pfile'];
$sfile = $_GET['sfile'];
$tag = $_GET['tag'];

//print_r($_GET);exit;

// get com dbf according to user details
$com_dbf_query = "SELECT com_dbf FROM catalog.dbo.comcat WHERE com_com = $ffcom AND com_unit = $ffunit";
$com_dbf_result = @odbc_exec($conn, $com_dbf_query);
$ffdbn = trim(@odbc_result($com_dbf_result, 1));
    
$UserId = $_SESSION['usr_id'];

$checkProcLock = "select p_lock = proc_lock from {$ffdbn}.invac.proc_lock";
$checkProcLockExec = odbc_exec($conn, $checkProcLock);
//print_r(odbc_result_all($checkProcLockExec, "border=1"));exit;
$ProcLock = odbc_result($checkProcLockExec, 1);

 if ($ProcLock == 'N') {

  // update prock lock with user id
  $updateProcLock = "update {$ffdbn}.invac.proc_lock set proc_lock  = 'Y', proc_usrid = {$UserId}";
  $updateProcLockExec = odbc_exec($conn, $updateProcLock);

  $frdt = date('Ymd', strtotime($fffdate));

  // store procedure storetran processing....
  $storetranProcess = "exec {$ffdbn}.invac.stortran '{$fffrom}','{$ffto}',{$ffunit},{$ffunit},
                      '{$frdt}','{$fftdate}'";
  $storetranProcessExec = odbc_exec($conn, $storetranProcess);

  // delete stdtl
  $deleteStdtl = "delete {$ffdbn}.invac.stdtl where grddt < '{$fffdate}'";
  $deleteStdtlExec = odbc_exec($conn, $deleteStdtl);

  // delete stdtl1
  $deleteStdtl1 = "delete {$ffdbn}.invac.stdtl1 where grddt < '{$fffdate}'";
  $deleteStdtl1Exec = odbc_exec($conn, $deleteStdtl1);

  $scons = 'scons'.$UserId;
  $irate = 'irate'.$UserId;
  $scons2 = 'scons2'.$UserId;
  $scons3 = 'scons3'.$UserId;
  $scons4 = 'scons4'.$UserId;

  // drop table scons
  $dropScons = "if exists (select * from tempdb..sysobjects where name='{$scons}') drop table tempdb..{$scons}";
  $dropSconsExec = odbc_exec($conn, $dropScons);

  // drop table irate
  $dropIrate = "if exists (select * from tempdb..sysobjects where name='{$irate}') drop table tempdb..{$irate}";
  $dropIrateExec = odbc_exec($conn, $dropIrate);

  // drop table scons2
  $dropScons2 = "if exists (select * from tempdb..sysobjects where name='{$scons2}') drop table tempdb..{$scons2}";
  $dropScons2Exec = odbc_exec($conn, $dropScons2);

  // drop table Scons3
  $dropScons3 = "if exists (select * from tempdb..sysobjects where name='{$scons3}') drop table tempdb..{$scons3}";
  $dropScons3Exec = odbc_exec($conn, $dropScons3);

  // drop table scons4
  $dropScons4 = "if exists (select * from tempdb..sysobjects where name='{$scons4}') drop table tempdb..{$scons4}";
  $dropScons4Exec = odbc_exec($conn, $dropScons4);

  // create table scons  
  $createTableScons = "create table tempdb..{$scons}
                      ( iss_com     tinyint        not null,
                        iss_unit    tinyint        not null,
                        iss_fyr     smallint       not null,
                        iss_tc      tinyint        not null,
                        iss_no      float          not null,
                        iss_dt      smalldatetime  not null,
                        iss_srl     tinyint        default 0,
                        iss_item    char(7)        not null,
                        itm_desc    char(35)       not null,
                        itm_uom     tinyint        not null,
                        iss_qty     float          default 0,
                        iss_val     float          default 0,
                        iss_rate    float          default 0, 
                        iss_fcd     tinyint        default 0,
                        iss_dept    smallint       default 0,
                        iss_cost    smallint       default 0,
                        deptname    char(25)       null,
                        costname    char(25)       null,
                        cod_desc    char(10)       not null,
                        mat_accd    char(7)        null,
                        mat_desc    char(50)       null,
                        ptycd       char(4)        null,
                        p_com       tinyint        null,
                        p_unit      tinyint        null,
                        mat_typ     tinyint        null)

                        create index scon_idx on  tempdb..{$scons}
                        (iss_dept, iss_item, iss_dt, iss_no)";
  $createTableSconsExec = odbc_exec($conn, $createTableScons);


  // insert data into scons
  $insertIntoScons = "INSERT INTO tempdb..{$scons} 
                      SELECT iss_com  = iss_com,
                      iss_unit = iss_unit,
                      iss_fyr  = iss_fyr, 
                      iss_tc   = iss_tc,
                      iss_no   = iss_no,
                      iss_dt   = iss_dt,
                      iss_srl  = iss_srl,
                      iss_item = iss_item,
                      itm_desc = ' ',
                      itm_uom  = 0,
                      iss_qty  = iss_qty,
                      iss_val  = iss_qty * iss_rate,
                      iss_rate = 0,
                      iss_fcd  = iss_fcd,
                      iss_dept = iss_dept,
                      iss_cost = iss_cost,
                      deptname = null,
                      costname = null,
                      cod_desc = '           ',
                      mat_accd =null,
                      mat_desc = '            ',
                      ptycd    = iss_ptycd,
                      p_com    = 0,
                      p_unit   = 0,
                      mat_typ  = 0
                      FROM {$ffdbn}.invac.issue a
                      WHERE a.iss_com  = {$ffcom}
                      AND a.iss_unit = {$ffunit}
                      AND a.iss_item BETWEEN '{$fffrom}' AND '{$ffto}'
                      AND a.iss_tc   = {$fftype}
                      AND a.iss_dt   BETWEEN '{$fffdate}' AND '{$fftdate}'
                      AND a.iss_dept BETWEEN {$fd1} AND {$fd2}
                      AND a.iss_cost BETWEEN {$fc1} AND {$fc2}
                      AND a.iss_qty  > 0";
  $insertIntoSconsExec = odbc_exec($conn, $insertIntoScons);


  /*

  // for rate
  $rateQuery = "select distinct grditem,clrate,issvalue into tempdb..{$irate} from {$ffdbn}.invac.stdtl1 where tc = 89";
  $rateQueryExec = odbc_exec($conn, $rateQuery);


  // update scons
  $updateSconsQuery1 = "update tempdb..{$scons} set iss_rate=round(b.clrate,2) from tempdb..{$scons} a,  tempdb..{$irate} b where a.iss_item=b.grditem";
  $updateSconsQuery1Exec = odbc_exec($conn, $updateSconsQuery1);

  */

  //PROCESS .....2
  /* TEMPERORY ADDITION */
  $updateSconsQuery2 = "update tempdb..{$scons} set iss_tc= 100 - iss_tc";
  $updateSconsQuery2Exec = odbc_exec($conn, $updateSconsQuery2);


  //PROCESS .....3
  /******************************** Note : Here iss_val is replace with issvalue */
  $updateSconsQuery3 = "update tempdb..{$scons} set iss_rate   = iss_val / issqty 
                        from {$ffdbn}.invac.stdtl1 
                        where iss_item = grditem
                        and   iss_tc   = tc
                        and   iss_dt   = grddt
                        and   iss_no   = grdno
                        and   iss_srl  = srl
                        and   clrate != 0
                        and   issqty > 0";
  $updateSconsQuery3Exec = odbc_exec($conn, $updateSconsQuery3);


  //PROCESS .....4
  /* TEMPERORY ADDITION */
  // $updateSconsQuery4 = "update tempdb..{$scons} set iss_rate=b.mat_oprate
  //                       from tempdb..{$scons} a, {$ffdbn}.invac.matmast b
  //                       where a.iss_tc in (11)
  //                       and   a.iss_rate=0
  //                       and   a.iss_unit=b.mat_unit
  //                       and   a.iss_item=b.mat_item";
  // $updateSconsQuery4Exec = odbc_exec($conn, $updateSconsQuery4);


  //PROCESS .....5
  $updateSconsQuery5 = "update tempdb..{$scons}
                        set iss_val=(iss_qty*iss_rate)
                        from tempdb..{$scons}";
  $updateSconsQuery5Exec = odbc_exec($conn, $updateSconsQuery5);

  //PROCESS .....6
  $updateSconsQuery6 = "update tempdb..{$scons}
                        set deptname = b.dep_desc
                        from catalog.dbo.deptcat b
                        where iss_dept=b.dep_cd
                        and   b.dep_prefix=1";
  $updateSconsQuery6Exec = odbc_exec($conn, $updateSconsQuery6);

  //PROCESS .....7
  $updateSconsQuery7 = "update tempdb..{$scons}
                        set costname = b.dep_desc 
                        from catalog.dbo.deptcat b
                        where b.dep_cd=iss_cost
                        and   b.dep_prefix=2";
  $updateSconsQuery7Exec = odbc_exec($conn, $updateSconsQuery7);

  //PROCESS .....8
  $updateSconsQuery8 = "update tempdb..{$scons}
                        set itm_desc = b.itm_desc, itm_uom=b.itm_uom 
                        from catalog.dbo.itmcat b
                        where itm_item=iss_item";
  $updateSconsQuery8Exec = odbc_exec($conn, $updateSconsQuery8);

  //PROCESS .....9
  $updateSconsQuery9 = "update tempdb..{$scons}
                        set mat_accd = '0000000',
                        --set mat_accd = b.mat_accd,
                        mat_typ  = b.mat_typ
                        from {$ffdbn}.invac.matmast b
                        where b.mat_item = iss_item
                        and   b.mat_unit = iss_unit
                        --and   b.mat_accd not in ('350201','350202','102171')";
  $updateSconsQuery9Exec = odbc_exec($conn, $updateSconsQuery9);

  //PROCESS .....10
  $updateSconsQuery10 = "update tempdb..{$scons}
                          set mat_accd = acp_exp_cd
                          from catalog.invac.acpdep
                          where acp_dept = iss_dept
                          and   iss_tc  != 13
                          --and   mat_accd not in ('350201','350202','102171')";
  $updateSconsQuery10Exec = odbc_exec($conn, $updateSconsQuery10);
  
  $updateSconsQuery10 = "update tempdb..{$scons}
                          set mat_accd = '311471'
                          where iss_tc = 13";
  $updateSconsQuery10Exec = odbc_exec($conn, $updateSconsQuery10);

  $updateSconsQuery10 = "update tempdb..{$scons}
                          set mat_accd = '311002'
                          where mat_accd = '0000000'";
  $updateSconsQuery10Exec = odbc_exec($conn, $updateSconsQuery10);

  $updateSconsQuery10 = "update tempdb..{$scons}
                          set cod_desc = b.cod_desc
                          from catalog.dbo.codecat b
                          where itm_uom=b.cod_code
                          and   b.cod_prefix=6";
  $updateSconsQuery10Exec = odbc_exec($conn, $updateSconsQuery10);


  //PROCESS .....11
  $updateSconsQuery11 = "update tempdb..{$scons}
                          set mat_desc = b.gen_desc
                          from tempdb..{$scons} a, catalog.dbo.gencat b
                          where a.mat_accd=b.gen_accd";
  $updateSconsQuery11Exec = odbc_exec($conn, $updateSconsQuery11);

  //PROCESS .....12
  $updateSconsQuery12 = "update tempdb..{$scons}
                        set p_com  = convert(numeric(2,0),substring(ptycd,1,2)),
                        p_unit = convert(numeric(2,0),substring(ptycd,3,2))
                        where ptycd is not null
                        and   ptycd not like '[A-Z]%'";
  $updateSconsQuery12Exec = odbc_exec($conn, $updateSconsQuery12);

  //PROCESS .....12
  $updateSconsQuery13 = "delete tempdb..{$scons} where mat_accd not between '{$fraccd}' and '{$toaccd}'";
  $updateSconsQuery13Exec = odbc_exec($conn, $updateSconsQuery13);



  $updateSconsQuery13 = "select * into tempdb..{$scons4} from tempdb..{$scons}";
  $updateSconsQuery13Exec = odbc_exec($conn, $updateSconsQuery13);

  $updateSconsQuery13 = "alter table tempdb..{$scons4} add exp_accd char(6) null 
                          alter table tempdb..{$scons4} add ast_accd char(6) null";
  $updateSconsQuery13Exec = odbc_exec($conn, $updateSconsQuery13);

  $updateSconsQuery13 = "update tempdb..{$scons4}
                          set exp_accd = acp_exp_cd
                          from catalog.invac.acpdep
                          where acp_dept = iss_dept
                          and   iss_tc  != 13";
  $updateSconsQuery13Exec = odbc_exec($conn, $updateSconsQuery13);

  $updateSconsQuery13 = "update tempdb..{$scons4}
                          set exp_accd = '311471'
                          where iss_tc = 13";
  $updateSconsQuery13Exec = odbc_exec($conn, $updateSconsQuery13);

  $updateSconsQuery13 = "update tempdb..{$scons4}
                          set ast_accd = acp_ast_cd
                          from catalog.invac.acpcon, {$ffdbn}.invac.matmast a
                          where mat_unit = {$ffunit}
                          and   a.mat_accd = acp_exp_cd
                          and   mat_item   = iss_item";
  $updateSconsQuery13Exec = odbc_exec($conn, $updateSconsQuery13);

  $updateSconsQuery13 = "update tempdb..{$scons4}
                          set exp_accd = '311002'
                          where exp_accd is null";
  $updateSconsQuery13Exec = odbc_exec($conn, $updateSconsQuery13);

  $updateSconsQuery13 = "update tempdb..{$scons4}
                          set ast_accd = '281157'
                          where ast_accd is null";
  $updateSconsQuery13Exec = odbc_exec($conn, $updateSconsQuery13);
 

  // $sql = "SELECT * FROM tempdb..{$scons}";
  // $result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
  // print_r(odbc_result_all($result, "border=1"));exit;

  ////////////////////////////////////  Dept / AC Wise print file /////////////////////////////////////////

  if ($pfile == 'pdaw') {

    //create ODBC connection   
    $sql = "SELECT DISTINCT iss.iss_no,iss.iss_dept,iss.deptname,iss.iss_item,iss.itm_desc, 
            com.com_name, com.com_uname
        		FROM tempdb..{$scons} AS iss
        		INNER JOIN catalog..comcat AS com
        		ON
        		iss.iss_com = com.com_com AND
        		iss.iss_unit = com.com_unit
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
    $filename = 'Dept_AC_Print_File_'.strtotime(date('Y-m-d h:m:s'));         //File Name
    header("Content-Disposition: attachment; filename=$filename.$file_ending");


  	/*******Start of Formatting for Excel*******/   

  	echo '<table border="1">';
  		echo '<tr class="bg-color">';
  			echo '<th colspan="4">NECO GROUP OF INDUSTRIES</th>';
  			echo '<th class="float-left" colspan="5">Date : '.date('d.m.Y').'</th>';
  		echo '</tr>';
  		echo '<tr>';
  			echo '<th class="float-right" colspan="4">Company Name : </th>';
  			echo '<th class="float-left" colspan="5">'.$rows[0]['com_name'].'</th>';
  		echo '</tr>';
  		echo '<tr>';
  			echo '<th class="float-right" colspan="4">Unit Name : </th>';
  			echo '<th class="float-left" colspan="5">'.$rows[0]['com_uname'].'</th>';
  		echo '</tr>';
  		echo '<tr>';
  			echo '<th class="float-right" colspan="4">Consumption Report : </th>';
  			echo '<th class="float-left" colspan="5">From '.date('d.m.Y', strtotime($fffdate)).' To '.date('d.m.Y', strtotime($fftdate)).'</th>';
  		echo '</tr>';
  		echo '<tr>';
  			echo '<th class="float-right" colspan="4">Item Number : </th>';
  			echo '<th class="float-left" colspan="5">From '.$fffrom.' To '.$ffto.'</th>';
  		echo '</tr>';
  		echo '<tr>';
  			echo '<th class="float-right" colspan="4">Department : </th>';
  			echo '<th class="float-left" colspan="5">From '.$fd1.' To '.$fd2.'</th>';
  		echo '</tr>';
  	echo '</table>';
  	 
  	echo '<table border="1">';	
  		echo '<tr>';
  			echo '<th class="float-right" colspan="4">File Name :</th>';
  			echo '<th class="float-left" colspan="5">Print File - Department Wise / Item Wise</th>';
  		echo '</tr>';
  		echo '<tr class="bg-color">';
  			echo '<th>Dept Code</th>';
  			echo '<th class="float-left" colspan="8">Dept Name</th>';
  		echo '</tr>';
      echo '<tr class="bg-color">';
        echo '<th>Item Code</th>';
        echo '<th class="float-left" colspan="8">Item Name</th>';
      echo '</tr>';

  		echo '<tr class="bg-color">';
  			echo '<th>&nbsp;</th>';
  			echo '<th>UOM</th>';
  			echo '<th>DCONO</th>';
  			echo '<th>DOC. DATE</th>';
  			echo '<th colspan="2">RATE</th>';
  			echo '<th>QUANTITY</th>';
  			echo '<th colspan="2">VALUE</th>';
  		echo '</tr>';
  	echo '</table>';

  	echo '<table border="1">';

  	//end of printing column names  
  	//start while loop to get data
  		
  	    
  	    if (!empty($rows)) {
  	        foreach ($rows as $row) {
  	            echo '<tr>';
  	                echo '<td class="float-center"><b>'.$row['iss_dept'].'</b></td>';
  	                echo '<td class="float-left" colspan="8"><b>'.$row['deptname'].'</b></td>';
  	            echo '</tr>';
                echo '<tr>';
                    echo '<td class="float-center"><b>'.$row['iss_item'].'</b></td>';
                    echo '<td class="float-left" colspan="8"><b>'.$row['itm_desc'].'</b></td>';
                echo '</tr>';

  	            $iss_no = $row['iss_no'];

  	            $sql2 = "SELECT iss.*, cod.cod_desc
                  FROM tempdb..{$scons} AS iss
                  INNER JOIN catalog..codecat AS cod
                  ON
                  iss.itm_uom = cod.cod_code AND
                  cod.cod_prefix = 6
  				        WHERE iss_no = $iss_no";

  				$result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

  				$rows2 = array();
  			    while ($myRow2 = odbc_fetch_array($result2)) {
  			        $rows2[] = $myRow2;
  			    }
  			    if (!empty($rows2)) {

      						$totalRate = 0;
                  $totalQty = 0;
                  $totalValue = 0;
  			        foreach ($rows2 as $row2) {
  			        	echo '<tr>';
  							       echo '<td>&nbsp;</td>';
  			               echo '<td class="float-center">'.$row2['cod_desc'].'</td>';
  			               echo '<td class="float-center">'.$row2['iss_no'].'</td>';
                       echo '<td class="float-center">'.date('d.m.Y', strtotime($row2['iss_dt'])).'</td>';
                       $rate = $row2['iss_rate'];
  			               echo '<td colspan="2" class="float-right">'.$rate.'</td>';
                       $qty = $row2['iss_qty'];
  			               echo '<td class="float-right">'.$qty.'</td>';
                       $value = $row2['iss_val'];
  			               echo '<td colspan="2" class="float-right">'.$value.'</td>';
  			            echo '</tr>';
  			            $totalRate = round(($totalRate + $rate), 2);
                    $totalQty = $totalQty + $qty;
                    $totalValue = round(($totalValue + $value), 2);
  			        }
  			    }

            // item total
  			    echo '<tr class="bg-color">';
    					echo '<th colspan="4"></th>';
    					echo '<th colspan="2">TOTAL RATE</th>';
              echo '<th>TOTAL QTY</th>';
              echo '<th colspan="2">TOTAL VALUE</th>';
    				echo '</tr>';
  			    echo '<tr>';
              echo '<td></td>';
              echo '<td colspan="3" class="float-right"><b>Item Total</b></td>';
    					echo '<td colspan="2"><b>'.number_format($totalRate,2).'</b></td>';
              echo '<td><b>'.number_format($totalQty,3).'</b></td>';
              echo '<td colspan="2"><b>'.number_format($totalValue,2).'</b></td>';
    				echo '</tr>';

            // departmental total
            echo '<tr>';
              echo '<td></td>';
              echo '<td colspan="3" class="float-right"><b>Department Total</b></td>';
              echo '<td colspan="2"><b>'.number_format($totalRate,2).'</b></td>';
              echo '<td><b>'.number_format($totalQty,3).'</b></td>';
              echo '<td colspan="2"><b>'.number_format($totalValue,2).'</b></td>';
            echo '</tr>';
            echo '<tr><td colspan="9">&nbsp;</td></tr>';
  	        }
  	    }else{
  	        echo '<tr><th style="color:red;" colspan="9">No records found.</th></tr>';
  	    }
        echo '<tr><th class="seperater" colspan="9"></th></tr>';
        echo '<tr><th colspan="9"></th></tr>';
  	echo '</table>';	
  }

  ///////////////////////////////////////  Dept / AC Wise Sammary file ///////////////////////////////////

  if ($sfile == 'sdaw') {

    //create ODBC connection   
    $sql = "SELECT DISTINCT iss.iss_no,iss.iss_dept,iss.deptname,iss.iss_item,iss.itm_desc, 
            com.com_name, com.com_uname
            FROM tempdb..{$scons} AS iss
            INNER JOIN catalog..comcat AS com
            ON
            iss.iss_com = com.com_com AND
            iss.iss_unit = com.com_unit
            ";
    $result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
    //print_r(odbc_result_all($result, "border=1"));exit;
    $rows = array();
    while ($myRow = odbc_fetch_array($result)) {
        $rows[] = $myRow;
    }

    $file_ending = "xls";

    /*******Start of Formatting for Excel*******/   

    echo '<table border="1">';
      echo '<tr class="bg-color">';
        echo '<th colspan="4">NECO GROUP OF INDUSTRIES</th>';
        echo '<th class="float-left" colspan="5">Date : '.date('d.m.Y').'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Company Name : </th>';
        echo '<th class="float-left" colspan="5">'.$rows[0]['com_name'].'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Unit Name : </th>';
        echo '<th class="float-left" colspan="5">'.$rows[0]['com_uname'].'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Consumption Report : </th>';
        echo '<th class="float-left" colspan="5">From '.date('d.m.Y', strtotime($fffdate)).' To '.date('d.m.Y', strtotime($fftdate)).'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Item Number : </th>';
        echo '<th class="float-left" colspan="5">From '.$fffrom.' To '.$ffto.'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Department : </th>';
        echo '<th class="float-left" colspan="5">From '.$fd1.' To '.$fd2.'</th>';
      echo '</tr>';
    echo '</table>';
     
    echo '<table border="1">';  
      echo '<tr>';
        echo '<th class="float-right" colspan="4">File Name :</th>';
        echo '<th class="float-left" colspan="5">Sammary File - Department Wise / Item Wise</th>';
      echo '</tr>';
      echo '<tr class="bg-color">';
        echo '<th>Dept Code</th>';
        echo '<th class="float-left" colspan="8">Dept Name</th>';
      echo '</tr>';
      echo '<tr class="bg-color">';
        echo '<th>Item Code</th>';
        echo '<th class="float-left" colspan="8">Item Name</th>';
      echo '</tr>';

      echo '<tr class="bg-color">';
        echo '<th>&nbsp;</th>';
        echo '<th colspan="3">UOM</th>';
        echo '<th colspan="2">RATE</th>';
        echo '<th>QUANTITY</th>';
        echo '<th colspan="2">VALUE</th>';
      echo '</tr>';
    echo '</table>';

    echo '<table border="1">';

    //end of printing column names  
    //start while loop to get data
      
        
        if (!empty($rows)) {
            $grandTotal = 0;
            foreach ($rows as $row) {
                echo '<tr>';
                    echo '<td class="float-center"><b>'.$row['iss_dept'].'</b></td>';
                    echo '<td class="float-left" colspan="8"><b>'.$row['deptname'].'</b></td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td class="float-center"><b>'.$row['iss_item'].'</b></td>';
                    echo '<td class="float-left" colspan="8"><b>'.$row['itm_desc'].'</b></td>';
                echo '</tr>';

                $iss_no = $row['iss_no'];

                $sql2 = "SELECT iss.*, cod.cod_desc
                  FROM tempdb..{$scons} AS iss
                  INNER JOIN catalog..codecat AS cod
                  ON
                  iss.itm_uom = cod.cod_code AND
                  cod.cod_prefix = 6
                  WHERE iss_no = $iss_no";

          $result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

          $rows2 = array();
            while ($myRow2 = odbc_fetch_array($result2)) {
                $rows2[] = $myRow2;
            }
            if (!empty($rows2)) {

                  $totalRate = 0;
                  $totalQty = 0;
                  $totalValue = 0;
                foreach ($rows2 as $row2) {
                    $uom = $row2['cod_desc'];
                    $rate = $row2['iss_rate'];
                    $qty = $row2['iss_qty'];
                    $value = $row2['iss_val'];
                    // echo '<tr>';
                    //    echo '<td>&nbsp;</td>';
                    //    echo '<td class="float-center">'.$row2['cod_desc'].'</td>';
                    //    echo '<td class="float-center">'.$row2['iss_no'].'</td>';
                    //    echo '<td class="float-center">'.date('d.m.Y', strtotime($row2['iss_dt'])).'</td>';
                    //    echo '<td colspan="2" class="float-right">'.$rate.'</td>';
                    //    echo '<td class="float-right">'.$qty.'</td>';
                    //    echo '<td colspan="2" class="float-right">'.$value.'</td>';
                    // echo '</tr>';
                    $totalRate = round(($totalRate + $rate), 2);
                    $totalQty = $totalQty + $qty;
                    $totalValue = round(($totalValue + $value), 2);
                    $grandTotal = $grandTotal + $value;
                }
            }

              // item total
              echo '<tr class="bg-color">';
                echo '<th></th>';
                echo '<th colspan="3">'.$uom.'</th>';
                echo '<th colspan="2">TOTAL RATE</th>';
                echo '<th>TOTAL QTY</th>';
                echo '<th colspan="2">TOTAL VALUE</th>';
              echo '</tr>';
              echo '<tr>';
                echo '<td></td>';
                echo '<td colspan="3" class="float-right"><b>Item Total</b></td>';
                echo '<td colspan="2"><b>'.number_format($totalRate,2).'</b></td>';
                echo '<td><b>'.number_format($totalQty,3).'</b></td>';
                echo '<td colspan="2"><b>'.number_format($totalValue,2).'</b></td>';
              echo '</tr>';

              // departmental total
              echo '<tr>';
                echo '<td></td>';
                echo '<td colspan="3" class="float-right"><b>Department Total</b></td>';
                echo '<td colspan="2"><b>'.number_format($totalRate,2).'</b></td>';
                echo '<td><b>'.number_format($totalQty,3).'</b></td>';
                echo '<td colspan="2"><b>'.number_format($totalValue,2).'</b></td>';
              echo '</tr>';
              echo '<tr><td colspan="9">&nbsp;</td></tr>';
            }

              // grand total
              echo '<tr>';
                echo '<td></td>';
                echo '<td colspan="3" class="float-right"><b>Grand Total</b></td>';
                echo '<td colspan="2"><b>'.number_format($grandTotal,2).'</b></td>';
                echo '<td></td>';
                echo '<td colspan="2"></td>';
              echo '</tr>';
              echo '<tr><td colspan="9">&nbsp;</td></tr>';

        }else{
            echo '<tr><th style="color:red;" colspan="9">No records found.</th></tr>';
        }
    echo '</table>';  
  }


////////////////////////////////////  Item Wise print file /////////////////////////////////////////

  if ($pfile == 'piw') {

    //create ODBC connection   
    $sql = "SELECT DISTINCT iss.iss_item,iss.itm_desc,iss.iss_dept,iss.deptname, 
            com.com_name, com.com_uname
            FROM tempdb..{$scons} AS iss
            INNER JOIN catalog..comcat AS com
            ON
            iss.iss_com = com.com_com AND
            iss.iss_unit = com.com_unit
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
    $filename = 'Item_Wise_Print_File_'.strtotime(date('Y-m-d h:m:s'));         //File Name
    header("Content-Disposition: attachment; filename=$filename.$file_ending");


    /*******Start of Formatting for Excel*******/   

    echo '<table border="1">';
      echo '<tr class="bg-color">';
        echo '<th colspan="4">NECO GROUP OF INDUSTRIES</th>';
        echo '<th class="float-left" colspan="5">Date : '.date('d.m.Y').'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Company Name : </th>';
        echo '<th class="float-left" colspan="5">'.$rows[0]['com_name'].'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Unit Name : </th>';
        echo '<th class="float-left" colspan="5">'.$rows[0]['com_uname'].'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Consumption Report : </th>';
        echo '<th class="float-left" colspan="5">From '.date('d.m.Y', strtotime($fffdate)).' To '.date('d.m.Y', strtotime($fftdate)).'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Item Number : </th>';
        echo '<th class="float-left" colspan="5">From '.$fffrom.' To '.$ffto.'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Department : </th>';
        echo '<th class="float-left" colspan="5">From '.$fd1.' To '.$fd2.'</th>';
      echo '</tr>';
    echo '</table>';
     
    echo '<table border="1">';  
      echo '<tr>';
        echo '<th class="float-right" colspan="4">File Name :</th>';
        echo '<th class="float-left" colspan="5">Print File - ITEM WISE CONSUMPTION</th>';
      echo '</tr>';
      echo '<tr class="bg-color">';
        echo '<th>Dept Code</th>';
        echo '<th class="float-left" colspan="8">Dept Name</th>';
      echo '</tr>';
      echo '<tr class="bg-color">';
        echo '<th>Item Code</th>';
        echo '<th class="float-left" colspan="8">Item Name</th>';
      echo '</tr>';

      echo '<tr class="bg-color">';
        echo '<th>&nbsp;</th>';
        echo '<th>UOM</th>';
        echo '<th>DCONO</th>';
        echo '<th>DOC. DATE</th>';
        echo '<th colspan="2">RATE</th>';
        echo '<th>QUANTITY</th>';
        echo '<th colspan="2">VALUE</th>';
      echo '</tr>';
    echo '</table>';

    echo '<table border="1">';

    //end of printing column names  
    //start while loop to get data
      
        
        if (!empty($rows)) {
            foreach ($rows as $row) {
                echo '<tr>';
                    echo '<td class="float-center"><b>'.$row['iss_dept'].'</b></td>';
                    echo '<td class="float-left" colspan="8"><b>'.$row['deptname'].'</b></td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td class="float-center"><b>'.$row['iss_item'].'</b></td>';
                    echo '<td class="float-left" colspan="8"><b>'.$row['itm_desc'].'</b></td>';
                echo '</tr>';

                $iss_dept = $row['iss_dept'];

                $sql2 = "SELECT iss.*, cod.cod_desc
                  FROM tempdb..{$scons} AS iss
                  INNER JOIN catalog..codecat AS cod
                  ON
                  iss.itm_uom = cod.cod_code AND
                  cod.cod_prefix = 6
                  WHERE iss_dept = $iss_dept";

          $result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

          $rows2 = array();
            while ($myRow2 = odbc_fetch_array($result2)) {
                $rows2[] = $myRow2;
            }
            if (!empty($rows2)) {

                  $totalRate = 0;
                  $totalQty = 0;
                  $totalValue = 0;
                foreach ($rows2 as $row2) {
                    echo '<tr>';
                       echo '<td>&nbsp;</td>';
                       echo '<td class="float-center">'.$row2['cod_desc'].'</td>';
                       echo '<td class="float-center">'.$row2['iss_no'].'</td>';
                       echo '<td class="float-center">'.date('d.m.Y', strtotime($row2['iss_dt'])).'</td>';
                       $rate = $row2['iss_rate'];
                       echo '<td colspan="2" class="float-right">'.$rate.'</td>';
                       $qty = $row2['iss_qty'];
                       echo '<td class="float-right">'.$qty.'</td>';
                       $value = $row2['iss_val'];
                       echo '<td colspan="2" class="float-right">'.$value.'</td>';
                    echo '</tr>';
                    $totalRate = round(($totalRate + $rate), 2);
                    $totalQty = $totalQty + $qty;
                    $totalValue = round(($totalValue + $value), 2);
                }
            }

            // item total
            echo '<tr class="bg-color">';
              echo '<th colspan="4"></th>';
              echo '<th colspan="2">TOTAL RATE</th>';
              echo '<th>TOTAL QTY</th>';
              echo '<th colspan="2">TOTAL VALUE</th>';
            echo '</tr>';
            echo '<tr>';
              echo '<td></td>';
              echo '<td colspan="3" class="float-right"><b>Item Total</b></td>';
              echo '<td colspan="2"><b>'.number_format($totalRate,2).'</b></td>';
              echo '<td><b>'.number_format($totalQty,3).'</b></td>';
              echo '<td colspan="2"><b>'.number_format($totalValue,2).'</b></td>';
            echo '</tr>';
            }
        }else{
            echo '<tr><th style="color:red;" colspan="9">No records found.</th></tr>';
        }
        echo '<tr><th class="seperater" colspan="9"></th></tr>';
        echo '<tr><th colspan="9"></th></tr>';
    echo '</table>';  
  }

  ///////////////////////////////////////  Item Wise Sammary file ///////////////////////////////////

  if ($sfile == 'siw') {

    //create ODBC connection   
    $sql = "SELECT DISTINCT iss.iss_item,iss.itm_desc,
            com.com_name, com.com_uname
            FROM tempdb..{$scons} AS iss
            INNER JOIN catalog..comcat AS com
            ON
            iss.iss_com = com.com_com AND
            iss.iss_unit = com.com_unit
            ";
    $result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
    //print_r(odbc_result_all($result, "border=1"));exit;
    $rows = array();
    while ($myRow = odbc_fetch_array($result)) {
        $rows[] = $myRow;
    }

    $file_ending = "xls";

    /*******Start of Formatting for Excel*******/   

    echo '<table border="1">';
      echo '<tr class="bg-color">';
        echo '<th colspan="4">NECO GROUP OF INDUSTRIES</th>';
        echo '<th class="float-left" colspan="5">Date : '.date('d.m.Y').'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Company Name : </th>';
        echo '<th class="float-left" colspan="5">'.$rows[0]['com_name'].'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Unit Name : </th>';
        echo '<th class="float-left" colspan="5">'.$rows[0]['com_uname'].'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Consumption Report : </th>';
        echo '<th class="float-left" colspan="5">From '.date('d.m.Y', strtotime($fffdate)).' To '.date('d.m.Y', strtotime($fftdate)).'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Item Number : </th>';
        echo '<th class="float-left" colspan="5">From '.$fffrom.' To '.$ffto.'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Department : </th>';
        echo '<th class="float-left" colspan="5">From '.$fd1.' To '.$fd2.'</th>';
      echo '</tr>';
    echo '</table>';
     
    echo '<table border="1">';  
      echo '<tr>';
        echo '<th class="float-right" colspan="4">File Name :</th>';
        echo '<th class="float-left" colspan="5">Sammary File - ITEM WISE CONSUMPTION</th>';
      echo '</tr>';
      echo '<tr class="bg-color">';
        echo '<th>Item Code</th>';
        echo '<th class="float-left" colspan="8">Item Name</th>';
      echo '</tr>';

      echo '<tr class="bg-color">';
        echo '<th>&nbsp;</th>';
        echo '<th colspan="3">UOM</th>';
        echo '<th colspan="2">RATE</th>';
        echo '<th>QUANTITY</th>';
        echo '<th colspan="2">VALUE</th>';
      echo '</tr>';
    echo '</table>';

    echo '<table border="1">';

    //end of printing column names  
    //start while loop to get data
      
        
        if (!empty($rows)) {
            foreach ($rows as $row) {
                echo '<tr>';
                    echo '<td class="float-center"><b>'.$row['iss_item'].'</b></td>';
                    echo '<td class="float-left" colspan="8"><b>'.$row['itm_desc'].'</b></td>';
                echo '</tr>';

                $iss_item = $row['iss_item'];

                $sql2 = "SELECT iss.*, cod.cod_desc
                  FROM tempdb..{$scons} AS iss
                  INNER JOIN catalog..codecat AS cod
                  ON
                  iss.itm_uom = cod.cod_code AND
                  cod.cod_prefix = 6
                  WHERE iss_item = '$iss_item'";

          $result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

          $rows2 = array();
            while ($myRow2 = odbc_fetch_array($result2)) {
                $rows2[] = $myRow2;
            }
            if (!empty($rows2)) {
                  $totalRate = 0;
                  $totalQty = 0;
                  $totalValue = 0;
                foreach ($rows2 as $row2) {
                    $uom = $row2['cod_desc'];
                    $rate = $row2['iss_rate'];
                    $qty = $row2['iss_qty'];
                    $value = $row2['iss_val'];
                    // echo '<tr>';
                    //    echo '<td>&nbsp;</td>';
                    //    echo '<td class="float-center">'.$row2['cod_desc'].'</td>';
                    //    echo '<td class="float-center">'.$row2['iss_no'].'</td>';
                    //    echo '<td class="float-center">'.date('d.m.Y', strtotime($row2['iss_dt'])).'</td>';
                    //    echo '<td colspan="2" class="float-right">'.$rate.'</td>';
                    //    echo '<td class="float-right">'.$qty.'</td>';
                    //    echo '<td colspan="2" class="float-right">'.$value.'</td>';
                    // echo '</tr>';
                    $totalRate = round(($totalRate + $rate), 2);
                    $totalQty = $totalQty + $qty;
                    $totalValue = round(($totalValue + $value), 2);
                }
                    echo '<tr>';
                       echo '<td>&nbsp;</td>';
                       echo '<td colspan="3" class="float-center">'.$uom.'</td>';
                       echo '<td colspan="2" class="float-right">'.$rate.'</td>';
                       echo '<td class="float-right">'.$totalQty.'</td>';
                       echo '<td colspan="2" class="float-right">'.$totalValue.'</td>';
                    echo '</tr>';
            }

              // item total
              echo '<tr class="bg-color">';
                echo '<th></th>';
                echo '<th colspan="3"></th>';
                echo '<th colspan="2"></th>';
                echo '<th></th>';
                echo '<th colspan="2">TOTAL VALUE</th>';
              echo '</tr>';
              echo '<tr>';
                echo '<td colspan="4"></td>';
                echo '<td colspan="2"></td>';
                echo '<td></td>';
                echo '<td colspan="2"><b>'.number_format($totalValue,2).'</b></td>';
              echo '</tr>';
            }

        }else{
            echo '<tr><th style="color:red;" colspan="9">No records found.</th></tr>';
        }
    echo '</table>';  
  }

  ////////////////////////////////////  Cost Center Wise print file //////////////////////////////////////

  if ($pfile == 'pcc') {

    //create ODBC connection   
    $sql = "SELECT DISTINCT iss.iss_item,iss.itm_desc,iss.iss_cost,iss.costname, 
            com.com_name, com.com_uname
            FROM tempdb..{$scons} AS iss
            INNER JOIN catalog..comcat AS com
            ON
            iss.iss_com = com.com_com AND
            iss.iss_unit = com.com_unit
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
    $filename = 'Item_Wise_Print_File_'.strtotime(date('Y-m-d h:m:s'));         //File Name
    header("Content-Disposition: attachment; filename=$filename.$file_ending");


    /*******Start of Formatting for Excel*******/   

    echo '<table border="1">';
      echo '<tr class="bg-color">';
        echo '<th colspan="4">NECO GROUP OF INDUSTRIES</th>';
        echo '<th class="float-left" colspan="5">Date : '.date('d.m.Y').'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Company Name : </th>';
        echo '<th class="float-left" colspan="5">'.$rows[0]['com_name'].'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Unit Name : </th>';
        echo '<th class="float-left" colspan="5">'.$rows[0]['com_uname'].'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Consumption Report : </th>';
        echo '<th class="float-left" colspan="5">From '.date('d.m.Y', strtotime($fffdate)).' To '.date('d.m.Y', strtotime($fftdate)).'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Item Number : </th>';
        echo '<th class="float-left" colspan="5">From '.$fffrom.' To '.$ffto.'</th>';
      echo '</tr>';
      echo '<tr>';
        echo '<th class="float-right" colspan="4">Department : </th>';
        echo '<th class="float-left" colspan="5">From '.$fd1.' To '.$fd2.'</th>';
      echo '</tr>';
    echo '</table>';
     
    echo '<table border="1">';  
      echo '<tr>';
        echo '<th class="float-right" colspan="4">File Name :</th>';
        echo '<th class="float-left" colspan="5">Print File - Cost Center Wise Consumptions</th>';
      echo '</tr>';
      echo '<tr class="bg-color">';
        echo '<th>Cost Center Code</th>';
        echo '<th class="float-left" colspan="8">Cost Center Name</th>';
      echo '</tr>';
      echo '<tr class="bg-color">';
        echo '<th>Item Code</th>';
        echo '<th class="float-left" colspan="8">Item Name</th>';
      echo '</tr>';

      echo '<tr class="bg-color">';
        echo '<th>&nbsp;</th>';
        echo '<th>UOM</th>';
        echo '<th>DCONO</th>';
        echo '<th>DOC. DATE</th>';
        echo '<th colspan="2">RATE</th>';
        echo '<th>QUANTITY</th>';
        echo '<th colspan="2">VALUE</th>';
      echo '</tr>';
    echo '</table>';

    echo '<table border="1">';

    //end of printing column names  
    //start while loop to get data
      
        
        if (!empty($rows)) {                 
            $grandTotal = 0;
            $groupTotal = 0;
            foreach ($rows as $row) {
                echo '<tr>';
                    echo '<td class="float-center"><b>'.$row['iss_cost'].'</b></td>';
                    echo '<td class="float-left" colspan="8"><b>'.$row['costname'].'</b></td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td class="float-center"><b>'.$row['iss_item'].'</b></td>';
                    echo '<td class="float-left" colspan="8"><b>'.$row['itm_desc'].'</b></td>';
                echo '</tr>';

                $iss_cost = $row['iss_cost'];

                $sql2 = "SELECT iss.*, cod.cod_desc
                  FROM tempdb..{$scons} AS iss
                  INNER JOIN catalog..codecat AS cod
                  ON
                  iss.itm_uom = cod.cod_code AND
                  cod.cod_prefix = 6
                  WHERE iss_cost = $iss_cost";

          $result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

          $rows2 = array();
            while ($myRow2 = odbc_fetch_array($result2)) {
                $rows2[] = $myRow2;
            }
            if (!empty($rows2)) { 
                  $totalRate = 0;
                  $totalQty = 0;
                  $totalValue = 0;
                foreach ($rows2 as $row2) {
                    echo '<tr>';
                       echo '<td>&nbsp;</td>';
                       echo '<td class="float-center">'.$row2['cod_desc'].'</td>';
                       echo '<td class="float-center">'.$row2['iss_no'].'</td>';
                       echo '<td class="float-center">'.date('d.m.Y', strtotime($row2['iss_dt'])).'</td>';
                       $rate = $row2['iss_rate'];
                       echo '<td colspan="2" class="float-right">'.$rate.'</td>';
                       $qty = $row2['iss_qty'];
                       echo '<td class="float-right">'.$qty.'</td>';
                       $value = $row2['iss_val'];
                       echo '<td colspan="2" class="float-right">'.$value.'</td>';
                    echo '</tr>';
                    $totalRate = round(($totalRate + $rate), 2);
                    $totalQty = $totalQty + $qty;
                    $totalValue = round(($totalValue + $value), 2);
                    $groupTotal = $groupTotal + $totalValue;
                }
            }

            // total
            echo '<tr class="bg-color">';
              echo '<th colspan="4"></th>';
              echo '<th colspan="2">TOTAL RATE</th>';
              echo '<th>TOTAL QTY</th>';
              echo '<th colspan="2">TOTAL VALUE</th>';
            echo '</tr>';
            echo '<tr>';
              echo '<td></td>';
              echo '<td colspan="3" class="float-right"><b>Total</b></td>';
              echo '<td colspan="2"><b>'.number_format($totalRate,2).'</b></td>';
              echo '<td><b>'.number_format($totalQty,3).'</b></td>';
              echo '<td colspan="2"><b>'.number_format($totalValue,2).'</b></td>';
            echo '</tr>';
            echo '<tr>';
              echo '<td colspan="7" class="float-right"><b>Group Total</b></td>';
              echo '<td colspan="2"><b>'.number_format($groupTotal,2).'</b></td>';
            echo '</tr>';
            }
                $grandTotal = $grandTotal + $groupTotal;

            echo '<tr>';
              echo '<td colspan="7" class="float-right"><b>Grand Total</b></td>';
              echo '<td colspan="2"><b>'.number_format($grandTotal,2).'</b></td>';
            echo '</tr>';
        }else{
            echo '<tr><th style="color:red;" colspan="9">No records found.</th></tr>';
        }
        echo '<tr><th class="seperater" colspan="9"></th></tr>';
        echo '<tr><th colspan="9"></th></tr>';
    echo '</table>';  
  }

  ///////////////////////////////////////  Cost Center Wise Sammary file ///////////////////////////////////

  // if ($sfile == 'scc') {

  //   //create ODBC connection   
  //   $sql = "SELECT DISTINCT iss.iss_item,iss.itm_desc,
  //           com.com_name, com.com_uname
  //           FROM tempdb..{$scons} AS iss
  //           INNER JOIN catalog..comcat AS com
  //           ON
  //           iss.iss_com = com.com_com AND
  //           iss.iss_unit = com.com_unit
  //           ";
  //   $result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
  //   //print_r(odbc_result_all($result, "border=1"));exit;
  //   $rows = array();
  //   while ($myRow = odbc_fetch_array($result)) {
  //       $rows[] = $myRow;
  //   }

  //   $file_ending = "xls";

  //   /*******Start of Formatting for Excel*******/   

  //   echo '<table border="1">';
  //     echo '<tr class="bg-color">';
  //       echo '<th colspan="4">NECO GROUP OF INDUSTRIES</th>';
  //       echo '<th class="float-left" colspan="5">Date : '.date('d.m.Y').'</th>';
  //     echo '</tr>';
  //     echo '<tr>';
  //       echo '<th class="float-right" colspan="4">Company Name : </th>';
  //       echo '<th class="float-left" colspan="5">'.$rows[0]['com_name'].'</th>';
  //     echo '</tr>';
  //     echo '<tr>';
  //       echo '<th class="float-right" colspan="4">Unit Name : </th>';
  //       echo '<th class="float-left" colspan="5">'.$rows[0]['com_uname'].'</th>';
  //     echo '</tr>';
  //     echo '<tr>';
  //       echo '<th class="float-right" colspan="4">Consumption Report : </th>';
  //       echo '<th class="float-left" colspan="5">From '.date('d.m.Y', strtotime($fffdate)).' To '.date('d.m.Y', strtotime($fftdate)).'</th>';
  //     echo '</tr>';
  //     echo '<tr>';
  //       echo '<th class="float-right" colspan="4">Item Number : </th>';
  //       echo '<th class="float-left" colspan="5">From '.$fffrom.' To '.$ffto.'</th>';
  //     echo '</tr>';
  //     echo '<tr>';
  //       echo '<th class="float-right" colspan="4">Department : </th>';
  //       echo '<th class="float-left" colspan="5">From '.$fd1.' To '.$fd2.'</th>';
  //     echo '</tr>';
  //   echo '</table>';
     
  //   echo '<table border="1">';  
  //     echo '<tr>';
  //       echo '<th class="float-right" colspan="4">File Name :</th>';
  //       echo '<th class="float-left" colspan="5">Sammary File - Cost Center Wise Consumptions</th>';
  //     echo '</tr>';
  //     echo '<tr class="bg-color">';
  //       echo '<th>Item Code</th>';
  //       echo '<th class="float-left" colspan="8">Item Name</th>';
  //     echo '</tr>';

  //     echo '<tr class="bg-color">';
  //       echo '<th>&nbsp;</th>';
  //       echo '<th colspan="3">UOM</th>';
  //       echo '<th colspan="2">RATE</th>';
  //       echo '<th>QUANTITY</th>';
  //       echo '<th colspan="2">VALUE</th>';
  //     echo '</tr>';
  //   echo '</table>';

  //   echo '<table border="1">';

  //   //end of printing column names  
  //   //start while loop to get data
      
        
  //       if (!empty($rows)) {
  //           foreach ($rows as $row) {
  //               echo '<tr>';
  //                   echo '<td class="float-center"><b>'.$row['iss_item'].'</b></td>';
  //                   echo '<td class="float-left" colspan="8"><b>'.$row['itm_desc'].'</b></td>';
  //               echo '</tr>';

  //               $iss_item = $row['iss_item'];

  //               $sql2 = "SELECT iss.*, cod.cod_desc
  //                 FROM tempdb..{$scons} AS iss
  //                 INNER JOIN catalog..codecat AS cod
  //                 ON
  //                 iss.itm_uom = cod.cod_code AND
  //                 cod.cod_prefix = 6
  //                 WHERE iss_item = '$iss_item'";

  //         $result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

  //         $rows2 = array();
  //           while ($myRow2 = odbc_fetch_array($result2)) {
  //               $rows2[] = $myRow2;
  //           }
  //           if (!empty($rows2)) {
  //                 $totalRate = 0;
  //                 $totalQty = 0;
  //                 $totalValue = 0;
  //               foreach ($rows2 as $row2) {
  //                   $uom = $row2['cod_desc'];
  //                   $rate = $row2['iss_rate'];
  //                   $qty = $row2['iss_qty'];
  //                   $value = $row2['iss_val'];
  //                   // echo '<tr>';
  //                   //    echo '<td>&nbsp;</td>';
  //                   //    echo '<td class="float-center">'.$row2['cod_desc'].'</td>';
  //                   //    echo '<td class="float-center">'.$row2['iss_no'].'</td>';
  //                   //    echo '<td class="float-center">'.date('d.m.Y', strtotime($row2['iss_dt'])).'</td>';
  //                   //    echo '<td colspan="2" class="float-right">'.$rate.'</td>';
  //                   //    echo '<td class="float-right">'.$qty.'</td>';
  //                   //    echo '<td colspan="2" class="float-right">'.$value.'</td>';
  //                   // echo '</tr>';
  //                   $totalRate = round(($totalRate + $rate), 2);
  //                   $totalQty = $totalQty + $qty;
  //                   $totalValue = round(($totalValue + $value), 2);
  //               }
  //                   echo '<tr>';
  //                      echo '<td>&nbsp;</td>';
  //                      echo '<td colspan="3" class="float-center">'.$uom.'</td>';
  //                      echo '<td colspan="2" class="float-right">'.$rate.'</td>';
  //                      echo '<td class="float-right">'.$totalQty.'</td>';
  //                      echo '<td colspan="2" class="float-right">'.$totalValue.'</td>';
  //                   echo '</tr>';
  //           }

  //             // item total
  //             echo '<tr class="bg-color">';
  //               echo '<th></th>';
  //               echo '<th colspan="3"></th>';
  //               echo '<th colspan="2"></th>';
  //               echo '<th></th>';
  //               echo '<th colspan="2">TOTAL VALUE</th>';
  //             echo '</tr>';
  //             echo '<tr>';
  //               echo '<td colspan="4"></td>';
  //               echo '<td colspan="2"></td>';
  //               echo '<td></td>';
  //               echo '<td colspan="2"><b>'.number_format($totalValue,2).'</b></td>';
  //             echo '</tr>';
  //           }

  //       }else{
  //           echo '<tr><th style="color:red;" colspan="9">No records found.</th></tr>';
  //       }
  //   echo '</table>';  
  // }

}elseif ($ProcLock == 'Y') {  
    ?>
      <script type="text/javascript">
        alert("Stortran Processing Is Already Going On ||  Try After Some Time");
        window.location="../dashboard.php";
      </script>
    <?php
} // prock lock if end


// drop temp table
// $dropTableQuery1 = "drop table tempdb..{$grdlst}";
// $dropTableExec1 = odbc_exec($conn, $dropTableQuery1);


  // update prock lock with N and userid 0
  $updateProcLock = "update {$ffdbn}.invac.proc_lock set proc_lock  = 'N', proc_usrid = 0";
  $updateProcLockExec = odbc_exec($conn, $updateProcLock);

?>