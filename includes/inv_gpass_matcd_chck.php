<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
        	$q = date('Y-m-d 00:00:00', strtotime($_GET["q"]));
            $UserComDbf = trim($_GET["UserComDbf"]);
        
            require_once('cmp_pass_actn.php');

        	$query = "SELECT max(gpa_no) FROM $UserComDbf.invac.gpass WHERE gpa_dt = '$q'";
        	// execute the query
            $result = odbc_exec($conn, $query);
            //print(odbc_result_all($result, "border=1"));
            $gpa_no = odbc_result($result, 1)+1;
            if (!empty(odbc_result($result, 1))) {
            	print(
            		json_encode(
            			array(
            				'gpa_no' => $gpa_no,
                            'passActn' => $passActn
            			)
            		)
            	);
            }else{
                print(
                    json_encode(
                        array(
                            'gpa_no' => $gpa_no,
                            'passActn' => $passActn
                        )
                    )
                );
            }
	}
?>