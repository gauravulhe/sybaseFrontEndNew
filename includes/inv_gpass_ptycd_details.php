<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
        	$q = $_GET["q"];
        
            require_once('cmp_pass_actn.php');

        	$query = "SELECT sup_name,sup_add1,sup_add2,sup_add3 FROM catalog..supcat WHERE sup_supcd = '$q'";
        	// execute the query
            $result = odbc_exec($conn, $query);
            //print(odbc_result_all($result, "border=1"));
            if (!empty(odbc_result($result, 1))) {
            	print(
            		json_encode(
            			array(
            				'gpa_ptycd_details' => odbc_result($result, 1).', '.odbc_result($result, 2).', '.odbc_result($result, 3).', '.odbc_result($result, 4),
                            'passActn' => $passActn
            			)
            		)
            	);
            }else{
                print(
                    json_encode(
                        array(
                            'gpa_ptycd_details' => '',
                            'passActn' => $passActn
                        )
                    )
                );
            }
	}
?>