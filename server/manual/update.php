<?php
include "../config.php";
if(!isset($_GET["password"])){
  echo "potrebna je lozinka";
  exit();
}
if (ADMINPASSWORD != $_GET["password"]){
  echo "Kriva lozinka";
  exit();
}


if (isset($_POST["CVOR"])) {
    echo "<h2>CVOR</h2>";
    $sql_query = "SELECT * FROM CVOR";

    $result = mysqli_query($con, $sql_query);
    $index = 0;

    while ($row = mysqli_fetch_array($result)) {
        $package = "UPDATE CVOR SET ";
        $send = false;
        if ($row["MAC"] != str_replace(":", "", $_POST["CVOR"][$index]["MAC"])) {
            $package .= "MAC='" . str_replace(":", "", $_POST["CVOR"][$index]["MAC"]) . "' ";
            $send = true;
        }
        if ($row["AKTIVNO"] != $_POST["CVOR"][$index]["AKTIVNO"]) {
            $package .= "AKTIVNO=" . $_POST["CVOR"][$index]["AKTIVNO"] . " ";
            $send = true;
        }


        if ($send) {
            $package .= "WHERE ID=" . $row["ID"];
            mysqli_query($con, $package);
            echo $package . "<br>";
        }
        $index++;
    }
}

if (isset($_POST["TEMP_SENZOR"])) {
    echo "<h2>TEMP_SENZOR</h2>";
    $sql_query = "SELECT * FROM TEMP_SENZOR ";
    $result = mysqli_query($con, $sql_query);
    $index = 0;
    while ($row = mysqli_fetch_array($result)) {
        $package = "UPDATE TEMP_SENZOR SET ";
        $send = false;

        if ($row["ID_CVOR"] != $_POST["TEMP_SENZOR"][$index]["ID_CVOR"]) {
            $package .= "ID_CVOR=" . $_POST["TEMP_SENZOR"][$index]["ID_CVOR"] . " ";
            $send = true;
        }
        if ($row["ADRESA"] != str_replace(":", "", $_POST["TEMP_SENZOR"][$index]["ADRESA"])) {
            $package .= "ADRESA='" . str_replace(":", "", $_POST["TEMP_SENZOR"][$index]["ADRESA"]) . "' ";
            $send = true;
        }
        if ($row["TIP"] != $_POST["TEMP_SENZOR"][$index]["TIP"]) {
            $package .= "TIP=" . $_POST["TEMP_SENZOR"][$index]["TIP"] . " ";
            $send = true;
        }
        if ($send) {
            $package .= "WHERE ID=" . $row["ID"];
            mysqli_query($con, $package);
            echo $package . "<br>";
        }
        $index++;
    }
}




if (isset($_POST["STATUSOBJEKT_SENZOR"])) {
    echo "<h2>STATUSOBJEKT_SENZOR</h2>";
    $sql_query = "SELECT * FROM STATUSOBJEKT_SENZOR ";
    $result = mysqli_query($con, $sql_query);
    $index = 0;
    while ($row = mysqli_fetch_array($result)) {
        $package = "UPDATE STATUSOBJEKT_SENZOR SET ";
        $send = false;

        if ($row["ID_CVOR"] != $_POST["STATUSOBJEKT_SENZOR"][$index]["ID_CVOR"]) {
            $package .= "ID_CVOR=" . $_POST["STATUSOBJEKT_SENZOR"][$index]["ID_CVOR"] . " ";
            $send = true;
        }
        if ($row["PIN"] != $_POST["STATUSOBJEKT_SENZOR"][$index]["PIN"]) {
            $package .= "PIN=" . $_POST["STATUSOBJEKT_SENZOR"][$index]["PIN"] . " ";
            $send = true;
        }
        if ($row["TIP"] != $_POST["STATUSOBJEKT_SENZOR"][$index]["TIP"]) {
            $package .= "TIP=" . $_POST["STATUSOBJEKT_SENZOR"][$index]["TIP"] . " ";
            $send = true;
        }
        if ($send) {
            $package .= "WHERE ID=" . $row["ID"];
            mysqli_query($con, $package);
            echo $package . "<br>";
        }
        $index++;
    }
}


if (isset($_POST["PROSTORIJA"])) {
    echo "<h2>PROSTORIJA</h2>";
    $sql_query = "SELECT * FROM PROSTORIJA ";
    $result = mysqli_query($con, $sql_query);

    $index = 0;
    while ($row = mysqli_fetch_array($result)) {
        $package = "UPDATE PROSTORIJA SET ";
        $send = false;

        if ($row["ID_CVOR"] != $_POST["PROSTORIJA"][$index]["ID_CVOR"]) {
            $package .= "ID_CVOR=" . $_POST["PROSTORIJA"][$index]["ID_CVOR"] . " ";
            $send = true;
        }
        if ($row["NAZIV"] != $_POST["PROSTORIJA"][$index]["NAZIV"]) {
            $package .= "NAZIV='" . $_POST["PROSTORIJA"][$index]["NAZIV"] . "' ";
            $send = true;
        }

        if ($send) {
            $package .= "WHERE ID=" . $row["ID"];
            mysqli_query($con, $package);
            echo $package . "<br>";
        }
        $index++;
    }
}

?>