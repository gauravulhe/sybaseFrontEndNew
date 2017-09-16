<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {

        //print_r($_POST);exit;

        $GLOBALS['Guser_id'] = $_SESSION['usr_id'];
        $comm_pass = $_POST['comm_pass']; 
        $frm_nm = $_POST['frm_nm'];
        $com_com = $_POST['grh_com'];
        $UserComDbf = $_POST['user_com_dbf'];
        $DbUser = $_SESSION['fduser'];

        // grhdr table fields
        $grh_com = $_POST['grh_com'];
        $grh_unit = $_POST['grh_unit'];
        $grh_fyr = $_POST['poh_fyr'];
        $grh_supcd = strtoupper($_POST['grh_supcd']);
        $grh_dt = date('Y-m-d 00:00:00', strtotime($_POST['grh_dt']));
        $grh_no = $_POST['grh_no'];
        $grh_chal_dt = date('Y-m-d 00:00:00', strtotime($_POST['grh_chal_dt']));
        $grh_chal_no = $_POST['grh_chal_no'];
        $grh_gate_dt = date('Y-m-d 00:00:00', strtotime($_POST['grh_gate_dt']));
        $grh_gate_no = $_POST['grh_gate_no'];
        $grh_transporter = strtoupper($_POST['grh_transporter']);
        $grh_trans_rate = $_POST['grh_trans_rate'];
        $grh_truck_no = strtoupper($_POST['grh_truck_no']);
        $grh_lr_no = $_POST['grh_lr_no'];
        $grh_unloader = $_POST['grh_unloader'];
        $grh_agent = $_POST['grh_agent'];
        $grh_agent_rate = $_POST['grh_agent_rate'];
        $grh_rly = strtoupper($_POST['grh_rly']);
        $grh_rly_rate = $_POST['grh_rly_rate'];
        $grh_userid = $_SESSION['usr_id'];

        // not null values
        $grh_tran_cd = ($_POST['grh_tran_cd'])?$_POST['grh_tran_cd']:'0000';
        $grh_ent_dt = date('Y-m-d 00:00:00');
        $grh_sys_dt = date('Y-m-d 00:00:00');
        
        // grdet table fields
        $grd_com = $_POST['grh_com'];
        $grd_unit = $_POST['grh_unit'];
        $grd_fyr = $_POST['poh_fyr'];
        $grd_no = $_POST['grh_no'];
        $grd_dt = date('Y-m-d 00:00:00', strtotime($_POST['grh_dt']));
        $grd_srl = $_POST['grd_srl'];
        $grd_po_fyr = ($_POST['pod_fyr'])?$_POST['pod_fyr']:'';
        $grd_po_fyr = implode(',', $grd_po_fyr);
        $grd_po_fyr = explode(',', $grd_po_fyr);
        $grd_po_no = ($_POST['pod_po_no'])?$_POST['pod_po_no']:'';
        $grd_po_no = implode(',', $grd_po_no);
        $grd_po_no = explode(',', $grd_po_no);
        $grd_po_srl = ($_POST['pod_po_srl'])?$_POST['pod_po_srl']:'';
        $grd_po_srl = implode(',', $grd_po_srl);
        $grd_po_srl = explode(',', $grd_po_srl);
        $grd_item = ($_POST['pod_item'])?$_POST['pod_item']:'';
        $grd_item = implode(',', $grd_item);
        $grd_item = explode(',', $grd_item);
        $grd_chal_qty = implode(',', $_POST['grd_chal_qty']);
        $grd_chal_qty = explode(',', $grd_chal_qty);
        $grd_rcv_qty = implode(',', $_POST['grd_rcv_qty']);
        $grd_rcv_qty = explode(',', $grd_rcv_qty);
        $grd_unloader_rate = implode(',', $_POST['grd_unloader_rate']);
        $grd_unloader_rate = explode(',', $grd_unloader_rate);
        $pod_rate = ($_POST['pod_rate'])?$_POST['pod_rate']:'';
        $pod_rate = implode(',', $pod_rate);
        $pod_rate = explode(',', $pod_rate);
        $count = count($grd_srl);


        $_SESSION['grn_com_params']['count'] = $count;
        $_SESSION['grn_com_params']['UserComDbf'] = $UserComDbf;
        $_SESSION['grn_com_params']['grd_com'] = $grd_com;
        $_SESSION['grn_com_params']['grd_unit'] = $grd_unit;
        $_SESSION['grn_com_params']['grd_fyr'] = $grd_fyr;
        $_SESSION['grn_com_params']['grd_no'] = $grd_no;
        $_SESSION['grn_com_params']['grd_srl'] = $grd_srl;
        $_SESSION['grn_com_params']['grd_po_fyr'] = $grd_po_fyr;
        $_SESSION['grn_com_params']['grd_dt'] = $grd_dt;
        $_SESSION['grn_com_params']['grd_po_no'] = $grd_po_no;
        $_SESSION['grn_com_params']['grd_po_srl'] = $grd_po_srl;
        $_SESSION['grn_com_params']['pod_rate'] = $pod_rate;

        // not null values
        $grd_stax_cd = $_POST['poh_stax_cd'];
        $grh_ent_dt = date('Y-m-d 00:00:00');
        $grd_sys_dt = date('Y-m-d 00:00:00');
        $grd_upd_dt = date('Y-m-d 00:00:00');

        require_once('includes/cmp_pass_actn.php');

        if ($passActn == 'u' && $frm_nm == 'grnent') { 
            $query = "UPDATE $UserComDbf.invac.grhdr SET grh_supcd = '$grh_supcd', grh_chal_dt = '$grh_chal_dt', grh_chal_no = $grh_chal_no, grh_gate_dt = '$grh_gate_dt', grh_gate_no = $grh_gate_no, grh_transporter = '$grh_transporter', grh_trans_rate = $grh_trans_rate, grh_truck_no = '$grh_truck_no', grh_lr_no = '$grh_lr_no', grh_unloader = '$grh_unloader', grh_agent = '$grh_agent', grh_agent_rate = $grh_agent_rate, grh_rly = '$grh_rly', grh_rly_rate = $grh_rly_rate, grh_updid = $grh_userid WHERE grh_com = $grh_com AND grh_unit = $grh_unit AND grh_fyr = $grh_fyr AND grh_no = $grh_no";

            $sql_result = odbc_exec($conn, $query);
                if ($sql_result) { 

                    // UPDATE into podet
                    for ($i=0; $i < $count; $i++) { 
                        $queryPod = "UPDATE $UserComDbf.invac.grdet SET grd_chal_qty = $grd_chal_qty[$i], grd_rcv_qty = $grd_rcv_qty[$i], grd_unloader_rate = $grd_unloader_rate[$i], grd_upd_dt = '$grd_upd_dt', grd_sys_dt = '$grd_sys_dt' WHERE grd_com = $grh_com AND grd_unit = $grh_unit AND grd_fyr = $grh_fyr AND grd_no = $grd_no";

                        $sql_resultPod = odbc_exec($conn, $queryPod);
                    }

                    if ($sql_resultPod) { 
                        $success_msg = 'Record Updated Successfully.';
                    }                
                }else{
                    $error_msg = 'Failed To Update Record, Please Try Again.';
                }
            }else if($passActn == 'e' && $frm_nm == 'grnent') {  
               
            $query = "SELECT * FROM $UserComDbf.invac.grhdr WHERE grh_com = $grh_com AND grh_unit = $grh_unit AND grh_fyr = $grh_fyr AND grh_no = $grh_no";
            $result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
            $result = odbc_exec($conn, $query);
            $row = odbc_result($result, 1);

            if (!empty($row)) {
                $error_msg = 'Record Already Exists. Please try again.';
            }else{
                $query = "INSERT INTO $UserComDbf.invac.grhdr (grh_com,grh_unit,grh_fyr,grh_supcd,grh_dt,grh_no,grh_chal_dt,grh_chal_no,grh_gate_dt,grh_gate_no,grh_transporter,grh_trans_rate,grh_truck_no,grh_lr_no,grh_unloader,grh_agent,grh_agent_rate,grh_rly,grh_rly_rate,grh_userid,grh_tran_cd,grh_ent_dt,grh_sys_dt) VALUES ($grh_com,$grh_unit,$grh_fyr,'$grh_supcd','$grh_dt',$grh_no,'$grh_chal_dt',$grh_chal_no,'$grh_gate_dt',$grh_gate_no,'$grh_transporter',$grh_trans_rate,'$grh_truck_no','$grh_lr_no','$grh_unloader','$grh_agent',$grh_agent_rate,'$grh_rly',$grh_rly_rate,$grh_userid,'$grh_tran_cd','$grh_ent_dt','$grh_sys_dt')";

                $sql_result = odbc_exec($conn, $query);
                
                if ($sql_result) {

                    $updateQuery1 = "UPDATE $UserComDbf.invac.parinv SET par_lval = $grh_no WHERE par_com = $grh_com AND par_unit = $grh_unit AND par_tbl = 'grhdr' AND par_col = 1 AND par_fyr = $grh_fyr";

                    $sql_result_update_parinv = odbc_exec($conn, $updateQuery1);

                    for ($i=0; $i < $count; $i++) { 
                        $updateQuery2 = "UPDATE $UserComDbf.invac.podet SET pod_rate = $pod_rate[$i] WHERE pod_com = $grd_com AND pod_unit = $grd_unit AND pod_fyr = $grd_po_fyr[$i] AND pod_po_no = $grd_po_no[$i] AND pod_po_srl = $grd_po_srl[$i] AND pod_item = '$grd_item[$i]'";

                        $sql_result_update_pod_rate = odbc_exec($conn, $updateQuery2);                    
                    }

                    if ($grh_tran_cd != '0000') {

                        $querySubmast = "SELECT * FROM $UserComDbf.$DbUser.submast WHERE sub_accd = '271204' AND sub_com = $grh_com AND sub_unit = $grh_unit AND sub_subcd = '$grh_tran_cd'";
                        $resultSubmast = odbc_exec($conn, $querySubmast);
                        $dataSubmast = odbc_result($resultSubmast, 1);
                        if (empty($dataSubmast) || $dataSubmast == '') {

                            $updateQuery3 = "INSERT INTO $UserComDbf.$DbUser.submast (sub_com,sub_unit,sub_accd,sub_subcd,sub_desc,sub_opbal,sub_opbaldt,sub_cat,sub_agetag,sub_pancard) VALUES ($grh_com,$grh_unit,'271204','$grh_tran_cd','$grh_transporter',0,'20110331','','','')";

                            $sql_result_update_submast = odbc_exec($conn, $updateQuery3);
                        }
                    }


                    for ($i=0; $i < $count; $i++) {                        
                        // insert into podet
                        $queryPod = "INSERT INTO $UserComDbf.invac.grdet (grd_com,grd_unit,grd_fyr,grd_no,grd_dt,grd_srl,grd_po_fyr,grd_po_no,grd_po_srl,grd_item,grd_chal_qty,grd_rcv_qty,grd_unloader_rate,grd_stax_cd,grd_sys_dt) VALUES ($grd_com,$grd_unit,$grd_fyr,$grd_no,'$grd_dt',$grd_srl[$i],$grd_po_fyr[$i],$grd_po_no[$i],$grd_po_srl[$i],'$grd_item[$i]',$grd_chal_qty[$i],$grd_rcv_qty[$i],$grd_unloader_rate[$i],$grd_stax_cd,'$grd_sys_dt')";

                        $sql_resultPod = odbc_exec($conn, $queryPod);

                    }

                    if ($sql_resultPod) {
                        $success_msg = 'New Record Saved Successfully.';
                        header("Location:inv_strs_grn_prcssng_comm.php");
                    }
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
                        Material Receipt
                        <small>Stores</small> <!-- | 
                        <small>Export To : </small>
                        <a href="exports/grnent_export.php?ext=doc"><img src="img/word.png" width="35px"></a>  
                        <a href="exports/grnent_export.php?ext=xls"><img src="img/xls.png" width="35px"></a>  
                        <a href="exports/grnent_export.php?ext=pdf"><img src="img/pdf.png" width="35px"></a> -->                        
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="grnent" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1" id="grn_table">
                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input type="hidden" name="frm_nm" id="frm_nm" value="grnent">
                                                <input type="password" name="comm_pass" id="comm_pass" onblur="CheckComPass()" required maxlength="6" size="1">
                                                <span id="InpReqPassErrorSpan"></span>
                                                <span id="ComPassErrorSpan"></span>
                                            </td>
                                            <th>Company</th>
                                            <td>
                                                <input type="hidden" name="user_com_cd" id="user_com_cd" value="<?php echo $_SESSION['com_cd']; ?>">
                                                <input type="hidden" name="user_com_dbf" id="user_com_dbf" value="<?php echo $_SESSION['com_dbf']; ?>">
                                                <input type="hidden" name="user_fduser" id="user_fduser" value="<?php echo $_SESSION['fduser']; ?>">
                                                <input type="text" name="grh_com" id="com_com" readonly maxlength="3" size="1" onblur="CheckComCd()" required onkeyup="CheckInputNumFormat(this.value)">
                                                <span id="ComCdErrorSpan"></span>
                                                <span id="ComCdName"></span>
                                            </td>             
                                            <th>Unit Code</th>
                                            <td><input type="text" name="grh_unit" id="mat_unit" readonly maxlength="3" size="1" required  onblur="CheckMatMastUntCd()" onkeyup="CheckInputNumFormat(this.value)">
                                            <span id="ComUntCdErrorSpan"></span>
                                            <span id="ComUntCdName"></span></td>
                                            </td> 
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr id="grn_edit_tr" class="">          
                                            <th>PO No.</th>
                                            <td>
                                                <input type="text" name="grh_poh_po_no" id="grh_poh_po_no" readonly maxlength="5" size="3" required disabled>
                                            </td>   
                                            <th>Fin Year</th>
                                            <td>
                                                <input type="text" name="poh_fyr" id="poh_fyr" readonly  onblur="CheckGRNPoNoDetails()" maxlength="4" size="3" style="text-transform: uppercase">
                                                <span id="GrnPoCdErrorSpan"></span>
                                            </td>
                                            <th>Supplier</th>
                                            <td>
                                                <input type="text" name="grh_supcd" id="poh_supcd" readonly style="text-transform: uppercase"  maxlength="4" size="3">
                                                <span id="PoSupCdErrorSpan"></span>
                                            </td>
                                        </tr>                                        
                                        <tr id="grn_update_tr" class="hide">
                                            <th>Fin Year</th>
                                            <td>
                                                <input type="text" name="poh_fyr" id="poh_fyr_upd" readonly   readonly maxlength="4" size="3" style="text-transform: uppercase">
                                            </td>
                                            <th>Supplier</th>
                                            <td>
                                                <input type="text" name="grh_supcd" id="poh_supcd_upd" readonly style="text-transform: uppercase"  maxlength="4" size="3">
                                                <span id="PoSupCdErrorSpanUpd"></span>
                                                
                                            </td>
                                        </tr>
                                        <tr><td colspan="8"><hr><span id="GrnNoErrorSpanUpd"></span></td></tr>                                        
                                        <tr>    
                                            <td colspan="8">
                                                    <span id="pod_data"></span>
                                            </td>
                                        </tr>
                                        <tr><td colspan="8"><hr></td></tr>
                                        <tr id="toggle_grn_form1" class="hide">
                                            <td colspan="8">
                                                <table width="100%">
                                                    <tr>               
                                                        <th>GRN Date</th>
                                                        <td>
                                                            <input type="hidden" name="crnt_dt" id="crnt_dt" value="<?php echo date('d-m-Y'); ?>">
                                                            <input type="text" name="grh_dt" id="grh_dt"  maxlength="10" readonly size="8"  value="<?php echo date('d-m-Y'); ?>" required>
                                                            <span id="GrnDtErrorSpan"></span>
                                                        </td>         
                                                        <th>GRN No</th>
                                                        <td>
                                                            <input type="text" name="grh_no" id="grh_no"  maxlength="7" readonly size="8" onfocus="CheckLastGrnNo()" onblur="CheckLastGrnNo()" onkeyup="CheckInputNumFormat(this.value)" required>
                                                        <span id="PoTypeErrorSpan"></span>
                                                        </td> 
                                                        <th>Challan Date</th>
                                                        <td><input type="text" name="grh_chal_dt" id="grh_chal_dt" readonly  maxlength="10" size="8" required  value="<?php echo date('d-m-Y'); ?>" >
                                                        <span id="PoInqNoErrorSpan"></span> 
                                                        </td>
                                                    </tr>
                                                    <tr>      
                                                        <th>Challan No</th>
                                                        <td><input type="text" name="grh_chal_no" id="grh_chal_no"  style="text-transform: uppercase" maxlength="7" size="8" required>
                                                        </td>     
                                                        <th>Gate Regn.Dt</th>
                                                        <td>   
                                                            <input type="text" name="grh_gate_dt" id="grh_gate_dt" readonly required  style="text-transform: uppercase" maxlength="10" size="8" value="<?php echo date('d-m-Y'); ?>">
                                                        </td>
                                                        <th>Gate No</th>
                                                        <td>
                                                            <input type="text" name="grh_gate_no" id="grh_gate_no" style="text-transform: uppercase" required maxlength="10" size="8">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Transporter
                                                            <small>
                                                                <a href="includes/view_details.php?q=supcd" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0'); return false;" >(Help)</a>
                                                            </small>
                                                        </th>
                                                        <td>
                                                            <input type="text" name="grh_tran_cd" id="grh_tran_cd" required onblur="CheckGrnTranspCd(this)" maxlength="4" size="2" value="0000">
                                                            <input type="text" name="grh_transporter" id="grh_transporter" required  maxlength="4" size="4" value="OTHERS">
                                                        </td> 
                                                        <th>Trans Rate</th>
                                                        <td><input type="text" name="grh_trans_rate" id="grh_trans_rate" required maxlenght="10" size="8" placeholder="00.00" onblur="setNumberDecimal(this)"></td> 
                                                        <th>Truck no</th>
                                                        <td><input type="text" name="grh_truck_no" id="grh_truck_no" maxlength="36" size="8" style="text-transform: uppercase"></td>
                                                    </tr>
                                                    <tr>      
                                                        <th>LR No</th>
                                                        <td><input type="text" name="grh_lr_no" id="grh_lr_no" maxlength="10" size="8">
                                                        </td>
                                                        <th>
                                                            Unloader
                                                            <small>
                                                                <a href="includes/view_details.php?q=unloader" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0'); return false;" >(Help)</a>
                                                            </small>
                                                        </th>
                                                        <td><input type="text" name="grh_unloader" id="grh_unloader" maxlength="10" size="8" value="0000"></td> 
                                                        <th>
                                                            Agent
                                                            <small>
                                                                <a href="includes/view_details.php?q=agent" onclick="window.open(this.href,'mywin','left=200,top=150,width=500,height=500,toolbar=1,resizable=0'); return false;" >(Help)</a>
                                                            </small>
                                                        </th>
                                                        <td>
                                                            <input type="text" name="grh_agent" id="grh_agent" maxlength="36" size="8" value="0000" onblur="CheckGrnAgentCd(this)">
                                                        </td>
                                                    </tr>
                                                    <tr>      
                                                        <th>Agent Rate</th>
                                                        <td><input type="text" name="grh_agent_rate" id="grh_agent_rate" maxlength="10" size="8" placeholder="00.00"></td>
                                                        <th>RLY [Y/N]</th>
                                                        <td>
                                                            <input type="text" name="grh_rly" id="grh_rly" maxlength="1" size="1" style="text-transform: uppercase">
                                                            <input type="text" name="grh_rly_rate" id="grh_rly_rate" maxlength="10" size="1" style="text-transform: uppercase" onblur="setNumberDecimal(this)">
                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td>
                                                            <input type="text" name="grh_agent_desc" id="grh_agent_desc" maxlength="36" size="8" value="OTHERS">
                                                        </td>   
                                                    </tr>
                                                    <input type="hidden" name="poh_stax_cd" id="poh_stax_cd">
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8">
                                                <table width="100%" id="gra_data_append"  class="hide">
                                                    <tr><td colspan="8"><hr></td></tr>
                                                </table>
                                            </td>
                                        </tr>  
                                        <tr>
                                            <td colspan="8">
                                                <table width="100%" id="gra_data_append_upd"  class="">
                                                    
                                                </table>
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td colspan="8">
                                                <table width="100%" id="submit_clear_append"  class="hide">
                                                    <tr><td colspan="8"><hr></td></tr>
                                                    <tr><td>&nbsp;</td></tr>                    
                                                    <tr>
                                                        <td colspan="8" align="center">
                                                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                                            <input type="reset" name="clear" value="Clear" class="btn btn-primary">
                                                        </td>
                                                    </tr>
                                                </table>
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