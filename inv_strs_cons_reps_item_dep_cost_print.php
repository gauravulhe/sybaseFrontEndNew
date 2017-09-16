<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {
        $iss_com = $_POST['iss_com'];
        $iss_unit = $_POST['iss_unit'];
        $fr_iss_dt = $_POST['fr_iss_dt'];
        $to_iss_dt = $_POST['to_iss_dt'];
        $iss_tc = $_POST['iss_tc'];
        $fr_iss_item = $_POST['fr_iss_item'];
        $to_iss_item = $_POST['to_iss_item'];
        $fr_iss_dept = $_POST['fr_iss_dept'];
        $to_iss_dept = $_POST['to_iss_dept'];
        $fr_iss_cost = $_POST['fr_iss_cost'];
        $to_iss_cost = $_POST['to_iss_cost'];
        $fr_mat_accd = $_POST['fr_mat_accd'];
        $to_mat_accd = $_POST['to_mat_accd'];
        $print_file_name = $_POST['print_file_name'];
        $summary_file_name = $_POST['summary_file_name'];
        $tag = $_POST['tag'];
        //print_r($_POST);exit;
       
        header('Location:strs_reports/strs_cons_reps_item_dep_cost_print.php?iss_com='.$iss_com.'&iss_unit='.$iss_unit.'&fr_iss_dt='.$fr_iss_dt.'&to_iss_dt='.$to_iss_dt.'&iss_tc='.$iss_tc.'&fr_iss_item='.$fr_iss_item.'&to_iss_item='.$to_iss_item.'&fr_iss_dept='.$fr_iss_dept.'&to_iss_dept='.$to_iss_dept.'&fr_iss_cost='.$fr_iss_cost.'&to_iss_cost='.$to_iss_cost.'&fr_mat_accd='.$fr_mat_accd.'&to_mat_accd='.$to_mat_accd.'&tag='.$tag.'&pfile='.$print_file_name.'&sfile='.$summary_file_name);
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
                        Stores Consumption Reps.Item/Dep/Cost
                        <small>Stores</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                        <form role="form" name="strsreportsexports" action="" method="post">
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
                                                <input type="text" name="iss_com" id="com_com"  maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>          
                                            <td colspan="4">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Unit Code</th>
                                            <td><input type="text" name="iss_unit" id="mat_unit"  maxlength="3" size="1" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            </td>
                                            <td colspan="4">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span>
                                            </td>
                                        </tr>
                                        <tr><td colspan="6"><hr></td></tr>      
                                        <tr>
                                            <th>TC Code</th>
                                            <td><input type="text" name="iss_tc" id="iss_tc" readonly required maxlength="3" size="1" style="text-transform: uppercase">
                                            <small>
                                                <a href="includes/view_details.php?q=tc" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0, status=1'); return false;">(Help)</a>
                                            </small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>From Date</th>
                                            <td><input type="text" name="fr_iss_dt" id="fr_grh_dt" readonly required maxlength="10" size="8" style="text-transform: uppercase"></td>
                                            <th>To Date</th>
                                            <td><input type="text" name="to_iss_dt" id="to_grh_dt" readonly required maxlength="10" size="8" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>From Item No</th>
                                            <td><input type="text" name="fr_iss_item" id="fr_iss_item" required maxlength="7" size="6" style="text-transform: uppercase"></td>
                                            <th>To Item No</th>
                                            <td><input type="text" name="to_iss_item" id="to_iss_item" required maxlength="7" size="6" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>From Dept</th>
                                            <td><input type="text" name="fr_iss_dept" id="fr_iss_dept" value="0" required maxlength="4" size="2" style="text-transform: uppercase"></td>
                                            <th>To iss_dept</th>
                                            <td><input type="text" name="to_iss_dept" id="to_iss_dept" value="9999" required maxlength="4" size="2" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>From Cost</th>
                                            <td><input type="text" name="fr_iss_cost" id="fr_iss_cost" value="0" required maxlength="4" size="2" style="text-transform: uppercase"></td>
                                            <th>To Cost</th>
                                            <td><input type="text" name="to_iss_cost" id="to_iss_cost" value="9999" required maxlength="4" size="2" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>From A/C</th>
                                            <td><input type="text" name="fr_mat_accd" id="fr_mat_accd" value="000000" required maxlength="6" size="2" style="text-transform: uppercase"></td>
                                            <th>To A/C</th>
                                            <td><input type="text" name="to_mat_accd" id="to_mat_accd" value="999999" required maxlength="6" size="2" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr><td colspan="4"><hr></td></tr>
                                        <tr>
                                            <th>Print File Name</th>
                                            <td>
                                                <select name="print_file_name" id="print_file_name" required>
                                                    <option value="pdaw">Dept / AC Wise</option>
                                                    <option value="piw">Item Wise</option>
                                                    <option value="pcc">Cost Center Wise</option>
                                                    <option value="padw">AC / Dept Wise</option>
                                                    <option value="pacc">AC / Cost / Cent</option>
                                                    <option value="pai">AC / Item</option>
                                                    <option value="ps">Stationary (TC 18)</option>
                                                    <option value="pc">Computers (TC 18)</option>
                                                </select>
                                            </td>
                                            <th>Summary File Name</th>
                                            <td>
                                                <select name="summary_file_name" id="summary_file_name" required>
                                                    <option value="sdaw">Dept / AC Wise</option>
                                                    <option value="siw">Item Wise</option>
                                                    <option value="scc">Cost Center Wise</option>
                                                    <option value="sadw">AC / Dept Wise</option>
                                                    <option value="sacc">AC / Cost / Cent</option>
                                                    <option value="sai">AC / Item</option>
                                                    <option value="ss">Stationary (TC 18)</option>
                                                    <option value="sc">Computers (TC 18)</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr><td colspan="4"><hr></td></tr>
                                        <tr>
                                            <th>Tag</th>
                                            <td colspan="4"><input type="text" name="tag" id="tag" value="0" required maxlength="6" size="2" style="text-transform: uppercase">
                                            ( e.g. 0 : COMPLETE / 1 : 350202 / 2 : 350201 )
                                            </td>
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