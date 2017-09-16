<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $com_com = $_POST['user_com_cd'];
        $UserComDbf = $_POST['user_com_dbf'];

        $iss_com = $_POST['iss_com'];
        $iss_unit = $_POST['iss_unit'];
        $iss_fyr = $_POST['iss_fyr'];
        $iss_dt = date('Y-m-d', strtotime($_POST['iss_dt']));
        $iss_tc = $_POST['iss_tc'];
        $iss_no = $_POST['iss_no'];
        $iss_srl = $_POST['iss_srl'];
        $iss_item = $_POST['iss_item'];
        $iss_qty = $_POST['iss_qty'];
        $iss_rate = $_POST['iss_itm_rate'];
        $iss_fcd = $_POST['iss_fcd'];
        $iss_dept = $_POST['iss_dept'];
        $iss_cost = $_POST['iss_cost'];
        $iss_ptycd = $_POST['iss_ptycd'];
        $iss_trf_item = $_POST['iss_trf_item'];
        $iss_truck_no = strtoupper($_POST['iss_truck_no']);
        $iss_ref_no = $_POST['iss_ref_no'];
        $iss_ref_srl = $_POST['iss_ref_srl'];
        $iss_ref_dt = date('Y-m-d', strtotime($_POST['iss_ref_dt']));
        $iss_userid = $_SESSION['usr_id'];
        $iss_updid = $_SESSION['usr_id'];
        $iss_upddt = date('Y-m-d 00:00:00');

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'issue') { 
            $query = "UPDATE $UserComDbf.invac.issue set iss_item = '$iss_item', iss_qty = $iss_qty, iss_rate = $iss_rate, iss_fcd = $iss_fcd, iss_dept = $iss_dept, iss_cost = $iss_cost, iss_ptycd = '$iss_ptycd', iss_trf_item = '$iss_trf_item', iss_truck_no = '$iss_truck_no', iss_ref_no = $iss_ref_no, iss_ref_srl = $iss_ref_srl, iss_ref_dt = '$iss_ref_dt', iss_updid = $iss_updid, iss_upddt = '$iss_upddt' WHERE iss_com = $iss_com AND iss_unit = $iss_unit AND iss_fyr = $iss_fyr AND iss_dt = '$iss_dt' AND iss_tc = $iss_tc AND iss_no = $iss_no AND iss_srl = $iss_srl";

            $sql_result = odbc_exec($conn, $query);
                if ($sql_result) { 
                    $success_msg = 'Record Updated Successfully.';                
                }else{
                    $error_msg = 'Failed To Update Record, Please Try Again.';
                }
            }else if(($passActn == 'e' || $passActn == 'b') && $frm_nm == 'issue') { 

            $query = "SELECT * FROM $UserComDbf.invac.issue WHERE iss_com = $iss_com AND iss_unit = $iss_unit AND iss_fyr = $iss_fyr AND iss_dt = '$iss_dt' AND iss_tc = $iss_tc AND iss_no = $iss_no AND iss_srl = $iss_srl";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) {
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO $UserComDbf.invac.issue (iss_com, iss_unit, iss_fyr, iss_dt, iss_tc, iss_no, iss_srl, iss_item, iss_qty, iss_rate, iss_fcd, iss_dept, iss_cost, iss_ptycd, iss_trf_item, iss_truck_no, iss_ref_no, iss_ref_srl, iss_ref_dt, iss_userid) VALUES ($iss_com, $iss_unit, $iss_fyr, '$iss_dt', $iss_tc, $iss_no, $iss_srl, '$iss_item', $iss_qty, $iss_rate, $iss_fcd, $iss_dept, $iss_cost, '$iss_ptycd', '$iss_trf_item', '$iss_truck_no', $iss_ref_no, $iss_ref_srl, '$iss_ref_dt', $iss_userid)";

            $sql_result = odbc_exec($conn, $query);
                
                if ($sql_result) {
                    $updateQuery = "UPDATE $UserComDbf.invac.parinv SET par_lval = $iss_no WHERE par_com = $iss_com AND par_unit = $iss_unit AND par_tbl = 'issue' AND par_col = $iss_tc AND par_fyr = $iss_fyr";  
                    $sql_result_update_parinv = odbc_exec($conn, $updateQuery);

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
                        Stores Issue / Returns
                        <small>Stores</small> | 
                        <small>Export To : </small>
                        <a href="exports/issue_export.php?ext=doc&dbf=<?php echo $_SESSION['com_dbf']; ?>"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/issue_export.php?ext=xls&dbf=<?php echo $_SESSION['com_dbf']; ?>"><img src="img/xls.png" width="35px"></a>  
                        <!-- <a href="exports/issue_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a> -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="issue" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">                                     
                                    <table border="1" cellpadding="3px">
                                        <tr>
                                            <th>TC Codes</th>
                                        </tr>
                                        <tr>
                                            <td><b>11</b> - Issue</td>
                                            <td><b>13</b> - Sales</td>
                                            <td><b>15</b> - Issue For Processing</td>
                                            <td><b>17</b> - St & Comp I</td>
                                            <td><b>19</b> - Adjustment</td>
                                            <td><b>22</b> - Loan Receipt</td>
                                            <td><b>25</b> - Receipts For Processing</td>
                                            <td><b>29</b> - Issue Adjustment</td>
                                        </tr>
                                        <tr>
                                            <td><b>12</b> - Loan</td>
                                            <td><b>14</b> - Trf FG</td>
                                            <td><b>16</b> - 57F4 Issue</td>
                                            <td><b>18</b> - St & Comp L</td>
                                            <td><b>21</b> - Issue Return</td>
                                            <td><b>23</b> - Transfer To Raw Material</td>
                                            <td colspan="2"><b>26</b> - 57F4 Receipt</td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </table>  <br>
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="issue">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="6" size="1">
                                                <span id="InpReqPassErrorSpan"></span>
                                            </td>
                                            <td colspan="4">
                                            <span id="ComPassErrorSpan"></span>
                                            <span id="ComCdErrorSpan"></span>
                                            <span id="ComCdName"></span>
                                            </td>  
                                        </tr>
                                        <tr>            
                                            <th>Company</th>
                                            <td>
                                                <input type="hidden" name="user_com_cd" id="user_com_cd" value="<?php echo $_SESSION['com_cd']; ?>">
                                                <input type="hidden" name="user_com_dbf" id="user_com_dbf" value="<?php echo $_SESSION['com_dbf']; ?>">
                                                <input type="text" name="iss_com" id="com_com" readonly maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>             
                                            <th>Unit Code</th>
                                            <td><input type="text" name="iss_unit" id="mat_unit" readonly maxlength="3" size="1" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            <span id="ComUntCdErrorSpan"></span>
                                            <span id="ComUntCdName"></span></td>
                                            </td>   
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>
                                            <th>TC Code</th>
                                            <td><input type="text" name="iss_tc" id="iss_tc"  maxlength="3" size="3" required readonly onkeyup="CheckInputNumFormat(this.value)"></td>     
                                            <th>Doc Date</th>
                                            <td>
                                                <input type="text" name="iss_dt" id="iss_dt" readonly maxlength="10" size="8"  value="<?php echo date('d-m-Y'); ?>" required onblur="CheckIssDocNoDetails()">
                                            </td> 
                                            <th>Financial Year</th>
                                            <td>
                                                <input type="text" name="iss_fyr" id="iss_fyr" required maxlength="4" size="4" readonly>
                                            </td>  
                                        </tr>
                                        <tr>    
                                            <th>Doc No.</th>
                                            <td><input type="text" name="iss_no" id="iss_no" readonly  maxlength="6" size="3" style="text-transform: uppercase">
                                            <span id="DocNoErrorSpan"></span></td>           
                                            <th>Srl. No.</th>
                                            <td><input type="text" name="iss_srl" id="iss_srl" readonly maxlength="3" size="1" required onblur="CheckIssSrlNoDetails()">
                                            <span id="SrlNoErrorSpan"></span></td>  
                                            <th>Stock</th>
                                            <td><input type="text" name="iss_itm_stock" value="0.00" id="iss_itm_stock" readonly maxlength="36" size="8"></td> 
                                            <th>Rate</th>
                                            <td><input type="text" name="iss_itm_rate" value="0.00" id="iss_itm_rate" readonly maxlength="36" size="8"></td>      
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>      
                                            <th>
                                                Item
                                                <small>
                                                    <a href="includes/view_details.php?q=itemcode" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0, status=1'); return false;" >( Help )</a>
                                                </small>
                                            </th>
                                            <td><input type="text" name="iss_item" id="iss_item" readonly onblur="CheckStrsIssItmCd()" maxlength="7" size="4" required>
                                            
                                            </td>
                                            <td colspan="2">
                                                <!-- <span id="ItmCdErrorSpan"></span> -->
                                                <input type="text" id="ItmCdErrorSpan" maxlength="36" size="16">
                                            </td>

                                            <th>Qty</th>
                                            <td><input type="text" name="iss_qty" id="iss_qty" readonly style="text-transform: uppercase"  maxlength="10" size="4" placeholder="0.000" onblur="CheckIssStockQty(this)">
                                            <!-- <span id="ItmUomCdErrorSpan"></span> -->
                                            <input type="text" id="ItmUomCdErrorSpan" maxlength="10" size="4">
                                            </td>
                                            <th>Dept Code
                                                <small>
                                                    <a href="includes/view_details.php?q=iss_dep_cd" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0, status=1'); return false;" >( Help )</a>
                                                </small>
                                            </th>
                                            <td><input type="text" name="iss_dept" id="iss_dept" readonly style="text-transform: uppercase" onblur="CheckStrsDeptCd()" maxlength="6" size="6"  required>
                                            </td>     
                                            <td colspan="2">
                                                <!-- <span id="DeptCdErrorSpan"></span> -->
                                                <input type="text" id="DeptCdErrorSpan" maxlength="36" size="22">
                                            </td>
                                        </tr>        
                                        <tr>      
                                            <th>Party</th>
                                            <td><input type="text" name="iss_ptycd" id="iss_ptycd" maxlength="6" size="6" readonly style="text-transform: uppercase" required></td>
                                            <th>Tr Item</th>
                                            <td><input type="text" name="iss_trf_item" id="iss_trf_item" readonly maxlength="6" size="6" required ></td> 
                                            <th>Fond Code
                                                <small>
                                                    <a href="includes/view_details.php?q=iss_fond_cd" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0, status=1'); return false;" >( Help )</a>
                                                </small>
                                            </th>
                                            <td><input type="text" name="iss_fcd" onblur="CheckStrsFondCd()" id="iss_fcd" readonly required maxlenght="3" size="1">
                                                <!-- <span id="FondCdErrorSpan"></span> -->
                                                <input type="text" id="FondCdErrorSpan" maxlength="36" size="10">
                                            </td>
                                            <th>Cost Code
                                                <small>
                                                    <a href="includes/view_details.php?q=iss_cost_cd" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0, status=1'); return false;" >( Help )</a>
                                                </small>
                                            </th>
                                            <td><input type="text" name="iss_cost" id="iss_cost" onblur="CheckStrsCostCd()"  readonly required  maxlength="6" size="4" style="text-transform: uppercase"></td> 
                                            <td colspan="2">
                                                <!-- <span id="CostCdErrorSpan"></span> -->
                                                <input type="text" id="CostCdErrorSpan" maxlength="36" size="22">
                                            </td> 
                                        </tr>
                                        <tr>    
                                            <th>Truck</th>
                                            <td><input type="text" name="iss_truck_no" id="iss_truck_no" maxlength="12" size="10" readonly></td>
                                            <th>Ref. No.</th>
                                            <td><input type="text" name="iss_ref_no" id="iss_ref_no" readonly  maxlength="6" size="6" ></td>
                                            <th>Ref. Srl. No.</th>
                                            <td><input type="text" name="iss_ref_srl" id="iss_ref_srl" readonly style="text-transform: uppercase"  maxlength="3" size="3"></td>
                                            <th>Ref. Date</th>
                                            <td><input type="text" name="iss_ref_dt" id="iss_ref_dt"  maxlength="10" size="8" readonly></td> 
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