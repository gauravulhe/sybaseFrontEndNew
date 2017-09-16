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
                        Sales Despatch Challan Print 
                        <small>Despatch</small><!--  | 
                        <small>Export To : </small>
                        <a href="exports/porder_export.php?ext=doc"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/porder_export.php?ext=xls"><img src="img/xls.png" width="35px"></a>  
                        <a href="exports/porder_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="porder" action="prints/challan_final.php" target="_blank" method="post">
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
                                                <input type="text" name="chal_com" id="com_com"  maxlength="3" size="6" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>    
                                            </td>    
                                        </tr>
                                        <tr>               
                                            <th>Unit Code</th>
                                            <td><input type="text" name="chal_unit" id="mat_unit"  maxlength="3" size="6" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            <span id="ComUntCdErrorSpan"></span>
                                            <span id="ComUntCdName"></span></td>
                                            </td> 
                                        </tr>
                                        <tr>               
                                            <th>Bill Type</th>
                                            <td>
                                                <select name="chal_bil_type" id="chal_bil_type" required>
                                                    <option value="gst_bil">G.S.T. Bill </option>
                                                    <option value="sup_bil">Supplimentry Bill</option>
                                                </select>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <th>From Bill No.</th>
                                            <td><input type="text" name="chal_bil_frno" id="chal_bil_frno"  maxlength="10" size="6" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td> 
                                        </tr>
                                        <tr>               
                                            <th>To Bill No.</th>
                                            <td><input type="text" name="chal_bil_tono" id="chal_bil_tono"  maxlength="10" size="6" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td> 
                                        </tr>
                                        <tr>               
                                            <th>From Bill Date</th>
                                            <td><input type="text" name="chal_bil_frdt" id="chal_bil_frdt"  maxlength="10" size="6" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td> 
                                        </tr>
                                        <tr>               
                                            <th>To Bill Date</th>
                                            <td><input type="text" name="chal_bil_todt" id="chal_bil_todt"  maxlength="10" size="6" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td> 
                                        </tr>
                                        <tr>               
                                            <th>Fin. Year</th>
                                            <td><input type="text" name="chal_bil_fyr" id="chal_bil_fyr"  maxlength="4" size="1" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td> 
                                        </tr>
                                        <tr>               
                                            <th>Suffix</th>
                                            <td><input type="text" name="chal_bil_sfx" id="chal_bil_sfx"  maxlength="10" size="1">
                                            </td> 
                                        </tr>
                                        <tr>               
                                            <th>No. of Records</th>
                                            <td><input type="text" name="no_of_records" id="no_of_records"  maxlength="2" size="1" value="15" onkeyup="CheckInputNumFormat(this.value)"> <span style="font-size:10px;">Default : 15 records per page.</span>
                                            </td> 
                                        </tr>                      
                                        <tr>               
                                            <th>Line Break</th>
                                            <td><input type="text" name="line_break" id="line_break"  maxlength="2" size="1" value="38" onkeyup="CheckInputNumFormat(this.value)"> <span style="font-size:10px;">Default : 38 lines.</span>
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