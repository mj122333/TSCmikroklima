<?php
include "../../config.php";
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
    $greska_query = "SELECT * FROM TEMP WHERE VRIJEDNOST >= 35 AND format(VRIJEME,'dd-MM-yyyy hh:mm') IN (SELECT format(VRIJEME,'dd-MM-yyyy hh:mm') FROM STATUSOBJEKT WHERE VRIJEDNOST=1 AND ID_SENZOR=" . $senzor_id . " AND VRIJEME >= NOW() - INTERVAL 8 HOUR)";
    $result = mysqli_query($con, $greska_query);
    $greske[$nazivi_prostorija[$i]] = (mysqli_fetch_array($result) != null);
}
?>