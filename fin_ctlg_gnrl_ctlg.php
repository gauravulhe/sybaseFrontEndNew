<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $gen_accd = $_POST['gen_accd'];
        $gen_desc = strtoupper($_POST['gen_desc']);

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'gencat') { 
            $query = "UPDATE catalog..gencat set gen_desc = '$gen_desc' where gen_accd = '$gen_accd'";

           $sql_result = odbc_exec($conn, $query);
           if ($sql_result) { 
                $success_msg = 'Record Updated Successfully.';                
            }else{ 
                $error_msg = 'Failed To Update Record, Please Try Again.';
            }
        }else if($passActn == 'e' && $frm_nm == 'gencat') {

            $query = "SELECT * FROM catalog..gencat WHERE gen_accd = '$gen_accd'";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { 
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO catalog..gencat (gen_accd, gen_desc) VALUES ('$gen_accd', '$gen_desc')";
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
                        General Ledger A/cs Catalogue
                        <small>Catalogues And Masters</small> | 
                        <small>Export To : </small>
                        <a href="exports/gencat_export.php?ext=doc"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/gencat_export.php?ext=xls"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/gencat_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="gencat" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="gencat">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="6" size="1">
                                                <span id="ComPassErrorSpan"></span></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr><td colspan="3"><hr></td></tr>
                                        <tr>
                                            <th>GL Code</th>
                                            <td><input type="text" name="gen_accd" id="gen_accd" readonly maxlength="7" size="7" required  onblur="ChckFrmFldsCodeDsc()" onkeyup="CheckInputNumFormat(this.value)">
                                            <span id="GenCdErrorSpan"></span></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td><input type="text" name="gen_desc" id="gen_desc" readonly maxlength="36" size="36" style="text-transform: uppercase" required></td>      
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr><td colspan="3"><hr></td></tr>                    
                                        <tr>
                                            <td colspan="3" align="center">
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