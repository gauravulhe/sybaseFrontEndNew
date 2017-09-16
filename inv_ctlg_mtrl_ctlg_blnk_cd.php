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
                        Catalogues And Masters
                        <small>Material Catalogue</small> | 
                        <a href="inv_ctlg_mtrl_ctlg.php" class="btn btn-primary">Back</a>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="itemcat" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <td>
                                                <?php 
                                                    $sql = "select * from tempdb.invac.itmblnk";
                                                    $rslt = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
                                                    print(odbc_result_all($rslt, "border=3; cellpadding=10;"))."<br>";
                                                ?>
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