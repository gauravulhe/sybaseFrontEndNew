<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $itm_item = $_POST['itm_item'];
        $itm_desc = strtoupper($_POST['itm_desc']);
        $itm_part = strtoupper($_POST['itm_part']);
        $itm_uom = strtoupper($_POST['itm_uom']);
        $itm_crossitm = strtoupper($_POST['itm_crossitm']);
        $itm_modvat = strtoupper($_POST['itm_modvat']);
        $itm_type = strtoupper($_POST['itm_type']);
        $itm_cr_days = strtoupper($_POST['itm_cr_days']);
        $itm_del_tag = strtoupper($_POST['itm_del_tag']);

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'itemcat') { 
            $query = "UPDATE catalog..itmcat set itm_desc = '$itm_desc', itm_part = '$itm_part', itm_uom = $itm_uom, itm_crossitm = '$itm_crossitm', itm_modvat = '$itm_modvat', itm_type = '$itm_type', itm_cr_days = $itm_cr_days, itm_del_tag = '$itm_del_tag' where itm_item = '$itm_item'";

            $sql_result = odbc_exec($conn, $query);
            if ($sql_result) { 
                $success_msg = 'Record Updated Successfully.';                
            }else{ 
                $error_msg = 'Failed To Update Record, Please Try Again.';
            }    
        }else if($passActn == 'e' && $frm_nm == 'itemcat') {

            $query = "SELECT * FROM catalog..itmcat WHERE itm_item = '$itm_item'";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { 
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO catalog..itmcat (itm_item, itm_desc, itm_part, itm_uom, itm_crossitm, itm_modvat, itm_type, itm_cr_days, itm_del_tag) VALUES ('$itm_item', '$itm_desc', '$itm_part', $itm_uom, '$itm_crossitm', '$itm_modvat', '$itm_type', $itm_cr_days, '$itm_del_tag')";
                $sql_result = odbc_exec($conn, $query);
                
                if ($sql_result) { 
                    $success_msg = 'New Record Saved Successfully.';
                }
            }
        }
        //print_r($_POST);
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
                        Material Catalogue
                        <small>Catalogues And Masters</small> | 
                        <small>Export To : </small>
                        <a href="exports/itmcat_export.php?ext=doc"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/itmcat_export.php?ext=xls"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/itmcat_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a>  -->| 
                        <a href="inv_ctlg_mtrl_ctlg_blnk_cd.php" class="btn btn-primary">Blank Code !</a>
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
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="itemcat">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="6" size="1">
                                            <span id="ComPassErrorSpan"></span>
                                            </td>                                 
                                            <td colspan="2"></td>    
                                            <th>Company</th>
                                            <td>
                                                <input type="text" name="com_com" id="com_com" readonly maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                            <span id="ComCdErrorSpan"></span>
                                            <span id="ComCdName"></span>
                                            </td>
                                        </tr>
                                        <tr><td colspan="2"></td></tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                    </table>
                                    <table cellpadding="1">
                                        <tr>                                            
                                            <th>Item No.</th>
                                            <td><input type="text" name="itm_item" id="itm_item" readonly maxlength="7" size="5" onblur="CheckMtrlItmNo()" required onkeyup="CheckInputNumFormat(this.value)">&nbsp;<span id="MtrlItmNoErrorSpan"></span></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Item Desc</th>
                                            <td><input type="text" name="itm_desc" id="itm_desc" readonly required  style="text-transform: uppercase"></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Part No.</th>
                                            <td><input type="text" name="itm_part" id="itm_part" readonly maxlength="15" size="15" style="text-transform: uppercase" required></td>      
                                            <td>&nbsp;</td>
                                        </tr>                                        
                                        <tr>
                                            <th>Unit Of Measurment</th>
                                            <td><input type="text" name="itm_uom" id="itm_uom" readonly maxlength="3" size="1" onblur="CheckUntOfMsrmntCd()" required onkeyup="CheckInputNumFormat(this.value)">            
                                            <span id="UomErrorSpan"></span>
                                            <span id="UomCdName"></span>
                                            </td>    
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Cross Item No.</th>
                                            <td><input type="text" name="itm_crossitm" id="itm_crossitm" readonly  maxlength="7" size="5" style="text-transform: uppercase" required></td>      
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Modvat</th>
                                            <td><input type="text" name="itm_modvat" id="itm_modvat" readonly maxlength="1" size="1" style="text-transform: uppercase" required></td>      
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Item Type</th>
                                            <td><input type="text" name="itm_type" id="itm_type" readonly maxlength="1" size="1" required  onblur="CheckItmTypCrdtDys()">
                                            <span id="ItmTypErrorSpan"></span>
                                            </td>      
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Credit Days</th>
                                            <td><input type="text" name="itm_cr_days" id="itm_cr_days" readonly maxlength="2" size="1" style="text-transform: uppercase" required></td>      
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th>Delete</th>
                                            <td><input type="text" name="itm_del_tag" id="itm_del_tag" readonly maxlength="1" size="2" style="text-transform: uppercase" required></td>      
                                            <td>&nbsp;</td>
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