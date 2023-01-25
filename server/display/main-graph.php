<?php 
include "..//config.php";

$debug = false;
if(!isset($_GET["prostorija"])){
    echo "U zahtjevu nema informacije o adresi.\n";
    exit();
}

$sql_query = "SELECT * FROM PROSTORIJA WHERE NAZIV='".$_GET["prostorija"]."'";
$result = mysqli_query($con, $sql_query);
$data = mysqli_fetch_array($result);
if($debug) echo $sql_query;
if($debug) echo "<br>";
if($debug)print_r($data);
if($debug) echo "<br>";


//Uzimanje podataka o senzorima temperatura
$sql_query = "SELECT * FROM TEMP_SENZOR WHERE ID_CVOR=".$data["ID_CVOR"];
$result = mysqli_query($con, $sql_query);
if($debug) echo $sql_query;
if($debug) echo "<br>";

while ($row = mysqli_fetch_array($result)){
    if($row["TIP"] == 0)$sobnaID = $row["ID"];
    if($row["TIP"] == 1)$radijatorID = $row["ID"];
    if($row["TIP"] == 2)$kilmaID = $row["ID"];
}

//Uzimanje podataka o senzoru prozora
$sql_query = "SELECT * FROM STATUSOBJEKT_SENZOR WHERE ID_CVOR=".$data["ID_CVOR"];
$result = mysqli_query($con, $sql_query);
if($debug) echo $sql_query;
if($debug) echo "<br>";

while ($row = mysqli_fetch_array($result)){
    if($row["TIP"] == 1)$prozorID = $row["ID"];
}








//Čitanje i spremanje podataka o sobnoj temperaturi
$sql_query = "SELECT * FROM TEMP WHERE ID_SENZOR=".$sobnaID;
$result = mysqli_query($con, $sql_query);
if($debug) echo $sql_query;
$dataset="[";
while ($row = mysqli_fetch_array($result)){
    $dataset.= "{x:'".$row["VRIJEME"]."',y:'".$row["VRIJEDNOST"]."'},";
}
$sobnaData= rtrim(str_replace("\n", "",$dataset), ",")."]";


//Čitanje i spremanje podataka o temperaturi radijatora
$sql_query = "SELECT * FROM TEMP WHERE ID_SENZOR=".$radijatorID;
$result = mysqli_query($con, $sql_query);
if($debug) echo $sql_query;
$dataset="[";
while ($row = mysqli_fetch_array($result)){
    $dataset.= "{x:'".$row["VRIJEME"]."',y:'".$row["VRIJEDNOST"]."'},";
}
$radijatorData= rtrim(str_replace("\n", "",$dataset), ",")."]";


//Čitanje i spremanje podataka o temperaturi kilme
$sql_query = "SELECT * FROM TEMP WHERE ID_SENZOR=".$kilmaID;
$result = mysqli_query($con, $sql_query);
if($debug) echo $sql_query;
$dataset="[";
while ($row = mysqli_fetch_array($result)){
    $dataset.= "{x:'".$row["VRIJEME"]."',y:'".$row["VRIJEDNOST"]."'},";
}
$klimaData= rtrim(str_replace("\n", "",$dataset), ",")."]";






//Čitanje i spremanje podataka o stanju prozora
$sql_query = "SELECT * FROM STATUSOBJEKT WHERE ID_SENZOR=".$prozorID;
$result = mysqli_query($con, $sql_query);
if($debug) echo $sql_query;
$dataset="[";
while ($row = mysqli_fetch_array($result)){
    $dataset.= "{x:'".$row["VRIJEME"]."',y:'".(($row["VRIJEDNOST"]==0 ) ? "ZATVOREN" : "OTVOREN")."'},";
}
$prozorData= rtrim(str_replace("\n", "",$dataset), ",")."]";

?>

<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<script>
    let sobnaData = <?php echo $sobnaData;?>;
    let radijatorData = <?php echo $radijatorData;?>;
    let klimaData = <?php echo $klimaData;?>;
    let prozorData = <?php echo $prozorData;?>;
</script>
<script src="main-graph.js"></script>