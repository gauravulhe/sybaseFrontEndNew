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
                        TML GST Export To Excel
                        <small>TML GST</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="tmlgstexports" action="sal_tml_gst_export_excel.php" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <input type="hidden" name="user_com_dbf" id="user_com_dbf" value="<?php echo $_SESSION['com_dbf']; ?>">
                                        <tr>
                                            <th>Fin Year</th>
                                            <td><input type="text" name="tml_gst_fyr" id="tml_gst_fyr"  required maxlength="4" size="4" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>From Date</th>
                                            <td><input type="text" name="tml_gst_frdt" id="tml_gst_frdt" readonly required maxlength="8" size="10" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>To Date</th>
                                            <td><input type="text" name="tml_gst_todt" id="tml_gst_todt" readonly required maxlength="8" size="10" style="text-transform: uppercase"></td>
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