<?php 
	require_once('../config/config.php');

	if (!empty($_GET['PoPoNo'])) {		
		$ComDbf = $_GET['ComDbf'];		
		$PoCommCd = $_GET['PoCommCd'];
		$PoUntCd = $_GET['PoUntCd'];
		$PoPoNo = $_GET['PoPoNo'];
		$PoFyr = $_GET['PoFyr'];
	}else{
		$ComDbf = 'acd2';
		$PoCommCd = 54;
		$PoUntCd = 3;
		$PoPoNo = 31;
		$PoFyr = 2017;		
	}
?>
<html>
<head>
	<title>Purchase Order</title>
	<?php if (!empty($_GET['PoPoNo'])): ?>		
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
	            window.location="po.php";
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script src="../js/jspdf.min.js"></script>
	<script>
	    function demoFromHTML() {
		    var pdf = new jsPDF('p', 'pt', 'letter');
		    // source can be HTML-formatted string, or a reference
		    // to an actual DOM element from which the text will be scraped.
		    source = $('.container')[0];

		    // we support special element handlers. Register them with jQuery-style 
		    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
		    // There is no support for any other type of selectors 
		    // (class, of compound) at this time.
		    specialElementHandlers = {
		        // element with id of "bypass" - jQuery style selector
		        '#bypassme': function (element, renderer) {
		            // true = "handled elsewhere, bypass text extraction"
		            return true
		        }
		    };
		    margins = {
		        top: 80,
		        bottom: 60,
		        left: 40,
		        width: 522
		    };
		    // all coords and widths are in jsPDF instance's declared units
		    // 'inches' in this case
		    pdf.fromHTML(
		    source, // HTML string or DOM elem ref.
		    margins.left, // x coord
		    margins.top, { // y coord
		        'width': margins.width, // max width of content on PDF
		        'elementHandlers': specialElementHandlers
		    },

		    function (dispose) {
		        // dispose: object with X, Y of the last line add to the PDF 
 				pdf.save('Test.pdf');
 				}, margins);
			}
	</script>
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
</head>
<body>
	<div class="container">		
		<?php if (!empty($_GET['PoPoNo'])): ?>
			<div class="print">
				Purchase Order
			</div>		
		<?php else: ?>
			<div class="print">
				<a href="po.php?ComDbf=<?php echo $ComDbf; ?>&PoCommCd=<?php echo $PoCommCd; ?>&PoUntCd=<?php echo $PoUntCd; ?>&PoPoNo=<?php echo $PoPoNo; ?>&PoFyr=<?php echo $PoFyr; ?>">PRINT</a>
			</div>
		<?php endif ?>
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
			if (!empty($rows)){
			foreach ($rows as $resultPO) {
		?>
		<div class="content">
			<table width="100%">
				<tr>
					<td width="5%" align="center"><?php echo str_pad($i, 3, "0", STR_PAD_LEFT); ?></td>
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
		<?php if (!empty($_GET['PoPoNo'])){ ?>
			
			<?php if ($i % 20 == 0) { ?>
				<?php require('po_print_footer.php'); ?>
				<br><br><br><br><br>
				<?php require('po_print_header_top.php'); ?>		
			<?php	} ?>
			
		<?php } ?>		
		<?php $i++;  } ?>
		<?php require('po_print_footer_final.php'); ?>
		<?php } ?>
	</div>
</body>
</html>