<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {
        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $UserComDbf = $_POST['user_com_dbf'];

        $gpa_com = $_POST['gpa_com'];
        $gpa_unit = $_POST['gpa_unit'];
        $gpa_dt = date('Y-m-d 00:00:00', strtotime($_POST['gpa_dt']));
        $gpa_no = $_POST['gpa_no'];
        $gpa_ryn = strtoupper($_POST['gpa_ryn']);
        $gpa_tc = $_POST['gpa_tc'];
        $gpa_ptycd = strtoupper($_POST['gpa_ptycd']);
        $gpa_pty_rep = strtoupper($_POST['gpa_pty_rep']);
        $gpa_truck_no = strtoupper($_POST['gpa_truck_no']);
        $gpa_ref_no = $_POST['gpa_ref_no'];
        $gpa_ref_dt = date('Y-m-d 00:00:00', strtotime($_POST['gpa_ref_dt']));
        $gpa_dept = $_POST['gpa_dept'];
        $gpa_remarks = strtoupper($_POST['gpa_remarks']);
        $gpa_sys_dt = date('Y-m-d 00:00:00');
        $gpa_upd_dt = date('Y-m-d 00:00:00');
        $gpa_userid = $_SESSION['usr_id'];

        $count = count($_POST['gpd_srl']);
        $gpd_srl = $_POST['gpd_srl'];
        $gpd_item = $_POST['gpd_item'];
        $gpd_itm_desc = $_POST['gpd_itm_desc'];
        $gpd_qty = $_POST['gpd_qty'];
        $gpd_uom = $_POST['gpd_uom'];
        $gpd_rate = $_POST['gpd_rate'];

        //print_r($_POST);exit;
        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'gpmatent') { 
            $query1 = "UPDATE $UserComDbf.invac.gpass SET gpa_ryn = '$gpa_ryn', gpa_tc = $gpa_tc, gpa_ptycd = '$gpa_ptycd', gpa_pty_rep = '$gpa_pty_rep', gpa_truck_no = '$gpa_truck_no', gpa_ref_no = $gpa_ref_no, gpa_ref_dt = '$gpa_ref_dt', gpa_dept = $gpa_dept, gpa_remarks = '$gpa_remarks', gpa_sys_dt = '$gpa_sys_dt', gpa_upd_dt = '$gpa_upd_dt' WHERE gpa_com = $gpa_com AND gpa_unit = $gpa_unit AND gpa_dt = '$gpa_dt' AND gpa_no = $gpa_no";

            $sql_result1 = odbc_exec($conn, $query1);
            if ($sql_result1) { 
                    for ($i=0; $i < $count; $i++) { 
                        
                        $gpd_expected_dt = date('Y-m-d 00:00:00', strtotime($_POST['gpd_expected_dt'][$i]));
                        $gpd_itm_desc[$i] = strtoupper($gpd_itm_desc[$i]);
                        $query2 = "UPDATE $UserComDbf.invac.gpdet SET gpd_item = '$gpd_item[$i]', gpd_itm_desc = '$gpd_itm_desc[$i]', gpd_qty = $gpd_qty[$i], gpd_uom = $gpd_uom[$i], gpd_expected_dt = '$gpd_expected_dt', gpd_upd_dt = '$gpa_upd_dt', gpd_userid = $gpa_userid, gpd_rate = $gpd_rate[$i] WHERE gpd_com = $gpa_com AND gpd_unit = $gpa_unit AND gpd_dt = '$gpa_dt' AND gpd_no = $gpa_no AND gpd_srl = $gpd_srl[$i]";

                        $sql_result2 = odbc_exec($conn, $query2);
                    }
                    if ($sql_result2) { 
                        $success_msg = 'Record Updated Successfully.';
                    }else{ 
                        $error_msg = 'Failed To Update Record, Please Try Again.';
                    }
            }    
        }else if($passActn == 'e' && $frm_nm == 'gpmatent') {

            $query = "SELECT * FROM $UserComDbf.invac.gpass WHERE gpa_com = $gpa_com AND gpa_unit = $gpa_unit AND gpa_dt = '$gpa_dt' AND gpa_no = $gpa_no";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) { 
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query1 = "INSERT INTO $UserComDbf.invac.gpass (gpa_com,gpa_unit,gpa_dt,gpa_no,gpa_ryn,gpa_tc,gpa_ptycd,gpa_pty_rep,gpa_truck_no,gpa_ref_no,gpa_ref_dt,gpa_dept,gpa_remarks,gpa_sys_dt,gpa_upd_dt,gpa_userid) VALUES ($gpa_com,$gpa_unit,'$gpa_dt',$gpa_no,'$gpa_ryn',$gpa_tc,'$gpa_ptycd','$gpa_pty_rep','$gpa_truck_no',$gpa_ref_no,'$gpa_ref_dt',$gpa_dept,'$gpa_remarks','$gpa_sys_dt','$gpa_upd_dt', $gpa_userid)";

                $sql_result1 = odbc_exec($conn, $query1);
                
                if ($sql_result1) {

                    for ($i=0; $i < $count; $i++) { 

                        $gpd_expected_dt = date('Y-m-d 00:00:00', strtotime($_POST['gpd_expected_dt'][$i]));
                        $gpd_itm_desc[$i] = strtoupper($gpd_itm_desc[$i]);
                        $query2 = "INSERT INTO $UserComDbf.invac.gpdet (gpd_com,gpd_unit,gpd_dt,gpd_no,gpd_srl,gpd_item,gpd_itm_desc,gpd_qty,gpd_uom,gpd_expected_dt,gpd_upd_dt,gpd_userid,gpd_rate) VALUES ($gpa_com,$gpa_unit,'$gpa_dt',$gpa_no,$gpd_srl[$i],'$gpd_item[$i]','$gpd_itm_desc[$i]',$gpd_qty[$i],$gpd_uom[$i],'$gpd_expected_dt','$gpa_upd_dt',$gpa_userid,$gpd_rate[$i])";
                        $sql_result2 = odbc_exec($conn, $query2);
                    } 
                    if ($sql_result2) {
                        $success_msg = 'New Record Saved Successfully.';
                    }    
                }
            }
        }elseif ($passActn == 'a' && $frm_nm == 'gpmatent') { 
            for ($i=0; $i < $count; $i++) { 
                $sql_srl = "SELECT max(gpd_srl) FROM $UserComDbf.invac.gpdet WHERE gpd_com = $gpa_com AND gpd_unit = $gpa_unit AND gpd_dt = '$gpa_dt' AND gpd_no = $gpa_no";
                $sql_result_srl = odbc_exec($conn, $sql_srl);
                $gpd_srl = odbc_result($sql_result_srl, 1)+1;
                //print_r(odbc_result($sql_result_srl, 1));
                $gpd_expected_dt = date('Y-m-d 00:00:00', strtotime($_POST['gpd_expected_dt'][$i]));
                $gpd_itm_desc[$i] = strtoupper($gpd_itm_desc[$i]);
                $query2 = "INSERT INTO $UserComDbf.invac.gpdet (gpd_com,gpd_unit,gpd_dt,gpd_no,gpd_srl,gpd_item,gpd_itm_desc,gpd_qty,gpd_uom,gpd_expected_dt,gpd_upd_dt,gpd_userid,gpd_rate) VALUES ($gpa_com,$gpa_unit,'$gpa_dt',$gpa_no,$gpd_srl,'$gpd_item[$i]','$gpd_itm_desc[$i]',$gpd_qty[$i],$gpd_uom[$i],'$gpd_expected_dt','$gpa_upd_dt',$gpa_userid,$gpd_rate[$i])";
                $sql_result2 = odbc_exec($conn, $query2);
            }
            if ($sql_result2) { 
                $success_msg = 'Record Updated Successfully.';
            }else{ 
                $error_msg = 'Failed To Update Record, Please Try Again.';
            }
        }
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
                        Material Gate Pass
                        <small>Gate Pass</small> <!-- | 
                        <small>Export To : </small>
                        <a href="exports/gpmatent_export.php?ext=doc"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/gpmatent_export.php?ext=xls"><img src="img/xls.png" width="35px"></a>  
                        <a href="exports/gpmatent_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a> |  -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="gpmatent" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="gpmatent">
                                                <input type="hidden" name="user_com_dbf" id="user_com_dbf" value="<?php echo $_SESSION['com_dbf']; ?>">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="6" size="1">
                                                <span id="ComPassErrorSpan"></span>
                                            </td>
                                            <th>Company</th>
                                            <td>
                                                <input type="hidden" name="user_com_cd" id="user_com_cd" value="<?php echo $_SESSION['com_cd']; ?>">
                                                <input type="hidden" name="user_com_dbf" id="user_com_dbf" value="<?php echo $_SESSION['com_dbf']; ?>">
                                                <input type="hidden" name="user_fduser" id="user_fduser" value="<?php echo $_SESSION['fduser']; ?>">
                                                <input type="text" name="gpa_com" id="com_com"  maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                            </td>          
                                            <td colspan="4">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>&nbsp;</th><td>&nbsp;</td>
                                            <th>Unit Code</th>
                                            <td><input type="text" name="gpa_unit" id="mat_unit"  maxlength="3" size="1" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            </td>
                                            <td colspan="4">
                                                <span id="ComUntCdErrorSpan"></span>
                                                <span id="ComUntCdName"></span>
                                            </td>
                                        </tr>
                                        <tr><td colspan="6"><hr></td></tr>
                                        <tr>
                                            <th>Date</th>
                                            <td><input type="text" name="gpa_dt" id="gpa_dt" value="<?php echo date('d-m-Y'); ?>" maxlength="10" size="8" required readonly>
                                            </td>                                    
                                            <th>No</th>
                                            <td><input type="text" name="gpa_no" id="gpa_no" maxlength="2" size="1" required readonly onblur="GetGpNoDetails()">
                                            <span id="gpa_error"></span>
                                            </td>
                                            <th>Returnable (Y/N) </th>
                                            <td><input type="text" name="gpa_ryn" id="gpa_ryn" onkeyup="GetGpMatNo()"  required maxlength="1" size="1" style="text-transform: uppercase"></td>
                                            <th>TRN Code
                                                <small>
                                                    <a href="includes/view_details.php?q=trn_cd&comDbf=<?php echo $_SESSION['com_dbf']; ?>" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0, status=1'); return false;" >(Help)</a>
                                                </small>
                                            </th>
                                            <td><input type="text" name="gpa_tc" id="gpa_tc"  required maxlength="1" size="1" style="text-transform: uppercase" onblur="GetTranCdDetails()">
                                            <input type="text" name="gp_tran_name" id="gp_tran_name"  required maxlength="36" size="30" style="text-transform: uppercase">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Person Name</th>
                                            <td><input type="text" name="gpa_pty_rep" id="gpa_pty_rep" maxlength="36" size="10" required  style="text-transform: uppercase"></td>
                                            <th>Truck No</th>
                                            <td><input type="text" name="gpa_truck_no" id="gpa_truck_no"  required maxlength="36" size="10" style="text-transform: uppercase"></td>       
                                            <th>Party Cd / Emp No
                                                <small>
                                                    <a href="includes/view_details.php?q=supcd" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0, status=1'); return false;" >(Help)</a>
                                                </small>
                                            </th>
                                            <td><input type="text" name="gpa_ptycd" id="gpa_ptycd" maxlength="4" size="2" required onblur="GetPartyCdDetails()">
                                            </td>       
                                            <th>&nbsp;</th>
                                            <td>
                                                <textarea  name="gpa_ptycd_details" id="gpa_ptycd_details" rows="4" cols="39"></textarea>        
                                            </td>                                    
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr>              
                                            <th>REF No</th>
                                            <td><input type="text" name="gpa_ref_no" id="gpa_ref_no" maxlength="10" size="2" required>
                                            </td>                                    
                                            <th>REF Dt</th>
                                            <td><input type="text" name="gpa_ref_dt" id="gpa_ref_dt" maxlength="10" size="8" required></td>
                                            <th>Remarks</th>
                                            <td><input type="text" name="gpa_remarks" id="gpa_remarks"  required maxlength="36" size="10" style="text-transform: uppercase"></td>
                                            <th>Dept Cd
                                                <small>
                                                    <a href="includes/view_details.php?q=dep_cd" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0, status=1'); return false;" >(Help)</a>
                                                </small>
                                            </th>
                                            <td><input type="text" name="gpa_dept" id="gpa_dept"  required maxlength="4" size="4" onblur="GetDeptCdDetails()">
                                            <input type="text" name="gpa_dept_desc" id="gpa_dept_desc"  required maxlength="36" size="20" style="text-transform: uppercase">
                                            </td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                    </table>
                                    <table cellpadding="1" width="80%" id="gpassDetails">                    
                                        <tr>
                                            <th width="5%">Srl</th>
                                            <th width="10%">Item Code</th>
                                            <th width="20%">Item Desc</th>
                                            <th width="10%">Qty</th>
                                            <th width="10%">Rate</th>
                                            <th width="10%">UOM</th>
                                            <th width="10%">Exp. Dt</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="gpd_srl[]" value="1" id="gpd_srl" maxlength="2" size="1" required>
                                            </td>
                                            <td>
                                                <input type="text" name="gpd_item[]" id="gpd_item" maxlength="7" size="7" required>
                                            </td>
                                            <td>
                                                <input type="text" name="gpd_itm_desc[]" id="gpd_itm_desc" maxlength="36" size="20" required style="text-transform: uppercase">
                                            </td>
                                            <td>
                                                <input type="text" name="gpd_qty[]" id="gpd_qty" maxlength="10" size="5" required>
                                            </td>
                                            <td>
                                                <input type="text" name="gpd_rate[]" id="gpd_rate" maxlength="10" size="8" required>
                                            </td>
                                            <td>
                                                <input type="text" name="gpd_uom[]" id="gpd_uom" maxlength="10" size="5" required>
                                            </td>
                                            <td>
                                                <input type="text" name="gpd_expected_dt[]" id="gpd_expected_dt" placeholder="dd/mm/yyyy" maxlength="10" size="8" required>
                                            </td>
                                            <!-- <td>
                                                <input type="text" name="gpd_sur[]" id="gpd_sur" maxlength="1" size="1" required style="text-transform: uppercase">
                                            </td>
                                            <td>
                                                <input type="text" name="gpd_con[]" id="gpd_con" maxlength="1" size="1" required style="text-transform: uppercase">
                                            </td> -->
                                            <td>
                                                <a href="javascript:void(0);" id="addGpassRow" class="btn btn-xs btn-success">Add New</a>
                                            </td>
                                        </tr>
                                    </table>
                                    <span id="gpd_data"></span>
                                    <table cellpadding="1" width="100%">
                                        <tr><td colspan="8"><hr></td></tr>
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