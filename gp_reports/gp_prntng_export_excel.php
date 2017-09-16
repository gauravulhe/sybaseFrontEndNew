<html>
<head>
    <title>GST UPLOADS</title>
    <style type="text/css">
        .bg-color{
            background-color: skyblue;
        }
    </style>
</head>
<body>

<?php

//create ODBC connection   
require_once('../config/config.php');

if (isset($_POST['submit'])) {

	$user_com_dbf = $_POST['user_com_dbf'];
	$gpa_com = $_POST['gpa_com'];
	$gpa_unit = $_POST['gpa_unit'];
	$fr_gp_dt = $_POST['fr_gp_dt'];
	$to_gp_dt = $_POST['to_gp_dt'];
	$fr_gp_no = $_POST['fr_gp_no'];
	$to_gp_no = $_POST['to_gp_no'];
	$file_name = strtoupper($_POST['file_name']);
	$file_ending = "xls";

	$sql = "SELECT * FROM $user_com_dbf.invac.gpass WHERE gpa_dt = '$fr_gp_dt'";
	$result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
	//print_r(odbc_result_all($result, "border=1"));
	
	//header info for browser
	header("Content-Type: application/$file_ending");
	header("Content-Disposition: attachment; filename=$file_name.$file_ending");
	header("Pragma: no-cache"); 
	header("Expires: 0");
	
	/*******Start of Formatting for Excel*******/   
	//define separator (defines columns in excel & tabs in word)
	echo '<table border="1">';
	echo '<tr class="bg-color">';
	echo '<th colspan="4">Gate Pass Export</th>';
	echo '</tr>';
	echo '</table>';
	echo '<table border="1" cellpadding="5px">';
	echo '<tr class="bg-color">';

	echo '<th>gpa_com</th>';
	echo '<th>gpa_unit</th>';
	echo '<th>gpa_dt</th>';
	echo '<th>gpa_no</th>';
	echo '<th>gpa_ryn</th>';
	echo '<th>gpa_tc</th>';
	echo '<th>gpa_ptycd</th>';
	echo '<th>gpa_pty_rep</th>';
	echo '<th>gpa_truck_no</th>';
	echo '<th>gpa_ref_no</th>';
	echo '<th>gpa_ref_dt</th>';
	echo '<th>gpa_dept</th>';
	echo '<th>gpa_sys_dt</th>';
	echo '<th>gpa_upd_dt</th>';
	echo '<th>gpa_remarks</th>';
	echo '<th>gpa_userid</th>';
	echo '<th>gpa_can_tag</th>';

	echo '</tr>';
	echo '</table>';
	echo '<table border="0" cellpadding="5px">';

	//end of printing column names  
	//start while loop to get data

	    $rows = array();
	    while ($myRow = odbc_fetch_array($result)) {
	        $rows[] = $myRow;
	    }
	    foreach ($rows as $row) {
	        echo '<tr>';

	            echo '<td>'.$row['gpa_com'].'</td>';
	            echo '<td>'.$row['gpa_unit'].'</td>';
	            echo '<td>'.date('d.m.Y', strtotime($row['gpa_dt'])).'</td>';
	            echo '<td>'.$row['gpa_no'].'</td>';
	            echo '<td>'.$row['gpa_ryn'].'</td>';
	            echo '<td>'.$row['gpa_tc'].'</td>';
	            echo '<td>'.$row['gpa_ptycd'].'</td>';
	            echo '<td>'.$row['gpa_pty_rep'].'</td>';
	            echo '<td>'.$row['gpa_truck_no'].'</td>';
	            echo '<td>'.$row['gpa_ref_no'].'</td>';
	            echo '<td>'.date('d.m.Y', strtotime($row['gpa_ref_dt'])).'</td>';
	            echo '<td>'.$row['gpa_dept'].'</td>';
	            echo '<td>'.date('d.m.Y', strtotime($row['gpa_sys_dt'])).'</td>';
	            echo '<td>'.date('d.m.Y', strtotime($row['gpa_upd_dt'])).'</td>';
	            echo '<td>'.$row['gpa_remarks'].'</td>';
	            echo '<td>'.$row['gpa_userid'].'</td>';
	            echo '<td>'.$row['gpa_can_tag'].'</td>';


	        echo '</tr>';
	    }
	echo '</table>';


}
?>


</body>
</html>