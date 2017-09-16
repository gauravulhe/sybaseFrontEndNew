<?php
  // header("Content-type: application/vnd.ms-word");
  // header("Content-Disposition: attachment;Filename=purchase_order.doc");
?>  
<html>
<head>
	<title>Tax Invoice | Bill Of Supply | Delivery Challan | Export Invoice</title>
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
		@page 
	    {
	        size: auto;   /* auto is the initial value */
	        margin: 0mm;  /* this affects the margin in the printer settings */
	    }
	</style>
	<?php if (!empty($_GET['print_pdf'])): ?>		
		<script type="text/javascript">
			// window.print();
		</script>
	<?php endif ?>
	<script type="text/javascript">
		(function () {

	        var beforePrint = function () {
	            //alert('Functionality to run before printing.');
	            document.getElementById("print_save").remove();
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
	<span onclick="window.print();" id="print_save" style="cursor:pointer; float:right;">PRINT / SAVE</span>
	<?php 

	if (!empty($_POST['chal_bil_frno'])) {
		$chal_bil_frno = $_POST['chal_bil_frno'];
		$chal_bil_tono = $_POST['chal_bil_tono'];
		$chal_bil_frdt = date('Ymd', strtotime($_POST['chal_bil_frdt']));
		$chal_bil_todt = date('Ymd', strtotime($_POST['chal_bil_todt']));
		$chal_bil_no = array();
		$chal_bil_dt = array();
		for ($number = $chal_bil_frno; $number <= $chal_bil_tono; $number++)
		{			
			for ($date = $chal_bil_frdt; $date <= $chal_bil_todt; $date++)
			{
				array_push($chal_bil_no, $number);
				array_push($chal_bil_dt, $date);
	    	}
    	}
    	$bil_dt_count = count($chal_bil_no);
    	$bil_no_count = count($chal_bil_dt);
	}
	for ($j=0; $j < $bil_dt_count; $j++) { 
		if (!empty($_POST['chal_bil_frno'])) {
			$chal_com = $_POST['chal_com'];
			$chal_unit = $_POST['chal_unit'];
			$chal_bil_type = $_POST['chal_bil_type'];

	    	$chal_bil_frno = $chal_bil_no[$j];
			$chal_bil_tono = $chal_bil_no[$j];			
	    	$chal_bil_frdt = $chal_bil_dt[$j];
			$chal_bil_todt = $chal_bil_dt[$j];
			
			$chal_bil_fyr = $_POST['chal_bil_fyr'];
			$chal_bil_sfx = strtolower(trim($_POST['chal_bil_sfx']));
		}else{
			$chal_com = 1;
			$chal_unit = 1;
			$chal_bil_type = 'gst_bil';
			$chal_bil_frno = $chal_bil_no[$j];
			$chal_bil_tono = $chal_bil_no[$j];
			$chal_bil_frdt = date('Ymd', strtotime($chal_bil_dt[$j]));
			$chal_bil_todt = date('Ymd', strtotime($chal_bil_dt[$j]));
			$chal_bil_fyr = '2017';
			$chal_bil_sfx = '';
		}
		require('challan_calculation_new.php');
		$container_result = odbc_result($resultChal, 1);
		if (!empty($container_result)) {
			echo '<div class="container">';
			require('challan_print_header_top.php');
			require('challan_body.php');
			echo '</div>';
		}		
	}

	function foo($total_sum)
	{
	 	// $number = $total_sum;
		// $no = round($number);
		// $point = round($number - $no, 2) * 100;

		$number = number_format($total_sum, 2);
		$number = str_replace(',', '', $number);
		$str_arr = explode('.',$number);
		$no = $str_arr[0];  // Before the Decimal point
		$point = ($str_arr[1])?$str_arr[1]:'';  // After the Decimal point
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array('0' => 'ZERO', '1' => 'ONE', '2' => 'TWO',
		'3' => 'THREE', '4' => 'FOUR', '5' => 'FIVE', '6' => 'SIX',
		'7' => 'SEVEN', '8' => 'EIGHT', '9' => 'NINE',
		'10' => 'TEN', '11' => 'ELEVEN', '12' => 'TWELVE',
		'13' => 'THIRTEEN', '14' => 'FOURTEEN',
		'15' => 'FIFTEEN', '16' => 'SIXTEEN', '17' => 'SEVENTEEN',
		'18' => 'EIGHTEEN', '19' =>'NINETEEN', '20' => 'TWENTY',
		'30' => 'THIRTY', '40' => 'FORTY', '50' => 'FIFTY',
		'60' => 'SIXTY', '70' => 'SEVENTY',
		'80' => 'EIGHTY', '90' => 'NINETY');
		$digits = array('', 'HUNDRED', 'THOUSAND', 'LAKH', 'CRORE');
		while ($i < $digits_1) {
		 $divider = ($i == 2) ? 10 : 100;
		 $number = floor($no % $divider);
		 $no = floor($no / $divider);
		 $i += ($divider == 10) ? 1 : 2;
		 if ($number) {
		    $plural = (($counter = count($str)) && $number > 9) ? 'S' : null;
		    $hundred = ($counter == 1 && $str[0]) ? ' AND ' : null;
		    $str [] = ($number < 21) ? $words[$number] .
		        " " . $digits[$counter] . $plural . " " . $hundred
		        :
		        $words[floor($number / 10) * 10]
		        . " " . $words[$number % 10] . " "
		        . $digits[$counter] . $plural . " " . $hundred;
		 } else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		$result = ($result)?$result:'ZERO ';
		$points = ($point) ?
		" AND " . $words[$point / 10] . " " . 
		      $words[$point = $point % 10] : 'ZERO';
		$final_result = $result . "RUPEES  " . $points . " PAISE";
	    return $final_result;
	}
?>
</body>
</html>