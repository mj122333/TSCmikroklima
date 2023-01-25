<?php 
include "..//config.php";
if(!isset($_GET["prostorija"])){
    echo "U zahtjevu nema informacije o adresi.\n";
    exit();
}
echo $_GET["prostorija"];

$sql_query = "SELECT * FROM PROSTORIJA";
$result = mysqli_query($con, $sql_query);
print_r(mysqli_fetch_array($result));
echo "<br>";

$sql_query = "ALTER TABLE PROSTORIJA RENAME COLUMN ADRESA TO NAZIV";
$result = mysqli_query($con, $sql_query);
print_r(mysqli_fetch_array($result));
echo "<br>";

$sql_query = "SELECT * FROM PROSTORIJA";
$result = mysqli_query($con, $sql_query);
print_r(mysqli_fetch_array($result));



?>