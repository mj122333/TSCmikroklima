<?php
include "config.php";

function makeMacString($mac){
    $outputMac = "";
    for ($i = 0; $i < strlen($mac) - 1; $i += 2){
        $outputMac .= $mac[$i] . $mac[$i + 1];
        if ($i != strlen($mac) - 2) $outputMac .= ":";
    }
    return strtoupper($outputMac);
}
?>


<html>
    <head>
        <meta charset="UTF-8">

        <style>
            table {
                text-align: center;
                border-collapse: collapse;
            }

            td, th {
                border: 1px solid black;
                padding: 0.5rem;
            }

            td:nth-child(2){
                width: 15rem;
            }
        </style>
    </head>
    <body>
        <br>
        <?php
            //$sql_query = "INSERT INTO PROSTORIJA (ID_CVOR, ADRESA) VALUES (10, 18)";
            //$result = mysqli_query($con, $sql_query);
            //print_r($result);
            ?>
        <br>

        <table id="table_cvor">
            <tr>
                <th colspan="3">CVOREVI</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>MAC adresa</th>
                <th>Aktivno</th>
            </tr>
            <?php
            $sql_query = "SELECT * FROM CVOR";
            $result = mysqli_query($con, $sql_query);
            while ($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . makeMacString($row['MAC']) . "</td>";
                echo "<td>" . $row['AKTIVNO'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <table id="table_temp">
            <tr>
                <th colspan="5">TEMPERATURE</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>ID senzora</th>
                <th>MAC adresa čvora</th>
                <th>Temperatura</th>
                <th>Vrijeme</th>
            </tr>
            <?php
            $sql_query = "SELECT * FROM TEMP WHERE VRIJEME >= NOW() - INTERVAL 1 DAY";
            $result = mysqli_query($con, $sql_query);
            while ($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['ID_SENZOR'] . "</td>";
                echo "<td>";
                $senzor_query = "SELECT ID_CVOR FROM TEMP_SENZOR WHERE ID=" . $row['ID_SENZOR'];
                $id_cvor = mysqli_query($con, $senzor_query);
                $mac_query = "SELECT MAC FROM CVOR WHERE ID="
                    . mysqli_fetch_array(mysqli_query($con, $senzor_query))['ID_CVOR'];
                $mac = makeMacString(mysqli_fetch_array(mysqli_query($con, $mac_query))['MAC']);
                echo $mac;
                echo "</td>";
                echo "<td>" . $row['VRIJEDNOST'] . "</td>";
                echo "<td>" . $row['VRIJEME'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <table id="table_prozor">
            <tr>
                <th colspan="4">STATUS OBJEKTA</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>MAC adresa čvora</th>
                <th>Otvoreni</th>
                <th>Vrijeme</th>
            </tr>
            <?php
            $sql_query = "SELECT * FROM STATUSOBJEKT WHERE VRIJEME >= NOW() - INTERVAL 1 DAY";
            $result = mysqli_query($con, $sql_query);
            while ($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>";
                $id_cvor_query = "SELECT ID_CVOR FROM STATUSOBJEKT_SENZOR WHERE ID=" . $row['ID_SENZOR'];
                $id_cvor = mysqli_fetch_array(mysqli_query($con, $id_cvor_query))['ID_CVOR'];
                $mac_query = "SELECT MAC FROM CVOR WHERE ID=" . $id_cvor;
                $mac = makeMacString(mysqli_fetch_array(mysqli_query($con, $mac_query))['MAC']);
                echo $mac;
                echo "</td>";
                echo "<td>" . $row['VRIJEDNOST'] . "</td>";
                echo "<td>" . $row['VRIJEME'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <table id="table_temp_senzor">
            <tr>
                <th colspan="4">SENZORI TEMPERATURE</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>ID čvora</th>
                <th>MAC adresa čvora</th>
                <th>Tip</th>
            </tr>
            <?php
            $sql_query = "SELECT * FROM TEMP_SENZOR";
            $result = mysqli_query($con, $sql_query);
            while ($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['ID_CVOR'] . "</td>";
                echo "<td>";
                $mac_query = "SELECT MAC FROM CVOR WHERE ID=" . $row['ID_CVOR'];
                $mac = makeMacString(mysqli_fetch_array(mysqli_query($con, $mac_query))['MAC']);
                echo $mac;
                echo "</td>";
                echo "<td>" . $row['TIP'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <table id="table_statusobjekt_senzor">
            <tr>
                <th colspan="5">SENZORI STATUSA OBJEKTA</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>ID čvora</th>
                <th>MAC adresa čvora</th>
                <th>Pin</th>
                <th>Tip</th>
            </tr>
            <?php
            $sql_query = "SELECT * FROM STATUSOBJEKT_SENZOR";
            $result = mysqli_query($con, $sql_query);
            while ($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['ID_CVOR'] . "</td>";
                echo "<td>";
                $mac_query = "SELECT MAC FROM CVOR WHERE ID=" . $row['ID_CVOR'];
                $mac = makeMacString(mysqli_fetch_array(mysqli_query($con, $mac_query))['MAC']);
                echo $mac;
                echo "</td>";
                echo "<td>" . $row['PIN'] . "</td>";
                echo "<td>" . $row['TIP'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <table id="prostorija">
            <tr>
                <th colspan="4">AKTIVNE PROSTORIJE</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>ID čvora</th>
                <th>MAC adresa</th>
                <th>Adresa</th>
            </tr>
            <?php
            $sql_query = "SELECT * FROM PROSTORIJA";
            $result = mysqli_query($con, $sql_query);
            while ($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['ID_CVOR'] . "</td>";
                echo "<td>";
                $mac_query = "SELECT MAC FROM CVOR WHERE ID=" . $row['ID_CVOR'];
                $mac = makeMacString(mysqli_fetch_array(mysqli_query($con, $mac_query))['MAC']);
                echo $mac;
                echo "</td>";
                echo "<td>" . $row['NAZIV'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br>
    </body>
</html>

