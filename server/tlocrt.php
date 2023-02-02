<html lang="en">

<?php
include "config.php";
$sql_query = "SELECT ID_CVOR, NAZIV FROM PROSTORIJA";
$result = mysqli_query($con, $sql_query);
$aktivne_prostorije = array();
$nazivi_prostorija = array();
for ($i = 0; $row = mysqli_fetch_array($result); $i++){
    $nazivi_prostorija[$i] = $row["NAZIV"];
    $aktivne_prostorije[$i] = $row;
}

$temperatura_prostorija = array();
$otvoreni_prozori = array();
$greske = array();
for ($i = 0; $i < count($aktivne_prostorije); $i++){
    $sql_query = "SELECT ID FROM TEMP_SENZOR WHERE ID_CVOR=" . $aktivne_prostorije[$i]['ID_CVOR'] . " ORDER BY TIP";
    $result = mysqli_query($con, $sql_query);
    $temperatura_prost = array();
    for ($j = 0; $j < 3; $j++) {
        $id_senzora = mysqli_fetch_array($result)[0];

        $temp_query = "SELECT VRIJEDNOST FROM TEMP WHERE ID_SENZOR=" . $id_senzora . " ORDER BY VRIJEME DESC LIMIT 1";
        $temp_result = mysqli_query($con, $temp_query);
        $vrijednost = mysqli_fetch_array($temp_result)["VRIJEDNOST"];
        $temperatura_prost[$j] = $vrijednost;
    }

    $temperatura_prostorija[$nazivi_prostorija[$i]] = $temperatura_prost;

    $sql_query = "SELECT ID FROM STATUSOBJEKT_SENZOR WHERE ID_CVOR=" . $aktivne_prostorije[$i]['ID_CVOR'] . " ORDER BY TIP";
    $result = mysqli_query($con, $sql_query);
    $id_senzora = mysqli_fetch_array($result)[0];
    $prozor_query = "SELECT VRIJEDNOST FROM STATUSOBJEKT WHERE ID_SENZOR=" . $id_senzora . " ORDER BY VRIJEME DESC LIMIT 1";
    $otvoreni = mysqli_fetch_array(mysqli_query($con, $prozor_query))['VRIJEDNOST'];
    $otvoreni_prozori[$nazivi_prostorija[$i]] = $otvoreni;

    $senzor_query = "SELECT ID FROM STATUSOBJEKT_SENZOR WHERE ID_CVOR=" . $aktivne_prostorije[$i]['ID_CVOR'];
    $senzor_id = mysqli_fetch_array(mysqli_query($con, $sql_query))['ID'];
    //kada je u zadnjih 8h postojalo vrijeme kada je tempratura nekok senzora bila više od 35 stupneva, a prozor otvoren
    $greska_query = "SELECT * FROM TEMP WHERE VRIJEDNOST >= 35 AND VRIJEME IN (SELECT VRIJEME FROM STATUSOBJEKT WHERE VRIJEDNOST=1 AND ID_SENZOR=" . $senzor_id . " AND VRIJEME >= NOW() - INTERVAL 8 HOUR)";
    $result = mysqli_query($con, $greska_query);
    $greske[$nazivi_prostorija[$i]] = (mysqli_fetch_array($result) != null);
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tlocrt TSČ-a</title>
    <link rel="stylesheet" href="css/tlocrt.css">

</head>
<body>
    <iframe id="graf" class="graf graf-off" src="display/main-graph.php"></iframe>
    <div class="flex">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2227.22 859.74">
            <g id="back"><polygon points="1 249.87 1 783.61 260.83 783.61 260.83 630.22 1029.35 630.22 1029.35 597.35 2226.22 597.35 2226.22 536.3 1029.35 536.3 1029.35 15.09 941.7 15.09 941.7 93.35 747.61 93.35 747.61 249.87 1 249.87" style="fill:#e6e6e6;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="Knjiznica"><polygon points="747.61 249.87 260.83 249.87 260.83 93.35 345.35 93.35 345.35 1 747.61 1 747.61 249.87" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_19" data-name="19"><rect x="345.35" y="630.22" width="203.48" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_18" data-name="18"><rect x="548.83" y="630.22" width="198.78" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_17" data-name="17"><rect x="747.61" y="630.22" width="86.09" height="153.39" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_16" data-name="16"><rect x="833.7" y="630.22" width="195.65" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_1" data-name="1"><rect x="1" y="93.35" width="84.52" height="156.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_2" data-name="2"><rect x="85.52" y="93.35" width="175.3" height="156.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_20" data-name="20"><rect x="260.83" y="630.22" width="84.52" height="153.39" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_10" data-name="10"><rect x="2109.87" y="597.35" width="116.35" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_11" data-name="11"><rect x="1825.52" y="597.35" width="284.35" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_12" data-name="12"><rect x="1718.56" y="597.35" width="106.96" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_13" data-name="13"><rect x="1434.22" y="597.35" width="284.35" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_14" data-name="14"><rect x="1144.13" y="597.35" width="290.09" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_15" data-name="15"><rect x="1029.35" y="597.35" width="114.78" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_9" data-name="9"><rect x="2109.87" y="375.09" width="116.35" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_8" data-name="8"><rect x="1825.52" y="283.52" width="284.35" height="252.78" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_7" data-name="7"><rect x="1718.56" y="375.09" width="106.96" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_6" data-name="6"><rect x="1434.22" y="283.52" width="284.35" height="252.78" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_5" data-name="5"><rect x="1144.13" y="283.52" width="290.09" height="252.78" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_4" data-name="4"><rect x="1029.35" y="375.09" width="114.78" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        </svg>
        </div>

</body>

<script type="text/javascript" src="jquery/jquery.js"></script>
<script>
    var naziviAktivnihProstorija = <?php echo json_encode($nazivi_prostorija)?>;
    var temperatureProstorija = <?php echo json_encode($temperatura_prostorija)?>;
    var otvoreniProzori = <?php echo json_encode($otvoreni_prozori)?>;
    var greske = <?php echo json_encode($greske)?>;
</script>
<script type="text/javascript" src="tlocrt.js"></script>
</html>