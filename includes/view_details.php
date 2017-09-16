<?php 
	
	require_once('../config/config.php');

	if(isset($_GET["q"])){

		$q = $_GET["q"];

		if ($q == 'type') {
			$query = "SELECT cod_code as Type, cod_desc as Description FROM catalog..codecat WHERE cod_prefix = 15 AND cod_code != 0";
            echo "<h3>Purchase Order Types</h3>";
		}elseif ($q == 'supcd') {
			$query = "SELECT sup_supcd as Supplier_Party_Code, sup_name as Supplier_Name FROM catalog..supcat WHERE sup_gst_class >= 0";
            echo "<h3>Supplier's Details</h3>";
		}elseif ($q == 'salestax') {
			$query = "SELECT cod_code as Sales_Tax_Code, cod_desc as Description FROM catalog..codecat WHERE cod_prefix = 1 AND cod_code != 0";
            echo "<h3>Sales Tax Codes</h3>";
		}elseif ($q == 'excisecd') {
			$query = "SELECT cod_code as Excise_Code, cod_desc as Description FROM catalog..codecat WHERE cod_prefix = 2 AND cod_code != 0";
            echo "<h3>Excise Codes</h3>";
		}elseif ($q == 'payterms') {
			$query = "SELECT cod_code as Payment_Terms, cod_desc as Description FROM catalog..codecat WHERE cod_prefix = 13 AND cod_code != 0";
            echo "<h3>Payment Terms Descriptions</h3>";
		}elseif ($q == 'gstcd') {
			$query = "SELECT cod_code as GST_Code, cod_desc as Description FROM catalog..codecat WHERE cod_prefix = 19";
            echo "<h3>GST Code Details</h3>";
		}elseif ($q == 'com_id') {
			$query = "SELECT cod_code as Id, cod_desc as Description FROM catalog..codecat WHERE cod_prefix = 201 AND cod_code NOT IN (0,5,10)";
            echo "<h3>Commercial Details Ids</h3>";
		}elseif ($q == 'com_tag') {
			$query = "SELECT cod_code as Tag, cod_desc as Description FROM catalog..codecat WHERE cod_prefix = 202 AND cod_code != 0";
            echo "<h3>Commercial Details Tags</h3>";
		}elseif ($q == 'itemcode') {
			$query = "SELECT itm_item as Item_Code,itm_desc as Description FROM catalog..itmcat WHERE itm_item != '0000000'";
            echo "<h3>Item Codes</h3>";
		}elseif ($q == 'unloader') {
			$query = "SELECT cod_code as Unloader_Code, cod_desc as Description FROM catalog..codecat WHERE cod_prefix = 5 AND cod_code != 0";
            echo "<h3>Loading / Unloading Contractors</h3>";
		}elseif ($q == 'agent') {
			$query = "SELECT cod_code as Agent_Code, cod_desc as Description FROM catalog..codecat WHERE cod_prefix = 3 AND cod_code != 0";
            echo "<h3>Commission Agents</h3>";
		}elseif ($q == 'trn_cd') {
			$comDbf = $_GET['comDbf'];
			$query = "SELECT gp_tran_cd as TRN_Code,gp_tran_name as TRN_Name,gp_tran_type as TRN_Type FROM $comDbf.invac.gptran";
            echo "<h3>Gate Pass Transaction Codes</h3>";
		}elseif ($q == 'dep_cd') {
			$query = "SELECT dep_cd as Dept_Code,dep_desc as Description FROM catalog..deptcat WHERE dep_cd = $q AND dep_prefix = 3";
            echo "<h3>Gate Pass Department Codes</h3>";
		}elseif ($q == 'iss_dep_cd') {
			$query = "SELECT dep_cd as Dept_Code,dep_desc as Description FROM catalog..deptcat WHERE dep_cd != 0 AND dep_prefix = 1";
            echo "<h3>Store Issue Department Codes</h3>";
		}elseif ($q == 'iss_cost_cd') {
			$query = "SELECT dep_cd as Cost_Code,dep_desc as Description FROM catalog..deptcat WHERE dep_cd != 0 AND dep_prefix = 2";
            echo "<h3>Store Issue Cost Codes</h3>";
		}elseif ($q == 'iss_fond_cd') {
			$query = "SELECT cod_code as Fond_Code, cod_desc as Description FROM catalog..codecat WHERE cod_prefix = 16 AND cod_code != 0";
            echo "<h3>Store Issue Fond Codes</h3>";
		}elseif ($q == 'tc') {
			$query = "SELECT cod_code as Tc_Code, cod_desc as Description FROM catalog..codecat WHERE cod_prefix = 203 AND cod_code != 0";
            echo "<h3>Store Issue Codes</h3>";
		}


		// execute the query
        $result = odbc_exec($conn, $query);
        //print(odbc_result($result, 1));
        print(odbc_result_all($result, "border=1"));
	}


	if (isset($_GET['term'])) {
	    //get search term
	    $searchTerm = $_GET['term'];
	    $srchTermType = $_GET['fldType'];
	    $fldName = $_GET['fldName'];
	    $tblName = $_GET['tblName'];

	    //get matched data from table
	    if ($srchTermType == 'int') {
	    	if (isset($_GET['cdPrfx'])) {	    		
		    	$cdPrfx = $_GET['cdPrfx'];
		    	$query = "SELECT $fldName FROM catalog..$tblName WHERE $fldName = $searchTerm AND cod_prefix = $cdPrfx AND $fldName != 0";
	    	}else{
	    		$query = "SELECT $fldName FROM catalog..$tblName WHERE $fldName = '$searchTerm'";
	    	}
	    }elseif ($srchTermType == 'str'){
	    	$searchTerm = strtoupper($_GET['term']);
	    	$query = "SELECT $fldName FROM catalog..$tblName WHERE $fldName LIKE '%".$searchTerm."%'";
	    }


	    $result = odbc_exec($conn, $query);
		//print(odbc_result_all($result, "border=1"));

	    $data = odbc_result($result, 1);

		print(
			json_encode(
				array(
					$data
				)
			)
		);


		// $rows = array();
		// while($myRow = odbc_fetch_array( $result )){ 
		//     $rows[] = $myRow;//pushing into $rows array
		// }
  		
		
		// foreach($rows as $row) {
		// 	print(
		// 		json_encode(
		// 			array(
		// 				'sup_supcd' => $row['sup_supcd'],
		// 				'sup_name' => $row['sup_name']
		// 			)
		// 		)
		// 	);
		// }

	}
?>