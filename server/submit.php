<?php
include "config.php" //sluzi za povezivanje s bazom podataka
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo "Not a POST method";
    exit();
}
$json = file_get_contents('php://input');
$data = json_decode($json, true);
if($data == null) {
    echo "JSON data not valid!";
    exit();
}

if(!isset($data["MAC"])){
    echo "Missing MAC address";
    exit();
}
$mac = str_replace("-", "", $data["MAC"]);

if(false)exit;# TODO: provjeriti je li čvor upaljen
$sql_query = "select id from ?? where macAddress like '".$mac."'";
$result = mysqli_query($con, $sql_query);   //$con postoji u config.php!
$row = mysli_fetch_array($result);
$cvor_id = $row['id']; //dohvacamo vrijednost ID-a

//$cvor_id = 1; # TODO: poveži se na mysql i pročitati id čvora za MAC adresu


if(isset($data["temp"])){
    $temp = $data['temp'];
    
    foreach($temp as $adresa => $vrijednost) {
        $senzor_id = 1; #TODO: pročitaj id od senzora na temelju $adresa i $cvor_id

        #TODO: Zapiši podatke u mysql tablicu
        echo $adresa ." : ".$vrijednost."\n";
    }
}


?>
