<div class="footer">
			<table width="100%">
				<tr><td><hr></td></tr>
			</table>
			<table width="100%">
				<tr>
					<td width="85%" align="right"><b>Gross Amount: INR</b></td>
					<td width="15%" align="right" style="padding-right: 10px;" colspan="2">
						<?php 							
							echo number_format($total_irate,2);
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
						<table width="100%">
						<?php
							
							echo '<tr><td width="60%" align="">SALES TAX</td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_stax_amt,2).'</td></tr>';							
							
							echo '<tr><td width="60%" align="">EXCISE DUTY</td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_excise_amt,2).'</td></tr>';							
							
							echo '<tr><td width="60%" align="">INS.COV.BY PARTY </td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_ins_amt ,2).'</td></tr>';							
							
							echo '<tr><td width="60%" align="">LOAD/UNLODING</td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_load_amt,2).'</td></tr>';							
							
							echo '<tr><td width="60%" align="">COMMISSION</td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_comm_amt,2).'</td></tr>';

							echo '<tr><td width="60%" align="">OTHER CHARGES</td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_others ,2).'</td></tr>';

							
						?>
						</table>
					</td>
					<td>
						<table width="100%">
						<?php	

							echo '<tr><td width="60%" align="">SURCHARGE</td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_scharg ,2).'</td></tr>';							
							
							echo '<tr><td width="60%" align="">TURNOVER</td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_tcharg ,2).'</td></tr>';							
							
							echo '<tr><td width="60%" align="">SERVICE CHRG</td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_serv_amt,2).'</td></tr>';							
							
							echo '<tr><td width="60%" align="">CESS</td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_cess_amt,2).'</td></tr>';
							
							echo '<tr><td width="60%" align="">H&S ED CESS</td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_hsec_amt,2).'</td></tr>';

							echo '<tr><td width="60%" align="">GST '.number_format($gst_per,2).' % </td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_gst_amt,2).'</td></tr>';
							
						?>
						</table>
					</td>
					<td>
						<table width="100%">
						<?php							

							echo '<tr><td width="60%" align="">PACK & FORWARDING</td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_pack_amt,2).'</td></tr>';
							
							echo '<tr><td width="60%" align="">FREIGHT AMT.  RATE </td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_frt_amt ,2).'</td></tr>';							
							
							echo '<tr><td width="60%" align="">IGST '.number_format($igst_per,2).' % </td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_igst_amt,2).'</td></tr>';							
							
							echo '<tr><td width="60%" align="">SGST '.number_format($sgst_per,2).' % </td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_sgst_amt,2).'</td></tr>';							
							
							echo '<tr><td width="60%" align="">CGST '.number_format($cgst_per,2).' % </td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_cgst_amt,2).'</td></tr>';							
							
							echo '<tr><td width="60%" align="">UGST '.number_format($ugst_per,2).' % </td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_ugst_amt,2).'</td></tr>';							
							
							echo '<tr><td width="60%" align="">DISCOUNT</td><td width="40%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_disc_amt,2).'</td></tr>';
							
						?>
						</table>
					</td>
				</tr>
			</table>				
			<table width="100%">
				<tr>
					<td>
						<?php 
							echo '<tr><td width="10%" align="">ADDL.RMK : </td><td width="90%" align="left" colspan="2">'.$addlrmk.'</td></tr>';
						?>
					</td>
				</tr>
			</table>				
			<table width="100%">
				<tr><td><hr></td></tr>
			</table>
			<table width="100%">
				<tr>
					<td width="40%">&nbsp;</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td width="47%" align="right"><b>Total Amount: INR</b></td>
					<td width="13%" align="right" style="padding-right: 10px;" colspan="2">
						<?php 							
							echo '<b>'.number_format($totalPriceSum,2).'</b>';
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
										<b>USER:</b> <?php //echo $poUser; ?> | 
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