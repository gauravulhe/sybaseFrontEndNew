                    <ul>
                    <li><a href="dashboard.php"><img src="img/home.png" width="20px"></a></li>
                    <li><a href="#" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'fagnrl') { echo "active-menu"; }{ echo ""; }?>>F / A ( General )</a>
                      <ul>
                        <li><a href="#">Catalogues & Masters</a>
                          <ul>
                              <li><a href="fin_ctlg_gnrl_ctlg.php?pid=fagnrl"> 1. General Ledger A/cs Catalogue</a></li>
                              <li><a href="fin_ctlg_deprt_cst_ctlg.php?pid=fagnrl"> 2. Department /Cost Centre Codes</a></li>
                              <li><a href="fin_ctlg_accnts_mstr.php?pid=fagnrl"> 3. Accounts Master</a></li>
                              <li><a href="fin_ctlg_sub_mstr.php?pid=fagnrl"> 4. Sub Master</a></li>
                              <li><a href="fin_ctlg_bk_mstr.php?pid=fagnrl"> 5. Book Master</a></li>
                              <li><a href="fin_ctlg_bdgt_mstr.php?pid=fagnrl"> 6. Budget Master</a></li>
                          </ul>
                        </li>
                        <li><a href="#">Transactions</a>
                          <ul>
                              <li><a href=""> 1.  Bank/Cash Transactions</a></li>
                              <li><a href=""> 2.  Bank Voucher Multiple Advices</a></li>
                              <li><a href=""> 3.  Tour Bill Passing</a></li>
                              <li><a href=""> 4.  ACP/ACR/FIN Journal Vouchers</a></li>
                              <li><a href=""> 5.  Vouchers Signed By</a></li>
                              <li><a href=""> 6.  TDS JV Entry</a></li>
                              <li><a href=""> 7.  Cheque Reconciliation</a></li>
                              <li><a href=""> 8.  Cash Reconciliation</a></li>
                              <li><a href=""> 9.  Voucher Printing</a></li>
                              <li><a href=""> 10. Payment Advice List</a></li>
                              <li><a href=""> 11. Cheque Details</a></li>
                              <li><a href=""> 12. Cheque Totals</a></li>
                              <li><a href=""> 13. Cheque Printing</a></li>
                              <li><a href=""> 14. Debit Note from bank vou/JV</a></li>
                              <li><a href=""> 15. Voucher Appropriation</a></li>
                              <li><a href=""> 16. Prepaid Insurance</a></li>
                          </ul>
                        </li>
                        <li><a href="#">Reports</a>
                          <ul>
                            <li><a href="#"> 1.  Cash Book</a>
                              <ul>
                                  <li><a href=""> 1. Complete Cash Book</a></li>
                                  <li><a href=""> 2. Cashiers' Book</a></li>
                              </ul>
                            </li>
                            <li><a href=""> 2.  Bank Book</a></li>
                            <li><a href=""> 3.  Journal Book</a></li>
                            <li><a href=""> 4.  TDS Jv Details</a></li>
                            <li><a href=""> 5.  Account wise Summary</a></li>
                            <li><a href=""> 6.  General Ledger & Trial Balance</a></li>
                            <li><a href=""> 7.  Sub Ledger & Trial Balance</a></li>
                            <li><a href="#"> 8.  Dept./Cost Cen.wise report</a>
                              <ul>
                                <li><a href=""> 1. Department/Account Wise Rep.</a></li>
                                <li><a href=""> 2. Account/Department Wise Rep.</a></li>
                                <li><a href=""> 3. Department Wise Expen. Report</a></li>
                            </ul>
                            </li>
                            <li><a href=""> 9.  Interest Calculation</a></li>
                            <li><a href="#"> 10. Inter Company</a>
                              <ul>
                                  <li><a href=""> 1. Inter Company Balances</a></li>
                                  <li><a href=""> 2. Inter Company datewise Report</a></li>
                              </ul>
                            </li>
                            <li><a href=""> 11. P & L A/c & Balance Sheet</a></li>
                            <li><a href=""> 12. Cheque Position</a></li>
                            <li><a href=""> 13. Cheque Details</a></li>
                            <li><a href=""> 14. Liability Statement</a></li>
                            <li><a href=""> 15. Liability Comparison</a></li>
                            <li><a href=""> 16. Prepaid Insurance Statement</a></li>
                          </ul>
                        </li>
                        <li><a href="">Printing Files</a></li>
                        <li><a href="#">Query</a>
                          <ul>
                              <li><a href=""> 1. General Ledger Balances query</a></li>
                              <li><a href=""> 2. Inter Co. Balances Query</a></li>
                              <li><a href=""> 3. Token Search</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>                    
                    <li><a href="#" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'spplrs') { echo "active-menu"; }{ echo ""; }?>>Suppliers Accounting Module</a>
                      <ul>
                        <li><a href="#">Catalogues & Masters</a>                          
                          <ul>
                              <li><a href="fin_ctlg_spplr_ctlg.php?pid=spplrs"> 1. Supplier's Party Catalogue</a></li>
                              <li><a href="fin_ctlg_spplr_accnts_mstr.php?pid=spplrs"> 2. Accounts Master</a></li>
                              <li><a href="fin_ctlg_supplr_spplr_mstr.php?pid=spplrs"> 3. Supplier's Master</a></li>
                          </ul>
                        </li>
                        <li><a href="#">Bills Passing</a>
                          <ul>
                            <li><a href=""> 1.  Material Bills</a></li>
                            <li><a href=""> 2.  Bill wise stax catg.cd entry</a></li>
                            <li><a href=""> 3.  Excise Gate Pass No</a></li>
                            <li><a href=""> 4.  Print Material Payment Advice</a></li>
                            <li><a href=""> 5.  Payment Advice - Audit</a></li>
                            <li><a href=""> 6.  Audit Report-Payment Advice</a></li>
                            <li><a href=""> 7.  Payment Advice Listing</a></li>
                            <li><a href=""> 8.  Commission Agents Bills</a></li>
                            <li><a href=""> 9.  Transport Bills</a></li>
                            <li><a href=""> 10. Loading/Unloading Bills</a></li>
                            <li><a href=""> 11. Electricity Bills</a></li>
                            <li><a href=""> 12. Water Bills</a></li>
                          </ul> 
                        </li>
                        <li><a href="#">Transactions</a>
                          <ul>
                            <li><a href=""> 1.  Payment Advice Generation</a></li>
                            <li><a href=""> 2.  Appropriation of Bills</a></li>
                            <li><a href=""> 3.  Debit Note Entry</a></li>
                            <li><a href=""> 4.  Debit Note against Bill</a></li>
                            <li><a href=""> 5.  Credit Note Entry </a></li>
                            <li><a href=""> 6.  Journal Voucher Entry</a></li>
                            <li><a href=""> 7.  Credit Voucher (Reversal)</a></li>
                            <li><a href=""> 8.  Vouchers Printing</a></li>
                            <li><a href=""> 9.  Supplier Bill Appropriation</a></li>
                            <li><a href=""> 10. Supplier JV Appropriation</a></li>
                            <li><a href=""> 11. C-Form Entry</a></li>
                            <li><a href="#"> 12. LC Entry</a>
                              <ul>
                                  <li><a href=""> 1. Voucher Entry</a></li>
                                  <li><a href=""> 2. Detail Entry</a></li>
                                  <li><a href=""> 3. Transaction Entry</a></li>
                                  <li><a href=""> 4. Other Charges Entry</a></li>
                                  <li><a href="#"> 5. Reports</a>
                                      <ul>
                                          <li><a href=""> 1. Misc Reports</a></li>
                                          <li><a href=""> 2. Agewise Analysis</a></li>
                                      </ul>
                                  </li>
                                  <li><a href=""> 6. Closing Entry</a></li>
                              </ul>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#">Reports</a>
                            <ul>
                                <li><a href=""> 1.  Payment Register</a></li>
                                <li><a href=""> 2.  Purchase Registers</a></li>
                                <li><a href=""> 3.  Freight Register</a></li>
                                <li><a href=""> 4.  Debit Notes Register</a></li>
                                <li><a href=""> 5.  Credit Notes Register</a></li>
                                <li><a href=""> 6.  Liability Register (A/c Wise)</a></li>
                                <li><a href=""> 7.  Liability Register (Supl.Wise)</a></li>
                                <li><a href=""> 8.  Supplier wise Age Analysis</a></li>
                                <li><a href=""> 9.  Payment Age Analysis</a></li>
                                <li><a href=""> 10. TDS Certificates</a></li>
                                <li><a href=""> 11. Supplier Ledger/Trial Balance</a></li>
                                <li><a href=""> 12. Excise duty details</a></li>
                                <li><a href=""> 13. Supplier Balance Confirmation</a></li>
                                <li><a href=""> 14. Due Date/Suppl.Wise Payment</a></li>
                                <li><a href=""> 15. Freight Reconcilation Report</a></li>
                            </ul>
                        </li>
                        <li><a href="">Printing Files</a></li>
                        <li><a href="#">Query</a>
                            <ul>
                                <li><a href=""> 1. Supplier Balances</a></li>
                                <li><a href=""> 2. Supplier bill Details</a></li>
                                <li><a href=""> 3. Supplier Balance Status</a></li>
                                <li><a href=""> 4. Item  wise PO's Rates Query</a></li>
                                <li><a href=""> 5. Party wise PO Item Rates Query</a></li>
                            </ul>
                        </li>
                      </ul>
                    </li>
                    <li><a href="#" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'dbtrs') { echo "active-menu"; }{ echo ""; }?>>Debtors Accounting Module</a>
                      <ul>
                        <li><a href="#">Catalogues & Masters</a>
                            <ul>
                                <li><a href="fin_ctlg_dbtrs_accnts_mstr.php?pid=dbtrs"> 1. Accounts Master</a></li>
                                <li><a href="fin_ctlg_dbtrs_dbtrs_mstr.php?pid=dbtrs"> 2. Debtors Master</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Invoice Module</a>
                            <ul>
                                <li><a href=""> 1. Supplementary Bills(PVC&Other)</a></li>
                                <li><a href=""> 2. Account Code Updation</a></li>
                                <li><a href=""> 3. Credit Note(Cash disc. & T.O.)</a></li>
                                <li><a href=""> 4. Liability Register</a></li>
                                <li><a href=""> 5. Party wise Bill Details</a></li>
                                <li><a href=""> 6. Party Code Block</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Transactions</a>
                            <ul>
                                <li><a href=""> 1.  Receipts</a></li>
                                <li><a href=""> 2.  Receipt Unit</a></li>
                                <li><a href=""> 3.  Receipt A/c Updation</a></li>
                                <li><a href=""> 4.  Bill Appropriation</a></li>
                                <li><a href=""> 5.  Debit Note Entry</a></li>
                                <li><a href=""> 6.  Credit Note Entry</a></li>
                                <li><a href=""> 7.  Journal Entry</a></li>
                                <li><a href=""> 8.  Inter Co.Bill ent</a></li>
                                <li><a href=""> 9.  J V Apporpriation</a></li>
                                <li><a href=""> 10. Debit Voucher (reversal)</a></li>
                                <li><a href=""> 11. Printing Voucher</a></li>
                                <li><a href=""> 12. Bill Party Code Updation</a></li>
                                <li><a href=""> 13. Inter Co. Credit Note</a></li>
                                <li><a href=""> 14. Sale Return Credit Note</a></li>
                                <li><a href=""> 15. Form C Entry </a></li>
                            </ul>
                        </li>
                        <li><a href="#">Reports</a>
                            <ul>
                                <li><a href=""> 1.  Liability Register</a></li>
                                <li><a href=""> 2.  Receipts Register</a></li>
                                <li><a href=""> 3.  Receipt Age Analysis</a></li>
                                <li><a href=""> 4.  Debit Notes Register</a></li>
                                <li><a href=""> 5.  Credit Notes Register</a></li>
                                <li><a href=""> 6.  Age wise analysis</a></li>
                                <li><a href=""> 7.  Bills Overdue Report</a></li>
                                <li><a href=""> 8.  Age Analysis (Rrepresentative)</a></li>
                                <li><a href=""> 9.  Party wise Bill Details</a></li>
                                <li><a href=""> 10. Debtor Ledger/Trial Balance</a></li>
                                <li><a href=""> 11. Interest Calculation</a></li>
                                <li><a href=""> 12. Account Wise Freight</a></li>
                                <li><a href=""> 13. TC WISE RECEIPTS DETAILS</a></li>
                                <li><a href=""> 14. Debtors Balance Confirmation</a></li>
                                <li><a href=""> 15. Receipt Detail Report</a></li>
                                <li><a href=""> 16. Month Wise Receipts</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Printing Files</a></li>
                        <li><a href="#">Query</a>
                          <ul>
                              <li><a href=""> 1. Supplier Balances</a></li>
                              <li><a href=""> 2. Supplier bill Details</a></li>
                              <li><a href=""> 3. Supplier Balance Status</a></li>
                              <li><a href=""> 4. Item  wise PO's Rates Query</a></li>
                              <li><a href=""> 5. Party wise PO Item Rates Query</a></li>
                          </ul>
                      </ul>
                    </li>
                    <li><a href="#" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'ms') { echo "active-menu"; }{ echo ""; }?>>M.I.S.</a>
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
                    <li><a href="#" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'xcs') { echo "active-menu"; }{ echo ""; }?>>Excise Reports</a>
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
                    <li><a href="" class=<?php if(isset($_GET['pid']) && $_GET['pid'] == 'prntng') { echo "active-menu"; }{ echo ""; }?>>Printing Files</a></li>                    
                    <li><a href="config/logout.php">Logout</a></li>
                  </ul>
