<?php 
include "..//config.php";
if(!isset($_GET["prostorija"])){
    echo "U zahtjevu nema informacije o adresi.\n";
    exit();
}

$sql_query = "SELECT * FROM PROSTORIJA WHERE NAZIV='".$_GET["prostorija"]."'";
$result = mysqli_query($con, $sql_query);
$data = mysqli_fetch_array($result);
echo $sql_query;
echo "<br>";
print_r($data);
echo "<br>";
$sql_query = "SELECT * FROM TEMP_SENZOR WHERE ID_CVOR=".$data["ID_CVOR"];
$result = mysqli_query($con, $sql_query);
echo $sql_query;
echo "<br>";

if($row["TIP"] == 0)$zrakID = $row["ID"];
if($row["TIP"] == 1)$radijatorID = $row["ID"];
if($row["TIP"] == 2)$kilmaID = $row["ID"];
$klima="";
while ($row = mysqli_fetch_array($result)){
    if($row["TIP"] == 0)$zrakID = $row["ID"];
    if($row["TIP"] == 1)$radijatorID = $row["ID"];
    if($row["TIP"] == 2)$kilmaID = $row["ID"];
}


?>