<?php
include "config.php"; //sluzi za povezivanje s bazom podataka
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
$mac = str_replace("-", "", str_replace(":", "", $data["MAC"]));


$sql_query = "select ID from CVOR where MAC = '".$mac."'";  //#TODO eventualno promijeniti naziv atributa macAddress (pogledati u definiciji baze)

$result = mysqli_query($con, $sql_query);   //$con postoji u config.php!
$row = mysqli_fetch_array($result);
if($row ==null){
    print_r($result);
    echo "Dodana nova MAC adresa: ".$mac."\n\n";
    $sql_query = "insert into CVOR (MAC, AKTIVNO) values ('".$mac."', 0)"; 
    $result = mysqli_query($con, $sql_query);
}

$cvor_id = $row['ID']; //dohvacamo vrijednost ID-a
echo "Cvor id: ".$cvor_id."\n";


if(isset($data["temp"])){
    $temp = $data['temp'];
    
    foreach($temp as $adresa => $vrijednost) {
        $sql_query = "select id from TEMP_SENZOR where ID_CVOR =".$cvor_id." and ADRESA = '".$adresa."'";
        $result = mysqli_query($con, $sql_query);
        $row=mysqli_fetch_array($result);
        $senzor_id=-1;
        //ako ne postoji taj senzor u tablici TEMP_SENZOR, potrebno ga je unijeti u bazu sa nekim tipom koji oznacava da je trenutno NEDEFINIRAN->tip=100
        // u slucaju da ne postoji, $row je null?
        if ($row!=null)
            $senzor_id=$row['id'];
        else{
            $sql_query = "insert into TEMP_SENZOR (ADRESA, ID_CVOR, TIP) values ('".$adresa."', ".$cvor_id.", 100)";
            mysqli_query($con, $sql_query);
            $sql_query = "select id from TEMP_SENZOR where ID_CVOR =".$cvor_id." and ADRESA = '".$adresa."'"; // #TODO optimizirati da se ID dohvati prilikom unosa?
            $result = mysqli_query($con, $sql_query);
            $row=mysqli_fetch_array($result);
            $senzor_id=$row['ID'];
        }
        
        $sql_query = "insert into TEMP (ID_SENZOR, VRIEJDNOST, VRIJEME) values (".$senzor_id.", ".$vrijednost.", 0)";
        echo  "\n\n\n".$sql_query."\n\n\n";
        $result = mysqli_query($con, $sql_query);
        
        echo $adresa ." : ".$vrijednost."\n";
    }
}

if(isset($data["prozor"])){
    $prozor = $data["prozor"];
    $sql_query = "insert into TEMP (ID_SENZOR, VRIEJDNOST, VRIJEME) values (".$senzor_id.", ".$vrijednost.", '".date("Y-m-d H:i:s")."')";
    mysqli_query($con, $sql_query);
}


?>