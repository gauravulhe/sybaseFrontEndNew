<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $cod_prefix = $_POST['cod_prefix'];
        $cod_code = $_POST['cod_code'];
        $cod_desc = strtoupper($_POST['cod_desc']);

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'codent') { 
            $query = "UPDATE catalog..codecat set cod_code = $cod_code, cod_desc = '$cod_desc' where cod_prefix = $cod_prefix AND cod_code = $cod_code";

           $sql_result = odbc_exec($conn, $query);
           if ($sql_result) { 
                $success_msg = 'Record Updated Successfully.';                
            }else{ 
                $error_msg = 'Failed To Update Record, Please Try Again.';
            }
        }else if($passActn == 'e' && $frm_nm == 'codent') {

            $query = "SELECT * FROM catalog..codecat WHERE cod_prefix = $cod_prefix AND cod_code = $cod_code";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { 
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO catalog..codecat (cod_prefix, cod_code, cod_desc) VALUES ($cod_prefix, $cod_code, '$cod_desc')";
                $sql_result = odbc_exec($conn, $query);
                
                if ($sql_result) { 
                    $success_msg = 'New Record Saved Successfully.';
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
                        General Codes Catalogue
                        <small>Catalogues And Masters</small> | 
                        <small>Export To : </small>
                        <a href="exports/codecat_export.php?ext=doc"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/codecat_export.php?ext=xls"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/codecat_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="codent" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="codent">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="6" size="1">
                                                <span id="ComPassErrorSpan"></span></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr><td colspan="3"><hr></td></tr>
                                        <tr>                                            
                                            <th>Prefix</th>
                                            <td><input type="text" name="cod_prefix" id="cod_prefix" readonly maxlength="3" size="1" onblur="ChckFrmFldsPrfxCode()" required onkeyup="CheckInputNumFormat(this.value)"><span id="CdEntCdErrorSpan"></span></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Code</th>
                                            <td><input type="text" name="cod_code" id="cod_code" readonly maxlength="3" size="1" required  onblur="ChckFrmFldsCodeDesc()" onkeyup="CheckInputNumFormat(this.value)"></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td><input type="text" name="cod_desc" id="cod_desc" readonly style="text-transform: uppercase" required></td>      
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