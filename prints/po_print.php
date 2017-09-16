<?php 
	require_once('../config/config.php');
	if (!empty($_GET['PoPoNo'])) {		
		$PoCommCd = $_GET['PoCommCd'];
		$PoUntCd = $_GET['PoUntCd'];
		$PoPoNo = $_GET['PoPoNo'];
		$PoFyr = $_GET['PoFyr'];
?>
<html>
<head>
	<script type="text/javascript">
		window.print();
	</script>
	<title>Purchase Order</title>
	<style type="text/css">
		.container{
			font-size: 12px;
			margin: 5px;
			padding: 10px;
			/*border: 1px solid #000;*/
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
	</style>
</head>
<body>
	<div class="container">
		
		<?php require('po_print_header_top.php'); ?>

		<?php

			$result = odbc_exec($conn, $queryPO);
			$rows = array();
			$i = 1;						
			while ($myRow = odbc_fetch_array($result)) {
				$rows[] = $myRow;
			}
			$noOfRows = count($rows);

			$totalPriceSum = 0;
			foreach ($rows as $resultPO) {
		?>
		<div class="content">
			<table width="100%">
				<tr>
					<td width="5%" align="center"><?php echo str_pad($i, 3, "0", STR_PAD_LEFT);; ?></td>
					<td width="10%" align="center"><?php 
							$itemNo = $resultPO['pod_item'];
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
					<td width="10%" align="center"><?php echo $resultPO['pod_chpt_id']; ?></td>
					<td width="10%" align="right"><?php echo number_format($resultPO['pod_ord_qty'],2); ?></td>
					<td width="10%" align="right"><?php echo number_format($resultPO['pod_rate'],2); ?></td>
					<td width="15%" align="right" style="padding-right: 10px;">
						<?php 
							$totalPrice = $resultPO['pod_ord_qty'] * $resultPO['pod_rate'];
							echo number_format($totalPrice,2); 
							$totalPriceSum = $totalPriceSum + $totalPrice;
						?>
					</td>
					<?php 
						$stax 	=	$resultPO['poh_stax_per'];
						$excCd	=	$resultPO['poh_excise_cd'];
						$queryExcCdDesc = "SELECT cod_desc FROM catalog..codecat WHERE cod_prefix = 1 AND cod_code = $excCd";
						$resultExcCdDesc = odbc_exec($conn, $queryExcCdDesc);
						$excise = odbc_result($resultExcCdDesc, 1);
						$gst	=	$resultPO['poh_gst_per'];
						$igst	=	$resultPO['poh_igst_per'];
						$sgst	=	$resultPO['poh_sgst_per'];
						$cgst	=	$resultPO['poh_cgst_per'];
					?>
				</tr>
			</table>
		</div>
		<?php if ($i % 20 == 0) { ?>
			<?php require('po_print_footer.php'); ?>
			<br><br><br><br><br><br><br>
			<?php require('po_print_header_top.php'); ?>		
		<?php	} ?>
		<?php $i++;  } ?>
		<?php require('po_print_footer_final.php'); ?>
	</div>
</body>
</html>
<?php } ?>