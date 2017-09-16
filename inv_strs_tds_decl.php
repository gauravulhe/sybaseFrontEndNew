<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');    

    if (!empty($_POST['submit'])) {

        //print_r($_POST);exit;

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $com_com = $_POST['dec_com'];
        $UserComDbf = trim($_POST['user_com_dbf']);

        // table fields
        $dec_com = $_POST['dec_com'];
        $dec_unit = $_POST['dec_unit'];
        $dec_fyr = $_POST['dec_fyr'];
        $dec_panno = strtoupper($_POST['dec_panno']);
        $dec_name = strtoupper($_POST['dec_name']);
        $dec_frdt = date('Y-m-d', strtotime($_POST['dec_frdt']));
        $dec_todt = date('Y-m-d', strtotime($_POST['dec_todt']));
        $dec_sys_dt = date('Y-m-d h:m:s');
        //print_r($_POST);exit;
        
        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'decltds') { 
            
            $query = "UPDATE catalog..decltds set dec_name = '$dec_name', dec_sys_dt = '$dec_sys_dt' WHERE dec_com = $dec_com AND dec_unit = $dec_unit AND dec_fyr = $dec_fyr AND dec_panno = '$dec_panno'";

            $sql_result = odbc_exec($conn, $query);
            
            if ($sql_result) { 
                $success_msg = 'Record Updated Successfully.';
            }else{
                $error_msg = 'Failed To Update Record, Please Try Again.';
            }            

            }else if($passActn == 'e' && $frm_nm == 'decltds') {

            $query = "SELECT * FROM catalog..decltds WHERE dec_com = $dec_com AND dec_unit = $dec_unit AND dec_fyr = $dec_fyr AND dec_panno = '$dec_panno'";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { 
                $success_msg = 'Record Already Exists.';
            }else{

                $query = "INSERT INTO catalog..decltds (dec_com,dec_unit,dec_fyr,dec_panno,dec_name,dec_frdt,dec_todt,dec_sys_dt) VALUES ($dec_com,$dec_unit,$dec_fyr,'$dec_panno','$dec_name','$dec_frdt','$dec_todt','$dec_sys_dt')";
                $sql_result = odbc_exec($conn, $query);
                    
                if ($sql_result) { 
                    $success_msg = 'Record Added Successfully.';
                }else{
                    $error_msg = 'Failed To Update Record, Please Try Again.';
                }
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
                        TDS Declaration
                        <small>Stores</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="decltds" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="decltds">
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
                                                <input type="text" name="dec_com" id="com_com" readonly maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
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
                                                <input type="text" name="dec_unit" id="mat_unit" readonly maxlength="3" size="1" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            </td>
                                            <td>&nbsp;</td>
                                            <td colspan="5">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span></td>
                                            </td>    
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>
                                            <th>Year</th>
                                            <td colspan="">
                                                <input type="text" name="dec_fyr" id="dec_fyr"  maxlength="4" size="1" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>PAN Card</th>
                                            <td colspan="">
                                                <input type="text" name="dec_panno" id="dec_panno"  maxlength="15" size="10" required  onblur="CheckTdsDeclDetails()" style="text-transform: uppercase">
                                            </td>
                                            <td>&nbsp;</td>
                                            <td colspan="5">
                                                <span id="TdsDecErrorSpan"></span>
                                            </td>    
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td colspan="">
                                                <input type="text" name="dec_name" id="dec_name"  maxlength="36" size="20" required style="text-transform: uppercase">
                                            </td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>
                                            <th>From Date</th>
                                            <td colspan="">
                                                <input type="text" name="dec_frdt" id="dec_dt" readonly value="<?php echo date('01-04-Y'); ?>" maxlength="10" size="10" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>To Date</th>
                                            <td colspan="">
                                                <input type="text" name="dec_todt" value="<?php echo date('31-03-Y', strtotime("+12 months")); ?>" id="dec_dt" readonly maxlength="10" size="10" required>
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