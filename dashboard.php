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
                        <?php
                            if ($key == 'invac') { echo "Invac "; }
                            elseif($key == 'finac') { echo "Finac "; }
                            elseif($key == 'sales'){ echo "Sales "; }
                        ?>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                        <!-- Left col -->
                        <?php 
                            echo 'User Id : '.$_SESSION['usr_id'].'<br>';
                            echo 'Company Code : '.$_SESSION['com_cd'].'<br>';
                            echo 'Com Dbf : '.$_SESSION['com_dbf'].'<br>';
                            echo 'ffuser : '.$_SESSION['ffuser'].'<br>';
                            echo 'fduser : '.$_SESSION['fduser'].'<br>';
                        ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->

        <!-- add new calendar event modal -->  
        <?php require_once('includes/dash_footer.php'); ?> 
    </body>
</html>