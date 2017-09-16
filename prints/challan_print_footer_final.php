<div class="footer">
			<table width="100%">
				<tr><td><hr></td></tr>
			</table>
			<table width="100%">
				<tr>
					<td width="85%" align="right"><b>GROSS AMOUNT : INR</b></td>
					<td width="15%" align="right" style="padding-right: 10px;" colspan="2">
						<?php 							
							echo number_format($total_value,2);
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
						<table width="80%">
						<?php

							echo '<tr><td width="60%" align="">FREIGHT : </td><td width="40%" align="left" style="padding-right: 10px;" colspan="2">'.$frtnm.'</td></tr>';
							
							echo '<tr><td width="60%" align="">L.C. No. : </td><td width="40%" align="right" style="padding-right: 10px;" colspan="2"></td></tr>';							
							
							echo '<tr><td width="60%" align="">DOCUMENT THROUGH : </td><td width="40%" align="right" style="padding-right: 10px;" colspan="2"></td></tr>';

							echo '<tr><td width="60%" align="">PAYMENT TERMS : </td><td width="40%" align="right" style="padding-right: 10px;" colspan="2"></td></tr>';							
							
							echo '<tr><td width="60%" align="">ADVANCE FOR SUPPLY REFERENCE No. : </td><td width="40%" align="right" style="padding-right: 10px;" colspan="2"></td></tr>';							
							
							echo '<tr><td width="60%" align="">DATE : </td><td width="40%" align="right" style="padding-right: 10px;" colspan="2"></td></tr>';
						?>
						</table>
					</td>
					<td>
						<table width="100%">
						<?php		

							if (isset($amortization_value)) {

							echo '<tr><td width="70%" align="right">AMORTIZATION </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($amortization_value,2).'</td></tr>';
							}else{
								echo '<tr><td width="70%" align="right">AMORTIZATION </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format(0,2).'</td></tr>';
							}

							if (isset($bilexcise) && $bilexcise != 0) {

							echo '<tr><td width="70%" align="right">EXCISE DUTY PAYABLE </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($bilexcise,2).'</td></tr>';
							}else{
								echo '<tr><td width="70%" align="right">EXCISE DUTY PAYABLE </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format(0,2).'</td></tr>';
							}

							if (isset($bilcess) && $bilcess != 0) {

							echo '<tr><td width="70%" align="right">CESS </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($bilcess,2).'</td></tr>';
							}else{
								echo '<tr><td width="70%" align="right">CESS </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format(0,2).'</td></tr>';
							}

							if (isset($bilhscs) && $bilhscs != 0) {

							echo '<tr><td width="70%" align="right">HSCS </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($bilhscs,2).'</td></tr>';
							}else{
								echo '<tr><td width="70%" align="right">HSCS </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format(0,2).'</td></tr>';
							}

							if (isset($bilstax) && $bilstax != 0) {

							echo '<tr><td width="70%" align="right">SALES TAX/VAT </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($bilstax,2).'</td></tr>';
							}else{
								echo '<tr><td width="70%" align="right">SALES TAX/VAT </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format(0,2).'</td></tr>';
							}

							echo '<tr><td width="70%" align="right">FREIGHT AMT.  RATE </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">0.00</td></tr>';
						?>
						</table>
					</td>
					<td>
						<table width="100%">
						<?php												
							
							echo '<tr><td width="70%" align="right">DISCOUNT</td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_disc_amt,2).'</td></tr>';	
							
							echo '<tr><td width="70%" align="right">INSURANCE</td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_ins_amt,2).'</td></tr>';	

							echo '<tr><td width="70%" align="right">PACKING & FORWARDING</td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_pack_amt,2).'</td></tr>';

							if (isset($amortization_value) && $amortization_value != 0) {
								$total_taxable_amt = (($total_value+$total_ins_amt+$total_pack_amt+$bilexcise+$bilcess+$bilhscs+$bilstax)-($total_disc_amt+$amortization_value)); 
							}else{
								$total_taxable_amt = (($total_value+$total_ins_amt+$total_pack_amt+$bilexcise+$bilcess+$bilhscs+$bilstax)-($total_disc_amt)); 
							}

							echo '<tr><td width="70%" align="right">TOTAL TAXABLE VALUE</td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_taxable_amt, 2).'</td></tr>';
							
							echo '<tr><td width="70%" align="right">CGST @ '.number_format($cgst_per,2).' % </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_cgst_amt,2).'</td></tr>';	
							
							echo '<tr><td width="70%" align="right">SGST @ '.number_format($sgst_per,2).' % </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_sgst_amt,2).'</td></tr>';							
							
							echo '<tr><td width="70%" align="right">IGST @ '.number_format($igst_per,2).' % </td><td width="30%" align="right" style="padding-right: 10px;" colspan="2">'.number_format($total_igst_amt,2).'</td></tr>';
							
						?>
						</table>
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
					<td width="47%" align="right"><b>TOTAL INVOICE VALUE : INR</b></td>
					<td width="13%" align="right" style="padding-right: 10px;" colspan="2">
						<?php 
							$total_sum = round($total_taxable_amt + $total_cgst_amt + $total_sgst_amt + $total_igst_amt);
							echo '<b>'.number_format($total_sum,2).'</b>';
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
						<p style="font-size:9px;"><b>IN WORDS</b><br>
							<?php 
								echo '<b>CGST : </b>'.foo($total_cgst_amt).'<br>';
								echo '<b>SGST : </b>'.foo($total_sgst_amt).'<br>';
								echo '<b>IGST : </b>'.foo($total_igst_amt).'<br>';
								echo '<b>INVOICE AMOUNT : </b>'.foo($total_sum).'<br>';
								echo '<b>TAX PAYABLE ON REVERSE CHARGE : </b>'.foo($total_taxable_amt);
							?>
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
						<p style="font-size:9px;">
							Certified that particulars given above are true and correct and the amount indicated represent the price actually charged & that there is flow of additional consideration directly or indirectly from the buyer. <b>OR</b><br>
							Certified that particulars given above are true and correct and the amount indicated is provisional as additional consideration will be received from the buyer on account of fluctuations in price in future.
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
										SUBJECT TO TERMS & CONDITIONS MENTIONED OVERLEAF. | 
										E-mail : contact@necoindia.com | 
										WEBSITE : www.necoindia.com
									</p>
								</td>
								<td width="20%">
									<p><b>(Authorized Signatory)</b></p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>			
		</div>