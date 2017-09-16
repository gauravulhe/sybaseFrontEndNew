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

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'npddet') { 

            $query = "UPDATE $UserComDbf.invac.podet SET pod_com = $pod_com, pod_unit = $pod_unit, pod_fyr = $pod_fyr, pod_po_no = $pod_po_no, pod_po_srl = $pod_po_srl, pod_item = '$pod_item', pod_tech_spec = '$pod_tech_spec', pod_rate = $pod_rate, pod_ord_qty = $pod_ord_qty, pod_tolerance = $pod_tolerance WHERE pod_com = $poh_com AND pod_unit = $poh_unit AND pod_fyr = $poh_fyr AND pod_po_no = $poh_po_no  AND pod_po_srl = $pod_po_srl";

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
                        PO Details
                        <small>Purchase > Purchase / Work Order Updation</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="npddet" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="npddet">
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
                                            <td><input type="text" name="poh_inq_fyr" id="poh_fyr1" readonly maxlength="4" size="3" style="text-transform: uppercase">
                                        </tr>
                                        <tr>           
                                            <th>PO No.</th>
                                            <td><input type="text" name="poh_po_no" id="poh_po_no" readonly maxlength="5" size="3" required onblur="CheckPoWoNoDetails()">
                                            </td>
                                            <td colspan="4">                                                
                                                <span id="PoPoCdErrorSpan"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Srl No.</th>
                                            <td><input type="text" name="pod_po_srl" id="pod_po_srl" readonly maxlength="3" size="3" onblur="CheckPoPoDetDetails()"></td>
                                            <td><span id="podSrlNoDetailsErrorSpan"></span></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Item</th>
                                            <td><input type="text" name="pod_item" id="pod_item" readonly maxlength="7" size="7"onblur="CheckWoItemNo()">
                                            </td>
                                            <td><span id="WoItemErrorCd"></span></td>
                                        </tr>
                                        <tr> 
                                            <th>Rate</th>
                                            <td><input type="text" name="pod_rate" id="pod_rate" readonly maxlength="10" size="10" placeholder="0.00" onblur="setNumberDecimal(this)">
                                            </td>
                                            <th>&nbsp;</th>
                                        </tr>
                                        <tr>
                                            <th>Ord Qty.</th>
                                            <td>
                                                <input type="hidden" name="pod_ord_qty_old" id="pod_ord_qty_old" readonly value="0"  maxlength="10" size="10">
                                                <input type="text" name="pod_ord_qty" id="pod_ord_qty" readonly value="0"  maxlength="10" size="10" onblur="CalPoDetOrdBalQty(this)">
                                            </td>
                                            <td><span id="WoQtyErrorCd"></span></td>
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
                                        <tr>
                                            <th>Bal Qty</th>
                                            <td><input type="text" name="pod_bal_qty" id="pod_bal_qty" value="0.00" maxlength="10" size="10" style="text-transform: uppercase">
                                            </td>                                            
                                            <th>Total</th>
                                            <td><input type="text" name="pod_total_qty" id="pod_total_qty" value="0.00" maxlength="10" size="10" style="text-transform: uppercase">
                                            </td>
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