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

        // pdcomm table fields
        $pdc_com = $_POST['poh_com'];
        $pdc_unit = $_POST['poh_unit'];
        $pdc_fyr = $_POST['poh_fyr'];
        $pdc_po_no = $_POST['poh_po_no'];
        $pdc_po_srl = $_POST['pdc_sr'];
        $pdc_id = $_POST['pdc_id'];
        $pdc_tag = $_POST['pdc_tag'];
        $pdc_amt = $_POST['pdc_amt'];
        $pdc_sys_dt = date('Y-m-d 00:00:00', strtotime($_POST['pdc_sys_dt']));

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'npdcomm') { 

            $query = "UPDATE $UserComDbf.invac.pdcomm SET pdc_com = $pdc_com, pdc_unit = $pdc_unit, pdc_fyr = $pdc_fyr, pdc_po_no = $pdc_po_no, pdc_po_srl = $pdc_po_srl, pdc_id = $pdc_id, pdc_tag = $pdc_tag, pdc_amt = $pdc_amt, pdc_sys_dt = '$pdc_sys_dt' WHERE pdc_com = $poh_com AND pdc_unit = $poh_unit AND pdc_fyr = $poh_fyr AND pdc_po_no = $poh_po_no  AND pdc_id = $pdc_id AND pdc_tag = $pdc_tag";

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
                        PO Commercial
                        <small>Purchase > Purchase / Work Order Updation</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="npdcomm" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="npdcomm">
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
                                            <th>PO No.</th>
                                            <td><input type="text" name="poh_po_no" id="poh_po_no" readonly maxlength="5" size="3" required onblur="CheckPoWoNoDetails()">
                                            </td>
                                            <td colspan="4">
                                                <span id="PoPoCdErrorSpan"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Srl No.</th>
                                            <td><input type="text" name="pdc_sr" id="pdc_sr" maxlength="3" size="3"></td>
                                        </tr>
                                        <tr>
                                            <th>Id 
                                                <small>
                                                    <a href="includes/view_details.php?q=com_id" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0'); return false;" >(Help)</a>
                                                </small>
                                            </th>
                                            <td><input type="text" name="pdc_id" id="pdc_id" maxlength="7" size="7" onblur="CheckPoPdcIdDetails()">
                                            </td>
                                            <td><span id="pdcIdDetailsErrorSpan"></span></td>
                                        </tr>
                                        <tr> 
                                            <th>Tag 
                                                <small>
                                                    <a href="includes/view_details.php?q=com_tag" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0'); return false;" >(Help)</a>
                                                </small>
                                            </th>
                                            <td><input type="text" name="pdc_tag" id="pdc_tag" readonly maxlength="10" size="10">
                                            </td>
                                            <th>&nbsp;</th>
                                        </tr>
                                        <tr>
                                            <th>Amount</th>
                                            <td><input type="text" name="pdc_amt" id="pdc_amt" readonly value="0"  maxlength="10" size="10">
                                            </td>
                                            <td><span id="WoQtyErrorCd"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Sys Date</th>
                                            <td><input type="text" name="pdc_sys_dt" id="pdc_sys_dt" readonly maxlength="10" size="10" placeholder="dd-mm-yyyy" value="<?php echo date("d-m-Y"); ?>">
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