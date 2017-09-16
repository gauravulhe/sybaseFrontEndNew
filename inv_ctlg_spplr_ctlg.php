<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $com_com = $_POST['com_com'];

        $sup_supcd = strtoupper($_POST['sup_supcd']);
        $sup_name = strtoupper($_POST['sup_name']);
        $sup_add1 = strtoupper($_POST['sup_add1']);
        $sup_add2 = strtoupper($_POST['sup_add2']);
        $sup_add3 = strtoupper($_POST['sup_add3']);
        $sup_sstno = strtoupper($_POST['sup_sstno']);
        $sup_sstdt = strtoupper($_POST['sup_sstdt']);
        $sup_cstno = strtoupper($_POST['sup_cstno']);
        $sup_cstdt = strtoupper($_POST['sup_cstdt']);
        $sup_tinno = strtoupper($_POST['sup_tinno']);
        $sup_ctinno = strtoupper($_POST['sup_ctinno']);
        $sup_panno = strtoupper($_POST['sup_panno']);
        $sup_email1 = strtolower($_POST['sup_email1']);
        $sup_email2 = strtolower($_POST['sup_email2']);
        $sup_website = strtolower($_POST['sup_website']);
        $sup_phone_no = strtoupper($_POST['sup_phone_no']);
        $sup_fax_no = strtoupper($_POST['sup_fax_no']);
        $sup_bank_name1 = strtoupper($_POST['sup_bank_name1']);
        $sup_bank_acct1 = strtoupper($_POST['sup_bank_acct1']);
        $sup_bank_name2 = strtoupper($_POST['sup_bank_name2']);
        $sup_bank_acct2 = strtoupper($_POST['sup_bank_acct2']);
        $sup_bank_name3 = strtoupper($_POST['sup_bank_name3']);
        $sup_bank_acct3 = strtoupper($_POST['sup_bank_acct3']);
        $sup_bank_cd1 = strtoupper($_POST['sup_bank_cd1']);
        $sup_bank_ifsc = strtoupper($_POST['sup_bank_ifsc']);
        $sup_state = strtoupper($_POST['sup_state']);
        $sup_city = strtoupper($_POST['sup_city']);
        $sup_stct_cd = strtoupper($_POST['sup_stct_cd']);
        $sup_gstin_no = strtoupper($_POST['sup_gstin_no']);

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'supcat') { 
            $query = "UPDATE catalog..supcat set sup_name = '$sup_name', sup_add1 = '$sup_add1', sup_add2 = '$sup_add2', sup_add3 = '$sup_add3', sup_sstno = '$sup_sstno', sup_sstdt = '$sup_sstdt', sup_cstno = '$sup_cstno', sup_cstdt = '$sup_cstdt', sup_tinno = '$sup_tinno', sup_ctinno = '$sup_ctinno', sup_panno = '$sup_panno', sup_email1 = '$sup_email1', sup_email2 = '$sup_email2', sup_website = '$sup_website', sup_phone_no = '$sup_phone_no', sup_fax_no = '$sup_fax_no', sup_bank_name1 = '$sup_bank_name1', sup_bank_acct1 = '$sup_bank_acct1', sup_bank_name2 = '$sup_bank_name2', sup_bank_acct2 = '$sup_bank_acct2', sup_bank_name3 = '$sup_bank_name3', sup_bank_acct3 = '$sup_bank_acct3', sup_bank_cd1 = $sup_bank_cd1, sup_bank_ifsc = '$sup_bank_ifsc', sup_state = $sup_state, sup_city = $sup_city, sup_stct_cd = '$sup_stct_cd', sup_gstin_no = '$sup_gstin_no' where sup_supcd = '$sup_supcd'";

            $sql_result = odbc_exec($conn, $query);
                if ($sql_result) { 
                    $success_msg = 'Record Updated Successfully.';                
                }else{
                    $error_msg = 'Failed To Update Record, Please Try Again.';
                }
            }else if($passActn == 'e' && $frm_nm == 'supcat') { 

            $query = "SELECT * FROM catalog..supcat WHERE sup_supcd = '$sup_supcd'";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) {
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO catalog..supcat (sup_supcd, sup_name, sup_add1, sup_add2, sup_add3, sup_sstno, sup_sstdt, sup_cstno, sup_cstdt, sup_tinno, sup_ctinno, sup_panno, sup_email1, sup_email2, sup_website, sup_phone_no, sup_fax_no, sup_bank_name1, sup_bank_acct1, sup_bank_name2, sup_bank_acct2, sup_bank_name3, sup_bank_acct3, sup_bank_cd1,sup_bank_ifsc, sup_state, sup_city, sup_stct_cd, sup_gstin_no) VALUES ('$sup_supcd', '$sup_name', '$sup_add1', '$sup_add2', '$sup_add3', '$sup_sstno', '$sup_sstdt', '$sup_cstno', '$sup_cstdt', '$sup_tinno', '$sup_ctinno', '$sup_panno', '$sup_email1', '$sup_email2', '$sup_website', '$sup_phone_no', '$sup_fax_no', '$sup_bank_name1', '$sup_bank_acct1', '$sup_bank_name2', '$sup_bank_acct2', '$sup_bank_name3', '$sup_bank_acct3', $sup_bank_cd1, '$sup_bank_ifsc', $sup_state, $sup_city, '$sup_stct_cd', '$sup_gstin_no')";

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
                        Supplier Catalogue
                        <small>Catalogues And Masters</small> | 
                        <small>Export To : </small>
                        <a href="exports/supcat_export.php?ext=doc"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/supcat_export.php?ext=xls"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/supcat_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="supcat" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="supcat">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="6" size="1"><br>
                                                <span id="ComPassErrorSpan"></span>
                                            </td>                                    
                                            <th>Company</th>
                                            <td colspan="4">
                                                <input type="text" name="com_com" id="com_com" readonly maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                            <span id="ComCdErrorSpan"></span>
                                            <span id="ComCdName"></span>
                                            </td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>                                            
                                            <th>Code</th>
                                            <td><input type="text" name="sup_supcd" id="sup_supcd" readonly maxlength="4" size="1" onblur="CheckSupCatCd()" required>                 
                                            <span id="SupCdErrorSpan"></span>
                                            </td>
                                            <th>Address 1</th>
                                            <td><input type="text" name="sup_add1" id="sup_add1" readonly style="text-transform: uppercase" required></td>      
                                            <th>Address 2</th>
                                            <td><input type="text" name="sup_add2" id="sup_add2" readonly style="text-transform: uppercase"></td>          
                                            <th>Address 3</th>
                                            <td><input type="text" name="sup_add3" id="sup_add3" readonly style="text-transform: uppercase"></td>    
                                        </tr>
                                        <tr>  
                                            <th>Name</th>
                                            <td><input type="text" name="sup_name" id="sup_name" readonly style="text-transform: uppercase" required></td>         
                                            <th>State Code</th>
                                            <td><input type="text" name="sup_state" id="sup_state" readonly required maxlenght="10" size="5" onkeyup="CheckInputNumFormat(this.value)"></td>          
                                            <th>City Code</th>
                                            <td><input type="text" name="sup_city" id="sup_city" readonly required maxlenght="10" size="5" onkeyup="CheckInputNumFormat(this.value)"></td>                           
                                            <th>State/City Code</th>
                                            <td><input type="text" name="sup_stct_cd" id="sup_stct_cd" readonly maxlenght="8" size="8" style="text-transform: uppercase"></td>         
                                            <!-- <td>City Name</td>
                                            <td><input type="text" name="com_add3" id="com_add3" readonly style="text-transform: uppercase"></td> -->
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>                                              
                                            <th>GSTIN No</th>
                                            <td><input type="text" name="sup_gstin_no" id="sup_gstin_no" readonly maxlenght="15" size="15" style="text-transform: uppercase"></td>  
                                            <th>SST No.</th>
                                            <td><input type="text" name="sup_sstno" id="sup_sstno" readonly style="text-transform: uppercase"></td>
                                            <th>SST Date</th>
                                            <td><input type="text" name="sup_sstdt" id="sup_sstdt" readonly maxlength="8" size="8"></td>
                                            <th>CST No.</th>
                                            <td><input type="text" name="sup_cstno" id="sup_cstno" readonly style="text-transform: uppercase"></td>      
                                        </tr>
                                        <tr>           
                                            <th>CST Date</th>
                                            <td><input type="text" name="sup_cstdt" id="sup_cstdt" readonly maxlength="8" size="8"></td>
                                            <th>Tin No</th>
                                            <td><input type="text" name="sup_tinno" id="sup_tinno" readonly></td>      
                                            <th>C Tin No</th>
                                            <td><input type="text" name="sup_ctinno" id="sup_ctinno" readonly></td> 
                                            <th>PAN No.</th>
                                            <td><input type="text" name="sup_panno" id="sup_panno" readonly maxlength="15" size="15"></td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>        
                                            <th>Email Id-1</th>
                                            <td><input type="text" name="sup_email1" id="sup_email1" readonly style="text-transform: uppercase"></td>
                                            <th>Fax No.</th>
                                            <td><input type="text" name="sup_fax_no" id="sup_fax_no" readonly style="text-transform: uppercase"></td>        
                                            <th>Phone No.</th>
                                            <td><input type="text" name="sup_phone_no" id="sup_phone_no" readonly style="text-transform: uppercase"></td>   
                                            <th>Bank Branch 1</th>
                                            <td><input type="text" name="sup_bank_name1" id="sup_bank_name1" readonly style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>Email Id-2</th>
                                            <td><input type="text" name="sup_email2" id="sup_email2" readonly style="text-transform: uppercase"></td> 
                                            <th>Website</th>
                                            <td><input type="text" name="sup_website" id="sup_website" readonly style="text-transform: uppercase"></td>
                                            <th>Bank Code 1</th>
                                            <td><input type="number" name="sup_bank_cd1" id="sup_bank_cd1" readonly  min="1" max="999999" required></td>
                                            <th>Bank Acct 1</th>
                                            <td><input type="text" name="sup_bank_acct1" id="sup_bank_acct1" readonly maxlength="15" size="15"></td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>       
                                            <th>Bank Name 2</th>
                                            <td><input type="text" name="sup_bank_name2" id="sup_bank_name2" readonly style="text-transform: uppercase"></td>     
                                            <th>Bank Name 3</th>
                                            <td><input type="text" name="sup_bank_name3" id="sup_bank_name3" readonly></td>      
                                            <th>IFS Code</th>
                                            <td><input type="text" name="sup_bank_ifsc" id="sup_bank_ifsc" readonly></td>
                                        </tr>
                                        <tr>      
                                            <th>Bank Acct 2</th>
                                            <td><input type="text" name="sup_bank_acct2" id="sup_bank_acct2" readonly></td>      
                                            <th>Bank Acct 3</th>
                                            <td><input type="text" name="sup_bank_acct3" id="sup_bank_acct3" readonly></td> 
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>   
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