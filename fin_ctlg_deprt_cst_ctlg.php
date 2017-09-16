<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $dep_prefix = $_POST['dep_prefix'];
        $dep_cd = strtoupper($_POST['dep_cd']);
        $dep_desc = strtoupper($_POST['dep_desc']);

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'deptent') { 
            $query = "UPDATE catalog..deptcat set dep_desc = '$dep_desc' where dep_prefix = $dep_prefix AND dep_cd = $dep_cd";

            $sql_result = odbc_exec($conn, $query);            
                if ($sql_result) { 
                    $success_msg = 'Record Updated Successfully.';                
                }else{ 
                    $error_msg = 'Failed To Update Record, Please Try Again.';
                } 
            }else if($passActn == 'e' && $frm_nm == 'deptent') {

            $query = "SELECT * FROM catalog..deptcat WHERE dep_prefix = $dep_prefix AND dep_cd = $dep_cd";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { 
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO catalog..deptcat (dep_prefix, dep_cd, dep_desc) VALUES ($dep_prefix, $dep_cd, '$dep_desc')";
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
                        Department /Cost Centre Codes
                        <small>Catalogues And Masters</small> | 
                        <small>Export To : </small>
                        <a href="exports/deptcat_export.php?ext=doc"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/deptcat_export.php?ext=xls"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/deptcat_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="deptent" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="deptent">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="6" size="1"><br>
                                                <span id="ComPassErrorSpan"></span>
                                            </td>                                     
                                            <th>Dept./Cost</th>
                                            <td>
                                                <select name="dep_prefix" id="dep_prefix" class="form-control" required onchange="CheckDeptCostCd()" readonly>
                                                    <option value="">--Select--</option>
                                                    <option value="1">Department Code</option>
                                                    <option value="2">Cost Center Code</option>
                                                    <option value="3">Stationary Code</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr><td colspan="4"><hr></td></tr>
                                    </table>
                                    <table cellpadding="1">
                                        <tr>                                            
                                            <th>Code</th>
                                            <td><input type="text" name="dep_cd" id="dep_cd" readonly maxlength="4" size="1" onblur="CheckDeptCostAvalblCd()" required onkeyup="CheckInputNumFormat(this.value)">&nbsp;<span id="DeptCostCdErrorSpan"></span></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr>
                                            <th>Description</th>
                                            <td><input type="text" name="dep_desc" id="dep_desc" readonly required  style="text-transform: uppercase"></td>
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