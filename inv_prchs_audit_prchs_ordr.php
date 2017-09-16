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

        $poh_po_dt = $_POST['poh_po_dt'];
        $poh_paycr_days = strtoupper($_POST['poh_paycr_days']);
        $poh_pmnt_terms = strtoupper($_POST['poh_pmnt_terms']);
        $poh_vet_tag = 1;
        $pod_po_srl = $_POST['pod_po_srl'];
        $pdd_con = $_POST['pdd_con'];
        $poh_updid = $_SESSION['usr_id'];

        // apprmk data        
        $app_dt = date('Y-m-d 00:00:00');
        $app_tm = date('h:m');
        $app_aud_rmk = strtoupper($_POST['app_aud_rmk']);

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'b' && $frm_nm == 'apprvlpo') { 

            for ($i=0; $i < count($pod_po_srl); $i++) { 
                if ($pdd_con[$i] == 'Y' || $pdd_con[$i] == 'y') {
                    $query = "UPDATE $UserComDbf.invac.pohdr SET poh_paycr_days = $poh_paycr_days, poh_pmnt_terms = '$poh_pmnt_terms', poh_vet_tag = $poh_vet_tag, poh_updid = $poh_updid WHERE poh_com = $poh_com AND poh_unit = $poh_unit AND poh_fyr = $poh_fyr AND poh_po_no = $poh_po_no";

                    $sql_result = @odbc_exec($conn, $query);   
                    if ($sql_result) { 
                        $queryAppRmk = "INSERT INTO $UserComDbf.invac.apprmk (app_id,app_dt,app_tm,app_com,app_unit,app_fyr,app_po_no,app_po_dt,app_aud_rmk,app_usr_id,app_aud_tag,app_pocr_dys,app_pmnt_term) VALUES ($pod_po_srl[$i],'$app_dt','$app_tm',$poh_com,$poh_unit,$poh_fyr,$poh_po_no,'$poh_po_dt','$app_aud_rmk',$poh_updid,$poh_vet_tag,$poh_paycr_days,'$poh_pmnt_terms')";

                        $sql_result_app_rmk = @odbc_exec($conn, $queryAppRmk);
                    }
                }
            }



            if ($sql_result_app_rmk) {
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
                        Purchase Order Approval ( P.O. & W.O. )
                        <small>Purchase > Audit</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="apprvlpo" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="apprvlpo">
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
                                            <td colspan="2">
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
                                            <td colspan="2">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span></td>
                                            </td>    
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>
                                            <th>PO No.</th>
                                            <td>
                                                <input type="text" name="poh_po_no" id="poh_po_no" readonly maxlength="5" size="3" required>
                                            </td>                                            
                                            <th>Fin. Year</th>
                                            <td>
                                                <input type="text" name="poh_fyr" id="poh_fyr" required maxlength="4" size="1" readonly onblur="CheckPoWoNoDetails()"><br>
                                            </td>
                                            <td><span id="PoIdDetailsErrorSpan"></span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <p id="PoNoDetailsErrorSpan"></p>
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