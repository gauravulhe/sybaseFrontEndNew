<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');
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
                        Department Wise Pending Gate Pass Status
                        <small>Gate Pass Reports</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="gpreportsexports" target="_blank" action="gp_reports/gp_rprts_deptwise_pndng_status_print.php" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Company</th>
                                            <td>
                                                <input type="hidden" name="user_com_cd" id="user_com_cd" value="<?php echo $_SESSION['com_cd']; ?>">
                                                <input type="hidden" name="user_com_dbf" id="user_com_dbf" value="<?php echo $_SESSION['com_dbf']; ?>">
                                                <input type="hidden" name="user_fduser" id="user_fduser" value="<?php echo $_SESSION['fduser']; ?>">
                                                <input type="text" name="gpa_com" id="com_com"  maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>          
                                            <td colspan="4">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Unit Code</th>
                                            <td><input type="text" name="gpa_unit" id="mat_unit"  maxlength="3" size="1" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            </td>
                                            <td colspan="4">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span>
                                            </td>
                                        </tr>
                                        <tr><td colspan="6"><hr></td></tr>
                                        <tr>
                                            <th>From Date</th>
                                            <td><input type="text" name="fr_gp_dt" id="fr_gp_dt" readonly required maxlength="8" size="10" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>To Date</th>
                                            <td><input type="text" name="to_gp_dt" id="to_gp_dt" readonly required maxlength="8" size="10" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>From Dept.</th>
                                            <td><input type="text" name="fr_gp_dept" id="fr_gp_dept" required maxlength="4" size="4" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>To Dept.</th>
                                            <td><input type="text" name="to_gp_dept" id="to_gp_dept" required maxlength="4" size="4" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>Returnable (Y/N)</th>
                                            <td><input type="text" name="gpa_ryn" id="gpa_ryn" required maxlength="1" size="1" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>File Name</th>
                                            <td><input type="text" name="file_name" id="file_name" required maxlength="10" size="10" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>No. Of Records</th>
                                            <td><input type="text" name="no_of_records" value="23" id="no_of_records" required maxlength="2" size="1" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>Line Break</th>
                                            <td><input type="text" name="line_break" value="1" id="line_break" required maxlength="2" size="1" style="text-transform: uppercase"></td>
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