<?php
include "../config.php";
for ($ind = 0; $ind < 3; $ind++) {
    $sql_query = "SELECT * FROM TEMP WHERE ID_SENZOR=".($ind+34)." ORDER BY ID";
    $result = mysqli_query($con, $sql_query);

    if (mysqli_num_rows($result) > 1) {
        $prevTemp = null;
        $prevTime = null;
        while ($row = mysqli_fetch_assoc($result)) {
            $currTemp = $row['VRIJEDNOST'];
            $currTime = strtotime($row['VRIJEME']);
            if ($prevTemp !== null && abs($currTemp - $prevTemp) > 2 && ($currTime - $prevTime) < (10 * 60)) {
                $deleteSql = "DELETE FROM TEMP WHERE ID = " . $row['ID'];
                echo "Obrisan ID: " . $row['ID'] . " Sadasnji: " . $currTemp . " Prosli: " . $prevTemp ." Sada: ".date('Y/m/d H:i:s', $currTime)." Prosli: ".date('Y/m/d H:i:s', $prevTime). "<br>";
                mysqli_query($con, $deleteSql);
            }

            $prevTemp = $currTemp;
            $prevTime = $currTime;
        }
    }
}
?>