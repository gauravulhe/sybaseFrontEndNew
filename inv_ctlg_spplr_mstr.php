<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $com_dbf = $_POST['user_com_dbf']; 
        $user_fduser = $_POST['user_fduser']; 

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];

        $sub_com = $_POST['sub_com'];
        $sub_unit = $_POST['sub_unit'];
        $sub_accd = $_POST['sub_accd'];
        $sub_subcd = $_POST['sub_subcd'];
        $sub_desc = strtoupper($_POST['sub_desc']);
        $sub_opbal = $_POST['sub_opbal'];
        $sub_opbaldt = $_POST['sub_opbaldt'];
        $sub_cat = strtoupper($_POST['sub_cat']);
        $sub_agetag = strtoupper($_POST['sub_agetag']);
        $sub_pancard = strtoupper($_POST['sub_pancard']);

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'submast' && $com_dbf != '' && $user_fduser != '') { 
            $query = "UPDATE $com_dbf.$user_fduser.submast set sub_desc = '$sub_desc', sub_opbal = $sub_opbal, sub_opbaldt = '$sub_opbaldt', sub_cat = '$sub_cat', sub_agetag = '$sub_agetag', sub_pancard = '$sub_pancard' where sub_com = $sub_com AND sub_unit = $sub_unit AND sub_accd = '$sub_accd' AND sub_subcd = '$sub_subcd'";

            $sql_result = odbc_exec($conn, $query);
            if ($sql_result) { 
                $success_msg = 'Record Updated Successfully.';                
            }else{ 
                $error_msg = 'Failed To Update Record, Please Try Again.';
            } 
        }else if($passActn == 'e' && $frm_nm == 'submast' && $com_dbf != '' && $user_fduser != '') { 

            $query = "SELECT * FROM $com_dbf.$user_fduser.submast WHERE sub_com = $sub_com AND sub_unit = $sub_unit AND sub_accd = '$sub_accd' AND sub_subcd = '$sub_subcd'";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { 
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO $com_dbf.$user_fduser.submast (sub_com, sub_unit, sub_accd, sub_subcd, sub_desc, sub_opbal, sub_opbaldt, sub_cat, sub_agetag, sub_pancard) VALUES ($sub_com, $sub_unit, '$sub_accd', '$sub_subcd', '$sub_desc', $sub_opbal, '$sub_opbaldt', '$sub_cat', '$sub_agetag', '$sub_pancard')";
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
                        Supplier Master
                        <small>Catalogues And Masters</small> | 
                        <small>Export To : </small>
                        <?php 
                            $dbf = trim($_SESSION['com_dbf']);
                            $fduser = trim($_SESSION['fduser']);
                        ?>
                        <a href="exports/submast_export.php?ext=doc&dbf=<?php echo $dbf; ?>&fduser=<?php echo $fduser; ?>"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/submast_export.php?ext=xls&dbf=<?php echo $dbf; ?>&fduser=<?php echo $fduser; ?>"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/submast_export.php?ext=pdf&dbf=<?php echo $dbf; ?>&fduser=<?php echo $fduser; ?>"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="submast" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="submast">
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
                                                <input type="text" name="sub_com" id="com_com" disable readonly onkeyup="CheckSubMastComCd()"  maxlength="3" size="1" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>
                                            <td colspan="2">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>
                                            </td>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>  
                                            <th>Unit Code</th>
                                            <td><input type="text" name="sub_unit" id="mat_unit" readonly maxlength="3" size="1" onblur="CheckMatMastUntCd()" required onkeyup="CheckInputNumFormat(this.value)"></td> 
                                            <td colspan="2">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span>
                                            </td>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>                                              
                                            <th>General Ledger code</th>
                                            <td><input type="text" name="sub_accd" id="sub_accd" maxlength="6" size="3" onblur="CheckSubMastGenCd()" readonly onkeyup="CheckInputNumFormat(this.value)"></td> 
                                            <td colspan="2">
                                                <span id="GenLedCdErrorSpan"></span>
                                                <span id="GenLedCdName"></span>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <th>Sub/Party code</th>
                                            <td><input type="text" name="sub_subcd" id="sub_subcd" readonly maxlength="6" size="3" onblur="CheckSubMastSubCd()" style="text-transform: uppercase"></td> 
                                            <td colspan="2">
                                                <span id="SubCdErrorSpan"></span>
                                                <span id="SubCdName"></span>
                                            </td> 
                                        </tr>
                                        <tr>       
                                            <th>Description</th>
                                            <td colspan="3"><input type="float" name="sub_desc" id="sub_desc" readonly maxlength="36" size="41" style="text-transform: uppercase"></td>  
                                        </tr>
                                        <tr>        
                                            <th>Opening Balance</th>
                                            <td><input type="float" name="sub_opbal" id="sub_opbal" readonly maxlength="12" size="10" placeholder="0.000"  onkeyup="CheckInputNumFormat(this.value)"></td>
                                            <th>Sales Tax Category</th>
                                            <td><input type="text" name="sub_cat" id="sub_cat" readonly  maxlength="1" size="1"></td>
                                        </tr>
                                        <tr>                                           
                                            <th>Opening Balance Date</th>
                                            <td><input type="text" name="sub_opbaldt" id="sub_opbaldt" readonly maxlength="15" size="15"></td>   
                                            <th>Tag For Agewise</th>
                                            <td><input type="text" name="sub_agetag" id="sub_agetag" readonly  maxlength="1" size="1" style="text-transform: uppercase"></td> 
                                        </tr>
                                        <tr>  
                                            <td colspan="2">&nbsp;</td> 
                                            <th>Pan Card No</th>
                                            <td><input type="text" name="sub_pancard" id="sub_pancard" maxlength="15" size="15" readonly style="text-transform: uppercase"></td>
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