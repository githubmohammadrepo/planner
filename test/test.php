<?php
?>
<html>
<head>
<title>PHP PDO CRUD</title>
<style>
body{width:615px;font-family:arial;letter-spacing:1px;line-height:20px;}
.tbl-qa{width: 100%;font-size:0.9em;background-color: #f5f5f5;}
.tbl-qa th.table-header {padding: 5px;text-align: left;padding:10px;}
.tbl-qa .table-row td {padding:10px;background-color: #FDFDFD;vertical-align:top;}
.button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;}
</style>
</head>
<body>
<?php	
try {
$db =new PDO('mysql:host=localhost;dbname=planner', 'root','');
    // Enabled throwing errors - you can remove this after debugging
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Prepare the statement
    $stmt = $db->prepare("Select * From titles");

    // You can also use bindparams, I like to use execute and pass and array so it is shorter
    $stmt->execute(array());
    if($stmt->RowCount()==0) {
        // Do stuff when no results are found (without an error)
        echo 'something';
    } else {
        $Results = $stmt->FetchAll();
       return json_encode($Results);
    }

// Catch any exceptions and put the error into $e
} catch (Exception $e) {
    // Echo the error we got - you should only output errors when debugging
    echo $e->GetMessage();
}





// /* Exercise PDOStatement::fetch styles */
// print("PDO::FETCH_ASSOC: ");
// print("Return next row as an array indexed by column name\n");
// $result = $sth->fetch(PDO::FETCH_ASSOC);
// echo '<hr>';
// print_r($result);
// print("\n");
?>
