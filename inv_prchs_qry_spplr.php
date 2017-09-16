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
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                         Query on Supplier PO Rate's
                        <small>Purchase > Query on pending PRM, PO & Rate</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="poquery" action="" method="post">
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
                                                <input type="text" name="poh_com" id="com_com"  maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>                                            
                                            <td>&nbsp;</td>  
                                            <td colspan="2">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>
                                            </td>  
                                        </tr>
                                        <tr>           
                                            <th>Unit Code</th>
                                            <td>
                                                <input type="text" name="poh_unit" id="mat_unit"  maxlength="3" size="1" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            </td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span></td>
                                            </td>    
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>
                                            <th>Supplier Code</th>
                                            <td colspan="">
                                                <input type="text" name="poh_supcd" id="poh_supcd"  maxlength="4" size="4" required onblur="CheckPoQuerySupDetails()">
                                            </td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>
                                            <td colspan="6">
                                                <span id="PoQuerySupErrorSpan"></span>
                                                <span id="pohPoQuerySupErrorSpan"></span>
                                            </td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
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