<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $com_dbf = $_POST['user_com_dbf']; 

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];

        $mat_com = $_POST['mat_com'];
        $mat_unit = $_POST['mat_unit'];
        $mat_item = $_POST['mat_item'];
        $mat_location = $_POST['mat_location'];
        $mat_accd = $_POST['mat_accd'];
        $mat_minlev = $_POST['mat_minlev'];
        $mat_maxlev = $_POST['mat_maxlev'];
        $mat_ordlev = $_POST['mat_ordlev'];
        $mat_opdate = $_POST['mat_opdate'];
        $mat_opqty = $_POST['mat_opqty'];
        $mat_oprate = $_POST['mat_oprate'];
        $mat_abc = $_POST['mat_abc'];
        $mat_typ = $_POST['mat_typ'];
        $mat_budg = $_POST['mat_budg'];

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'matmast' && $com_dbf != '') { 
            $query = "UPDATE $com_dbf.invac.matmast set mat_location = '$mat_location', mat_accd = '$mat_accd', mat_minlev = $mat_minlev, mat_maxlev = $mat_maxlev, mat_ordlev = $mat_ordlev, mat_opdate = '$mat_opdate', mat_opqty = $mat_opqty, mat_oprate = $mat_oprate, mat_abc = '$mat_abc', mat_typ = $mat_typ, mat_budg = '$mat_budg' where mat_com = $mat_com AND mat_unit = $mat_unit AND mat_item = '$mat_item'";

            $sql_result = odbc_exec($conn, $query);
            if ($sql_result) { 
                $success_msg = 'Record Updated Successfully.';                
            }else{ 
                $error_msg = 'Failed To Update Record, Please Try Again.';
            } 
        }else if($passActn == 'e' && $frm_nm == 'matmast' && $com_dbf != '') { 

            $query = "SELECT * FROM $com_dbf.invac.matmast WHERE mat_com = $mat_com AND mat_unit = $mat_unit AND mat_item = '$mat_item'";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { 
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO $com_dbf.invac.matmast (mat_com, mat_unit, mat_item, mat_location, mat_accd, mat_minlev, mat_maxlev, mat_ordlev, mat_opdate, mat_opqty, mat_oprate, mat_abc, mat_typ, mat_budg) VALUES ($mat_com, $mat_unit, '$mat_item', '$mat_location', '$mat_accd', $mat_minlev, $mat_maxlev, $mat_ordlev, '$mat_opdate', $mat_opqty, $mat_oprate, '$mat_abc', $mat_typ, '$mat_budg')";
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
                        Material Master
                        <small>Catalogues And Masters</small> | 
                        <small>Export To : </small>
                        <?php 
                            $dbf = trim($_SESSION['com_dbf']);
                        ?>
                        <a href="exports/matmast_export.php?ext=doc&dbf=<?php echo $dbf; ?>"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/matmast_export.php?ext=xls&dbf=<?php echo $dbf; ?>"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/matmast_export.php?ext=pdf&dbf=<?php echo $dbf; ?>"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="matmast" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="matmast">
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
                                                <input type="text" name="mat_com" id="com_com" readonly onblur="CheckMatMastComCd()"  maxlength="3" size="1" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>
                                            <td colspan="2">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>
                                            </td>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>  
                                            <th>Unit Code</th>
                                            <td><input type="text" name="mat_unit" id="mat_unit" readonly maxlength="3" size="1" onblur="CheckMatMastUntCd()" required onkeyup="CheckInputNumFormat(this.value)"></td> 
                                            <td colspan="2">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span>
                                            </td>
                                            <th colspan="2">UOM</th>
                                        </tr>
                                        <tr>                                              
                                            <th>Item Code</th>
                                            <td><input type="text" name="mat_item" id="mat_item" maxlength="7" size="4" onblur="CheckMatMastItmCd()" readonly onkeyup="CheckInputNumFormat(this.value)"></td> 
                                            <td colspan="2">
                                                <span id="ComItmCdErrorSpan"></span>
                                                <span id="ComItmCdName"></span>
                                            </td>
                                            <td>
                                                <!-- <input type="text" name="mat_uom" id="mat_uom" readonly maxlength="8" size="8"> -->
                                                <p id="mat_uom" style="color:#000; background-color:#fff;"></p>
                                            </td>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>        
                                            <th>Min Qty</th>
                                            <td><input type="float" name="mat_minlev" id="mat_minlev" readonly maxlength="15" size="15" placeholder="0.000"  onkeyup="CheckInputNumFormat(this.value)"></td>
                                            <th>Location</th>
                                            <td><input type="text" name="mat_location" id="mat_location" maxlength="6" size="6" readonly onkeyup="CheckInputNumFormat(this.value)"></td>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Max Qty</th>
                                            <td><input type="float" name="mat_maxlev" id="mat_maxlev" readonly maxlength="15" size="15" placeholder="0.000" onkeyup="CheckInputNumFormat(this.value)"></td> 
                                            <th>ABC Class</th>
                                            <td><input type="text" name="mat_abc" id="mat_abc" readonly  maxlength="1" size="1" onkeyup="CheckInputNumFormat(this.value)"></td>
                                            <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr>       
                                            <th>Ord Qty</th>
                                            <td><input type="float" name="mat_ordlev" id="mat_ordlev" readonly maxlength="15" size="15" placeholder="0.000" onkeyup="CheckInputNumFormat(this.value)"></td>     
                                            <th>Type</th>
                                            <td><input type="text" name="mat_typ" id="mat_typ" readonly  maxlength="3" size="1" required onkeyup="CheckInputNumFormat(this.value)"></td> 
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>        
                                            <th>A/C Code</th>
                                            <td><input type="text" name="mat_accd" id="mat_accd" readonly  maxlength="6" size="6"  onkeyup="CheckInputNumFormat(this.value)"></td>
                                            <th>Opening Qty</th>
                                            <td><input type="text" name="mat_opqty" id="mat_opqty" readonly placeholder="0.000" maxlength="15" size="15" onkeyup="CheckInputNumFormat(this.value)"></td>        
                                            <th>Opening Rate</th>
                                            <td><input type="text" name="mat_oprate" id="mat_oprate" readonly placeholder="0.00" maxlength="15" size="15" onkeyup="CheckInputNumFormat(this.value)"></td>   
                                            <th>Opening Date</th>
                                            <td><input type="text" name="mat_opdate" id="mat_opdate" readonly maxlength="15" size="15"></td>
                                        </tr> 
                                        <tr><td colspan="8"><hr></td></tr>          
                                        <tr>                                               
                                            <th>Budget Code</th>
                                            <td><input type="text" name="mat_budg" id="mat_budg" readonly  maxlength="10" size="10"  onkeyup="CheckInputNumFormat(this.value)"></td>
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