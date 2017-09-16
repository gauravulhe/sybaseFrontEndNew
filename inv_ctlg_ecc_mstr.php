<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $esup_supcd = strtoupper($_POST['esup_supcd']);
        $esup_name = strtoupper($_POST['esup_name']);
        $esup_eccno = strtoupper($_POST['esup_eccno']);

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'supeccmst') { 
            $query = "UPDATE catalog..supeccmst set esup_name = '$esup_name', esup_eccno = '$esup_eccno' WHERE esup_supcd = '$esup_supcd'";

            $sql_result = odbc_exec($conn, $query);
            if ($sql_result) { ?>
                <script type="text/javascript">
                    alert('Update Success');
                </script>
        <?php }else{?>
                <script type="text/javascript">
                    alert('Update Failed');
                </script>
        <?php             
            } }else if($passActn == 'e' && $frm_nm == 'supeccmst') {

            $query = "SELECT * FROM catalog..supeccmst WHERE esup_supcd = '$esup_supcd'";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { ?>
                <script type="text/javascript">
                    alert('Record Already Exists.');
                </script>
             <?php }else{
                $query = "INSERT INTO catalog..supeccmst (esup_supcd, esup_name, esup_eccno) VALUES ('$esup_supcd', '$esup_name', '$esup_eccno')";
                $sql_result = odbc_exec($conn, $query);
                
                if ($sql_result) { ?>
                    <script type="text/javascript">
                        alert('New Record Saved.');
                    </script>
            <?php }
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
                        Ecc Master ( Supplier )
                        <small>Catalogues And Masters</small> | 
                        <small>Export To : </small>
                        <a href="exports/supeccmst_export.php?ext=doc"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/supeccmst_export.php?ext=xls"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/supeccmst_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="supeccmst" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="supeccmst">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="15" size="15"><br>
                                                <span id="ComPassErrorSpan"></span>
                                            </td>
                                        </tr>
                                        <tr><td colspan="4"><hr></td></tr>
                                    </table>
                                    <table cellpadding="1">
                                        <tr>                                            
                                            <th>Code</th>
                                            <td><input type="text" name="esup_supcd" id="esup_supcd" readonly maxlength="4" size="4" onblur="CheckEsupCd()" required style="text-transform: uppercase">&nbsp;<span id="EsupCdErrorSpan"></span></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr>                                            
                                            <th>Name</th>
                                            <td><input type="text" name="esup_name" id="esup_name" readonly maxlength="15" size="15" required style="text-transform: uppercase"></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr>
                                            <th>Ecc No</th>
                                            <td><input type="text" name="esup_eccno" id="esup_eccno" readonly required maxlength="15" size="15" style="text-transform: uppercase"></td>
                                            <td>&nbsp;</td>
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