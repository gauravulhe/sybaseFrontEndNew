<div class="header1">
			<div class="header1-left float-left">
				<img src="../img/neco.jpg" width="110px">
			</div>
			<div class="header1-right">
				<p>
					<?php 
						$chal_bil_sfx = odbc_result($resultChal, 61);
						//var_dump($chal_bil_sfx);
						if ($chal_bil_sfx == 'd' || $chal_bil_sfx == 'D') {
							echo 'Delivery Challan';
						}elseif($chal_bil_sfx == 'b' || $chal_bil_sfx == 'B'){
							echo 'Bill Of Supply';
						}elseif($chal_bil_sfx == 'e' || $chal_bil_sfx == 'E'){
							echo 'Export Invoice';
						}else{
							echo 'Tax Invoice';
						}
					?>
					<br>
					<span style="font-size:10px;">
						(Under Section 31 of CGST Act, 2017 read with Rule 
						<?php 
							if ($chal_bil_sfx == 'd') {
								echo '10';
							}elseif ($chal_bil_sfx == '') {
								echo '1';
							}
						?>
						 of GST Invoice Rules)
					</span>
				</p>
				<h1>JAYASWAL NECO INDUSTRIES LIMITED</h1>
				<p>
					Regd. Off. : F-8 & F-8/1, MIDC Industrial Area, Hingna Road, Nagpur - 400 016(M.S.)</br>
					PH : +91 7104 237276, Fax : +91 7104 237583
					CIN : L28920MH1972PLC016154
				</p>
			</div>
		</div>
		<div class="clear"></div>
		<div class="hr-divider"><hr></div>
		<div class="header2">
			<div class="header2-left float-left">
				<?php 
					$queryCom = "SELECT * FROM catalog..comcat where com_com = $chal_com AND com_unit = $chal_unit";
					$resultCom = odbc_exec($conn, $queryCom);
				?>
				<table width="100%">
					<tr>
						<td width="15%"><b>NAME</b></td>
						<td>:</td>
						<td>
							(<?php echo odbc_result($resultCom, 1); ?>)
							<?php echo odbc_result($resultCom, 3); ?>
						</td>
					</tr>
					<tr>
						<td><b>ADDRESS</b></td>
						<td>:</td>
						<td>
							(<?php echo odbc_result($resultCom, 2); ?>)
							<?php echo odbc_result($resultCom, 4); ?>,
							<?php echo odbc_result($resultCom, 5); ?>,
							<?php echo odbc_result($resultCom, 6); ?>,
							<?php echo odbc_result($resultCom, 7); ?>
						</td>
					</tr>
					<tr>
						<td width="15%"><b>GSTIN</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultCom, 26); ?></td>
					</tr>
					<tr>
						<td width="15%"><b>STCT</b></td>
						<td>:</td>						
						<td>
							<?php 
								$StCtCd = odbc_result($resultCom, 25);
								$StCtNameQry = "SELECT stc_name FROM catalog..stctcat WHERE stc_stct_cd = '$StCtCd'";
								$StCtNameResult = odbc_exec($conn, $StCtNameQry);
								$StCtName = odbc_result($StCtNameResult, 1);
								echo $StCtCd." ( ".trim($StCtName)." )"; 
							?>
						</td>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td width="70%"><b>TAX PAYABLE ON REVERSE CHARGES</b></td>
						<td>:</td>
						<td>YES / NO</td>
					</tr>	
				</table>
			</div>
			<div class="header2-right">
				<?php //$resultChal = @odbc_exec($conn, $queryChal); ?>
				<table width="">
					<tr>
						<td><b>TI/BOS/DC No.</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultChal, 43); ?></td>
					</tr>
					<tr>
						<td><b>DATE</b></td>
						<td>:</td>
						<td><?php echo date('d/m/Y', strtotime(odbc_result($resultChal, 47))); ?></td>
					</tr>
					<tr>
						<td><b>MODE OF TRANSPORT</b></td>
						<td>:</td>
						<td></td>
					</tr>
					<tr>
						<td><b>VEHICLE No.</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultChal, 45); ?></td>
					</tr>
					<tr>
						<td><b>CARRIER</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultChal, 48); ?></td>
					</tr>
					<tr>
						<td><b>E-WAY BILL/L.R. No.</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultChal, 46).' | '.date('d/m/Y', strtotime(odbc_result($resultChal, 47))); ?></td>
					</tr>
				</table>
			</div>
			<div class="hr-divider"><hr></div>
			<div class="header2-left float-left">
				<table width="">
					<tr>
						<td><b>DETAILS OF REVEIVER ( BILLED TO )</b></td>
					</tr>
				</table>
			</div>
			<div class="header2-right">
				<table width="">
					<tr>
						<td><b>DETAILS OF CONSIGNEE ( SHIPPED TO )</b></td>
					</tr>
				</table>
			</div>
			<div class="clear"></div>
			<div class="hr-divider"><hr></div>
			<div class="header2-left float-left">
				<table width="100%">
					<tr>
						<td width="15%"><b>NAME</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultChal, 9); ?></td>
					</tr>
					<tr>
						<td><b>ADDRESS</b></td>
						<td>:</td>
						<td>
							<?php echo odbc_result($resultChal, 10); ?> 
							<?php echo odbc_result($resultChal, 11); ?> 
							<?php echo odbc_result($resultChal, 12); ?>
						</td>
					</tr>
					<tr>
						<td><b>GSTIN</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultChal, 14); ?></td>
					</tr>
					<tr>
						<td><b>STCT</b></td>
						<td>:</td>						
						<td>
							<?php 
								$StCtCd = odbc_result($resultChal, 13);
								$StCtNameQry = "SELECT stc_name FROM catalog..stctcat WHERE stc_stct_cd = '$StCtCd'";
								$StCtNameResult = odbc_exec($conn, $StCtNameQry);
								$StCtName = odbc_result($StCtNameResult, 1);
								if (!empty($StCtName)) {
									echo $StCtCd." ( ".trim($StCtName)." )"; 
								}elseif (empty($StCtName)) {
									echo $StCtCd; 
								}
							?>
						</td>
					</tr>
				</table>
			</div>
			<div class="header2-right">
				<table width="">
					<tr>
						<td><b>NAME</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultChal, 16); ?>
						</td>
					</tr>
					<tr>
						<td><b>ADDRESS</b></td>
						<td>:</td>
						<td>
							<?php echo odbc_result($resultChal, 17); ?> 
							<?php echo odbc_result($resultChal, 18); ?> 
							<?php echo odbc_result($resultChal, 19); ?>
						</td>
					</tr>
					<tr>
						<td><b>GSTIN</b></td>
						<td>:</td>
						<td><?php echo odbc_result($resultChal, 21); ?></td>
					</tr>
					<tr>
						<td><b>STCT</b></td>
						<td>:</td>						
						<td>
							<?php 
								$StCtCd = odbc_result($resultChal, 20);
								$StCtNameQry = "SELECT stc_name FROM catalog..stctcat WHERE stc_stct_cd = '$StCtCd'";
								$StCtNameResult = odbc_exec($conn, $StCtNameQry);
								$StCtName = odbc_result($StCtNameResult, 1);
								if (!empty($StCtName)) {
									echo $StCtCd." ( ".trim($StCtName)." )"; 
								}elseif (empty($StCtName)) {
									echo $StCtCd; 
								}
							?>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="clear"></div>
		<div class="hr-divider"><hr></div>
		<div class="header2-left float-left">
			<table width="">
				<tr>
					<td><b>PARTY'S ORDER No. & DATE</b></td>
					<td>:</td>
					<td><?php echo odbc_result($resultChal, 50); ?></td>
				</tr>
			</table>
		</div>
		<div class="header2-right">
			<table width="">
				<tr>
					<td><b>OUR ORDER CONF. No. & DATE</b></td>
					<td>:</td>
					<td><?php echo odbc_result($resultChal, 24).' | '.date('d/m/Y', strtotime(odbc_result($resultChal, 23))); ?></td>
				</tr>
			</table>
		</div>
		<div class="clear"></div>
		<div class="hr-divider"><hr></div>
		<div class="header5">
			<table width="100%">
				<tr>
					<td width="5%" align="center"><b>SL No</b></td>
					<td width="10%" align="center"><b>ITEM CODE</b></td>
					<td width="30%" align="left"><b>MATERIAL DESCRIPTION</b></td>
					<td width="5%" align=""><b>UOM</b></td>
					<td width="10%" align="center"><b>HSN / SAC</b></td>
					<td width="5%" align="right"><b>QTY.</b></td>
					<?php if($chal_com != 54 && $chal_unit != 3){ ?>
					<td width="10%" align="right"><b>WEIGHT</b></td>
					<?php } ?>
					<td width="10%" align="right"><b>RATE</b></td>
					<td width="15%" align="right"><b>VALUE(INR)</b></td>
				</tr>
			</table>
		</div>
		<div class="clear"></div>