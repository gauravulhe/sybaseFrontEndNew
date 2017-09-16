		<div class="footer">
			<table width="100%">
				<tr><td><hr></td></tr>
			</table>
			<table>
				<tr>
					<td width="40%">STAX  <?php echo $stax; ?>% + EXCISE  <?php echo $excise; ?>% + </td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td width="47%" align="right">Gross Price</td>
					<td></td>
					<td width="13%" align="right" style="padding-right: 10px;"><?php echo number_format($totalPriceSum,2); ?></td>
				</tr>
				<tr>
					<td width="40%">GST <?php echo $gst; ?>% +</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td width="47%" align="right">GST  <?php echo $gst; ?>%</td>
					<td width="13%" align="right" style="padding-right: 10px;" colspan="2">
						<?php 
							$totalGst = ($totalPriceSum * $gst) / 100;
							echo number_format($totalGst,2);
						?>
					</td>
				</tr>
				<tr>
					<td width="40%" >IGST <?php echo $igst; ?>% +</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td width="47%" align="right">IGST  <?php echo $igst; ?>%</td>
					<td width="13%" align="right" style="padding-right: 10px;" colspan="2">
						<?php 
							$totalIgst = ($totalPriceSum * $igst) / 100;
							echo number_format($totalIgst,2);
						?>
					</td>
				</tr>
				<tr>
					<td width="40%" >SGST <?php echo $sgst; ?>% +</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td width="47%" align="right">SGST  <?php echo $sgst; ?>%</td>
					<td width="13%" align="right" style="padding-right: 10px;" colspan="2">
						<?php 
							$totalSgst = ($totalPriceSum * $sgst) / 100;
							echo number_format($totalSgst,2);
						?>
					</td>
				</tr>
				<tr>
					<td width="40%" >CGST <?php echo $cgst; ?>%</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td width="47%" align="right">CGST  <?php echo $cgst; ?>%</td>
					<td width="13%" align="right" style="padding-right: 10px;" colspan="2">
						<?php 
							$totalCgst = ($totalPriceSum * $cgst) / 100;
							echo number_format($totalCgst,2);
						?>
					</td>
				</tr>
				<tr><td colspan="8"><hr></td></tr>
				<tr>
					<td width="40%">&nbsp;</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td width="47%" align="right"><b>Total Amount: INR</b></td>
					<td width="13%" align="right" style="padding-right: 10px;" colspan="2">
						<?php 
							$totalAmount = $totalPriceSum + $totalGst + $totalIgst;
							echo '<b>'.number_format($totalAmount,2).'</b>';
						?>
					</td>
				</tr>
			</table>
			<table width="100%">
				<tr><td><hr></td></tr>
			</table>
			<table width="100%">
				<tr>
					<td>
						<p style="font-size:9px;">
							NOTE:-<br>
							(*)Immediate Upon dispatch 01 set of dispatch documents(advance intimation copy) must be forwarded to Manager (Purchase) & original
							invoice with all relevant quality documents as per order must be forwarded along with your material to our stores.<br>
							(*)Please mail your order acceptance as a token of acceptance of all terms and conditions of our order.<br>
							(*)Price shall remain firm till completion of contractual periods & no escalation on any account shall be payable.<br>
							(*) Any dispute concerning to this purchase order shall be subject to the jurisdiction of the court of Nagpur (Maharashtra) India only.<br>
							(*) Delivery is the essence of contract and you shall supply the material within stipulated delivery schedule. No delivery extension shall be
							issued. In case of delay beyond the delivery period stipulated in our order, liquidity damages shall be levied @ 0.5%of the contract price per
							week subject to maximum 5%of the contract price.<br>
							(*) In case of delivery failure,risk purchase clause as per JAYASWAL NECO INDUSTRIES LIMITED policy will be applicable
						</p>
					</td>
				</tr>
			</table>
			<table width="100%">
				<tr><td><hr></td></tr>
			</table>
			<table width="100%">
				<tr>
					<td>
						<table width="100%">
							<tr>
								<td width="60%">
									<p>
										<b>DT:</b> <?php echo date('d.m.Y'); ?> | 
										<b>TIME:</b> <?php echo date('h:m:s'); ?> | 
										<b>USER:</b> <?php echo $poUser; ?> | 
										<b>SY:</b> <!-- VINAY-PC --> <?php echo gethostname(); ?></br>
										<b>IP :</b> <!-- 80.0.1.162 --> <?php echo $_SERVER['SERVER_ADDR']; ?>
									</p>
								</td>
								<td width="20%">
									<h4>(Authorized Signatory)</h4>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>			
		</div>
		<div class="clear"></div>