<?php

    require_once('../config/config.php');

/*******EDIT LINES 3-8*******/
$DB_DBName = "catalog";         //ODBC Database Name  
$DB_TBLName = "catalog.invac.request"; //ODBC Table Name   
$filename = "purchase_requisition";         //File Name
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create ODBC connection   
$sql = "Select * from $DB_TBLName";
$result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
if (!empty($_GET['ext']) && $_GET['ext'] == 'doc') {
    $file_ending = "doc";
}elseif (!empty($_GET['ext']) && $_GET['ext'] == 'pdf') {
    $file_ending = "pdf";
}else{
    $file_ending = "xls";
}
//header info for browser
header("Content-Type: application/$file_ending");
header("Content-Disposition: attachment; filename=$filename.$file_ending");
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of ODBC fields
// for ($i = 1; $i < odbc_num_fields($result); $i++) {
//     echo odbc_field_name($result,$i) . "\t";
// }
echo "\n";
//end of printing column names  
//start while loop to get data
    while($row = odbc_fetch_row($result))
    {
        $schema_insert = "";
        for ($i = 1; $i < odbc_num_fields($result); $i++) {
            $schema_insert .= odbc_result($result, $i).$sep;
        }
        $schema_insert .= odbc_result_all($result, "border=1").$sep;
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }   
?>