<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {
        $grh_com = $_POST['grh_com'];
        $grh_unit = $_POST['grh_unit'];
        $fr_grh_dt = $_POST['fr_grh_dt'];
        $to_grh_dt = $_POST['to_grh_dt'];
        $fr_grd_item = $_POST['fr_grd_item'];
        $to_grd_item = $_POST['to_grd_item'];
        $fr_grh_supcd = $_POST['fr_grh_supcd'];
        $to_grh_supcd = $_POST['to_grh_supcd'];
        $poh_po_type = $_POST['poh_po_type'];
        $file_name = $_POST['file_name'];
        //print_r($_POST);exit;
       
        header('Location:strs_reports/strs_itm_grn_values_print.php?grh_com='.$grh_com.'&grh_unit='.$grh_unit.'&fr_grh_dt='.$fr_grh_dt.'&to_grh_dt='.$to_grh_dt.'&fr_grd_item='.$fr_grd_item.'&to_grd_item='.$to_grd_item.'&fr_grh_supcd='.$fr_grh_supcd.'&to_grh_supcd='.$to_grh_supcd.'&poh_po_type='.$poh_po_type.'&file='.$file_name);
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
                        Item Wise GRN With Values
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
                                                <input type="text" name="grh_com" id="com_com"  maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>          
                                            <td colspan="4">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Unit Code</th>
                                            <td><input type="text" name="grh_unit" id="mat_unit"  maxlength="3" size="1" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            </td>
                                            <td colspan="4">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span>
                                            </td>
                                        </tr>
                                        <tr><td colspan="6"><hr></td></tr>
                                        <tr>
                                            <th>From Date</th>
                                            <td><input type="text" name="fr_grh_dt" id="fr_grh_dt" readonly required maxlength="10" size="8" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>To Date</th>
                                            <td><input type="text" name="to_grh_dt" id="to_grh_dt" readonly required maxlength="10" size="8" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>From Item No</th>
                                            <td><input type="text" name="fr_grd_item" id="fr_grd_item" required maxlength="7" size="6" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>To Item No</th>
                                            <td><input type="text" name="to_grd_item" id="to_grd_item" required maxlength="7" size="6" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>From Party</th>
                                            <td><input type="text" name="fr_grh_supcd" id="fr_grh_supcd" value="A000" required maxlength="4" size="2" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>To Party</th>
                                            <td><input type="text" name="to_grh_supcd" id="to_grh_supcd" value="Z999" required maxlength="4" size="2" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>With W/O</th>
                                            <td><input type="text" name="poh_po_type" value="Y" id="poh_po_type" required maxlength="1" size="1" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr><td colspan="4"><hr></td></tr>
                                        <tr>
                                            <th>File Name</th>
                                            <td>
                                                <!-- <input type="text" name="file_name" id="file_name" required maxlength="10" size="10" style="text-transform: uppercase"> -->
                                                <select name="file_name" id="file_name" required>
                                                    <option value="pf">Print File</option>
                                                    <option value="gf">Group File</option>
                                                    <option value="aw">Account Wise</option>
                                                    <option value="dgw">Date/Grn Wise</option>
                                                    <option value="ic">Inter Company</option>
                                                    <option value="is">Intercomp Summary</option>
                                                    <option value="sf">Summary File</option>
                                                </select>
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