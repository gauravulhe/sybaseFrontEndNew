<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $com_dbf = $_POST['user_com_dbf']; 
        $user_fduser = $_POST['user_fduser']; 

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];

        $acm_com = $_POST['acm_com'];
        $acm_unit = $_POST['acm_unit'];
        $acm_accd = $_POST['acm_accd'];
        $acm_opbal = $_POST['acm_opbal'];
        $acm_baldt = strtoupper($_POST['acm_baldt']);
        $acm_bal = $_POST['acm_bal'];
        $acm_sublink = strtoupper($_POST['acm_sublink']);
        $acm_sch = strtoupper($_POST['acm_sch']);
        $acm_schsrl = strtoupper($_POST['acm_schsrl']);
        $acm_prtag = strtoupper($_POST['acm_prtag']);
        $acm_budget = $_POST['acm_budget'];
        $acm_sysdt = date('Y-m-d 00:00:00');

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'acmast' && $com_dbf != '' && $user_fduser != '') { 
            $query = "UPDATE $com_dbf.$user_fduser.acmast set acm_opbal = $acm_opbal, acm_baldt = '$acm_baldt', acm_bal = $acm_bal, acm_sublink = '$acm_sublink', acm_sch = '$acm_sch', acm_schsrl = $acm_schsrl, acm_budget = '$acm_budget', acm_prtag = '$acm_prtag', acm_sysdt = '$acm_sysdt' where acm_com = $acm_com AND acm_unit = $acm_unit AND acm_accd = '$acm_accd'";

            $sql_result = odbc_exec($conn, $query);
            if ($sql_result) { 
                $success_msg = 'Record Updated Successfully.';                
            }else{ 
                $error_msg = 'Failed To Update Record, Please Try Again.';
            } 
        }else if($passActn == 'e' && $frm_nm == 'acmast' && $com_dbf != '' && $user_fduser != '') { 

            $query = "SELECT * FROM $com_dbf.$user_fduser.acmast WHERE acm_com = $acm_com AND acm_unit = $acm_unit AND acm_accd = '$acm_accd'";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { 
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO $com_dbf.$user_fduser.acmast (acm_com, acm_unit, acm_accd, acm_opbal, acm_baldt, acm_bal, acm_sublink, acm_sch, acm_schsrl, acm_budget, acm_prtag, acm_sysdt) VALUES ($acm_com, $acm_unit, '$acm_accd', $acm_opbal, '$acm_baldt', $acm_bal, '$acm_sublink', '$acm_sch', $acm_schsrl, '$acm_budget', '$acm_prtag', '$acm_sysdt')";
                //echo $query;
                $sql_result = odbc_exec($conn, $query);
                
                if ($sql_result) {
                    $success_msg = 'New Record Saved Successfully.';
                }
            }
        }else{ 
        
            $error_msg = "Failed To Saved. Database for This Company Code May Not Be Exists.";
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
            <!-- Left side column. contains the logo and sidebar -->
            <!-- <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <?php //require_once('includes/dash_sidebar.php'); ?>
                </section>
            </aside> -->

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Accounts Master
                        <small>Catalogues And Masters</small> | 
                        <small>Export To : </small>
                        <?php 
                            $dbf = trim($_SESSION['com_dbf']);
                            $fduser = trim($_SESSION['fduser']);
                        ?>
                        <a href="exports/acmast_export.php?ext=doc&dbf=<?php echo $dbf; ?>&fduser=<?php echo $fduser; ?>"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/acmast_export.php?ext=xls&dbf=<?php echo $dbf; ?>&fduser=<?php echo $fduser; ?>"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/acmast_export.php?ext=pdf&dbf=<?php echo $dbf; ?>&fduser=<?php echo $fduser; ?>"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="acmast" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="acmast">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" maxlength="6" size="1" required>
                                            </td>
                                            <td colspan="2">
                                                <span id="ComPassErrorSpan"></span>
                                            </td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>                                     
                                            <th>Company</th>
                                            <td>
                                                <input type="hidden" name="user_com_cd" id="user_com_cd" value="<?php echo $_SESSION['com_cd']; ?>">
                                                <input type="hidden" name="user_com_dbf" id="user_com_dbf" value="<?php echo $_SESSION['com_dbf']; ?>">
                                                <input type="hidden" name="user_fduser" id="user_fduser" value="<?php echo $_SESSION['fduser']; ?>">
                                                <input type="text" name="acm_com" id="com_com" disable readonly onkeyup="CheckSubMastComCd()"  maxlength="3" size="1" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>
                                            <td colspan="2">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>
                                            </td>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>  
                                            <th>Unit Code</th>
                                            <td><input type="text" name="acm_unit" id="mat_unit" readonly maxlength="3" size="1" onblur="CheckMatMastUntCd()" required onkeyup="CheckInputNumFormat(this.value)"></td> 
                                            <td colspan="2">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span>
                                            </td>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>                                              
                                            <th>Account code</th>
                                            <td><input type="text" name="acm_accd" id="acm_accd" maxlength="6" size="3" onblur="CheckAccMastGenCd()" readonly onkeyup="CheckInputNumFormat(this.value)"></td> 
                                            <td colspan="2">
                                                <span id="AccMstrCdErrorSpan"></span>
                                                <span id="AccMstrCdName"></span>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <th>Opening Balance</th>
                                            <td><input type="text" name="acm_opbal" id="acm_opbal" readonly maxlength="13" size="10"  placeholder="0.000" onblur="CheckSubMastSubCd()" style="text-transform: uppercase" onkeyup="CheckInputNumFormat(this.value)"></td>  
                                            <th>Schedule code</th>
                                            <td><input type="text" name="acm_sch" id="acm_sch" readonly  maxlength="3" size="1"></td>
                                        </tr>
                                        <tr>       
                                            <th>Balance Date</th>
                                            <td><input type="float" name="acm_baldt" id="acm_baldt" readonly maxlength="15" size="15" style="text-transform: uppercase"></td>   
                                            <th>Schedule Sr. No.</th>
                                            <td><input type="text" name="acm_schsrl" id="acm_schsrl" readonly  maxlength="6" size="6" style="text-transform: uppercase" onkeyup="CheckInputNumFormat(this.value)"></td>
                                        </tr>
                                        <tr>        
                                            <th>Balance</th>
                                            <td><input type="float" name="acm_bal" id="acm_bal" readonly maxlength="13" size="10" placeholder="0.000"  onkeyup="CheckInputNumFormat(this.value)"></td> 
                                            <th>Budget code</th>
                                            <td><input type="text" name="acm_budget" id="acm_budget" maxlength="20" size="15" readonly style="text-transform: uppercase"></td> 
                                        </tr>
                                        <tr>                                           
                                            <th>Sub ledger link ?(Y/N)</th>
                                            <td><input type="text" name="acm_sublink" id="acm_sublink" readonly maxlength="1" size="1" style="text-transform: uppercase"></td> 
                                            <th>Suppress Print ?(Y/N)</th>
                                            <td><input type="text" name="acm_prtag" id="acm_prtag" maxlength="1" size="1" readonly style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>         
                                        <tr>      
                                            <td colspan="4" align="center">
                                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                                <input type="reset" name="clear" value="Clear" class="btn btn-primary">
                                            </td> 
                                            <td colspan="2">&nbsp;</td>
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