<ul>
                      <li><a href="dashboard.php"><img src="img/home.png" width="20px"></a></li>
                      <li><a href="#" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'ctlgs') { echo "active-menu"; }{ echo ""; }?>>Catalogues & Masters</a>
                        <ul>
                            <li><a href="inv_ctlg_cmp_ctlg.php?pid=ctlgs">Company Catalogue</a></li>
                            <li><a href="inv_ctlg_gnrl_cd_ctlg.php?pid=ctlgs">General Codes Catalogue</a></li>
                            <li><a href="inv_ctlg_mtrl_ctlg.php?pid=ctlgs">Material Catalogue</a></li>
                            <li><a href="inv_ctlg_deprt_cst_ctlg.php?pid=ctlgs">Depart./Cost Center Catalogue</a></li>
                            <li><a href="inv_ctlg_spplr_ctlg.php?pid=ctlgs">Supplier Catalogue</a></li>
                            <li><a href="inv_ctlg_mtrl_mstr.php?pid=ctlgs">Material Master</a></li>
                            <li><a href="inv_ctlg_spplr_mstr.php?pid=ctlgs">Supplier Master</a></li>
                            <li><a href="inv_ctlg_ecc_mstr.php?pid=ctlgs">Ecc Master ( Supplier )</a></li>
                            <!-- <li><a href="inv_ctlg_shrtg_allwd.php">Shortage Allowed</a></li> -->
                            <li><a href="#">Shortage Allowed</a></li>
                        </ul>
                      </li>
                      <li><a href="#" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'prchs') { echo "active-menu"; }{ echo ""; }?>>Purchase</a>
                        <ul>
                            <li><a href="inv_prchs_prchs_rqstn.php?pid=prchs">Purchase Requisition</a></li>
                            <li><a href="inv_prchs_inqry_lttr.php?pid=prchs">Inquiry Letter</a></li>
                            <li><a href="inv_prchs_qcs_prcssng.php?pid=prchs">QCS Processing</a></li>
                            <li><a href="inv_prchs_prchs_ordrs.php?pid=prchs">Purchase Orders</a>
                                <ul>
                                    <li><a href="inv_prchs_prchs_ordrs_print.php?pid=prchs" target="_blank">Purchase Order Print</a></li>
                                </ul>
                            </li>
                            <li><a href="inv_prchs_wrk_ordrs.php?pid=prchs">Work Orders</a></li>
                            <li><a href="#">Audit</a>
                                <ul>
                                    <li><a href="inv_prchs_audit_prchs_ordr.php?pid=prchs"> 1. Purchase Order</a></li>
                                    <li><a href="inv_prchs_audit_po_grn_diff.php?pid=prchs"> 2. PO Grn. Rate Diff.</a></li>
                                    <li><a href="inv_prchs_audit_po_hdr_upd.php?pid=prchs"> 3. PO Header Update</a></li>
                                    <li><a href="inv_prchs_audit_po_det_upd.php?pid=prchs"> 4. PO Detail Update</a></li>
                                    <li><a href="inv_prchs_audit_po_sch_upd.php?pid=prchs"> 5. PO Schedule Update</a></li>
                                    <li><a href="inv_prchs_audit_po_comm_upd.php?pid=prchs"> 6. PO Commercial Update</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Purchase/Work Order Updation</a>
                                <ul>
                                    <li><a href="inv_prchs_prchs_ordr_po_hdr.php?pid=prchs"> 1. PO Header</a></li>
                                    <li><a href="inv_prchs_prchs_ordr_po_dtl.php?pid=prchs"> 2. PO Detail</a></li>
                                    <li><a href="inv_prchs_prchs_ordr_po_commrcl.php?pid=prchs"> 3. PO Commercial</a></li>
                                </ul>
                            </li>
                            <li><a href="inv_prchs_prm_clsr.php?pid=prchs">PRM Short Closer</a></li>
                            <li><a href="inv_prchs_po_shrt_clsr.php?pid=prchs">Purchase Order Short Closer</a></li>
                            <li><a href="inv_prchs_po_cncltn.php?pid=prchs">Purchase Order Cancelation</a></li>
                            <li><a href="#">Reports</a>
                                <ul>
                                    <li><a href="inv_prchs_reprts_po_list.php?pid=prchs"> 1. PO Listing (PO Number Wise)</a></li>
                                    <li><a href="inv_prchs_reprts_itm_prchs.php?pid=prchs"> 2. Item Wise Purchases (Avg. Val)</a></li>
                                    <li><a href="inv_prchs_reprts_itm_po_list.php?pid=prchs"> 3. Item Wise PO List (Rate)</a></li>
                                    <li><a href="inv_prchs_reprts_itm_spplr_list.php?pid=prchs"> 4. Item Wise Supplier List</a></li>
                                    <li><a href="inv_prchs_reprts_spplr_pndng_list.php?pid=prchs"> 5. Supplier Wise Pending PO List</a></li>
                                    <li><a href="inv_prchs_reprts_grnpo_audit.php?pid=prchs"> 6. GRN/PO Rate Diff Audit Report</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Query On Pending PRM,PO & Rate</a>
                                <ul>
                                    <li><a href="inv_prchs_qry_pos.php?pid=prchs"> 1. Query On Pending POS</a></li>
                                    <li><a href="inv_prchs_qry_prms.php?pid=prchs"> 2. Query On Pending PRMS</a></li>
                                    <li><a href="inv_prchs_qry_spplr.php?pid=prchs"> 3. Query On Supplier PO Rate's</a></li>
                                </ul>
                            </li>
                        </ul>
                      </li>
                      <li><a href="#" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'strs') { echo "active-menu"; }{ echo ""; }?>>Stores</a>        
                          <ul>
                              <li><a href="">Stock Updation</a></li>
                              <li><a href="inv_strs_grn_prcssng.php?pid=strs">GRN Processing</a></li>
                              <li><a href="">GRNs Rejections ( ITEM WISE )</a></li>
                              <li><a href="">GRNs Rejections ( SUPPLIER WISE )</a></li>
                              <li><a href="">GRNs Pending for Insp/Bill</a></li>
                              <li><a href="">TC Wise Store Tran.Register</a></li>
                              <li><a href="">Freight Advice</a></li>
                              <li><a href="inv_strs_tds_decl.php?pid=strs">TDS Declaration</a></li>
                              <li><a href="inv_strs_strs_issue_rtrns.php?pid=strs">Stores Issue/Returns</a>
                                <ul>
                                    <li><a href="inv_strs_strs_issue_slips_print.php?pid=strs">Issue Slips Print</a></li>
                                    <li><a href="">Issue Register ( St / Com ) Print</a></li>
                                    <li><a href="inv_strs_strs_receipt_issue_print.php?pid=strs">Receipt / Issue Print</a></li>
                                    <li><a href="inv_strs_strs_issue_reg_tc_itm_print.php?pid=strs">Issue Reg. Tc / Item Wise Print</a></li>
                                </ul>
                              </li>
                              <li><a href="">Non-Moving Items</a></li>
                              <li><a href="">Stores Ledger</a></li>
                              <li><a href="inv_strs_itm_grn_values_print.php?pid=strs">Item Wise GRN With Values</a></li>
                              <li><a href="">PO Type Wise Grn Listing </a></li>
                              <li><a href="inv_strs_cons_reps_item_dep_cost_print.php?pid=strs">Consumption Reps.Item/Dep/Cost</a></li>
                              <li><a href="">Weighment Record (WR) </a></li>
                              <li><a href="">Material Rejection Memo</a></li>
                          </ul>
                      </li>
                      <li><a href="#" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'reprts') { echo "active-menu"; }{ echo ""; }?>>Reports</a>
                          <ul>
                              <li><a href="">PRM Register</a></li>
                              <li><a href="">PRM's Status Report</a></li>
                              <li><a href="">PO. register</a></li>
                              <li><a href="">Goods Inwards Register</a></li>
                              <li><a href="">Inventory Age Analysis</a></li>
                              <li><a href="">Tc wise Tran.Register</a></li>
                              <li><a href="">Item/Challanwise GRN List</a></li>
                              <li><a href="">Stores Ledger</a></li>
                              <li><a href="">Grn Wise Excise/Cess</a></li>
                              <li><a href="">Stock Statement (With Value)</a></li>
                              <li><a href="">Stock Statement (Without Val)</a></li>
                              <li><a href="">Material Rejection Status</a></li>
                              <li><a href="">Inventory Stock Ageing Report</a></li>
                              <li><a href="">Purchase Dept.Performance Rep.</a></li>
                              <li><a href="">Freight Register</a></li>
                          </ul>
                      </li>
                      <li><a href="#" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'ms') { echo "active-menu"; }{ echo ""; }?>>M.I.S.</a>
                          <ul>
                              <li><a href="">PRM's Status Report</a></li>
                              <li><a href="">Pending PRM's Printing</a></li>
                              <li><a href="">Pending PO'S/WO'S Printing</a></li>
                              <li><a href="">Item Wise Fifo Ledger</a></li>
                              <li><a href="">Suppl.wise Material Rejection</a></li>
                              <li><a href="">Item wise Receipts/Issues</a></li>
                              <li><a href="">Itemwise Purchases</a></li>
                              <li><a href="#">Item Wise Budget</a>
                                  <ul>
                                      <li><a href=""> 1. Daily Entry</a></li>
                                      <li><a href=""> 2. Monthly Entry</a></li>
                                      <li><a href=""> 3. Report</a></li>
                                  </ul>
                              </li>

                              <li><a href="">Supplier wise Purchases</a></li>
                              <li><a href="">All Comp.Supplier C-Form</a></li>
                              <li><a href="">History of Vendor</a></li>
                              <li><a href="">ABC Analysis</a></li>
                              <li><a href="">Itemwise Supplier List</a></li>
                              <li><a href="">Min-Max-Stock Report</a></li>
                              <li><a href="">Emp.Issue Register</a></li>
                              <li><a href="">RPP Report</a></li>
                          </ul>
                      </li>
                      <li><a href="#" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'prntng') { echo "active-menu"; }{ echo ""; }?>>Printing Files</a></li>
                      <li><a href="#" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'qry') { echo "active-menu"; }{ echo ""; }?>>Query</a>
                          <ul>
                              <li><a href="">Itemwise Pending PRMs</a></li>
                              <li><a href="">Itemwise Pending PO.</a></li>
                              <li><a href="">Supplier wise PO Rate's</a></li>
                              <li><a href="">Supplierwise Pending PO.</a></li>
                              <li><a href="">Supplier wise GRN</a></li>
                              <li><a href="">Blank Item Codes</a></li>
                              <li><a href="">Material Code Query</a></li>
                              <li><a href="">Material/Supplier wise Query</a></li>
                              <li><a href="">Supplier/Material wise query</a></li>
                              <li><a href="">Supplier/Item wise Po's Query</a></li>
                              <li><a href="">Item Stcok Query</a></li>
                              <li><a href="">Party Wise Liability Reg.</a></li>
                              <li><a href="">C-Form Entry</a></li>
                          </ul>
                      </li>  
                      <li><a href="#" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'gpass') { echo "active-menu"; }{ echo ""; }?>>Gate Pass</a>
                          <ul>
                              <li><a href="#">Master Maintenance</a>
                                  <ul>
                                      <li><a href="#">Catalogues & Master</a>
                                          <ul>
                                              <li><a href="inv_gpass_main_cat_tran_mast.php?pid=gpass">Transaction Master</a></li>
                                          </ul>
                                      </li>
                                  </ul>
                              </li>
                              <li><a href="#">Gatepass Entry</a>
                                  <ul>
                                      <li><a href="inv_gpass_gpent_mat_gp.php?pid=gpass"> 1. Material Gatepass</a></li>
                                      <li><a href=""> 2. Employee Gatepass</a></li>
                                      <li><a href=""> 3. Visitors Gatepass</a></li>
                                  </ul>
                              </li>
                              <li><a href="">Receipt Entry</a></li>
                              <li><a href="">G.P.S. Reports</a>
                                  <ul>
                                      <li><a href="inv_gpass_rprts_gpprnt.php?pid=gpass"> 1. Gate Pass Printing</a></li>
                                      <li><a href="inv_gpass_rprts_gp_rgstr.php?pid=gpass"> 2. Gate Pass Register</a></li>
                                      <li><a href=""> 3. Gate Pass Receipt Register</a></li>
                                      <li><a href="inv_gpass_rprts_pndng_gp.php?pid=gpass"> 4. Pending Gate Pass</a></li>
                                      <li><a href=""> 5. Party wise Pending GP</a></li>
                                      <li><a href=""> 6. Gate pass wise Returns</a></li>
                                      <li><a href="inv_gpass_rprts_deptwise_pndng_status.php?pid=gpass"> 7. Dept.wise Pending status</a></li>
                                      <li><a href="inv_gpass_rprts_gpprty_rgstr.php?pid=gpass"> 8. Gate Pass Register (Party)</a></li>
                                  </ul>
                              </li>
                              <li><a href="">Print files</a></li>
                              <li><a href="">M.I.S Reports</a></li>
                              <li><a href="">Query</a></li>
                          </ul>
                      </li>
                      <li><a href="#">Excise</a>
                          <ul>
                              <li><a href="#">Input/Capital Goods Process</a>
                                  <ul>
                                      <li><a href=""> 1. Entry</a></li>
                                      <li><a href=""> 2. Supl.ECC Master</a></li>
                                      <li><a href=""> 3. Input/Capital Goods</a></li>
                                      <li><a href=""> 4. Abstract</a></li>
                                  </ul>
                              </li>
                              <li><a href="">Avail entry</a></li>
                              <li><a href="">Modification if any</a></li>
                          </ul>
                      </li>
                      <li><a href="#">Laboratory</a>
                          <ul>
                              <li><a href="">Master Entry</a></li>
                              <li><a href="">Transaction Entry</a></li>
                              <li><a href="">Report</a></li>
                              <li><a href="">Item Average Report</a></li>
                          </ul>
                      </li>
                      <li><a href="#">Contractor</a>
                          <ul>
                              <li><a href="">Rate Master</a></li>
                              <li><a href="">Process Master</a></li>
                              <li><a href="">Transaction</a></li>
                              <li><a href="">Report</a></li>
                          </ul>
                      </li>   
                      <li><a href="#">TDS</a></li>                      
                      <li><a href="config/logout.php">Logout</a></li>
                    </ul>