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
$sql_query = "select id from ?? where macAddress like '".$mac."'";  //#TODO eventualno promijeniti naziv atributa macAddress (pogledati u definiciji baze)
$result = mysqli_query($con, $sql_query);   //$con postoji u config.php!
$row = mysli_fetch_array($result);
$cvor_id = $row['id']; //dohvacamo vrijednost ID-a

//$cvor_id = 1; # TODO: poveži se na mysql i pročitati id čvora za MAC adresu


if(isset($data["temp"])){
    $temp = $data['temp'];
    
    foreach($temp as $adresa => $vrijednost) {
        $sql_query = "select id from temp_senzor where cvorID ='.$cvor_id." and adresa like '".$adresa."'";
        $result = mysqli_query($con, $sql_query);
        $row=mysqli_fetch_array($result);
        $senzor_id=-1;
        //ako ne postoji taj senzor u tablici TEMP_SENZOR, potrebno ga je unijeti u bazu sa nekim tipom koji oznacava da je trenutno NEDEFINIRAN->tip=100
        // u slucaju da ne postoji, $row je null?
        if ($row!=null)
            $senzor_id=$row['id'];
        else{
            $sql_query = "insert into temp_senzor (adresa, id_cvor, tip) values ('".$adresa."', ".$cvor_id.", 100)";
            $result = mysqli_query($con, $sql_query);
            $sql_query = "select id from temp_senzor where cvorID ='.$cvor_id." and adresa like '".$adresa."'"; // #TODO optimizirati da se ID dohvati prilikom unosa?
            $result = mysqli_query($con, $sql_query);
            $row=mysqli_fetch_array($result);
            $senzor_id=$row['id'];
        }
        //$senzor_id = 1; #TODO: pročitaj id od senzora na temelju $adresa i $cvor_id

        #TODO: Zapiši podatke u mysql tablicu
        echo $adresa ." : ".$vrijednost."\n";
    }
}


?>
