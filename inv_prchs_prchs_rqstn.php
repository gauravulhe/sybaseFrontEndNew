<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $com_com = $_POST['user_com_cd'];

        $req_com = $_POST['user_com_cd'];
        $req_unit = $_POST['req_unit'];
        $req_fyr = $_POST['req_fyr'];
        $req_no = $_POST['req_no'];
        $req_srl = $_POST['req_srl'];
        $req_dt = date('Y-m-d', strtotime($_POST['req_dt']));
        $req_dept = $_POST['req_dept'];
        $req_item = $_POST['req_item'];
        $req_qty = $_POST['req_qty'];
        $req_aprvd_qty = $_POST['req_aprvd_qty'];
        $req_can_qty = $_POST['req_can_qty'];
        $req_rmk =  strtoupper($_POST['req_rmk']);
        $req_catg = strtoupper($_POST['req_catg']);
        $req_inq_fyr = $_POST['req_inq_fyr'];
        $req_inq_no = $_POST['req_inq_no'];
        $req_cons_days = ($_POST['req_cons_days'])?$_POST['req_cons_days']:0;

        require_once('includes/cmp_pass_actn.php');

        if (($passActn == 'u' || $passActn == 'a') && $frm_nm == 'ireq') { 
            $query = "UPDATE catalog.invac.request set req_item = '$req_item', req_qty = $req_qty, req_aprvd_qty = $req_aprvd_qty, req_can_qty = $req_can_qty, req_rmk = '$req_rmk', req_catg = '$req_catg', req_inq_fyr = $req_inq_fyr, req_inq_no = $req_inq_no, req_cons_days = $req_cons_days where req_com = $req_com AND req_unit = $req_unit AND req_fyr = $req_fyr AND req_no = $req_no AND req_srl = $req_srl AND req_dt = '$req_dt' AND req_dept = $req_dept";

            $sql_result = odbc_exec($conn, $query);
                if ($sql_result) { 
                    $success_msg = 'Record Updated Successfully.';                
                }else{
                    $error_msg = 'Failed To Update Record, Please Try Again.';
                }
            }else if($passActn == 'e' && $frm_nm == 'ireq') { 

            $query = "SELECT * FROM catalog.invac.request WHERE req_com = $req_com AND req_unit = $req_unit AND req_fyr = $req_fyr AND req_no = $req_no AND req_srl = $req_srl AND req_dt = '$req_dt' AND req_dept = $req_dept";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) {
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO catalog.invac.request (req_com, req_unit, req_fyr, req_no, req_srl, req_dt, req_dept, req_item, req_qty, req_rmk, req_catg, req_cons_days, req_inq_fyr, req_inq_no) VALUES ($req_com, $req_unit, $req_fyr, $req_no, $req_srl, '$req_dt', $req_dept, '$req_item', $req_qty, '$req_rmk', '$req_catg', $req_cons_days, $req_inq_fyr, $req_inq_no)";

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
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Purchase Requisition
                        <small>Purchase</small> | 
                        <small>Export To : </small>
                        <a href="exports/ireq_export.php?ext=doc"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/ireq_export.php?ext=xls"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/ireq_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a> -->&nbsp; | &nbsp;
                        <a href="inv_ctlg_mtrl_mstr.php?pid=ctlgs" class="btn btn-info">New Item</a>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="ireq" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="ireq">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="6" size="1">
                                                <span id="InpReqPassErrorSpan"></span>
                                                <span id="ComPassErrorSpan"></span>
                                            </td>
                                            <td colspan="2">

                                            <span id="ComCdErrorSpan"></span>
                                            <span id="ComCdName"></span>
                                            </td>  
                                        </tr>
                                        <tr>            
                                            <th>Company</th>
                                            <td>
                                                <input type="hidden" name="user_com_cd" id="user_com_cd" value="<?php echo $_SESSION['com_cd']; ?>">
                                                <input type="hidden" name="user_com_dbf" id="user_com_dbf" value="<?php echo $_SESSION['com_dbf']; ?>">
                                                <input type="text" name="req_com" id="com_com" readonly maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>             
                                            <th>Unit Code</th>
                                            <td><input type="text" name="req_unit" id="mat_unit" readonly maxlength="3" size="1" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            <span id="ComUntCdErrorSpan"></span>
                                            <span id="ComUntCdName"></span></td>
                                            </td>
                                            <th>Financial Year</th>
                                            <td>
                                                <input type="text" name="req_fyr" id="req_fyr" required maxlength="6" size="8" readonly>
                                            </td>    
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>                                            
                                            <th>Date</th>
                                            <td>
                                                <input type="hidden" name="crnt_dt" id="crnt_dt" value="<?php echo date('d-m-Y'); ?>">
                                                <input type="text" name="req_dt" id="req_dt" disabled maxlength="10" size="8"  value="<?php echo date('d-m-Y'); ?>" required>
                                            </td>  
                                            <th>Req. No.</th>
                                            <td><input type="text" name="req_no" id="req_no"  maxlength="10" size="8" required onfocus="CheckIreqSrlNo()" readonly onkeyup="CheckInputNumFormat(this.value)"></td>  
                                            <th>Department</th>
                                            <td><input type="text" name="req_dept" id="req_dept" readonly onblur="CheckDeptDescCd()" maxlength="6" size="3" style="text-transform: uppercase">
                                            <span id="DeptCdErrorSpan"></span>
                                            <span id="DeptCdName"></span></td>
                                        </tr>
                                        <tr>           
                                            <th>Srl. No.</th>
                                            <td><input type="text" name="req_srl" id="req_srl" readonly maxlength="3" size="1" required></td>        
                                            <th>
                                                Item Code
                                                <small>
                                                    <a href="includes/view_details.php?q=itemcode" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0, status=1'); return false;" >( Help )</a>
                                                </small>
                                            </th>
                                            <td><input type="text" name="req_item" id="req_item" readonly onblur="CheckPrchsItmCd()" maxlength="7" size="4" required>
                                            <span id="ItmCdErrorSpan"></span>
                                            </td>
                                            <th>Description</th>
                                            <td><input type="text" name="req_desc" id="req_desc" readonly style="text-transform: uppercase"  maxlength="36" size="30"></td>
                                        </tr>
                                        <tr>      
                                            <th>Req. Qty</th>
                                            <td><input type="text" name="req_qty" id="req_qty" readonly style="text-transform: uppercase" onblur="CheckPrchsReqQty()" maxlength="10" size="7"  required  placeholder="0.00">
                                                <span id="ItmUomName"></span>
                                            </td>     
                                            <th>Remarks</th>
                                            <td><input type="text" name="req_rmk" id="req_rmk" readonly required  style="text-transform: uppercase"></td>       
                                            <th>Category ( E/U/O )</th>
                                            <td><input type="text" name="req_catg" id="req_catg" readonly style="text-transform: uppercase" required></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span id="ReqQtyCdErrorSpan"></span>
                                            </td>
                                        </tr>        
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>
                                            <th>Rate</th>
                                            <td><input type="text" name="req_rate" id="req_rate" readonly required placeholder="0.00"></td> 
                                            <th>Stock</th>
                                            <td><input type="text" name="req_stck" id="req_stck" readonly required maxlenght="10" size="5" placeholder="0.00"></td>      
                                            <th>Min. Stock</th>
                                            <td><input type="text" name="req_min_stck" id="req_min_stck" readonly  placeholder="0.00"></td> 
                                        </tr>
                                        <tr>
                                            <th>Max. Stock</th>
                                            <td><input type="text" name="req_mx_stck" id="req_mx_stck" readonly  placeholder="0.00"></td>
                                            <th>Net Requirment</th>
                                            <td><input type="text" name="req_net_req" id="req_net_req" readonly style="text-transform: uppercase" placeholder="0.00"></td>
                                            <th>Last PO No.</th>
                                            <td><input type="text" name="req_last_po" id="req_last_po" readonly></td>
                                        </tr>
                                        <tr>    
                                            <th>Srl</th>
                                            <td><input type="text" name="req_srl_no" id="req_srl_no" readonly></td>
                                            <th>PO Date</th>
                                            <td><input type="text" name="req_po_dt" id="req_po_dt" readonly></td>
                                            <th>Pending Qty.</th>
                                            <td><input type="text" name="req_pen_qty" id="req_pen_qty" readonly placeholder="0.00"></td>
                                        </tr>
                                        <tr>    
                                            <th>Cancelled Qty.</th>
                                            <td><input type="text" name="req_can_qty" id="req_can_qty" readonly placeholder="0.00"></td> 
                                            <th>Approved Qty.</th>
                                            <td><input type="text" name="req_aprvd_qty" id="req_aprvd_qty" readonly style="text-transform: uppercase" placeholder="0.00"></td>      
                                            <th>Consume In Days</th>
                                            <td><input type="text" name="req_cons_days" id="req_cons_days" readonly></td>  
                                        </tr>                                        
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>                                            
                                            <th>Fin. Year</th>
                                            <td><input type="text" name="req_inq_fyr" id="req_inq_fyr" readonly maxlength="4" size="1">
                                            </td>
                                            <th>Inquiry. No.</th>
                                            <td><input type="text" name="req_inq_no" id="req_inq_no" readonly maxlength="6" size="6"></td> 
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