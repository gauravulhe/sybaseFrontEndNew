<?php 	
	//create ODBC connection   
	require_once('../config/config.php');
?>
<html>
<head>
    <title>Gate Pass Reports</title>
    <style type="text/css">
        .bg-color{
            background-color: skyblue;
        }
    </style>
    <script type="text/javascript">
    	window.print();
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

	$user_com_dbf = $_POST['user_com_dbf'];
	$gpa_com = $_POST['gpa_com'];
	$gpa_unit = $_POST['gpa_unit'];
	$fr_gp_dt = $_POST['fr_gp_dt'];
	$to_gp_dt = $_POST['to_gp_dt'];
	$gpa_ryn = strtoupper($_POST['gpa_ryn']);
	$file_name = strtoupper($_POST['file_name']);

	$sql = "SELECT 
			gpa.gpa_com,gpa.gpa_unit,gpa.gpa_dt,gpa.gpa_no,gpa.gpa_ryn,gpa.gpa_tc,gpa.gpa_ptycd,gpa.gpa_pty_rep,gpa.gpa_truck_no,gpa.gpa_ref_no,gpa.gpa_ref_dt,gpa.gpa_dept,gpa.gpa_remarks,gpa.gpa_can_tag,
			gpd.gpd_srl,gpd.gpd_item,gpd.gpd_itm_desc,gpd.gpd_qty,gpd.gpd_rate,gpd.gpd_uom,gpd.gpd_cum_rqty,gpd.gpd_expected_dt,gpd.gpd_can_tag, 
			com.com_name,com.com_uname,com.com_add1,com.com_add2,com.com_add3,
			sup.sup_name,
			gpt.gp_tran_name,
			dept.dep_desc,
			cod.cod_desc
			FROM $user_com_dbf.invac.gpass as gpa 
			INNER JOIN $user_com_dbf.invac.gpdet as gpd 
			ON
			gpa.gpa_com = gpd.gpd_com AND
			gpa.gpa_unit = gpd.gpd_unit AND
			gpa.gpa_dt = gpd.gpd_dt AND
			gpa.gpa_no = gpd.gpd_no 
			INNER JOIN catalog..comcat as com
			ON
			gpa.gpa_com = com.com_com AND
			gpa.gpa_unit = com.com_unit
			INNER JOIN catalog..supcat as sup
			ON
			gpa.gpa_ptycd = sup.sup_supcd
			INNER JOIN $user_com_dbf.invac.gptran as gpt
			ON
			gpa.gpa_tc = gpt.gp_tran_cd
			INNER JOIN catalog..deptcat as dept
			ON
			gpa.gpa_dept = dept.dep_cd AND
			dept.dep_prefix = 3
			INNER JOIN catalog..codecat as cod
			ON
			gpd.gpd_uom = cod.cod_code AND
			cod.cod_prefix = 6
			WHERE gpa_com = $gpa_com AND gpa_unit = $gpa_unit AND gpa_ryn = '$gpa_ryn'  AND gpa_dt  BETWEEN '$fr_gp_dt' AND '$to_gp_dt'";
	$result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
	//print_r(odbc_result_all($result, "border=1"));
	$rows = array();
    while ($myRow = odbc_fetch_array($result)) {
        $rows[] = $myRow;
    }
    if (!empty($rows)) {
?>
	<table border="0" width="100%">
		<tr class="bg-color">
			<th colspan="3">Gate Pass Printing </th>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">Gate Pass Register Dt </th>
			<th> : </th>
			<td><?php echo date('d.m.Y', strtotime($fr_gp_dt)).' To '.date('d.m.Y', strtotime($to_gp_dt)); ?></td>
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
	</table>
	<table border="1" cellpadding="0px" width="100%">
		<tr class="bg-color">
			<th>GP DT</th>
			<th>GP NO</th>
			<th>GP SRL</th>
			<th>PARTY NAME</th>
			<th>PERSON NAME</th>
			<th>TRANSACTION</th>
			<th>DEPARTMENT</th>
			<th>ITEM NAME</th>
			<th>RATE</th>
			<th>QTY</th>
			<th>VALUE</th>
			<th>UOM</th>
			<th>EXP. DT/DELAY</th>
			<th>QTY SENT</th>
		</tr>

	<?php 
	    
		$i = 1;
	    foreach ($rows as $row) {
	 ?>
        <tr>
            <td><?php echo date('d.m.Y', strtotime($row['gpa_dt'])); ?></td>
            <td><?php echo $row['gpa_no']; ?></td>
            <td><?php echo $row['gpd_srl']; ?></td>
            <td><?php echo $row['sup_name']; ?></td>
            <td><?php echo $row['gpa_pty_rep']; ?></td>
            <td><?php echo $row['gp_tran_name']; ?></td>
            <td><?php echo $row['dep_desc']; ?></td>
            <td><?php echo $row['gpd_itm_desc']; ?></td>
            <td><?php echo $row['gpd_rate']; ?></td>
            <td><?php echo $row['gpd_qty']; ?></td>
            <td><?php echo number_format($row['gpd_rate']*$row['gpd_qty'], 2); ?></td>
            <td><?php echo $row['cod_desc']; ?></td>
            <td><?php echo date('d.m.Y', strtotime($row['gpd_expected_dt'])); ?></td>
            <td></td>
        </tr>
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
			<th>GP DT</th>
			<th>GP NO</th>
			<th>GP SRL</th>
			<th>PARTY NAME</th>
			<th>PERSON NAME</th>
			<th>TRANSACTION</th>
			<th>DEPARTMENT</th>
			<th>ITEM NAME</th>
			<th>RATE</th>
			<th>QTY</th>
			<th>VALUE</th>
			<th>UOM</th>
			<th>EXP. DT/DELAY</th>
			<th>QTY SENT</th>
		</tr> 
		<?php	} ?>
	<?php   $i++; }  ?> 

	</table>

<?php } } ?>


</body>
</html>