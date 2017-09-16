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
					$queryCom = "SELECT * FROM catalog..comcat where com_com = $com_com AND com_unit = $com_unit";
					$resultCom = odbc_exec($conn, $queryCom);
				?>
				<table width="100%">
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
				<table width="100%">
					<tr>
						<td width="17%"><b>SST</b></td>
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
						<td>
							<?php 
								$StCtCd = odbc_result($resultCom, 25);
								$StCtNameQry = "SELECT stc_name FROM catalog..stctcat WHERE stc_stct_cd = '$StCtCd'";
								$StCtNameResult = odbc_exec($conn, $StCtNameQry);
								$StCtName = odbc_result($StCtNameResult, 1);
								echo $StCtCd."(".trim($StCtName).")"; 
							?>
						</td>
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
					$resultPO = @odbc_exec($conn, $queryPO);
					$SupCd = odbc_result($resultPO, 4);					
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
						<td width="18%"><b>SST</b></td>
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
						<td><b>PAN</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultSup, 13); ?></td>
					</tr>
					<tr>
						<td><b>PHONE</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultSup, 17); ?></td>
					</tr>
					<tr>
						<td><b>EMAIL</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultSup, 14); ?></td>
					</tr>
					<tr>						
						<td><b>STCT</b></td>
						<td>:</td>
						<td>
							<?php 
								$StCtCd = odbc_result($resultSup, 29);
								$StCtNameQry = "SELECT stc_name FROM catalog..stctcat WHERE stc_stct_cd = '$StCtCd'";
								$StCtNameResult = odbc_exec($conn, $StCtNameQry);
								$StCtName = odbc_result($StCtNameResult, 1);
								echo $StCtCd." ( ".$StCtName." )"; 
							?>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="clear"></div>
		<div class="hr-divider"><hr></div>
		<div class="header3">			
			<table width="100%">
				<tr>
					<td width="17%"><b>PURCHASE ORDER</b></td>
					<td width="1%">:</td>
					<td width="82%"><?php echo odbc_result($resultPO, 5); ?></td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td width="17%"><b>PURCHASE DATE</b></td>						
					<td width="1%">:</td>
					<td width="82%"><?php echo date('d/m/Y', strtotime(odbc_result($resultPO, 6))); ?></td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td width="17%"><b>PAYMENT TERMS</b></td>
					<td width="1%">:</td>
					<td width="25%"><?php echo odbc_result($resultPO, 33); ?></td>
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