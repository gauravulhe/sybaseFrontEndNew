<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){
        	$q = $_GET["q"];
            $UserComDbf = trim($_GET["UserComDbf"]);
        
            require_once('cmp_pass_actn.php');

        	$query = "SELECT gp_tran_name FROM $UserComDbf.invac.gptran WHERE gp_tran_cd = $q";
        	// execute the query
            $result = odbc_exec($conn, $query);
            //print(odbc_result_all($result, "border=1"));
            if (!empty(odbc_result($result, 1))) {
            	print(
            		json_encode(
            			array(
            				'gp_tran_name' => odbc_result($result, 1),
                            'passActn' => $passActn
            			)
            		)
            	);
            }else{
                print(
                    json_encode(
                        array(
                            'gp_tran_name' => '',
                            'passActn' => $passActn
                        )
                    )
                );
            }
	}
?>