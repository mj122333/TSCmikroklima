<?php
exit();
$sql_query = "SELECT * FROM TEMP ORDER BY ID";
$result = mysqli_query($con, $sql_query);

if (mysqli_num_rows($result) > 1) {
    $prevTemp = null;
    $prevTime = null;
    while ($row = mysqli_fetch_assoc($result)) {
        $currTemp = $row['VRIJEDNOST'];
        $currTime = strtotime($row['VRIJEME']);

        if ($prevTemp !== null && abs($currTemp - $prevTemp) > 2 && ($currTime - $prevTime) < (10 * 60)) {
            $deleteSql = "DELETE FROM TEMP WHERE ID = " . $row['ID'];
            echo "Obrisan ID: " . $row['ID'] . "\n";
        }

        $prevTemp = $currTemp;
        $prevTime = $currTime;
    }
}
?>