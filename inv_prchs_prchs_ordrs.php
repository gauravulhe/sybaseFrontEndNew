<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        //print_r($_POST);exit;

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $com_com = $_POST['poh_com'];
        $UserComDbf = $_POST['user_com_dbf'];

        // pohdr table fields
        $poh_com = $_POST['poh_com'];
        $poh_unit = $_POST['poh_unit'];
        $poh_fyr = $_POST['poh_fyr'];
        $poh_po_no = $_POST['poh_po_no'];
        $poh_po_dt = date('Y-m-d 00:00:00', strtotime($_POST['poh_po_dt']));
        $poh_supcd = strtoupper($_POST['poh_supcd']);
        $poh_sup_accd = $_POST['poh_sup_accd'];
        $poh_stax_cd = $_POST['poh_stax_cd'];
        $poh_stax_per = $_POST['poh_stax_per'];
        $poh_excise_cd = $_POST['poh_excise_cd'];
        $poh_dlv_dest = strtoupper($_POST['poh_dlv_dest']);
        $poh_disc = $_POST['poh_disc'];
        $poh_paycr_days = $_POST['poh_paycr_days'];
        $poh_crdisc = $_POST['poh_crdisc'];
        $poh_bank = strtoupper($_POST['poh_bank']);
        $poh_pmnt_terms = strtoupper($_POST['poh_pmnt_terms']);
        $poh_inq_fyr = $_POST['poh_inq_fyr'];
        $poh_inq_no = $_POST['poh_inq_no'];
        $poh_po_type = $_POST['poh_po_type'];
        $poh_addl_rmk = strtoupper($_POST['poh_addl_rmk']);
        $poh_exp_dt = date('Y-m-d 00:00:00', strtotime($_POST['poh_exp_dt']));
        $poh_gst_cd = $_POST['poh_gst_cd'];
        $poh_gst_per = $_POST['poh_gst_per'];
        $poh_igst_per = $_POST['poh_igst_per'];
        $poh_sgst_per = $_POST['poh_sgst_per'];
        $poh_cgst_per = $_POST['poh_cgst_per'];
        $poh_ugst_per = $_POST['poh_ugst_per'];

        // podet table fields
        $pod_com = $_POST['poh_com'];
        $pod_unit = $_POST['poh_unit'];
        $pod_fyr = $_POST['poh_fyr'];
        $pod_po_no = $_POST['poh_po_no'];
        $pod_po_srl = $_POST['pod_po_srl'];
        $pod_item = $_POST['pod_item'];
        $pod_tech_spec = strtoupper($_POST['pod_tech_spec']);
        $pod_rate = $_POST['pod_rate'];
        $pod_ord_qty = $_POST['pod_ord_qty'];
        $pod_tolerance = $_POST['pod_tolerance'];

        // pdcomm table fields
        $pdc_com = $_POST['poh_com'];
        $pdc_unit = $_POST['poh_unit'];
        $pdc_fyr = $_POST['poh_fyr'];
        $pdc_po_no = $_POST['poh_po_no'];
        $pdc_po_srl = $_POST['pod_po_srl'];
        $pdc_id = $_POST['pdc_id'];
        $pdc_tag = $_POST['pdc_tag'];
        $pdc_amt = $_POST['pdc_amt'];

        // pddet table fields
        $pdd_com = $_POST['poh_com'];
        $pdd_unit = $_POST['poh_unit'];
        $pdd_fyr = $_POST['poh_fyr'];
        $pdd_po_no = $_POST['poh_po_no'];
        $pdd_po_srl = $_POST['pod_po_srl'];
        $pdd_sch_dt = $_POST['pdd_sch_dt'];
        $pdd_stag_qty = $_POST['pdd_stag_qty'];

        // pdreq table fields
        $pdr_com = $_POST['poh_com'];
        $pdr_unit = $_POST['poh_unit'];
        $pdr_fyr = $_POST['poh_fyr'];
        $pdr_po_no = $_POST['poh_po_no'];
        $pdr_po_srl = $_POST['pod_po_srl'];
        $pdr_req_fyr = $_POST['pdr_req_fyr'];
        $pdr_req_no = $_POST['pdr_req_no'];
        $pdr_req_srl = $_POST['pdr_req_srl'];

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'porder') { 
            $query = "UPDATE $UserComDbf.invac.pohdr SET poh_po_dt = '$poh_po_dt', poh_supcd = '$poh_supcd', poh_sup_accd = '$poh_sup_accd', poh_stax_cd = $poh_stax_cd, poh_stax_per = $poh_stax_per, poh_excise_cd = $poh_excise_cd, poh_dlv_dest = '$poh_dlv_dest', poh_disc = $poh_disc, poh_paycr_days = $poh_paycr_days, poh_crdisc = $poh_crdisc, poh_bank = '$poh_bank', poh_pmnt_terms = '$poh_pmnt_terms', poh_inq_fyr = $poh_inq_fyr, poh_inq_no = $poh_inq_no, poh_po_type = $poh_po_type, poh_addl_rmk = '$poh_addl_rmk', poh_exp_dt = '$poh_exp_dt', poh_gst_cd = $poh_gst_cd, poh_gst_per = $poh_gst_per, poh_igst_per = $poh_igst_per, poh_sgst_per = $poh_sgst_per, poh_cgst_per = $poh_cgst_per, poh_ugst_per = $poh_ugst_per WHERE poh_com = $poh_com AND poh_unit = $poh_unit AND poh_fyr = $poh_fyr AND poh_po_no = $poh_po_no";

            $sql_result = odbc_exec($conn, $query);
                if ($sql_result) { 

                    // UPDATE into podet
                    $queryPod = "UPDATE $UserComDbf.invac.podet SET pod_com = $pod_com, pod_unit = $pod_unit, pod_fyr = $pod_fyr, pod_po_no = $pod_po_no, pod_po_srl = $pod_po_srl, pod_item = '$pod_item', pod_tech_spec = '$pod_tech_spec', pod_rate = $pod_rate, pod_ord_qty = $pod_ord_qty, pod_tolerance = $pod_tolerance WHERE pod_com = $poh_com AND pod_unit = $poh_unit AND pod_fyr = $poh_fyr AND pod_po_no = $poh_po_no  AND pod_po_srl = $pod_po_srl";

                    $sql_resultPod = odbc_exec($conn, $queryPod);

                    if ($sql_resultPod) {     

                        for ($i=0; $i < count($pdc_id); $i++) { 

                            $queryPdcomm = "UPDATE $UserComDbf.invac.pdcomm SET pdc_com = $pdc_com, pdc_unit = $pdc_unit, pdc_fyr = $pdc_fyr, pdc_po_no = $pdc_po_no, pdc_po_srl = $pdc_po_srl, pdc_id = $pdc_id[$i], pdc_tag = $pdc_tag[$i], pdc_amt = $pdc_amt[$i] WHERE pdc_com = $poh_com AND pdc_unit = $poh_unit AND pdc_fyr = $poh_fyr AND pdc_po_no = $poh_po_no  AND pdc_id = $pdc_id[$i]";

                            $sql_resultPdcomm = odbc_exec($conn, $queryPdcomm);
                        }

                        if ($sql_resultPdcomm) {

                            // UPDATE into pddet
                            for ($j=0; $j < count($pdd_sch_dt); $j++) { 
                                $pdd_sch_dt[$j] = date('Y-m-d 00:00:00', strtotime($pdd_sch_dt[$j]));
                                $queryPddet = "UPDATE $UserComDbf.invac.pddet SET pdd_com = $pdd_com, pdd_unit = $pdd_unit, pdd_fyr = $pdd_fyr, pdd_po_no = $pdd_po_no, pdd_po_srl = $pdd_po_srl, pdd_sch_dt = '$pdd_sch_dt[$j]', pdd_stag_qty = $pdd_stag_qty[$j] WHERE pdd_com = $poh_com AND pdd_unit = $poh_unit AND pdd_fyr = $poh_fyr AND pdd_po_no = $poh_po_no AND pdd_sch_dt = '$pdd_sch_dt[$j]'";

                                $sql_resultPddet = odbc_exec($conn, $queryPddet);
                            }

                            if ($sql_resultPddet) {

                                // UPDATE into pdreq
                                for ($k=0; $k < count($pdr_req_fyr); $k++) { 
                                    $queryPdreq = "UPDATE $UserComDbf.invac.pdreq SET pdr_com = $pdr_com, pdr_unit = $pdr_unit, pdr_fyr = $pdr_fyr, pdr_po_no = $pdr_po_no, pdr_po_srl = $pdr_po_srl, pdr_req_fyr = $pdr_req_fyr[$k], pdr_req_no = $pdr_req_no[$k], pdr_req_srl = $pdr_req_srl[$k] WHERE pdr_com = $poh_com AND pdr_unit = $poh_unit AND pdr_fyr = $poh_fyr AND pdr_po_no = $poh_po_no AND pdr_po_srl = $pdr_srl[$k]";

                                        $sql_resultPdreq = odbc_exec($conn, $queryPdreq);
                                }

                                if ($sql_resultPdreq) {
                                    $success_msg = 'Record Updated Successfully.';
                                }
                            }
                        }
                    }                
                }else{
                    $error_msg = 'Failed To Update Record, Please Try Again.';
                }
            }else if($passActn == 'e' && $frm_nm == 'porder') {  
                        
               
            $query = "SELECT * FROM $UserComDbf.invac.pohdr WHERE poh_com = $poh_com AND poh_unit = $poh_unit AND poh_fyr = $poh_fyr AND poh_po_no = $poh_po_no";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) {
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO $UserComDbf.invac.pohdr (poh_com, poh_unit, poh_fyr, poh_po_no, poh_po_dt, poh_supcd, poh_sup_accd, poh_stax_cd, poh_stax_per, poh_excise_cd, poh_dlv_dest, poh_disc, poh_paycr_days, poh_crdisc, poh_bank, poh_pmnt_terms, poh_inq_fyr, poh_inq_no, poh_po_type, poh_addl_rmk, poh_exp_dt, poh_gst_cd, poh_gst_per, poh_igst_per, poh_sgst_per, poh_cgst_per, poh_ugst_per) VALUES ($poh_com, $poh_unit, $poh_fyr, $poh_po_no, '$poh_po_dt', '$poh_supcd', '$poh_sup_accd', $poh_stax_cd, $poh_stax_per, $poh_excise_cd, '$poh_dlv_dest', $poh_disc, $poh_paycr_days, $poh_crdisc, '$poh_bank', '$poh_pmnt_terms', $poh_inq_fyr, $poh_inq_no, $poh_po_type, '$poh_addl_rmk', '$poh_exp_dt', $poh_gst_cd, $poh_gst_per, $poh_igst_per, $poh_sgst_per, $poh_cgst_per, $poh_ugst_per)";

                $sql_result = odbc_exec($conn, $query);
                
                if ($sql_result) {

                    $updateQuery = "UPDATE $UserComDbf.invac.parinv SET par_lval = $poh_po_no WHERE par_com = $poh_com AND par_unit = $poh_unit AND par_tbl = 'pohdr' AND par_col = 1 AND par_fyr = $poh_fyr";

                    $sql_result_update_parinv = odbc_exec($conn, $updateQuery);

                    // insert into podet
                    $queryPod = "INSERT INTO $UserComDbf.invac.podet (pod_com, pod_unit, pod_fyr, pod_po_no, pod_po_srl, pod_item, pod_tech_spec, pod_rate, pod_ord_qty, pod_tolerance) VALUES ($pod_com, $pod_unit, $pod_fyr, $pod_po_no, $pod_po_srl, '$pod_item', '$pod_tech_spec', $pod_rate, $pod_ord_qty, $pod_tolerance)";

                    $sql_resultPod = odbc_exec($conn, $queryPod);

                    if ($sql_resultPod) {     

                        for ($i=0; $i < count($pdc_id); $i++) { 

                            $queryPdcomm = "INSERT INTO $UserComDbf.invac.pdcomm (pdc_com, pdc_unit, pdc_fyr, pdc_po_no, pdc_po_srl, pdc_id, pdc_tag, pdc_amt) VALUES ($pdc_com, $pdc_unit, $pdc_fyr, $pdc_po_no, ($i+1), $pdc_id[$i], $pdc_tag[$i], $pdc_amt[$i])";

                            $sql_resultPdcomm = odbc_exec($conn, $queryPdcomm);
                        }

                        if ($sql_resultPdcomm) {

                            // insert into pddet
                            for ($j=0; $j < count($pdd_sch_dt); $j++) { 
                                $pdd_sch_dt[$j] = date('Y-m-d 00:00:00', strtotime($pdd_sch_dt[$j]));
                                $queryPddet = "INSERT INTO $UserComDbf.invac.pddet (pdd_com, pdd_unit, pdd_fyr, pdd_po_no, pdd_po_srl, pdd_sch_dt, pdd_stag_qty) VALUES ($pdd_com, $pdd_unit, $pdd_fyr, $pdd_po_no, ($j+1), '$pdd_sch_dt[$j]', $pdd_stag_qty[$j])";

                                $sql_resultPddet = odbc_exec($conn, $queryPddet);
                            }

                            if ($sql_resultPddet) {

                                // insert into pdreq
                                for ($k=0; $k < count($pdr_req_fyr); $k++) { 
                                    $queryPdreq = "INSERT INTO $UserComDbf.invac.pdreq (pdr_com, pdr_unit, pdr_fyr, pdr_po_no, pdr_po_srl, pdr_req_fyr, pdr_req_no, pdr_req_srl) VALUES ($pdr_com, $pdr_unit, $pdr_fyr, $pdr_po_no, ($k+1), $pdr_req_fyr[$k], $pdr_req_no[$k], $pdr_req_srl[$k])";

                                        $sql_resultPdreq = odbc_exec($conn, $queryPdreq);
                                }

                                if ($sql_resultPdreq) {
                                    $success_msg = 'New Record Saved Successfully.';
                                }
                            }
                        }
                    }
                }
            }
        }        
        if (!empty($_SESSION['powo'])) {
            unset($_SESSION['powo']);
        }
        //print_r($_POST);
    }
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
                        Purchase Order
                        <small>Purchase</small> <!-- | 
                        <small>Export To : </small>
                        <a href="exports/porder_export.php?ext=doc"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/porder_export.php?ext=xls"><img src="img/xls.png" width="35px"></a>  
                        <a href="exports/porder_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a> -->                        
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="porder" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="porder">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="6" size="1">
                                                <span id="InpReqPassErrorSpan"></span>
                                                <span id="ComPassErrorSpan"></span>
                                            </td>
                                            <td colspan="2">

                                            <span id="ComCdErrorSpan"></span>
                                            <span id="ComCdName"></span>
                                            </td>  
                                        </tr>
                                        <tr>            
                                            <th>Company</th>
                                            <td>
                                                <input type="hidden" name="user_com_cd" id="user_com_cd" value="<?php echo $_SESSION['com_cd']; ?>">
                                                <input type="hidden" name="user_com_dbf" id="user_com_dbf" value="<?php echo $_SESSION['com_dbf']; ?>">
                                                <input type="hidden" name="user_fduser" id="user_fduser" value="<?php echo $_SESSION['fduser']; ?>">
                                                <input type="text" name="poh_com" id="com_com" readonly maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>             
                                            <th>Unit Code</th>
                                            <td><input type="text" name="poh_unit" id="mat_unit" readonly maxlength="3" size="1" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            <span id="ComUntCdErrorSpan"></span>
                                            <span id="ComUntCdName"></span></td>
                                            </td>
                                            <th>Financial Year</th>
                                            <td>
                                                <input type="text" name="poh_fyr" id="poh_fyr" required maxlength="4" size="3" readonly>
                                            </td>    
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>                                            
                                            <th>Date</th>
                                            <td>
                                                <input type="hidden" name="crnt_dt" id="crnt_dt" value="<?php echo date('d-m-Y'); ?>">
                                                <input type="text" name="poh_po_dt" id="poh_po_dt" disabled readonly maxlength="10" size="8"  value="<?php echo date('d-m-Y'); ?>" required>
                                            </td>  
                                            <th>Enquiry No.</th>
                                            <td><input type="text" name="poh_inq_no" id="poh_inq_no"  maxlength="6" size="6" required onblur="CheckPoInqNo()" readonly onkeyup="CheckInputNumFormat(this.value)">
                                            <span id="PoInqNoErrorSpan"></span> 
                                            </td>  
                                            <th>Fin Year</th>
                                            <td><input type="text" name="poh_inq_fyr" id="poh_fyr1" readonly onblur="CheckDeptDescCd()" maxlength="4" size="3" style="text-transform: uppercase">
                                        </tr>
                                        <tr>           
                                            <th>PO No.</th>
                                            <td><input type="text" name="poh_po_no" id="poh_po_no" readonly maxlength="5" size="3" required onblur="CheckPoPoNoDetails()">
                                                <span id="PoPoCdErrorSpan"></span>
                                            </td>        
                                            <th>
                                                PO Type
                                                <small>
                                                    <a href="includes/view_details.php?q=type" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0, status=1'); return false;" >(Help)</a>
                                                </small>
                                            </th>
                                            <td>
                                                <input type="text" name="poh_po_type" id="poh_po_type" readonly onblur="CheckPoTypeCd()" maxlength="3" size="3" onkeyup="CheckInputNumFormat(this.value)" required>
                                            <span id="PoTypeErrorSpan"></span>
                                            </td>
                                            <th>
                                                Supplier
                                                <small>
                                                    <a href="includes/view_details.php?q=supcd" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0'); return false;" >(Help)</a>
                                                </small>
                                            </th>
                                            <td>
                                                <input type="text" name="poh_supcd" id="poh_supcd" readonly style="text-transform: uppercase" onblur="CheckPoSupCd()"  maxlength="4" size="3">
                                                <input type="hidden" name="poh_st_cd" value="0" id="poh_st_cd">
                                            <span id="PoSupCdErrorSpan"></span>
                                        </td>
                                        </tr>
                                        <tr>      
                                            <th>Destination</th>
                                            <td><input type="text" name="poh_dlv_dest" id="poh_dlv_dest" readonly style="text-transform: uppercase" onblur="CheckPrchsReqQty()" maxlength="36" size="20"  required>
                                            </td>     
                                            <th>
                                                Sales Tax<br>
                                                <small>
                                                    <a href="includes/view_details.php?q=salestax" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0'); return false;" >(Help)</a>
                                                </small>
                                            </th>
                                            <td>
                                                <input type="text" name="poh_stax_cd" id="poh_stax_cd" readonly required onblur="CheckPoSalTaxCd()" style="text-transform: uppercase" maxlength="3" size="1">
                                                <input type="text" name="poh_stax_per" id="poh_stax_per" readonly required  style="text-transform: uppercase" maxlength="3" size="3" onblur="setNumberDecimal(this)">    
                                                <input type="text" name="poh_stax_desc" id="poh_stax_desc" readonly required  style="text-transform: uppercase" maxlength="30" size="23">
                                            <span id="PoSalTaxErrorSpan"></span>
                                            </td>       
                                            <th>Supplier A/C</th>
                                            <td>
                                                <input type="text" name="poh_sup_accd" id="poh_sup_accd" readonly style="text-transform: uppercase" required maxlength="6" size="4">
                                                <input type="text" name="poh_sup_accd_desc" id="poh_sup_accd_desc" readonly style="text-transform: uppercase" required maxlength="36" size="23">
                                            <span id="PoSupAccCdErrorSpan"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Excise Code<br>
                                                <small>
                                                    <a href="includes/view_details.php?q=excisecd" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0'); return false;" >(Help)</a>
                                                </small>
                                            </th>
                                            <td>
                                                <input type="text" name="poh_excise_cd" id="poh_excise_cd" readonly required onblur="CheckPoExciseCd()" maxlength="3" size="3">
                                                <span id="PoExciseCdErrorSpan"></span>
                                                <input type="text" name="poh_excise_cd_desc" id="poh_excise_cd_desc" readonly required maxlength="36" size="20">
                                            </td> 
                                            <th>Discount</th>
                                            <td><input type="text" name="poh_disc" id="poh_disc" readonly required maxlenght="6" size="6" placeholder="00.00" onblur="setNumberDecimal(this)">%</td> 
                                            <th>Bank Name</th>
                                            <td><input type="text" name="poh_bank" id="poh_bank" readonly maxlength="36" size="23" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>      
                                            <th>GST Code</th>
                                            <td><input type="text" name="poh_gst_cd" id="poh_gst_cd" onblur="CheckPoGstCd()" readonly maxlength="4" size="4">
                                            <span id="PoGstCdErrorSpan"></span>
                                            </td>
                                            <th>GST %</th>
                                            <td><input type="text" name="poh_gst_per" id="poh_gst_per" readonly maxlength="4" size="4"  placeholder="0.00" onblur="setNumberDecimal(this)">%</td> 
                                            <th>IGST %</th>
                                            <td><input type="text" name="poh_igst_per" id="poh_igst_per" readonly maxlength="4" size="4"  placeholder="0.00" onblur="setNumberDecimal(this)">%</td>
                                        </tr>
                                        <tr>      
                                            <th>SGST %</th>
                                            <td><input type="text" name="poh_sgst_per" id="poh_sgst_per" readonly maxlength="4" size="4" placeholder="0.00" onblur="setNumberDecimal(this)">%</td>
                                            <th>CGST %</th>
                                            <td><input type="text" name="poh_cgst_per" id="poh_cgst_per" readonly maxlength="4" size="4"  placeholder="0.00" onblur="setNumberDecimal(this)">%</td> 
                                            <th>UGST %</th>
                                            <td><input type="text" name="poh_ugst_per" id="poh_ugst_per" readonly maxlength="4" size="4"  placeholder="0.00" onblur="setNumberDecimal(this)">%</td>
                                        </tr>
                                        <tr>      
                                            <th>Credit Days</th>
                                            <td><input type="text" name="poh_paycr_days" id="poh_paycr_days" readonly maxlength="4" size="4"  placeholder="0.00"></td>      
                                            <th>Disc.</th>
                                            <td><input type="text" name="poh_crdisc" id="poh_crdisc" readonly maxlength="4" size="4"  placeholder="0.00" onblur="setNumberDecimal(this)">%</td> 
                                            <th>Additional Remark</th>
                                            <td><input type="text" name="poh_addl_rmk" id="poh_addl_rmk" readonly style="text-transform: uppercase" maxlength="36" size="23"></td>
                                        </tr>
                                        <tr>    
                                            <th>Validation Date</th>
                                            <td><input type="text" name="poh_exp_dt" id="poh_exp_dt" readonly></td>
                                            <th>
                                                Payment Terms<br>
                                                <small>
                                                    <a href="includes/view_details.php?q=payterms" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0'); return false;" >(Help)</a>
                                                </small>
                                            </th>
                                            <td><input type="text" name="poh_pmnt_terms" id="poh_pmnt_terms" readonly maxlength="36" size="20"></td>
                                        </tr>        
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>
                                            <th>Srl No.</th>
                                            <td><input type="text" name="pod_po_srl" id="pod_po_srl" readonly maxlength="3" size="3"></td>
                                            <th>&nbsp;</th>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Item</th>
                                            <td><input type="text" name="pod_item" id="pod_item" readonly maxlength="7" size="7" onfocus="CheckPoSrlCd()" onblur="CheckPoItemCd()">
                                            <span id="PoItemErrorCd"></span>
                                            </td>
                                            <th>&nbsp;</th>
                                            <td colspan="2" rowspan="4">
                                                <span id="item_data"></span>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <th>Rate</th>
                                            <td><input type="text" name="pod_rate" id="pod_rate" readonly maxlength="10" size="10" placeholder="0.00" onblur="setNumberDecimal(this)">
                                            </td>
                                            <th>&nbsp;</th>
                                        </tr>
                                        <tr>
                                            <th>Ord Qty.</th>
                                            <td><input type="text" name="pod_ord_qty" id="pod_ord_qty" readonly value="0"  maxlength="10" size="10">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tolerance</th>
                                            <td><input type="text" name="pod_tolerance" id="pod_tolerance" readonly maxlength="5" size="5" placeholder="0.00" onblur="setNumberDecimal(this)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tech Spec.</th>
                                            <td><input type="text" name="pod_tech_spec" id="pod_tech_spec" readonly maxlength="36" size="20" style="text-transform: uppercase">
                                            </td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="form-table" id="commercialFields">
                                                    <tr>
                                                        <th colspan="3">Commercial Details<th>
                                                    </tr>
                                                    <tr>
                                                        <th>Sr</th>
                                                        <th>Id <br>
                                                            <small>
                                                                <a href="includes/view_details.php?q=com_id" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0'); return false;" >(Help)</a>
                                                            </small>
                                                        </th>
                                                        <th>Tag <br>
                                                            <small>
                                                                <a href="includes/view_details.php?q=com_tag" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0'); return false;" >(Help)</a>
                                                            </small>
                                                        </th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    <tr valign="top" id="hidePdcOnupd">
                                                        <td>
                                                            <input type="text" name="pdc_sr[]" value="1" id="pdc_sr"  maxlength="1" size="1">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="pdc_id[]" id="pdc_id"  onblur="checkCommPdcVal(this)"  maxlength="2" size="1">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="pdc_tag[]" id="pdc_tag"  maxlength="3" size="1">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="pdc_amt[]" id="pdc_amt"  maxlength="10" size="10" onblur="setNumberDecimal(this)">
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0);" id="addCommDet" class="btn btn-xs btn-success">Add New</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <span id="toUpdatePdcData"></span>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">                                               
                                                <table class="form-table" id="staggeredFields">
                                                    <tr>
                                                        <th colspan="3">Staggered Details</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Sr</th>
                                                        <th>Date</th>
                                                        <th>Quantity</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    <tr valign="top" id="hidePddOnupd">                                           
                                                        <td>
                                                            <input type="text" name="pdd_sr[]" value="1" id="pdd_sr"  maxlength="1" size="1">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="pdd_sch_dt[]" id="pdd_sch_dt" placeholder="dd-mm-yyyy" maxlength="10" size="10">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="pdd_stag_qty[]" id="pdd_stag_qty" onblur="checkCommPddVal(this)"  maxlength="10" size="10">
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0);" id="addStagDet" class="btn btn-xs btn-success">Add New</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <span id="toUpdatePddData"></span>
                                            </td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr><td>&nbsp;</td></tr>                    
                                        <tr>
                                            <td colspan="8" align="center">
                                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                                <input type="reset" name="clear" value="Clear" class="btn btn-primary">
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