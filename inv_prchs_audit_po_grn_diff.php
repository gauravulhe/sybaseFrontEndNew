<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');    

    if (!empty($_POST['submit'])) {

        //print_r($_POST);exit;

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $com_com = $_POST['grh_com'];
        $UserComDbf = trim($_POST['user_com_dbf']);

        // table fields
        $pgd_com = $_POST['grh_com'];
        $pgd_unit = $_POST['grh_unit'];
        $pgd_fyr = $_POST['grh_fyr'];
        $pgd_grn_no = $_POST['grh_no'];        
        $pgd_grn_dt = date('Y-m-d 00:00:00', strtotime($_POST['grh_dt']));
        $pgd_po_no = $_POST['grd_po_no'];
        $pgd_po_fyr = $_POST['grd_po_fyr'];
        $pgd_po_srl = $_POST['grd_po_srl'];
        $pgd_grn_srl = $_POST['grd_srl'];
        $pgd_rmk = strtoupper($_POST['pgd_rmk']);
        $pgd_po_rate = $_POST['po_rate'];
        $pgd_grn_rate = $_POST['grn_rate'];
        $pgd_usrid = $_SESSION['usr_id'];
        $pgd_entdt = date('Y-m-d h:m:s');
        $pgd_item = $_POST['grd_item'];   
        $grn_con = $_POST['grn_con'];
        // print_r($_POST);
        
        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'p' && $frm_nm == 'pogrtdif') { 

            for ($i=0; $i < count($pgd_po_srl); $i++) { 
                if ($grn_con[$i] == 'Y' || $grn_con[$i] == 'y') {
                    $pgd_po_rate[$i] = number_format($pgd_po_rate[$i], 2);
                    $pgd_grn_rate[$i] = number_format($pgd_grn_rate[$i], 2);
                    $query1 = "INSERT INTO $UserComDbf.invac.pogrdfrmk (pgd_com,pgd_unit,pgd_fyr,pgd_grn_dt,pgd_grn_no,pgd_grn_srl,pgd_po_fyr,pgd_po_no,pgd_po_srl,pgd_rmk,pgd_po_rate,pgd_grn_rate,pgd_usrid,pgd_entdt) VALUES ($pgd_com,$pgd_unit,$pgd_fyr,'$pgd_grn_dt',$pgd_grn_no,$pgd_grn_srl[$i],$pgd_po_fyr[$i],$pgd_po_no[$i],$pgd_po_srl[$i],'$pgd_rmk',$pgd_po_rate[$i],$pgd_grn_rate[$i],$pgd_usrid,'$pgd_entdt')";

                    $sql_result1 = odbc_exec($conn, $query1);

                    if ($sql_result1) {
                        $query2 = "UPDATE $UserComDbf.invac.grdet SET grd_cbldtag = 'Y', grd_upd_dt = '$pgd_entdt' WHERE grd_com = $pgd_com AND grd_unit = $pgd_unit AND grd_no = $pgd_grn_no AND grd_fyr = $pgd_fyr AND grd_dt = '$pgd_grn_dt' AND grd_srl = $pgd_grn_srl[$i] AND grd_po_fyr = $pgd_po_fyr[$i] AND grd_po_no = $pgd_po_no[$i] AND grd_po_srl = $pgd_po_srl[$i] AND grd_item = '$pgd_item[$i]'";

                        $sql_result2 = odbc_exec($conn, $query2);
                    }

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
                        PO / GRN Differencial Rate Audit
                        <small>Purchase > Audit > PO Grn Rate Diff.</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="pogrtdif" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="pogrtdif">
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
                                                <input type="text" name="grh_com" id="com_com" readonly maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>                                            
                                            <td>&nbsp;</td>  
                                            <td colspan="2">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>
                                            </td>  
                                        </tr>
                                        <tr>           
                                            <th>Unit Code</th>
                                            <td>
                                                <input type="text" name="grh_unit" id="mat_unit" readonly maxlength="3" size="1" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            </td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span></td>
                                            </td>    
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>     
                                            <th>Fin. Year</th>
                                            <td>
                                                <input type="text" name="grh_fyr" id="grh_fyr" required maxlength="4" size="1" readonly>
                                            </td>
                                            <th>GRN No.</th>
                                            <td>
                                                <input type="text" name="grh_no" id="grh_no" maxlength="5" size="3" required>
                                            </td>
                                            <th>GRN Date</th>
                                            <td colspan="">
                                                <input type="text" name="grh_dt" id="grh_dt" readonly maxlength="10" size="10" required onchange="CheckGrnPoNoRateDiffDetails()">
                                            </td>
                                            <td><span id="grnNoDetailsErrorSpan"></span></td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>
                                            <td colspan="6">
                                                <p id="podGrnNoDetailsErrorSpan"></p>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <th valign="top">Remarks</th>
                                            <td colspan="6">
                                                <textarea name="pgd_rmk" id="pgd_rmk" required style="text-transform: uppercase" cols="50" rows="2" readonly></textarea>
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