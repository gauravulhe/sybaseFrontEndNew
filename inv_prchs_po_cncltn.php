<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');    

    if (!empty($_POST['submit'])) {

        //print_r($_POST);exit;

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $com_com = $_POST['poh_com'];
        $UserComDbf = trim($_POST['user_com_dbf']);

        // table fields
        $pod_com = $_POST['poh_com'];
        $pod_unit = $_POST['poh_unit'];
        $pod_fyr = $_POST['pod_fyr'];
        $pod_po_srl = $_POST['pod_po_srl'];
        $pod_item = $_POST['pod_item'];   
        $pod_can_qty = $_POST['pod_ord_qty'];
        $pod_usrid = $_SESSION['usr_id'];
        $pod_entdt = date('Y-m-d h:m:s');
        $pod_sure = $_POST['pod_sure'];
        // print_r($_POST);
        
        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'c' && $frm_nm == 'pocancel') { 

            if ($pod_sure == 'Y' || $pod_sure == 'y') {
                for ($i=0; $i < count($pod_po_srl); $i++) { 

                    $query2 = "UPDATE $UserComDbf.invac.podet SET pod_can_qty = $pod_can_qty[$i] WHERE pod_com = $pod_com AND pod_unit = $pod_unit AND pod_fyr = $pod_fyr[$i] AND pod_po_srl = $pod_po_srl[$i] AND pod_item = '$pod_item[$i]'";

                    $sql_result2 = odbc_exec($conn, $query2);

                }
            }

            if ($sql_result2) { 
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
                        Purchase Order Cancelation
                        <small>Purchase</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="pocancel" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="pocancel">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="6" size="1">
                                            </td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <span id="InpReqPassErrorSpan"></span>
                                                <span id="ComPassErrorSpan"></span>
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
                                            <td>&nbsp;</td>  
                                            <td colspan="5">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>
                                            </td>  
                                        </tr>
                                        <tr>           
                                            <th>Unit Code</th>
                                            <td>
                                                <input type="text" name="poh_unit" id="mat_unit" readonly maxlength="3" size="1" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            </td>
                                            <td>&nbsp;</td>
                                            <td colspan="5">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span></td>
                                            </td>    
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>
                                            <th>PO No</th>
                                            <td colspan="">
                                                <input type="text" name="poh_po_no" id="poh_po_no" readonly maxlength="7" size="7" required>
                                            </td>
                                            <th>Year</th>
                                            <td colspan="">
                                                <input type="text" name="poh_fyr" id="poh_fyr" readonly maxlength="4" size="4" required onblur="CheckPoCancelDetails()">
                                            </td>
                                            <th>PO Date</th>
                                            <td colspan="">
                                                <input type="text" name="poh_po_dt" id="po_dt" readonly maxlength="10" size="10" required>
                                            </td>
                                            <th>Sup Cd</th>
                                            <td colspan="">
                                                <input type="text" name="poh_supcd" id="poh_supcd" readonly maxlength="10" size="10" required>
                                            </td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>
                                            <td colspan="6">
                                                <span id="PoCancelErrorSpan"></span>
                                                <p id="pohPoCancelErrorSpan"></p>
                                            </td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr class="submit-clear">
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