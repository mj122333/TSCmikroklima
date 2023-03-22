<?php 
include "..//config.php";


$debug = false;
if(!isset($_GET["prostorija"])){
    echo "U zahtjevu nema informacije o adresi.\n";
    exit();
}

if(isset($_GET["sata"])) $SATA = $_GET["sata"];
else $SATA = 48;



function createDataChartJS($con, $table, $id_sensor) {
    //$sql_query = "SELECT * FROM ".$table." WHERE ID_SENZOR=".$id_sensor." order by VRIJEME desc limit ".$GLOBALS["SATA"]*60;
    $sql_query = "SELECT ID_SENZOR, ROUND(VRIJEDNOST,1) AS VRIJEDNOST, VRIJEME FROM ".$table." WHERE ID_SENZOR=".$id_sensor." and vrijeme>(CURDATE()-INTERVAL ".$GLOBALS["SATA"]." HOUR) order by VRIJEME desc";
    $result = mysqli_query($con, $sql_query);
    $dataset="[";
        
    while ($row = mysqli_fetch_array($result)){
        $vrijeme = strtotime($row["VRIJEME"]);
        if(time()-$GLOBALS["SATA"]*60*60 > $vrijeme) continue;
        $dataset.= "{x:'".$row["VRIJEME"]."',y:".(($staro_vrijeme < $vrijeme+600 /*sekundi*/) ? $row["VRIJEDNOST"] : "NaN")."},";
        $staro_vrijeme = strtotime($row["VRIJEME"]);
    }
    return rtrim(str_replace("\n", "",$dataset), ",")."]";
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
$sobnaData = createDataChartJS($con,"TEMP", $sobnaID);


//Čitanje i spremanje podataka o temperaturi radijatora

$radijatorData= createDataChartJS($con,"TEMP", $radijatorID);


//Čitanje i spremanje podataka o temperaturi kilme

$klimaData= createDataChartJS($con,"TEMP", $kilmaID);





//Čitanje i spremanje podataka o stanju prozora
$sql_query = "SELECT * FROM STATUSOBJEKT WHERE ID_SENZOR=".$prozorID." and vrijeme>(CURDATE()-INTERVAL ".$SATA." HOUR) order by VRIJEME desc";
$result = mysqli_query($con, $sql_query);
if($debug) echo $sql_query;
$dataset="[";
while ($row = mysqli_fetch_array($result)){
    $vrijeme = strtotime($row["VRIJEME"]);
    if(time()-$GLOBALS["SATA"]*60*60 > $vrijeme) continue;
    $dataset.= "{x:'".$row["VRIJEME"]."',y:'".(($row["VRIJEDNOST"]==0 ) ? "ZATVOREN" : "OTVOREN")."'},";
}
$prozorData= rtrim(str_replace("\n", "",$dataset), ",")."]";

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/2.0.0/chartjs-plugin-zoom.min.js"></script>
<script>
    let sobnaData = <?php echo $sobnaData;?>;
    let radijatorData = <?php echo $radijatorData;?>;
    let klimaData = <?php echo $klimaData;?>;
    let prozorData = <?php echo $prozorData;?>;
</script>
<script src="main-graph.js"></script>
<p style="position:fixed;"><?php
    $sql_query = "SELECT * FROM METADATA WHERE id_cvor=".$data["ID_CVOR"]." ORDER BY id DESC LIMIT 1";
$result = mysqli_query($con, $sql_query);
    $metadata = mysqli_fetch_array($result);
    echo $metadata["baterija"];
    ?><p>

<div style="margin: 0 2.5vw">
  <canvas id="myChart"></canvas>
</div>
