<?php
  // header("Content-type: application/vnd.ms-word");
  // header("Content-Disposition: attachment;Filename=purchase_order.doc");
?>  
<html>
<head>
	<title>Tax Invoice|Bill Of Supply|Delivery Challan|Export Invoice</title>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
	<style type="text/css">
		.container{
			font-size: 12px;
			margin: 5px;
			padding: 10px;
			/*border: 1px solid #000;*/
		}
		table tr td{
			font-size: 12px;
		}
		table tr td{
			font-size: 12px;
			vertical-align: top;
		}
		.container .float-left{
			float: left;
		}
		.container .clear{
			clear: both;
		}
		.container .header1 .header2 .header3 .header4 .header5 .content .footer{
			width: 100%;
		}
		.header2{
			height: 180px;
		}
		.header1{			
			text-align: center;
		}
		.container .header1-left{
			width: 20%;
		}
		.container .header1-right{
			width: 90%;
		}
		.container .header2-left{
			width: 50%;
			border-right: 1px solid #000;
		}
		.container .hr-divider{
			width: 100%;
		}
		.footer{
			margin: 5px;
		}
		.print{
			font-size: 18px;
			text-align: center;
		}
	</style>
	<?php if (!empty($_POST['chal_bil_frno'])): ?>		
		<script type="text/javascript">
			window.print();
		</script>
	<?php endif ?>
	<script type="text/javascript">
		(function () {

	        var beforePrint = function () {
	            //alert('Functionality to run before printing.');
	        };

	        var afterPrint = function () {
	            window.location="../sales_desp_chal_print.php?pid=sal";
	        };

	        if (window.matchMedia) {
	            var mediaQueryList = window.matchMedia('print');

	            mediaQueryList.addListener(function (mql) {
	                //alert($(mediaQueryList).html());
	                if (mql.matches) {
	                    beforePrint();
	                } else {
	                    afterPrint();
	                }
	            });
	        }

	        window.onbeforeprint = beforePrint;
	        window.onafterprint = afterPrint;

	    }());
	</script>
</head>
<body>
	<div class="container">	
		<?php require('challan_calculation_new.php'); ?>
		<?php require('challan_print_header_top.php'); ?>
		
		<div class="hr-divider"><hr></div>
		<?php
			$rows = array();
			$i = 1;		
			$resultChal = @odbc_exec($conn, $queryChal);				
			while ($myRow = odbc_fetch_array($resultChal)) {
				$rows[] = $myRow;
			}
			$noOfRows = count($rows);

			$total_value = 0;
			$total_adv_amt = 0;
			$total_frt_amt = 0;
			$total_pack_amt = 0;
			$total_taxable_amt = 0;
			$total_cgst_amt = 0;
			$total_sgst_amt = 0;
			$total_igst_amt = 0;
			$total_sum = 0;			

			$payterm = '';
			$addlrmk = '';

			if (!empty($rows)){
			foreach ($rows as $resultChal) {
		?>
		<div class="content">
			<table width="100%">
				<tr>
					<td width="5%" align="center"><?php echo str_pad($i, 3, "0", STR_PAD_LEFT); ?></td>
					<td width="10%" align="center"><?php 
							$itemNo = $resultChal['itemcd'];
							echo $itemNo; ?>
					</td>
					<td width="30%" align="left">
						<?php 
							$queryItmDesc = "SELECT itm_desc,itm_uom FROM catalog..itmcat WHERE itm_item = '$itemNo'";
							$resultItmDesc = odbc_exec($conn, $queryItmDesc);
							$itmDesc = odbc_result($resultItmDesc, 1);
							echo substr($itmDesc, 0, 36);
							//echo $itmDesc;
							$itmUomCd = odbc_result($resultItmDesc, 2);
						?>
					</td>
					<td width="5%" align="left">							
						<?php 
							$queryItmUomDesc = "SELECT cod_desc FROM catalog..codecat WHERE cod_prefix = 6 AND cod_code = $itmUomCd";
							$resultItmUomDesc = odbc_exec($conn, $queryItmUomDesc);
							$itmUomDesc = odbc_result($resultItmUomDesc, 1);
							echo $itmUomDesc;
						?>
					</td>
					<td width="10%" align="center"><?php echo $resultChal['chptid']; ?></td>
					<td width="05%" align="right">
						<?php 
							$qty = $resultChal['qty'];
							echo number_format($qty,2); 
						?>
					</td>
					<td width="10%" align="right">
						<?php echo number_format($resultChal['actwt'], 4); ?>
					</td>
					<td width="10%" align="right">
						<?php 
							$rate = $resultChal['rate'];
							echo number_format($rate,2); 
						?>
					</td>
					<td width="15%" align="right" style="padding-right: 10px;">
						<?php 
							echo number_format($resultChal['taxval'],2); 
						?>
					</td>
					<?php 

						$total_value = $total_value + $resultChal['taxval'];
						$total_disc_amt 	= $resultChal['disc'];
						$total_frt_amt 		= $total_frt_amt 	+ $resultChal['frtcd'];
						$total_ins_amt 		= $resultChal['insu'];
						$total_pack_amt 	= $total_pack_amt 	+ $resultChal['packing'];
						$total_cgst_amt 	= $total_cgst_amt 	+ $resultChal['cgstval'];
						$total_sgst_amt 	= $total_sgst_amt 	+ $resultChal['sgstval'];
						$total_igst_amt 	= $total_igst_amt 	+ $resultChal['igstval'];

						if ($itemNo == '9990291') {
							$amortization_value = ($resultChal['taxval'])?$resultChal['taxval']:'0.00';
						}
						//$total_sum 		= $total_sum 	+ $resultChal['total'];

						//$payterm 	=	$resultChal['payterm'];
						$frtnm	=	$resultChal['frtnm'];
						//$gst_per	=	$resultChal['gst_per'];
						$cgst_per	=	$resultChal['cgstrt'];
						$sgst_per	=	$resultChal['sgstrt'];
						$igst_per	=	$resultChal['igstrt'];
						$bilexcise = $resultChal['bilexcise'];
						$bilcess = $resultChal['bilcess'];
						$bilhscs = $resultChal['bilhscs'];
						$bilstax = $resultChal['bilstax'];
					?>
				</tr>
			</table>
		</div>			
			<?php if ($i % 10 == 0) { ?>
				<?php require('challan_print_footer.php'); ?>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<?php require('challan_print_header_top.php'); ?>	
				<div class="hr-divider"><hr></div>	
			<?php	} ?>
		<?php $i++;  } ?>
		<?php require('challan_print_footer_final.php'); ?>
		<?php }else{ ?>		
		<table width="100%">
			<tr>
				<td align="center" style="color:red;">No Record(s) Found.</td>
			</tr>
		</table>
		<?php } ?>
	</div>
</body>
</html>