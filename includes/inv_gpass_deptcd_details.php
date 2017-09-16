<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
        	$q = $_GET["q"];
        
            require_once('cmp_pass_actn.php');

        	$query = "SELECT dep_desc FROM catalog..deptcat WHERE dep_cd = $q AND dep_prefix = 3";
        	// execute the query
            $result = odbc_exec($conn, $query);
            //print(odbc_result_all($result, "border=1"));
            if (!empty(odbc_result($result, 1))) {
            	print(
            		json_encode(
            			array(
            				'gpa_dept_desc' => odbc_result($result, 1),
                            'passActn' => $passActn
            			)
            		)
            	);
            }else{
                print(
                    json_encode(
                        array(
                            'gpa_dept_desc' => '',
                            'passActn' => $passActn
                        )
                    )
                );
            }
	}
?>