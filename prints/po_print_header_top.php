<div class="header1">
			<div class="header1-left float-left">
				<img src="../img/neco.jpg" width="100px">
			</div>
			<div class="header1-right">
				<h1>JAYASWAL NECO INDUSTRIES LIMITED</h1>
				<p>
					Regd. Office : F-8, MIDC Industrial Area, Hingna Road, Nagpur - 400 016</br>
					PH : +91 7104 237276 / 237471, Fax : +91 7104 237583 / 236255</br>
					E-Mail: contact@necoindia.com website : www.necoindia.com
				</p>
			</div>
		</div>
		<div class="clear"></div>
		<div class="hr-divider"><hr></div>
		<div class="header2">
			<div class="header2-left float-left">
				<?php 
					$queryCom = "SELECT * FROM catalog..comcat where com_com = $PoCommCd AND com_unit = $PoUntCd";
					$resultCom = odbc_exec($conn, $queryCom);
				?>
				<table width="90%">
					<tr>
						<td width="15%"><b>COMPANY</b></td>
						<td>:</td>
						<td>
							(<?php echo odbc_result($resultCom, 1); ?>)
							<?php echo odbc_result($resultCom, 3); ?>
						</td>
					</tr>
					<tr>
						<td><b>PLANT</b></td>
						<td>:</td>
						<td>
							(<?php echo odbc_result($resultCom, 2); ?>)
							<?php echo odbc_result($resultCom, 4); ?>,
							<?php echo odbc_result($resultCom, 5); ?>,
							<?php echo odbc_result($resultCom, 6); ?>,
							<?php echo odbc_result($resultCom, 7); ?>
						</td>
					</tr>
				</table>
				<table width="90%">
					<tr>
						<td width="15%"><b>SST</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultCom, 8); ?></td>
						<td><b>CST</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultCom, 10); ?></td>
					</tr>
					<tr>
						<td><b>GRAM</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultCom, 12); ?></td>
						<td><b>TEL </b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultCom, 13); ?></td>
					</tr>
					<tr>
						<td><b>CEX</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultCom, 18); ?></td>
						<td><b>ECC</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultCom, 20); ?></td>
					</tr>
					<tr>
						<td><b>TIN</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultCom, 23); ?></td>
						<td><b>STCT</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultCom, 25); ?></td>
					</tr>
					<tr>
						<td><b>CTIN</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultCom, 24); ?></td>
						<td><b>GSTIN</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultCom, 26); ?></td>
					</tr>
				</table>
			</div>
			<div class="header2-right">
				<?php 

					$queryPO = "SELECT poh.poh_po_no, poh.poh_po_dt, pod.pod_item, poh.poh_pmnt_terms, pod.pod_ord_qty, pod.pod_rate, pod.pod_chpt_id, poh.poh_supcd, poh.poh_stax_per, poh.poh_excise_cd, poh.poh_gst_per, poh.poh_igst_per, poh.poh_sgst_per, poh.poh_cgst_per, poh.poh_userid
						FROM $ComDbf.invac.podet pod
						INNER JOIN $ComDbf.invac.pohdr poh
						ON  pod.pod_po_no = poh.poh_po_no AND 
							pod.pod_unit = poh.poh_unit AND
							pod.pod_fyr = poh.poh_fyr
						WHERE pod.pod_unit = $PoUntCd AND pod.pod_po_no = $PoPoNo AND pod.pod_fyr = $PoFyr AND poh.poh_po_type != 09 AND (poh.poh_vet_tag = 01 OR poh.poh_val_tag = 01)
						ORDER BY poh.poh_po_dt DESC, pod.pod_po_srl DESC
						";
					$resultPO = odbc_exec($conn, $queryPO);	
					$poUser = odbc_result($resultPO, 15);
				?>
				<?php 
					$SupCd = odbc_result($resultPO, 8);					
					$querySup = "SELECT * FROM catalog..supcat where sup_supcd = '$SupCd'";
					$resultSup = odbc_exec($conn, $querySup);
				?>
				
				<table width="">
					<tr>
						<td width="15%"><b>SUPPLIER</b></td>
						<td>:</td>
						<td>
							(<?php echo odbc_result($resultSup, 1); ?>)
							<?php echo odbc_result($resultSup, 2); ?>
						</td>
					</tr>
					<tr>
						<td><b>ADDRESS</b></td>
						<td>:</td>
						<td> 
							<?php echo odbc_result($resultSup, 3); ?>
							<?php echo odbc_result($resultSup, 4); ?>,
							<?php echo odbc_result($resultSup, 5); ?>
						</td>
					</tr>
				</table>
				<table width="">
					<tr>
						<td width="22%"><b>SST</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultSup, 6); ?></td>
						<td><b>CST</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultSup, 8); ?></td>
					</tr>
					<tr>
						<td><b>TIN</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultSup, 11); ?></td>
						<td><b>CTIN</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultSup, 12); ?></td>
					</tr>
					<tr>
						<td><b>GSTIN</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultSup, 30); ?></td>
						<td><b>STCT</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultSup, 29); ?></td>
					</tr>
					<tr>
						<td><b>PHONE</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultSup, 17); ?></td>
						<td><b>PAN</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultSup, 13); ?></td>
					</tr>
					<tr>
						<td><b>EMAIL</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultSup, 14); ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="clear"></div>
		<div class="hr-divider"><hr></div>
		<div class="header3">			
			<table width="100%">
				<tr>
					<td width="20%"><b>PURCHASE ORDER</b></td>
					<td width="5%">:</td>
					<td width="75%"><?php echo odbc_result($resultPO, 1); ?></td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td width="20%"><b>PURCHASE DATE</b></td>						
					<td width="5%">:</td>
					<td width="75%"><?php echo date('d/m/Y', strtotime(odbc_result($resultPO, 2))); ?></td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td width="20%"><b>PAYMENT TERMS</b></td>
					<td width="5%">:</td>
					<td width="20%"><?php echo odbc_result($resultPO, 4); ?></td>
					<td width="15%"><b>FREIGHT TERMS</b></td>
					<td width="5%">:</td>
					<td width="15%"></td>
					<td width="5%"><b>REV.</b></td>					
					<td width="5%">:</td>
					<td width="10%"></td>
				</tr>
			</table>
		</div>
		<div class="clear"></div>
		<div class="hr-divider"><hr></div>
		<div class="header4">
			<table>
				<tr>
					<td>
						REQUESTED TO SUPPLY FOLLOWING MATERIAL (S) AS PER GIVEN TERMS & CONDITIONS
					</td>
				</tr>
			</table>
		</div>
		<div class="clear"></div>
		<div class="hr-divider"><hr></div>
		<div class="header5">
			<table width="100%">
				<tr>
					<td width="5%" align="center"><b>SL No</b></td>
					<td width="10%" align="center"><b>Item Code</b></td>
					<td width="35%" align="left"><b>Description</b></td>
					<td width="5%" align=""><b>UOM</b></td>
					<td width="10%" align="center"><b>HSN Code</b></td>
					<td width="10%" align="right"><b>Quantity</b></td>
					<td width="10%" align="right"><b>Rate</b></td>
					<td width="15%" align="right"><b>Value(INR)</b></td>
				</tr>
			</table>
		</div>
		<div class="clear"></div>
		<div class="hr-divider"><hr></div>