<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $com_com = $_POST['com_com'];
        $com_unit = $_POST['com_unit'];
        $com_name = strtoupper($_POST['com_name']);
        $com_uname = strtoupper($_POST['com_uname']);
        $com_add1 = strtoupper($_POST['com_add1']);
        $com_add2 = strtoupper($_POST['com_add2']);
        $com_add3 = strtoupper($_POST['com_add3']);
        $com_sst_no = strtoupper($_POST['com_sst_no']);
        $com_sst_dt = $_POST['com_sst_dt'];
        $com_cst_no = strtoupper($_POST['com_cst_no']);
        $com_cst_dt = $_POST['com_cst_dt'];
        $com_gram = $_POST['com_gram'];
        $com_tel = strtoupper($_POST['com_tel']);
        $com_collectorate = strtoupper($_POST['com_collectorate']);
        $com_range = strtoupper($_POST['com_range']);
        $com_division = strtoupper($_POST['com_division']);
        $com_pla_no = strtoupper($_POST['com_pla_no']);
        $com_cex_no = strtoupper($_POST['com_cex_no']);
        $com_pf_no = strtoupper($_POST['com_pf_no']);
        $com_ecc_no = $_POST['com_ecc_no'];
        $com_mast = $_POST['com_mast'];
        $com_dbf = $_POST['com_dbf'];
        $com_tin_no = strtoupper($_POST['com_tin_no']);
        $com_ctin_no = $_POST['com_ctin_no'];
        $com_stct_cd = $_POST['com_stct_cd'];
        $com_gstin_no = $_POST['com_gstin_no'];

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'comcat') { 
            $query = "UPDATE catalog..comcat set com_com = $com_com, com_unit = $com_unit, com_name = '$com_name', com_uname = '$com_uname', com_add1 = '$com_add1', com_add2 = '$com_add2', com_add3 = '$com_add3', com_sst_no = '$com_sst_no', com_sst_dt = '$com_sst_dt', com_cst_no = '$com_cst_no', com_cst_dt = '$com_cst_dt', com_gram = '$com_gram', com_tel = '$com_tel', com_collectorate = '$com_collectorate', com_range = '$com_range', com_division = '$com_division', com_pla_no = '$com_pla_no', com_cex_no = '$com_cex_no', com_pf_no = '$com_pf_no', com_ecc_no = '$com_ecc_no', com_mast = '$com_mast', com_dbf = '$com_dbf', com_tin_no = '$com_tin_no', com_ctin_no = '$com_ctin_no', com_stct_cd = '$com_stct_cd', com_gstin_no = '$com_gstin_no'  where com_com = $com_com AND com_unit = $com_unit";

            $sql_result = odbc_exec($conn, $query);
           if ($sql_result) { 
                $success_msg = 'Record Updated Successfully.';                
            }else{ 
                $error_msg = 'Failed To Update Record, Please Try Again.';
            } 
        }else if($passActn == 'e' && $frm_nm == 'comcat') { 

            $query = "SELECT * FROM catalog..comcat WHERE com_com = $com_com AND com_unit = $com_unit";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { 
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO catalog..comcat (com_com, com_unit, com_name, com_uname, com_add1, com_add2, com_add3, com_sst_no, com_sst_dt, com_cst_no, com_cst_dt, com_gram, com_tel, com_collectorate, com_range, com_division, com_pla_no, com_cex_no, com_pf_no, com_ecc_no, com_mast, com_dbf, com_tin_no, com_ctin_no, com_stct_cd, com_gstin_no) VALUES ($com_com, $com_unit, '$com_name', '$com_uname', '$com_add1', '$com_add2', '$com_add3', '$com_sst_no', '$com_sst_dt', '$com_cst_no', '$com_cst_dt', '$com_gram', '$com_tel', '$com_collectorate', '$com_range', '$com_division', '$com_pla_no', '$com_cex_no', '$com_pf_no', '$com_ecc_no', '$com_mast', '$com_dbf', '$com_tin_no', '$com_ctin_no', '$com_stct_cd', '$com_gstin_no')";
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
                        Company Catalogue
                        <small>Catalogues And Masters</small> | 
                        <small>Export To : </small>
                        <a href="exports/comcat_export.php?ext=doc"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/comcat_export.php?ext=xls"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/comcat_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="comcat" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="comcat">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="6" size="1">
                                                <span id="ComPassErrorSpan"></span></td>
                                            <th>Company Code</th>
                                            <td><input type="text" name="com_com" id="cmp_cd" readonly maxlength="3" size="1" required onkeyup="CheckInputNumFormat(this.value)"></td>
                                            <th>Unit Code</th>
                                            <td><input type="text" name="com_unit" id="unt_cd" readonly maxlength="3" size="1" required  onblur="CheckCmpCdUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            <span id="CmpUntCdErrorSpan"></span></td>
                                            </td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>                                            
                                            <th>Com. Name</th>
                                            <td><input type="text" name="com_name" id="com_name" readonly style="text-transform: uppercase" onblur="RmvAttrComFrmFldsComUnm()" required></td>
                                            <th>Unt. Name</th>
                                            <td><input type="text" name="com_uname" id="com_uname" readonly style="text-transform: uppercase" onblur="RmvAttrComFrmFldsComAdd()"required></td>
                                            <th>Address 1</th>
                                            <td><input type="text" name="com_add1" id="com_add1" readonly style="text-transform: uppercase" onblur="RmvAttrComFrmFldsComAll()"required></td>      
                                            <th>Address 2</th>
                                            <td><input type="text" name="com_add2" id="com_add2" readonly style="text-transform: uppercase"></td>     
                                        </tr>
                                        <tr>          
                                            <th>Address 3</th>
                                            <td><input type="text" name="com_add3" id="com_add3" readonly style="text-transform: uppercase"></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>      
                                            <th>SST No.</th>
                                            <td><input type="text" name="com_sst_no" id="com_sst_no" readonly style="text-transform: uppercase"></td>
                                            <th>Date</th>
                                            <td><input type="text" name="com_sst_dt" id="com_sst_dt" readonly maxlength="8" size="8"></td>
                                            <th>CST No.</th>
                                            <td><input type="text" name="com_cst_no" id="com_cst_no" readonly style="text-transform: uppercase"></td>    
                                            <th>Date</th>
                                            <td><input type="text" name="com_cst_dt" id="com_cst_dt" readonly maxlength="8" size="8"></td>      
                                        </tr>
                                        <tr>       
                                            <th>CAT Id</th>
                                            <td><input type="text" name="com_cat_id" id="com_cat_id" readonly></td>      
                                            <th>DBF</th>
                                            <td><input type="text" name="com_dbf" id="com_dbf" readonly maxlength="6" size="6"></td> 
                                            <th>Gram</th>
                                            <td><input type="text" name="com_gram" id="com_gram" readonly maxlength="15" size="15"></td>     
                                            <th>Tel.</th>
                                            <td><input type="text" name="com_tel" id="com_tel" readonly style="text-transform: uppercase"></td>     
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>   
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>        
                                            <th>Collectorate</th>
                                            <td><input type="text" name="com_collectorate" id="com_collectorate" readonly style="text-transform: uppercase"></td>
                                            <th>Pla. No.</th>
                                            <td><input type="text" name="com_pla_no" id="com_pla_no" readonly style="text-transform: uppercase"></td>      
                                            <th>Range</th>
                                            <td><input type="text" name="com_range" id="com_range" readonly style="text-transform: uppercase"></td>
                                            <th>Cex. No.</th>
                                            <td><input type="text" name="com_cex_no" id="com_cex_no" readonly style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>Division</th>
                                            <td><input type="text" name="com_division" id="com_division" readonly style="text-transform: uppercase"></td>      
                                            <th>PF No.</th>
                                            <td><input type="text" name="com_pf_no" id="com_pf_no" readonly style="text-transform: uppercase"></td>
                                            <th>ECC No.</th>
                                            <td><input type="text" name="com_ecc_no" id="com_ecc_no" readonly maxlength="15" size="15"></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>      
                                            <th>Mast</th>
                                            <td><input type="text" name="com_mast" id="com_mast" readonly maxlength="2" size="2"></td>      
                                            <th>TIN No.</th>
                                            <td><input type="text" name="com_tin_no" id="com_tin_no" readonly style="text-transform: uppercase"></td>      
                                            <th>CTIN No.</th>
                                            <td><input type="text" name="com_ctin_no" id="com_ctin_no" readonly></td>      
                                            <th>STCT Code</th>
                                            <td><input type="text" name="com_stct_cd" id="com_stct_cd" readonly maxlength="8" size="8"required></td> 
                                        </tr>
                                        <tr>     
                                            <th>GSTIN No.</th>
                                            <td><input type="text" name="com_gstin_no" id="com_gstin_no" readonly maxlength="15" size="15"></td> 
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>                       
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