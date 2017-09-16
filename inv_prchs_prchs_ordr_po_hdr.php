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
        $poh_userid = $_SESSION['usr_id'];

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'nporder') { 

            $query = "UPDATE $UserComDbf.invac.pohdr SET poh_po_dt = '$poh_po_dt', poh_supcd = '$poh_supcd', poh_sup_accd = '$poh_sup_accd', poh_stax_cd = $poh_stax_cd, poh_stax_per = $poh_stax_per, poh_excise_cd = $poh_excise_cd, poh_dlv_dest = '$poh_dlv_dest', poh_disc = $poh_disc, poh_paycr_days = $poh_paycr_days, poh_crdisc = $poh_crdisc, poh_bank = '$poh_bank', poh_pmnt_terms = '$poh_pmnt_terms', poh_inq_fyr = $poh_inq_fyr, poh_inq_no = $poh_inq_no, poh_po_type = $poh_po_type, poh_addl_rmk = '$poh_addl_rmk', poh_exp_dt = '$poh_exp_dt', poh_gst_cd = $poh_gst_cd, poh_gst_per = $poh_gst_per, poh_igst_per = $poh_igst_per, poh_sgst_per = $poh_sgst_per, poh_cgst_per = $poh_cgst_per, poh_ugst_per = $poh_ugst_per, poh_updid = $poh_userid, poh_userid = $poh_userid WHERE poh_com = $poh_com AND poh_unit = $poh_unit AND poh_fyr = $poh_fyr AND poh_po_no = $poh_po_no";

            $sql_result = odbc_exec($conn, $query);
                if ($sql_result) { 
                    $success_msg = 'Record Updated Successfully.';
                }else{
                    $error_msg = 'Failed To Update Record, Please Try Again.';
                }
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
                        PO Header
                        <small>Purchase > Purchase / Work Order Updation</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="nporder" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="nporder">
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
                                            <td><input type="text" name="poh_inq_no" id="poh_inq_no"  value="999999" maxlength="6" size="6" required onblur="CheckPoInqNo()" readonly onkeyup="CheckInputNumFormat(this.value)">
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