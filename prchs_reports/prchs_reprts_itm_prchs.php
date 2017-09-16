<?php 	
	//create ODBC connection   
	require_once('../config/config.php');
?>
<html>
<head>
    <title>Purchase Order Reports</title>
    <style type="text/css">
        .bg-color{
            background-color: skyblue;
        }
    </style>
    <script type="text/javascript">
    	// window.print();
    </script>
</head>
<body>

	<table border="0" width="100%">
		<tr>
			<th colspan="3">NECO GROUP OF INDUSTRIES</th>
		</tr>
	</table>
<?php

if (isset($_POST['submit'])) {
	//print_r($_POST);

	$user_com_dbf = $_POST['user_com_dbf'];
	$grd_com = $_POST['grd_com'];
	$grd_unit = $_POST['grd_unit'];
	$fr_grd_item = $_POST['fr_grd_item'];
	$to_grd_item = $_POST['to_grd_item'];
	$fr_grd_dt = $_POST['fr_grd_dt'];
	$to_grd_dt = $_POST['to_grd_dt'];
	$file_name = strtoupper($_POST['file_name']);
	$Guser_id = $_SESSION['usr_id'];

	$grdlst = 'grdlst'.substr($Guser_id, 0, 4);

	// check if table1 exists or not
	$tab_check_query = "SELECT * FROM tempdb..sysobjects WHERE name = '$grdlst'";
	$tab_result = @odbc_exec($conn, $tab_check_query);		
	$tab_name = @odbc_result($tab_result, 1);
	//print_r(odbc_result_all($tab_result, "border=1"));exit;

	//checks if the table exists before dropping it and then drop.
	if (!empty($tab_name)) {
		$tab_drop_query = "DROP TABLE tempdb..$grdlst";
		$tab_drop_result = @odbc_exec($conn, $tab_drop_query);
	}

	$sql1 = "select a.grd_unit, a.grd_fyr, a.grd_no, a.grd_dt, a.grd_item,
                 a.grd_srl, qty=a.grd_rcv_qty-grd_rej_qty, a.grd_po_no,
                 c.grh_chal_no, c.grh_chal_dt, b.itm_desc, c.grh_supcd,
                 d.mat_accd
			  from $user_com_dbf.invac.grdet a, catalog.dbo.itmcat b,
		               $user_com_dbf.invac.grhdr c, $user_com_dbf.invac.matmast d
			  where a.grd_unit =$grd_unit
			  and   a.grd_fyr  =c.grh_fyr
			  and   a.grd_no   =c.grh_no
			  and   a.grd_dt between '$fr_grd_dt' and '$to_grd_dt'
			  and   a.grd_com  =$grd_com
			  and   a.grd_item =b.itm_item
			  and   a.grd_item between '$fr_grd_item' and '$to_grd_item'
			  and   a.grd_com  =c.grh_com
			  and   a.grd_unit =c.grh_unit
			  and   a.grd_item =d.mat_item
			  order by a.grd_unit,grd_fyr,grd_no,grd_dt,grd_srl";

	$result1 = odbc_exec($conn,$sql1) or die("Sybase Error".odbc_error());

	$sql2 = "alter table tempdb..{grdlst} add
              rate    float      null,
      	      value   float      null,
      	      avgrate float      null,
              name    char(7)    null,
      	      stax    float      null,
      	      excise  float      null,
              frt     float      null,
      	      ld      float      null, 
      	      pack    float      null,
      	      disc    float      null";

	$result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());

	$sql3 = "update tempdb..{grdlst}
           		set rate   = 0,
	               value  = 0,
	               avgrate= 0,
	               name   = ' ',
	               stax   = 0,
	               excise = 0,
	               frt    = 0,
	               ld     = 0,
	               pack   = 0,
	               disc   = 0";

	$result3 = odbc_exec($conn,$sql3) or die("Sybase Error".odbc_error());

	$sql4 = "update tempdb..{grdlst}
	           set qty = b.gra_forced_amt
	           from tempdb..{grdlst} a, {dbnm}.invac.gradj b 
	           where a.grd_unit= b.gra_unit
	             and a.grd_fyr = b.gra_fyr
	             and a.grd_no  = b.gra_no
	             and a.grd_dt  = b.gra_dt
	             and a.grd_srl = b.gra_srl
	             and b.gra_id  = 05";

	$result4 = odbc_exec($conn,$sql4) or die("Sybase Error".odbc_error());

	$sql5 = "update tempdb..{grdlst}
		       set rate = b.gra_forced_amt
		       from tempdb..{grdlst} a, {dbnm}.invac.gradj b 
		       where a.grd_unit= b.gra_unit
		         and a.grd_fyr = b.gra_fyr
		         and a.grd_no  = b.gra_no
		         and a.grd_dt  = b.gra_dt
		         and a.grd_srl = b.gra_srl
		         and b.gra_id  = 10";

	$result5 = odbc_exec($conn,$sql5) or die("Sybase Error".odbc_error());

	$sql6 = "delete from tempdb..{grdlst} where qty=0";
	$result6 = odbc_exec($conn,$sql6) or die("Sybase Error".odbc_error());

	$sql7 = "update tempdb..{grdlst} set value=rate*qty";
	$result7 = odbc_exec($conn,$sql7) or die("Sybase Error".odbc_error());

	

	print_r(odbc_result_all($result, "border=1"));exit;

	$rows = array();
    while ($myRow = odbc_fetch_array($result)) {
        $rows[] = $myRow;
    }
    //print_r($rows);exit;
    if (!empty($rows)) {
?>
	<table border="0" width="100%">
		<tr class="bg-color">
			<th colspan="3">PO Listing For Audit Department</th>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">Date </th>
			<th> : </th>
			<td><?php echo date('d.m.Y'); ?></td>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">Company Name </th>
			<th> : </th>
			<td><?php print_r($rows[0]['com_name']); ?></td>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">Company Unit </th>
			<th> : </th>
			<td><?php print_r($rows[0]['com_uname']); ?></td>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">PO Listing Date</th>
			<th> : </th>
			<td><?php echo 'From '.date('d-m-Y', strtotime($fr_grd_dt)).' To '.date('d-m-Y', strtotime($to_grd_dt)); ?></td>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">PO Listing Item</th>
			<th> : </th>
			<td><?php echo 'From '.$fr_grd_item.' To '.$to_grd_item; ?></td>
		</tr>
	</table>
	<table border="1" cellpadding="0px" width="100%">
		<tr class="bg-color">
			<th width="30%">Item No / Desc</th>
			<th>PO DATE</th>
			<th>PO NO </th>
			<th>SUPPLIER NAME</th>
			<th>RATE</th>
			<th>ORD QTY</th>
			<th>VALUE</th>
			<th>EX.AMT</th>
			<th>S.TAX</th>
			<th>NET.AMT.</th>
		</tr>

	<?php 	    
		$i = 1;
	    foreach ($rows as $row) {
	 ?>
        <tr>
            <td style="text-align:center"><?php echo $row['pod_item'].' <br>( '.$row['itm_desc'].' )'; ?></td>
            <td colspan="10">&nbsp;</td>
        </tr>
        <?php 
        	$sql2 = "SELECT DISTINCT * FROM $user_com_dbf.invac.podet WHERE pod_com = $poh_com AND pod_unit =  $poh_unit AND pod_fyr =  $row[poh_fyr] AND pod_po_no =  $row[poh_po_no]  AND pod_item = '$row[pod_item]'";

			$result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());
			//print_r(odbc_result_all($result2, "border=1"));
			$rows2 = array();
			while ($myRow2 = odbc_fetch_array($result2)) {
				$rows2[] = $myRow2;
			}
			foreach ($rows2 as $row2) {
        ?>
        <tr>
            <td>&nbsp;</td>
            <td style="text-align:center"><?php echo date('d-m-Y', strtotime($row['poh_po_dt'])); ?></td>
            <td style="text-align:center"><?php echo $row['poh_po_no']; ?></td>
            <td style="text-align:left"><?php echo $row['sup_name']; ?></td>
            <td style="text-align:right"><?php echo $rate = $row2['pod_rate']; ?></td>
            <td style="text-align:right">
            	<?php 
            		$qty = $row2['pod_ord_qty']; 
            		echo number_format($qty, 2); 
            	?>
            </td>
            <td style="text-align:right">
            	<?php 
            		$value = $rate*$qty; 
            		echo number_format($value, 2); 
            		?>
            </td>
            <td style="text-align:right">
            	<?php 
            		$ex_amt = explode('%', $row['cod_desc']);
            		$ex_amt = $ex_amt[0];
            		$ex_amt = ($value*$ex_amt)/100;
            		echo number_format($ex_amt, 2); ?></td>
            <td style="text-align:right">
            	<?php 
					$stax = $row['poh_stax_per']; 
					$stax_amt = ($value*$stax)/100; 
					echo number_format($stax_amt, 2);
				?>
            </td>
            <td style="text-align:right">
            	<?php 

            		$netAmt = $value + $stax_amt + $ex_amt;
            		echo number_format($netAmt, 2);
            	?>
           	</td>
        </tr>
        <?php } ?>
        <?php
        		$no_of_records = ($_POST['no_of_records'])?$_POST['no_of_records'] : 23;
				$line_break = ($_POST['line_break'])?$_POST['line_break'] : 1;
				if ($i % $no_of_records == 0) {
				while ($line_break >= 0) {
					echo '</table><br>';
					$line_break--;
				}
		?>
		<table border="1" cellpadding="0px" width="100%">
			<tr class="bg-color">
				<th>Item No / Desc</th>
				<th>PO DATE</th>
				<th>PO NO </th>
				<th>SUPPLIER NAME</th>
				<th>RATE</th>
				<th>ORD QTY</th>
				<th>VALUE</th>
				<th>EX.AMT</th>
				<th>S.TAX</th>
				<th>NET.AMT.</th>
			</tr>
		<?php	} ?>
	<?php   $i++; }  ?> 

	</table>

<?php } } ?>
<br><br>

</body>
</html>