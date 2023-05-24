<?php
include "..//config.php";


$debug = false;
if (!isset($_GET["prostorija"])) {
    echo "U zahtjevu nema informacije o adresi.\n";
    exit();
}

$start_date = date('Y-m-d H:i:s');
$end_date = date('Y-m-d H:i:s');
if (isset($_GET["start"]))
    if (strtotime($_GET["start"]) !== false)
        $start_date = date('Y-m-d H:i:s', strtotime($_GET['start']));

if (isset($_GET["sata"])) {
    $duration_hours = $_GET['sata'];
    $start_date = date('Y-m-d H:i:s', strtotime($start_date . "-$duration_hours hours"));
} else if (!isset($_GET["kraj"]))
    $start_date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . "-48 hours"));

if (isset($_GET["kraj"])) {
    $duration_hours = $_GET["kraj"];
    $end_date = date('Y-m-d H:i:s', strtotime($_GET["kraj"]));
}
$max_points = -1;
if (isset($_GET["max_points"])) {
    $max_points = $_GET["max_points"];
}


function createDataChartJS($con, $table, $id_sensor)
{
    $sql_query = "SELECT ID_SENZOR, ROUND(VRIJEDNOST,1) AS VRIJEDNOST, VRIJEME FROM " . $table . " WHERE ID_SENZOR=" . $id_sensor . " and vrijeme BETWEEN '" . $GLOBALS["start_date"] . "' AND '" . $GLOBALS["end_date"] . "' order by VRIJEME desc";
    $result = mysqli_query($con, $sql_query);
    $dataset = "[";

    while ($row = mysqli_fetch_array($result)) {

        $vrijeme = strtotime($row["VRIJEME"]);
        $dataset .= "{x:'" . $row["VRIJEME"] . "',y:" . (($staro_vrijeme < $vrijeme + 600 /*sekundi*/) ? $row["VRIJEDNOST"] : "NaN") . "},";
        $staro_vrijeme = strtotime($row["VRIJEME"]);
    }
    return rtrim(str_replace("\n", "", $dataset), ",") . "]";
}






$sql_query = "SELECT * FROM PROSTORIJA WHERE NAZIV='" . $_GET["prostorija"] . "'";
$result = mysqli_query($con, $sql_query);
$data = mysqli_fetch_array($result);
if ($debug)
    echo $sql_query;
if ($debug)
    echo "<br>";
if ($debug)
    print_r($data);
if ($debug)
    echo "<br>";


//Uzimanje podataka o senzorima temperatura
$sql_query = "SELECT * FROM TEMP_SENZOR WHERE ID_CVOR=" . $data["ID_CVOR"];
$result = mysqli_query($con, $sql_query);
if ($debug)
    echo $sql_query;
if ($debug)
    echo "<br>";

while ($row = mysqli_fetch_array($result)) {
    if ($row["TIP"] == 0)
        $sobnaID = $row["ID"];
    if ($row["TIP"] == 1)
        $radijatorID = $row["ID"];
    if ($row["TIP"] == 2)
        $kilmaID = $row["ID"];
}

//Uzimanje podataka o senzoru prozora
$sql_query = "SELECT * FROM STATUSOBJEKT_SENZOR WHERE ID_CVOR=" . $data["ID_CVOR"];
$result = mysqli_query($con, $sql_query);
if ($debug)
    echo $sql_query;
if ($debug)
    echo "<br>";

while ($row = mysqli_fetch_array($result)) {
    if ($row["TIP"] == 1)
        $prozorID = $row["ID"];
}







//Čitanje i spremanje podataka o sobnoj temperaturi
$sobnaData = createDataChartJS($con, "TEMP", $sobnaID);


//Čitanje i spremanje podataka o temperaturi radijatora

$radijatorData = createDataChartJS($con, "TEMP", $radijatorID);


//Čitanje i spremanje podataka o temperaturi kilme

$klimaData = createDataChartJS($con, "TEMP", $kilmaID);





//Čitanje i spremanje podataka o stanju prozora
$sql_query = "SELECT * FROM STATUSOBJEKT WHERE ID_SENZOR=" . $prozorID . " and vrijeme BETWEEN '" . $GLOBALS["start_date"] . "' AND '" . $GLOBALS["end_date"] . "' order by VRIJEME desc";

$result = mysqli_query($con, $sql_query);
if ($debug)
    echo $sql_query;
$dataset = "[";
while ($row = mysqli_fetch_array($result)) {

    $dataset .= "{x:'" . $row["VRIJEME"] . "',y:'" . (($row["VRIJEDNOST"] == 0) ? "ZATVOREN" : "OTVOREN") . "'},";
}
$prozorData = rtrim(str_replace("\n", "", $dataset), ",") . "]";

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@2.0.1/dist/chartjs-plugin-zoom.min.js"></script>

</script>
<p style="position:fixed;">
    <?php
    $sql_query = "SELECT * FROM METADATA WHERE id_cvor=" . $data["ID_CVOR"] . " ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($con, $sql_query);
    $metadata = mysqli_fetch_array($result);
    // print_r(($metadata["napon"] / 1000) + "V");
    ?>
</p>

<div style="margin: 0 2.5vw">
    <canvas id="myChart"></canvas>
</div>
<script>
    function downsampleTimeData(data, threshold) {
        if (data.length <= threshold) {
            return data;
        }

        const newData = [];
        const blockSize = Math.ceil(data.length / threshold);

        for (let i = 0; i < data.length; i += blockSize) {
            const block = data.slice(i, i + blockSize);
            const avgTime = new Date(
                block.reduce((acc, point) => acc + point.x.getTime(), 0) / block.length
            );
            const avgY = block.reduce((acc, point) => acc + point.y, 0) / block.length;

            newData.push({ x: avgTime, y: avgY });
        }

        return newData;
    }


    let sobnaData = <?php echo $sobnaData; ?>;
    let radijatorData = <?php echo $radijatorData; ?>;
    let klimaData = <?php echo $klimaData; ?>;
    let prozorData = <?php echo $prozorData; ?>;

    sobnaData = sobnaData.map(point => { return { x: new Date(point.x), y: point.y }; });
    radijatorData = radijatorData.map(point => { return { x: new Date(point.x), y: point.y }; });
    klimaData = klimaData.map(point => { return { x: new Date(point.x), y: point.y }; });
    prozorData = prozorData.map(point => { return { x: new Date(point.x), y: point.y }; });




    <?php
    if ($max_points > 0):
        echo "
        sobnaData = downsampleTimeData(sobnaData, $max_points);
        radijatorData = downsampleTimeData(radijatorData, $max_points);
        klimaData = downsampleTimeData(klimaData, $max_points);
        prozorData = prozorData;
        ";

    endif;
    ?>

    const skipped = (ctx, value) => ctx.p0.skip || ctx.p1.skip ? value : undefined;





    const ctx = document.getElementById('myChart').getContext('2d');
    const temperatureChart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [
                {
                    label: 'Radijator',
                    data: radijatorData,
                    borderColor: "#F00",
                    backgroundColor: "#F00",
                    pointStyle: false,
                    
                    yAxisID: 'y1',
                    segment: {
                        borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)'),
                        borderDash: ctx => skipped(ctx, [6, 6]),
                    },
                    spanGaps: true,
                    cubicInterpolationMode: 'monotone',
                    tension: 0,
                    borderWidth: (window.innerWidth >= 640 ? 2 : .5)
                },
                {
                    label: 'Sobna',
                    data: sobnaData,
                    borderColor: "#0F0",
                    backgroundColor: "#0F0",
                    pointStyle: false,
                    
                    yAxisID: 'y1',
                    segment: {
                        borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)'),
                        borderDash: ctx => skipped(ctx, [6, 6]),
                    },
                    spanGaps: true,
                    cubicInterpolationMode: 'monotone',
                    tension: 0.4,
                    borderWidth: (window.innerWidth >= 640 ? 2 : .5)
                },
                {
                    label: 'Klima',
                    data: klimaData,
                    borderColor: "#22F",
                    backgroundColor: "#22F",
                    pointStyle: false,
                    
                    yAxisID: 'y1',
                    segment: {
                        borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)'),
                        borderDash: ctx => skipped(ctx, [6, 6]),
                    },
                    spanGaps: true,
                    cubicInterpolationMode: 'monotone',
                    tension: 0.4,
                    borderWidth: (window.innerWidth >= 640 ? 2 : .5)
                },
                {
                    label: 'Prozor',
                    data: prozorData,
                    borderColor: "#00F",
                    backgroundColor: "#00F",
                    stepped: true,
                    pointStyle: false,
                    yAxisID: 'y2',
                    segment: {
                        borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)'),
                        borderDash: ctx => skipped(ctx, [6, 6]),
                    },
                    spanGaps: true,
                    cubicInterpolationMode: 'monotone',
                    tension: 0.4,
                    borderWidth: (window.innerWidth >= 640 ? 2 : .5)
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    type: 'time',
                    time: {
                        displayFormats: {
                            minute: "MM/d HH:mm",
                            hour: "MM/d HH:mm",
                            day: "MM/d HH:mm"
                        },
                        title: {
                            display: true,
                            text: 'Vrijeme'
                        }
                    }
                },

                y1: {
                    type: 'linear',
                    position: 'left',
                    stack: 'main',
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
                    stack: 'main',
                    stackWeight: 1,
                    border: {
                        color: "blue"
                    },
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: '<?php echo $_GET["prostorija"] ?> Temperatura - otvoreni prozor',
                },
                legend: {
                    display: (window.innerWidth >= 640 ? true : false)
                },
                zoom: {
                    pan: {
                        enabled: true,
                        mode: 'x',
                    },
                    zoom: {
                        wheel: {
                            enabled: true,
                        },
                        pinch: {
                            enabled: true,
                        },
                        mode: 'x',
                    },
                },
            },

            onAfterUpdate: function (chart) {
                const xAxis = chart.scales.x;
                const range = xAxis.max - xAxis.min;
                updateTimeFormat(chart, range);
            }
        },
    });
</script>