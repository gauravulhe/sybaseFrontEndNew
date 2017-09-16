<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

        $GLOBALS['Guser_id'] = $_SESSION['usr_id'];

        if (isset($_SESSION['grn_com_params'])) {
            $count = $_SESSION['grn_com_params']['count'];
            $UserComDbf = $_SESSION['grn_com_params']['UserComDbf'];
            $grd_com = $_SESSION['grn_com_params']['grd_com'];
            $grd_unit = $_SESSION['grn_com_params']['grd_unit'];
            $grd_fyr = $_SESSION['grn_com_params']['grd_fyr'];
            $grd_no = $_SESSION['grn_com_params']['grd_no'];
            $grd_dt = $_SESSION['grn_com_params']['grd_dt'];

            for ($i=0; $i < $count; $i++) { 

            $grd_srl = $_SESSION['grn_com_params']['grd_srl'][$i];
            $grd_po_no = $_SESSION['grn_com_params']['grd_po_no'][$i];
            $grd_po_fyr = $_SESSION['grn_com_params']['grd_po_fyr'][$i];
            $grd_po_srl = $_SESSION['grn_com_params']['grd_po_srl'][$i];
            $pod_rate = $_SESSION['grn_com_params']['pod_rate'][$i];

                $tmppodet = 'tmppodet_'.substr($Guser_id, 0, 4);
                $tmppdcom = 'tmppdcom_'.substr($Guser_id, 0, 4);
                $tmppohdr = 'tmppohdr_'.substr($Guser_id, 0, 4);

                $query = "SELECT * from tempdb..$tmppodet";
                $resultQuery = odbc_exec($conn, $query);
                //print_r(odbc_result_all($resultQuery, "border=1"));
                
                $queryUpdGradj = "UPDATE $UserComDbf.invac.gradj SET gra_po_amt = $pod_rate, gra_forced_amt = $pod_rate WHERE gra_unit = $grd_unit AND gra_fyr = $grd_fyr AND gra_no = $grd_no AND gra_dt = '$grd_dt' AND gra_srl = $grd_srl AND gra_id = 10";
                odbc_exec($conn, $queryUpdGradj);

                $queryGetGradjData = "SELECT grd.grd_srl, grd.grd_item, grd.grd_rcv_qty, tmppod.pod_rate, tmppdc.pdc_id, tmppdc.pdc_tag, tmppdc.pdc_amt, gra.gra_id, gra.gra_po_amt
                    FROM $UserComDbf.invac.grdet grd
                    INNER JOIN tempdb..$tmppodet tmppod
                    ON 
                    tmppod.pod_unit = grd.grd_unit AND
                    tmppod.pod_fyr = grd.grd_po_fyr AND
                    tmppod.pod_po_no = grd.grd_po_no AND
                    tmppod.pod_po_srl = grd.grd_po_srl
                    INNER JOIN tempdb..$tmppdcom tmppdc
                    ON
                    tmppdc.pdc_unit = grd.grd_unit AND
                    tmppdc.pdc_fyr = grd.grd_po_fyr AND
                    tmppdc.pdc_po_no = grd.grd_po_no AND
                    tmppdc.pdc_po_srl = grd.grd_po_srl
                    INNER JOIN $UserComDbf.invac.gradj gra
                    ON
                    gra.gra_unit = grd.grd_unit AND
                    gra.gra_fyr = grd.grd_fyr AND
                    gra.gra_no = grd.grd_no AND
                    gra.gra_srl = grd.grd_srl
                    WHERE grd_unit = $grd_unit AND grd_fyr = $grd_fyr AND grd_no = $grd_no AND pdc_id >= 15 AND pdc_id NOT IN (92,97)
                ";
                $resultGetGradjData = odbc_exec($conn, $queryGetGradjData);
                //print_r(odbc_result_all($resultGetGradjData, "border=1"));
                $grd_rcv_qty=odbc_result($resultGetGradjData, 3);
                $grd_rcv_qty= ($grd_rcv_qty)?$grd_rcv_qty:0;
                $pod_rate=odbc_result($resultGetGradjData, 4);
                $pod_rate = ($pod_rate)?$pod_rate:0;
                $pdc_id=odbc_result($resultGetGradjData, 5);
                $pdc_id = ($pdc_id)?$pdc_id:0;
                $pdc_tag=odbc_result($resultGetGradjData, 6);
                $pdc_tag = ($pdc_tag)?$pdc_tag:0;
                $pdc_amt=odbc_result($resultGetGradjData, 7);
                $pdc_amt = ($pdc_amt)?$pdc_amt:0;
                $gra_id=odbc_result($resultGetGradjData, 8);                            
                $gra_id = ($gra_id)?$gra_id:0;
                $gra_po_amt=odbc_result($resultGetGradjData, 9);
                $gra_po_amt = ($gra_po_amt)?$gra_po_amt:0;
                $value = $grd_rcv_qty * $pod_rate;
                $totalamt = 0;
                $mvalue = 0;
                if ($pdc_tag == 1) {
                    $mvalue = $value * $pdc_amt/100;
                }elseif ($pdc_tag == 2) {
                    $mvalue = $pdc_amt;
                }elseif ($pdc_tag == 3) {
                    $mvalue = 0;
                }elseif ($pdc_tag == 4) {
                    $mvalue = 0;
                }elseif ($pdc_tag > 4 && $pdc_amt < 7) {
                    $mvalue = $grd_rcv_qty * $pdc_amt;
                }elseif ($pdc_tag == 8) {
                    $mvalue = 0;
                }

                if ($pdc_id == $gra_id) {
                    $gra_po_amt = $gra_po_amt + $mvalue;
                }

                $queryGetCodecatData = "SELECT cod_desc FROM catalog..codecat WHERE cod_code = $pdc_id AND cod_prefix = 201";
                $resultGetCodecatData = odbc_exec($conn, $queryGetCodecatData);
                
                $mffid = odbc_result($resultGetCodecatData, 1);
                $totalamt = $totalamt + $value;



                $queryGetTmppohdrData = "SELECT poh_stax_per, poh_disc, poh_igst_per, poh_sgst_per, poh_cgst_per, poh_po_dt, poh_excise_cd FROM tempdb..$tmppohdr WHERE poh_com = $grd_com AND poh_unit = $grd_unit AND poh_fyr = $grd_po_fyr AND poh_po_no = $grd_po_no";
                $resultGetTmppohdrData = odbc_exec($conn, $queryGetTmppohdrData);
                
                $stax_per = odbc_result($resultGetTmppohdrData, 1);
                $disc_per = odbc_result($resultGetTmppohdrData, 2);
                $igst_per = odbc_result($resultGetTmppohdrData, 3);
                $sgst_per = odbc_result($resultGetTmppohdrData, 4);
                $cgst_per = odbc_result($resultGetTmppohdrData, 5);
                $poh_po_dt = odbc_result($resultGetTmppohdrData, 6);
                $poh_excise_cd = odbc_result($resultGetTmppohdrData, 7);

                $queryGetExcrateData1 = "SELECT max(exc_date) FROM catalog..excrate WHERE exc_code = $poh_excise_cd AND exc_date <= '$poh_po_dt'";
                $resultGetExcrateData1 = odbc_exec($conn, $queryGetExcrateData1);
                
                $exc_date = odbc_result($resultGetExcrateData1, 1);

                $queryGetExcrateData2 = "SELECT exc_rate FROM catalog..excrate WHERE exc_code = $poh_excise_cd AND exc_date IN ('$exc_date')";
                $resultGetExcrateData2 = odbc_exec($conn, $queryGetExcrateData2);
                
                $exc_per = odbc_result($resultGetExcrateData2, 1);


                if (empty($stax_per)) {
                    $stax_per = 0;
                }
                if (empty($disc_per)) {
                    $disc_per = 0;
                }
                if (empty($igst_per)) {
                    $igst_per = 0;
                }
                if (empty($sgst_per)) {
                    $sgst_per = 0;
                }
                if (empty($cgst_per)) {
                    $cgst_per = 0;
                }
                if (empty($exc_per)) {
                    $exc_per = 0;
                }
                $disc = $totalamt*$disc_per/100;
                $exc = ($totalamt-$disc)*$exc_per/100;

                ///////////////////// service tax ///////////////
                $queryServTax = "SELECT pdc_amt FROM tempdb..$tmppdcom WHERE pdc_unit = $grd_unit AND pdc_po_srl = 01 AND pdc_id = 93 AND pdc_tag = 1";
                $resultServTax = odbc_exec($conn, $queryServTax);
                $serv_pdc_amt = odbc_result($resultServTax, 1);
                $serv_pdc_amt = ($serv_pdc_amt)?$serv_pdc_amt:0;
                $serv = ($totalamt-$disc)*$serv_pdc_amt/100;

                $cess = 0;
                if ($serv > 0) {
                    ///////////////////// service charge cess ///////////////
                    $queryServCess = "SELECT pdc_amt FROM tempdb..$tmppdcom WHERE pdc_unit = $grd_unit AND pdc_po_srl = 01 AND pdc_id = 92 AND pdc_tag = 1";
                    $resultServCess = odbc_exec($conn, $queryServCess);
                    $cess_pdc_amt = odbc_result($resultServCess, 1);
                    $cess = $serv*$cess_pdc_amt/100;
                }elseif ($exc > 0) {
                    ///////////////////// excise charge cess ///////////////
                    $queryExcCess = "SELECT pdc_amt FROM tempdb..$tmppdcom WHERE pdc_unit = $grd_unit AND pdc_po_srl = 01 AND pdc_id = 92 AND pdc_tag = 1";
                    $resultExcCess = odbc_exec($conn, $queryExcCess);
                    $cess_pdc_amt = odbc_result($resultExcCess, 1);
                    $cess = $exc*$cess_pdc_amt/100;
                }

                $hscs = 0;
                if ($serv > 0) {
                    ///////////////////// exise cess tax ///////////////
                    $queryServCess = "SELECT pdc_amt FROM tempdb..$tmppdcom WHERE pdc_unit = $grd_unit AND pdc_po_srl = 01 AND pdc_id = 97 AND pdc_tag = 1";
                    $resultServCess = odbc_exec($conn, $queryServCess);
                    $cess_pdc_amt = odbc_result($resultServCess, 1);
                    $hscs = $serv*$cess_pdc_amt/100;
                }elseif ($exc > 0) {
                    ///////////////////// excise charge cess ///////////////
                    $queryExcCess = "SELECT pdc_amt FROM tempdb..$tmppdcom WHERE pdc_unit = $grd_unit AND pdc_po_srl = 01 AND pdc_id = 97 AND pdc_tag = 1";
                    $resultExcCess = odbc_exec($conn, $queryExcCess);
                    $cess_pdc_amt = odbc_result($resultExcCess, 1);
                    $hscs = $exc*$cess_pdc_amt/100;
                }

                $querySbcess = "SELECT pdc_amt FROM tempdb..$tmppdcom WHERE pdc_unit = $grd_unit AND pdc_po_srl = 01 AND pdc_id = 89 AND pdc_tag = 1";
                $resultSbcess = odbc_exec($conn, $querySbcess);
                $sbcess_pdc_amt = odbc_result($resultSbcess, 1);
                $sbcess = ($totalamt-$disc)*$sbcess_pdc_amt/100;


                $queryPack = "SELECT pdc_amt FROM tempdb..$tmppdcom WHERE pdc_unit = $grd_unit AND pdc_po_srl = 01 AND pdc_id = 30 AND pdc_tag = 1";
                $resultPack = odbc_exec($conn, $queryPack);
                $pack = odbc_result($resultPack, 1);
                $stax=($totalamt-$disc+$cess+$exc)*$stax_per/100;
                $igst=($totalamt-$disc+$pack)*$igst_per/100;
                $sgst=($totalamt-$disc+$pack)*$sgst_per/100;
                $cgst=($totalamt-$disc+$pack)*$cgst_per/100;
                
                $j = 0;
                if ($disc > 0) {
                    $ff_gra_id[$j] = 20;
                    $ff_id[$j] = 'DISCOUNT';
                    $ff_gra_po_amt[$j] = $disc;
                    $j = $j + 1;
                }
                if ($cess > 0) {
                    $ff_gra_id[$j] = 92;
                    $ff_id[$j] = 'CESS TAX';
                    $ff_gra_po_amt[$j] = $cess;
                    $j = $j + 1;
                }
                if ($hscs > 0) {
                    $ff_gra_id[$j] = 97;
                    $ff_id[$j] = 'HSCS TAX';
                    $ff_gra_po_amt[$j] = $hscs;
                    $j = $j + 1;
                }
                if ($serv > 0) {
                    $ff_gra_id[$j] = 93;
                    $ff_id[$j] = 'SERV. CHRG';
                    $ff_gra_po_amt[$j] = $serv;
                    $j = $j + 1;
                }
                if ($exc > 0) {
                    $ff_gra_id[$j] = 40;
                    $ff_id[$j] = 'EXCISE';
                    $ff_gra_po_amt[$j] = $exc;
                    $j = $j + 1;
                }
                if ($stax > 0) {
                    $ff_gra_id[$j] = 45;
                    $ff_id[$j] = 'SALES TAX';
                    $ff_gra_po_amt[$j] = $stax;
                    $j = $j + 1;
                }
                if ($sbcess > 0) {
                    $ff_gra_id[$j] = 89;
                    $ff_id[$j] = 'S.B.CESS';
                    $ff_gra_po_amt[$j] = $sbcess;
                    $j = $j + 1;
                }
                if ($igst > 0) {
                    $ff_gra_id[$j] = 51;
                    $ff_id[$j] = 'IGST';
                    $ff_gra_po_amt[$j] = $igst;
                    $j = $j + 1;
                }

                if ($sgst > 0) {
                    $ff_gra_id[$j] = 52;
                    $ff_id[$j] = 'SGST';
                    $ff_gra_po_amt[$j] = $sgst;
                    $j = $j + 1;
                }

                if ($cgst > 0) {
                    $ff_gra_id[$j] = 53;
                    $ff_id[$j] = 'CGST';
                    $ff_gra_po_amt[$j] = $cgst;
                    $j = $j + 1;
                }

                for ($k=0; $k < $j ; $k++) { 
                    if ($ff_gra_id[$k] == 26) {
                        $ff_gra_po_amt[$k] = ($stax*0.10);
                    }
                    if ($ff_gra_id[$k] == 36) {
                        $ff_gra_po_amt[$k] = ($totalamt-$disc+$cess+$exc)*0.01;
                    }

                    if (isset($_POST['submit'])) {
                        $gra_count = count($_POST['gra_com']);
                        $gra_com = $_POST['gra_com'];
                        $gra_unit = $_POST['gra_unit'];
                        $gra_fyr = $_POST['gra_fyr'];
                        $gra_no = $_POST['gra_no'];
                        $gra_dt = $_POST['gra_dt'];
                        $gra_srl = $_POST['gra_srl'];
                        $gra_id = $_POST['gra_id'];
                        $gra_rmk = $_POST['gra_rmk'];

                        $gra_po_amt = $_POST['gra_po_amt'];                        

                        for ($l=0; $l < $gra_count; $l++) { 

                            $finalAmtNew = (($gra_po_amt[$l] * $value)/$totalamt);

                            echo $queryInsGradjData = "INSERT INTO $UserComDbf.invac.gradj (gra_com, gra_unit, gra_fyr, gra_no, gra_dt, gra_srl, gra_id, gra_po_amt, gra_forced_amt) VALUES ($gra_com[$l], $gra_unit[$l], $gra_fyr[$l], $gra_no[$l], '$gra_dt[$l]', $gra_srl[$l], $gra_id[$l], $finalAmtNew, $finalAmtNew)";
                            $resultInsGradjData = odbc_exec($conn, $queryInsGradjData);
                            if ($resultInsGradjData) {
                                $success_msg = 'New Record Saved Successfully.';
                                header("Location:inv_strs_grn_prcssng.php");
                            }
                        }
                    }
                }

            }

        }
    // 
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once('includes/dash_head.php'); ?>
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="">
           <?php require_once('includes/dash_header.php'); ?> 
        </header>
        <div>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Material Receipt
                        <small>Stores</small>   
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="grnent" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1" id="grn_table">
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>
                                            <th>ID</th>
                                            <th>DESCRIPTION</th>
                                            <th>AMOUNT</th>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <?php
                                            if (!empty($ff_gra_po_amt)) {

                                            for ($i=0; $i < $count; $i++) { 

                                                for ($k=0; $k < $j ; $k++) {
                                        ?>
                                        <tr>
                                            <input type="hidden" name="gra_com[]" id="gra_com" value="<?php echo $grd_com; ?>">
                                            <input type="hidden" name="gra_unit[]" id="gra_unit" value="<?php echo $grd_unit; ?>">
                                            <input type="hidden" name="gra_fyr[]" id="gra_fyr" value="<?php echo $grd_fyr; ?>">
                                            <input type="hidden" name="gra_no[]" id="gra_no" value="<?php echo $grd_no; ?>">
                                            <input type="hidden" name="gra_dt[]" id="gra_dt" value="<?php echo $grd_dt; ?>">
                                            <input type="hidden" name="gra_srl[]" id="gra_srl" value="<?php echo $grd_srl[$i]; ?>">
                                            <td>
                                                <input type="text" name="gra_id[]" id="gra_id" value="<?php echo $ff_gra_id[$k]; ?>" maxlenght="3" size="1">
                                            </td>
                                            <td>
                                                <input type="text" name="gra_desc_id[]" id="gra_desc_id" value="<?php echo $ff_id[$k]; ?>" maxlenght="36" size="30">
                                            </td>
                                            <td>
                                                <input type="text" name="gra_po_amt[]" id="gra_po_amt" value="<?php echo $ff_gra_po_amt[$k]; ?>" maxlenght="10" size="10" style="text-align:right;">
                                            </td>                                            
                                            <input type="hidden" name="gra_forced_amt[]" id="gra_forced_amt" value="<?php echo $ff_gra_po_amt[$k]; ?>">
                                            <input type="hidden" name="gra_rmk[]" id="gra_rmk" value="NULL">
                                        </tr>
                                        <?php 
                                                    }    
                                                }

                                            }else{
                                        ?>        
                                        <tr>
                                            <td colspan="3"><p style="color:red;">No Commercial Details Found.</p></td>
                                        </tr>
                                        <?php } ?>                      
                                        <tr>
                                            <td colspan="8">
                                                <table width="100%">
                                                    <tr><td colspan="8"><hr></td></tr>
                                                    <tr><td>&nbsp;</td></tr>                    
                                                    <tr>
                                                        <td colspan="8" align="center">
                                                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                                            <input type="button" name="Cancel" value="Cancel" class="btn btn-primary" onclick="window.location='inv_strs_grn_prcssng.php'">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>                             
                                </div>
                            </div>
                        </div>   
                    </form>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->  
        <?php require_once('includes/dash_footer.php'); ?> 
    </body>
</html>