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
                        Purchase Order Print
                        <small>Purchase</small> <!-- | 
                        <small>Export To : </small>
                        <a href="exports/porder_export.php?ext=doc"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/porder_export.php?ext=xls"><img src="img/xls.png" width="35px"></a>  
                        <a href="exports/porder_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="porder" action="prints/po_final.php" target="_blank" method="post">
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
                                                <input type="text" name="po_com" id="com_com"  maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>    
                                            </td>    
                                        </tr>
                                        <tr>               
                                            <th>Unit Code</th>
                                            <td><input type="text" name="po_unit" id="mat_unit"  maxlength="3" size="1" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            <span id="ComUntCdErrorSpan"></span>
                                            <span id="ComUntCdName"></span></td>
                                            </td> 
                                        </tr>
                                        <tr>               
                                            <th>PO No.</th>
                                            <td><input type="text" name="po_no" id="po_no"  maxlength="10" size="1" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td> 
                                        </tr>
                                        <tr>               
                                            <th>Fin. Year</th>
                                            <td><input type="text" name="po_fyr" id="po_fyr"  maxlength="4" size="1" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td> 
                                        </tr>
                                        <tr>               
                                            <th>Quotation No.</th>
                                            <td><input type="text" name="qtn_no" id="qtn_no"  maxlength="4" size="1" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td> 
                                        </tr>
                                        <tr>               
                                            <th>No. of Records</th>
                                            <td><input type="text" name="no_of_records" id="no_of_records"  maxlength="2" size="1" value="15" onkeyup="CheckInputNumFormat(this.value)"> <span style="font-size:10px;">Default : 15 records per page.</span>
                                            </td> 
                                        </tr>                      
                                        <tr>               
                                            <th>Line Break</th>
                                            <td><input type="text" name="line_break" id="line_break"  maxlength="2" size="1" value="28" onkeyup="CheckInputNumFormat(this.value)"> <span style="font-size:10px;">Default : 28 lines.</span>
                                            </td> 
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr><td>&nbsp;</td></tr>                    
                                        <tr>
                                            <td colspan="8" align="center">
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