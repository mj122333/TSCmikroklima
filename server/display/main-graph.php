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


//Uzimanje podataka o temperaturama
$sql_query = "SELECT * FROM TEMP_SENZOR WHERE ID_CVOR=".$data["ID_CVOR"];
$result = mysqli_query($con, $sql_query);
echo $sql_query;
echo "<br>";

while ($row = mysqli_fetch_array($result)){
    if($row["TIP"] == 0)$zrakID = $row["ID"];
    if($row["TIP"] == 1)$radijatorID = $row["ID"];
    if($row["TIP"] == 2)$kilmaID = $row["ID"];
}





//Uzimanje podataka o prozorima
$sql_query = "SELECT * FROM STATUSOBJEKT_SENZOR WHERE ID_CVOR=".$data["ID_CVOR"];
$result = mysqli_query($con, $sql_query);
echo $sql_query;
echo "<br>";

while ($row = mysqli_fetch_array($result)){
    if($row["TIP"] == 1)$prozorID = $row["ID"];
}



$sql_query = "SELECT * FROM STATUSOBJEKT WHERE ID_SENZOR=".$prozorID;
$result = mysqli_query($con, $sql_query);
echo $sql_query;
$dataset="[";
while ($row = mysqli_fetch_array($result)){
    $dataset.= "{x:'".$row["VRIJEME"]."',y:'".(($row["VRIJEDNOST"]==0 ) ? "ZATVOREN" : "OTVOREN")."'},";
}
$prozorDataset= rtrim(str_replace("\n", "",$dataset), ",")."]";
?>

<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<script>



const ctx = document.getElementById('myChart');

let prozorData = <?php echo $prozorDataset;?>


    let chart = new Chart(ctx, {
    type: 'line',
    data: {
        datasets: [
        {
      label: 'Radijator',
      data: [10, 30, 50, 20, 25, 44, -10],
      borderColor: "#F00",
      backgroundColor: "#F00",
      pointStyle: false,
    },
        {
      label: 'Zrak',
      data: [20, 60, 70, 80, 95, 14, -10],
      borderColor: "#0F0",
      backgroundColor: "#0F0",
      pointStyle: false,
    },
        {
      label: 'Klima',
      data: [20, 60, 70, 80, 95, 14, -10],
      borderColor: "#00F",
      backgroundColor: "#00F",
      pointStyle: false,
    },
    {
      label: 'Prozor',
      fill: true,
      data: prozorData,
      borderColor: "#00F",
      backgroundColor: "#009",
      stepped: true,
      pointStyle: false,
      yAxisID: 'y2',
    }],
    },
    options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: 'Temperatura - otvoreni prozor',
      },
    },
    scales: {
      y: {
        type: 'linear',
        position: 'left',
        stack: 'demo',
        stackWeight: 4,
        border: {
          color: "red"
        }
      },
      y2: {
        type: 'category',
        labels: ['OTVOREN', 'ZATVOREN'],
        offset: true,
        position: 'left',
        stack: 'demo',
        stackWeight: 1,
        border: {
          color: "blue"
        }
      },
      x: {
            type:"time",
            time: {
                unit: 'hour'
                
            }
        }
    }
  }
});

</script>