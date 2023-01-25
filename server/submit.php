<?php
include "config.php"; //sluzi za povezivanje s bazom podataka
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo "Not a POST method\n";
    exit();
}
$json = file_get_contents('php://input');
$data = json_decode($json, true);
if($data == null) {
    echo "JSON data nije u redu!\n";
    exit();
}
if(!isset($data["MAC"])){
    echo "Nedostaje MAC adresa\n";
    exit();
}

$mac = str_replace("-", "", str_replace(":", "", $data["MAC"]));


$sql_query = "select ID from CVOR where MAC = '".$mac."'";  //#TODO eventualno promijeniti naziv atributa macAddress (pogledati u definiciji baze)

$result = mysqli_query($con, $sql_query);   //$con postoji u config.php!
$row = mysqli_fetch_array($result);
if($row ==null){
    $sql_query = "insert into CVOR (MAC, AKTIVNO) values ('".$mac."', 1)"; 
    mysqli_query($con, $sql_query);
    echo "Dodana nova MAC adresa: ".$mac."\n";
    $sql_query = "select ID from CVOR where MAC = '".$mac."'";
    $result = mysqli_query($con, $sql_query);
}

echo "MAC adresa: ".$data["MAC"]."\n";

$cvor_id = $row['ID']; //dohvacamo vrijednost ID-a
echo "Cvor id: ".$cvor_id."\n";


if(isset($data["temp"])){
    $temp = $data['temp'];
    
    foreach($temp as $neobradjenaAdresa => $vrijednost) {

        $hexAdresa = str_replace(",", "", str_replace(" ", "", str_replace("0x", "", $neobradjenaAdresa)));//Pretvaranje dobivene adrese u 16char hex zapis
        $adresa = $hexAdresa;
        //for($i=0;$i<strlen($hexAdresa);$i+=2) $adresa .= chr(hexdec(substr($hexAdresa,$i,2)));//Pretvaranje 16 char hex zapis u 8 char ascii zapis


        $sql_query = "select id from TEMP_SENZOR where ID_CVOR =".$cvor_id." and ADRESA = '".$adresa."'";
        $result = mysqli_query($con, $sql_query);
        $row=mysqli_fetch_array($result);
        $senzor_id=-1;
        if ($row==null) //ako senzor nije u TEMP_SENZOR tablici stvaramo novi zapis u tablici za taj senzor i uzimamo njegov novo stvoreni ID i spremamo ga i $senzor_id
        {
            $sql_query = "insert into TEMP_SENZOR (ADRESA, ID_CVOR, TIP) values ('".$adresa."', ".$cvor_id.", 100)";
            mysqli_query($con, $sql_query);
            echo "Dodan je novi senzor temperature u tablicu TEMP_SENZOR: ('".$adresa."', ".$cvor_id.", 100)\n";
            $sql_query = "select id from TEMP_SENZOR where ID_CVOR =".$cvor_id." and ADRESA = '".$adresa."'"; // #TODO optimizirati da se ID dohvati prilikom unosa?
            $result = mysqli_query($con, $sql_query);
            $row=mysqli_fetch_array($result);
        }
        $senzor_id=$row['id'];
        $sql_query = "insert into TEMP (ID_SENZOR, VRIJEDNOST, VRIJEME) values (".$senzor_id.", ".$vrijednost.", now())"; //Zapisujemo nove vrijednosti u tablicu TEMP
        $result = mysqli_query($con, $sql_query);
        echo "Dodana novi zapis u TEMP tablicu: senzor adresa u ASCII: ".$adresa.", senzor adresa u HEX: ".$hexAdresa.", ID_SENZOR: ". $senzor_id .", VRIJEDNOST: ".$vrijednost."\n";
    }
}

if(isset($data["statusObjekt"])){
    $prozor = $data["statusObjekt"];
    foreach($objekt as $pin => $vrijednost) {
        $sql_query = "select id from STATUSOBJEKT_SENZOR where ID_CVOR =".$cvor_id." and PIN = '".$pin."'";
        $result = mysqli_query($con, $sql_query);
        $row=mysqli_fetch_array($result);
        $senzor_id=-1;
        if ($row==null) //ako senzor nije u STATUSOBJEKT_SENZOR tablici stvaramo novi zapis u tablici za taj senzor i uzimamo njegov novo stvoreni ID i spremamo ga i $senzor_id
        {
            $sql_query = "insert into STATUSOBJEKT_SENZOR (PIN, ID_CVOR, TIP) values ('".$pin."', ".$cvor_id.", 100)";
            mysqli_query($con, $sql_query);
            echo "Dodan je novi senzor za status objekta u tablicu STATUSOBJEKT_SENZOR: ('".$pin."', ".$cvor_id.", 100)\n";
            $sql_query = "select id from STATUSOBJEKT_SENZOR where ID_CVOR =".$cvor_id." and PIN = '".$pin."'"; // #TODO optimizirati da se ID dohvati prilikom unosa?
            $result = mysqli_query($con, $sql_query);
            $row=mysqli_fetch_array($result);
        }
        $senzor_id=$row['id'];
        $sql_query = "insert into STATUSOBJEKT (ID_SENZOR, VRIJEDNOST, VRIJEME) values (".$senzor_id.", ".$vrijednost.", now())"; //Zapisujemo nove vrijednosti u tablicu TEMP
        $result = mysqli_query($con, $sql_query);
        echo "Dodana novi zapis u STATUSOBJEKT tablicu: adresa senzora: ".$pin.", ID_SENZOR: ". $senzor_id .", VRIJEDNOST: ".$vrijednost."\n";
    }
}


?>
