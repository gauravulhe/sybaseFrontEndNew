<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $com_dbf = $_POST['user_com_dbf']; 
        $user_fduser = $_POST['user_fduser']; 

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];

        $bud_com = $_POST['bud_com'];
        $bud_unit = $_POST['bud_unit'];
        $bud_yy = $_POST['bud_yy'];
        $bud_mm = $_POST['bud_mm'];
        $bud_accd = $_POST['bud_accd'];
        $bud_subcd = $_POST['bud_subcd'];
        $bud_bud_amt = $_POST['bud_bud_amt'];
        $bud_act_amt = $_POST['bud_act_amt'];
        $bud_sublink = strtoupper($_POST['bud_sublink']);        
        $user_id = $_SESSION['usr_id'];
        $date = date('Y-m-d 00:00:00'); 

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'budgmast' && $com_dbf != '' && $user_fduser != '') {
            $query = "UPDATE $com_dbf.$user_fduser.budgmast set bud_yy = $bud_yy, bud_mm = $bud_mm, bud_subcd = '$bud_subcd', bud_bud_amt = $bud_bud_amt, bud_act_amt = $bud_act_amt, bud_sublink = '$bud_sublink', bud_updid = $user_id, bud_upddt = '$date' where bud_com = $bud_com AND bud_unit = $bud_unit AND bud_accd = '$bud_accd'";

            $sql_result = odbc_exec($conn, $query);
            if ($sql_result) { 
                $success_msg = 'Record Updated Successfully.';                
            }else{ 
                $error_msg = 'Failed To Update Record, Please Try Again.';
            } 
        }else if($passActn == 'e' && $frm_nm == 'budgmast' && $com_dbf != '' && $user_fduser != '') { 

            $query = "SELECT * FROM $com_dbf.$user_fduser.budgmast WHERE bud_com = $bud_com AND bud_unit = $bud_unit AND bud_accd = '$bud_accd'";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { 
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO $com_dbf.$user_fduser.budgmast (bud_com, bud_unit, bud_yy, bud_mm, bud_accd, bud_subcd, bud_bud_amt, bud_act_amt, bud_sublink, bud_entid, bud_entdt) VALUES ($bud_com, $bud_unit, $bud_yy, $bud_mm, '$bud_accd', '$bud_subcd', $bud_bud_amt, $bud_act_amt, '$bud_sublink', $user_id, '$date')";
                //echo $query;
                $sql_result = odbc_exec($conn, $query);
                
                if ($sql_result) {
                    $success_msg = 'New Record Saved Successfully.';
                }
            }
        }else{ 
        
            $error_msg = "Failed To Saved. Database for This Company Code May Not Be Exists.";
        }
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
                        Budget Master
                        <small>Catalogues And Masters</small> | 
                        <small>Export To : </small>
                        <?php 
                            $dbf = trim($_SESSION['com_dbf']);
                            $fduser = trim($_SESSION['fduser']);
                        ?>
                        <a href="exports/budgmast_export.php?ext=doc&dbf=<?php echo $dbf; ?>&fduser=<?php echo $fduser; ?>"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/budgmast_export.php?ext=xls&dbf=<?php echo $dbf; ?>&fduser=<?php echo $fduser; ?>"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/budgmast_export.php?ext=pdf&dbf=<?php echo $dbf; ?>&fduser=<?php echo $fduser; ?>"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="budgmast" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="budgmast">
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
                                                <input type="text" name="bud_com" id="com_com" disable readonly onkeyup="CheckSubMastComCd()"  maxlength="3" size="1" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>
                                            <td colspan="2">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>
                                            </td>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>  
                                            <th>Unit Code</th>
                                            <td><input type="text" name="bud_unit" id="mat_unit" readonly maxlength="3" size="1" onblur="CheckMatMastUntCd()" required onkeyup="CheckInputNumFormat(this.value)"></td> 
                                            <td colspan="2">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span>
                                            </td>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>                                              
                                            <th>Account code</th>
                                            <td><input type="text" name="bud_accd" id="bud_accd" maxlength="6" size="3" onblur="CheckBdgtMastAcCd()" readonly onkeyup="CheckInputNumFormat(this.value)" required></td> 
                                            <td colspan="2">
                                                <span id="BdgtMastAcCdErrorSpan"></span>
                                            </td> 
                                        </tr>
                                        <tr>      
                                            <th>Year</th>
                                            <td><input type="text" name="bud_yy" id="bud_yy" readonly maxlength="4" size="1" style="text-transform: uppercase" onkeyup="CheckInputNumFormat(this.value)" required></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <th>Month</th>
                                            <td><input type="text" name="bud_mm" id="bud_mm" readonly  style="text-transform: uppercase" onkeyup="CheckInputNumFormat(this.value)" maxlength="2" size="1" required></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>      
                                            <th>Sub Accd Code</th>
                                            <td><input type="text" name="bud_subcd" id="bud_subcd" readonly maxlength="6" size="3" style="text-transform: uppercase" onblur="CheckBkMastSubAccCd()" onkeyup="CheckInputNumFormat(this.value)" required></td>
                                            <td colspan="2">
                                                <span id="BkMastSubAccCdErrorSpan"></span>
                                            </td> 
                                        </tr>
                                        <tr>  
                                            <th>Budget Amount</th>
                                            <td><input type="text" name="bud_bud_amt" id="bud_bud_amt" readonly maxlength="15" size="10"  placeholder="0.000" style="text-transform: uppercase" onkeyup="CheckInputNumFormat(this.value)" required></td>
                                            <td colspan="2"></td> 
                                        </tr>
                                        <tr> 
                                            <th>Actual Amount</th>
                                            <td><input type="text" name="bud_act_amt" id="bud_act_amt" readonly maxlength="15" size="10"  placeholder="0.000" style="text-transform: uppercase" onkeyup="CheckInputNumFormat(this.value)" required></td>
                                            <td colspan="2"></td>
                                        </tr>                                        
                                        <tr>      
                                            <th>Sub Link</th>
                                            <td><input type="text" name="bud_sublink" id="bud_sublink" readonly maxlength="1" size="1" style="text-transform: uppercase" required></td> 
                                            <td colspan="2"></td>
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