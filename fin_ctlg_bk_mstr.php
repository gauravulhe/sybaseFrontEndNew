<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $com_dbf = $_POST['user_com_dbf']; 
        $user_fduser = $_POST['user_fduser']; 

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];

        $bkm_com = $_POST['bkm_com'];
        $bkm_unit = $_POST['bkm_unit'];
        $bkm_code = $_POST['bkm_code'];
        $bkm_desc = strtoupper($_POST['bkm_desc']);
        $bkm_accd = $_POST['bkm_accd'];
        $bkm_opbal = $_POST['bkm_opbal'];
        $bkm_baldt = $_POST['bkm_baldt'];
        $bkm_prefix = strtoupper($_POST['bkm_prefix']);

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'bkmast' && $com_dbf != '' && $user_fduser != '') { 
            $query = "UPDATE $com_dbf.$user_fduser.bkmast set bkm_opbal = $bkm_opbal, bkm_baldt = '$bkm_baldt', bkm_desc = '$bkm_desc', bkm_accd = '$bkm_accd', bkm_prefix = '$bkm_prefix' where bkm_com = $bkm_com AND bkm_unit = $bkm_unit AND bkm_code = $bkm_code";

            $sql_result = odbc_exec($conn, $query);
            if ($sql_result) { 
                $success_msg = 'Record Updated Successfully.';                
            }else{ 
                $error_msg = 'Failed To Update Record, Please Try Again.';
            } 
        }else if($passActn == 'e' && $frm_nm == 'bkmast' && $com_dbf != '' && $user_fduser != '') { 

            $query = "SELECT * FROM $com_dbf.$user_fduser.bkmast WHERE bkm_com = $bkm_com AND bkm_unit = $bkm_unit AND bkm_code = $bkm_code";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { 
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO $com_dbf.$user_fduser.bkmast (bkm_com, bkm_unit, bkm_code, bkm_opbal, bkm_baldt, bkm_desc, bkm_accd, bkm_prefix) VALUES ($bkm_com, $bkm_unit, $bkm_code, $bkm_opbal, '$bkm_baldt', '$bkm_desc', '$bkm_accd', '$bkm_prefix')";
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
                        Accounts Master
                        <small>Catalogues And Masters</small> | 
                        <small>Export To : </small>
                        <?php 
                            $dbf = trim($_SESSION['com_dbf']);
                            $fduser = trim($_SESSION['fduser']);
                        ?>
                        <a href="exports/bkmast_export.php?ext=doc&dbf=<?php echo $dbf; ?>&fduser=<?php echo $fduser; ?>"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/bkmast_export.php?ext=xls&dbf=<?php echo $dbf; ?>&fduser=<?php echo $fduser; ?>"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/bkmast_export.php?ext=pdf&dbf=<?php echo $dbf; ?>&fduser=<?php echo $fduser; ?>"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="bkmast" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="bkmast">
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
                                                <input type="text" name="bkm_com" id="com_com" disable readonly onkeyup="CheckSubMastComCd()"  maxlength="3" size="1" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>
                                            <td colspan="2">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>
                                            </td>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>  
                                            <th>Unit Code</th>
                                            <td><input type="text" name="bkm_unit" id="mat_unit" readonly maxlength="3" size="1" onblur="CheckMatMastUntCd()" required onkeyup="CheckInputNumFormat(this.value)"></td> 
                                            <td colspan="2">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span>
                                            </td>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>                                              
                                            <th>Book code</th>
                                            <td><input type="text" name="bkm_code" id="bkm_code" maxlength="3" size="3" onblur="CheckBkMastBkCd()" readonly onkeyup="CheckInputNumFormat(this.value)" required></td> 
                                            <td colspan="2">
                                                <span id="BkMastBkCdErrorSpan"></span>
                                                <span id="BkMastBkCdName"></span>
                                            </td> 
                                        </tr>
                                        <tr>      
                                            <th>Description</th>
                                            <td><input type="text" name="bkm_desc" id="bkm_desc" readonly maxlength="36" size="30" style="text-transform: uppercase" required></td> 
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>  
                                            <th>A/C Code</th>
                                            <td><input type="text" name="bkm_accd" id="bkm_accd" readonly  maxlength="6" size="6" onblur="CheckBkMastAcCd()" style="text-transform: uppercase" onkeyup="CheckInputNumFormat(this.value)" required></td> 
                                            <td colspan="2">
                                                <span id="BkMastAcCdErrorSpan"></span>
                                                <span id="BkMastAcCdName"></span>
                                            </td> 
                                        </tr>
                                        <tr> 
                                            <th>Opening Balance</th>
                                            <td><input type="text" name="bkm_opbal" id="bkm_opbal" readonly maxlength="15" size="10"  placeholder="0.000" onblur="CheckSubMastSubCd()" style="text-transform: uppercase" onkeyup="CheckInputNumFormat(this.value)" required></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>      
                                            <th>Opening Date</th>
                                            <td><input type="text" name="bkm_baldt" id="bkm_baldt" readonly maxlength="15" size="15" required></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <th>Prefix</th>
                                            <td><input type="text" name="bkm_prefix" id="bkm_prefix" readonly  style="text-transform: uppercase" maxlength="3" size="1" required></td>
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