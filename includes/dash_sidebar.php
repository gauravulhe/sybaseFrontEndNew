<!-- Sidebar user panel -->


<!-- search form -->


<!-- /.search form -->
<!-- sidebar menu: : style can be found in sidebar.less -->

<?php 
    $pass = strtolower($_SESSION['pass']);  
    $key = substr($pass, 0, 5);  

    if ($key == 'invac') { 
?>

<!-- ///////////////////////////////  INVAC MENUS START /////////////////////// -->

<?php require_once('includes/dash_side_menu_invac.php'); ?>

<!-- ///////////////////////////////  INVAC MENUS ENDS /////////////////////// -->
<?php
        }else if($key == 'sales'){ 

?>
<!-- ///////////////////////////////  SALES MENUS STARTS /////////////////////// -->

<?php require_once('includes/dash_side_menu_sales.php'); ?>


<!-- ///////////////////////////////  SALES MENUS ENDS /////////////////////// -->

<?php
        }else if($key == 'finac'){ 

?>

<!-- ///////////////////////////////  SALES MENUS STARTS /////////////////////// -->

<?php require_once('includes/dash_side_menu_finac.php'); ?>


<!-- ///////////////////////////////  SALES MENUS ENDS /////////////////////// -->


<?php
        } 

?>