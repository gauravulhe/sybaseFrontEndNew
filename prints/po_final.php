<?php
  // header("Content-type: application/vnd.ms-word");
  // header("Content-Disposition: attachment;Filename=purchase_order.doc");
?>  
<?php require('po_final_calculation.php'); ?>
<html>
<head>
	<title>Purchase Order</title>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
	<style type="text/css">
		.container{
			font-size: 11px;
			margin: 5px;
			padding: 10px;
			/*border: 1px solid #000;*/
		}
		table tr td{
			font-size: 10px;
		}
		table tr td{
			font-size: 10px;
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
			height: auto;
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
	<?php if (!empty($_POST['po_no'])): ?>		
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
	            window.location="../inv_prchs_prchs_ordrs_print.php?pid=prchs";
	            window.close();
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
		<div class="print">
				Purchase Order
		</div>
		<?php require('po_final_print_header_top.php'); ?>
		
		<div class="hr-divider"><hr></div>
		<?php
			$rows = array();
			$i = 1;						
			while ($myRow = odbc_fetch_array($result)) {
				$rows[] = $myRow;
			}
			$noOfRows = count($rows);

			$total_irate = 0;
			$total_excise_amt = 0;
			$total_ins_amt = 0;
			$total_frt_amt = 0;
			$total_stax_amt = 0;
			$total_load_amt = 0;
			$total_pack_amt = 0;
			$total_comm_amt = 0;
			$total_others = 0;
			$total_scharg = 0;
			$total_tcharg = 0;
			$total_cess_amt = 0;
			$total_hsec_amt = 0;
			$total_serv_amt = 0;
			$total_gst_amt = 0;
			$total_igst_amt = 0;
			$total_sgst_amt = 0;
			$total_cgst_amt = 0;
			$total_ugst_amt = 0;
			$total_disc_amt = 0;
			$totalPriceSum = 0;

			$payterm = '';
			$addlrmk = '';

			if (!empty($rows)){
			foreach ($rows as $resultPO) {
		?>
		<div class="content">
			<table width="100%">
				<tr>
					<td width="5%" align="center"><?php echo str_pad($i, 3, "0", STR_PAD_LEFT); ?></td>
					<td width="10%" align="center"><?php 
							$itemNo = $resultPO['poitem'];
							echo $itemNo; ?>
					</td>
					<td width="35%" align="left">
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
					<td width="10%" align="center"><?php echo $resultPO['chpt_head']; ?></td>
					<td width="10%" align="right"><?php echo number_format($resultPO['poqty'],2); ?></td>
					<td width="10%" align="right"><?php echo number_format($resultPO['porate'],2); ?></td>
					<td width="15%" align="right" style="padding-right: 10px;"><?php echo number_format($resultPO['irate'],2); ?></td>
					<?php 

						$total_irate 		= $total_irate 		+ $resultPO['irate'];
						$total_excise_amt 	= $total_excise_amt + $resultPO['excise_amt'];
						$total_ins_amt 		= $total_ins_amt 	+ $resultPO['ins_amt'];
						$total_frt_amt 		= $total_frt_amt 	+ $resultPO['frt_amt'];
						$total_stax_amt 	= $total_stax_amt 	+ $resultPO['stax_amt'];
						$total_load_amt 	= $total_load_amt 	+ $resultPO['load_amt'];
						$total_pack_amt 	= $total_pack_amt 	+ $resultPO['pack_amt'];
						$total_comm_amt 	= $total_comm_amt 	+ $resultPO['comm_amt'];
						$total_others 		= $total_others 	+ $resultPO['others'];
						$total_scharg 		= $total_scharg 	+ $resultPO['scharg'];
						$total_tcharg 		= $total_tcharg 	+ $resultPO['tcharg'];
						$total_cess_amt 	= $total_cess_amt 	+ $resultPO['cess_amt'];
						$total_hsec_amt 	= $total_hsec_amt 	+ $resultPO['hsec_amt'];
						$total_serv_amt 	= $total_serv_amt 	+ $resultPO['serv_amt'];
						$total_igst_amt 	= $total_igst_amt 	+ $resultPO['igst_amt'];
						$total_gst_amt 	= $total_gst_amt 	+ $resultPO['gst_amt'];
						$total_sgst_amt 	= $total_sgst_amt 	+ $resultPO['sgst_amt'];
						$total_cgst_amt 	= $total_cgst_amt 	+ $resultPO['cgst_amt'];
						$total_ugst_amt 	= $total_ugst_amt 	+ $resultPO['ugst_amt'];
						$total_disc_amt 	= $total_disc_amt 	+ $resultPO['disc_amt'];
						$totalPriceSum 		= $totalPriceSum 	+ $resultPO['total'];

						$payterm 	=	$resultPO['payterm'];
						$addlrmk	=	$resultPO['addlrmk'];
						$gst_per	=	$resultPO['gst_per'];
						$igst_per	=	$resultPO['igst_per'];
						$sgst_per	=	$resultPO['sgst_per'];
						$cgst_per	=	$resultPO['cgst_per'];
						$ugst_per	=	$resultPO['ugst_per'];
					?>
				</tr>
			</table>
		</div>					
			<?php 				
				$no_of_records = ($_POST['no_of_records'])?$_POST['no_of_records'] : 15;
				$line_break = ($_POST['line_break'])?$_POST['line_break'] : 28;
				if ($i % $no_of_records == 0) { 
				require('po_final_print_footer.php'); 
				while ($line_break >= 0) {
					echo '<br>';
					$line_break--;
				}				
				require('po_final_print_header_top.php');
				} ?>
		<?php $i++;  } ?>
		<?php require('po_final_print_footer_final.php'); ?>
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