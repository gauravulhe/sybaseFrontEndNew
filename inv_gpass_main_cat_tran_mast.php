<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {
        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $UserComDbf = $_POST['user_com_dbf'];

        $gp_tran_cd = $_POST['gp_tran_cd'];
        $gp_tran_name = strtoupper($_POST['gp_tran_name']);
        $gp_tran_type = strtoupper($_POST['gp_tran_type']);

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'gateent') { 
            $query = "UPDATE $UserComDbf.invac.gptran set gp_tran_name = '$gp_tran_name', gp_tran_type = '$gp_tran_type' where gp_tran_cd = $gp_tran_cd";

            $sql_result = odbc_exec($conn, $query);
            if ($sql_result) { 
                $success_msg = 'Record Updated Successfully.';                
            }else{ 
                $error_msg = 'Failed To Update Record, Please Try Again.';
            }    
        }else if($passActn == 'e' && $frm_nm == 'gateent') {

            $query = "SELECT * FROM $UserComDbf.invac.gptran WHERE gp_tran_cd = $gp_tran_cd";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { 
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO $UserComDbf.invac.gptran (gp_tran_cd, gp_tran_name, gp_tran_type) VALUES ($gp_tran_cd, '$gp_tran_name', '$gp_tran_type')";
                $sql_result = odbc_exec($conn, $query);
                
                if ($sql_result) { 
                    $success_msg = 'New Record Saved Successfully.';
                }
            }
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
                        Transaction Master
                        <small>Gate Pass</small> | 
                        <small>Export To : </small>
                        <a href="exports/tran_export.php?ext=doc&dbf=<?php echo $_SESSION['com_dbf']; ?>"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/tran_export.php?ext=xls&dbf=<?php echo $_SESSION['com_dbf']; ?>"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/itmcat_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a>  -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="gstuploads" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="gateent">
                                                <input type="hidden" name="user_com_dbf" id="user_com_dbf" value="<?php echo $_SESSION['com_dbf']; ?>">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="6" size="1">
                                                <span id="ComPassErrorSpan"></span>
                                            </td>                                 
                                        </tr>
                                        <tr><td colspan="4"><hr></td></tr>
                                        <tr>                                            
                                            <th>Transaction code</th>
                                            <td><input type="text" name="gp_tran_cd" id="gp_tran_cd" maxlength="3" size="2" required onblur="CheckGpTranCd()" >
                                            <span id="TranCdErrorSpan"></span>
                                            </td>
                                        </tr>
                                        <tr>                                            
                                            <th>Description</th>
                                            <td><input type="text" name="gp_tran_name" id="gp_tran_name" maxlength="36" size="30" required  style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>Type </th>
                                            <td><input type="text" name="gp_tran_type" id="gp_tran_type"  required maxlength="1" size="1" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr><td colspan="4"><hr></td></tr>
                                    </table>
                                    <table cellpadding="1">                    
                                        <tr>  
                                            <td align="center">
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