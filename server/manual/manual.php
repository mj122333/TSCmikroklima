<?php
include "../config.php";
if (!isset($_GET["password"])) {
    echo "potrebna je lozinka";
    exit();
}
if (ADMINPASSWORD != $_GET["password"]) {
    echo "Kriva lozinka";
    exit();
}
//ako nije ulogiran

/*
$sql_query = "UPDATE TEMP_SENZOR SET TIP= 0 WHERE ID=44";
$result = mysqli_query($con, $sql_query);
$sql_query = "UPDATE TEMP_SENZOR SET TIP= 1 WHERE ID=45";
$result = mysqli_query($con, $sql_query);
$sql_query = "UPDATE TEMP_SENZOR SET TIP= 2 WHERE ID=46";
$result = mysqli_query($con, $sql_query);
*/


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manual edit</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex, follow" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,0" />
    <link rel="stylesheet" href="manual.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript" src="manual.js"></script>
</head>

<body>
    <div class="limiter">
        <div class="container-table">
            <div class="wrap-table">
                <form action="update.php/?password=<?php echo $_GET["password"] ?>" method="POST" target="_blank">
                    <h1 class="title">CVOR</h1>
                    <div class="table CVOR">
                        <div class="table-head">
                            <table>
                                <thead>
                                    <tr class="row head">
                                        <th class="cell column1">ID</th>
                                        <th class="cell column2">MAC</th>
                                        <th class="cell column3">AKTIVNO</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="table-body js-pscroll">
                            <table>
                                <tbody>
                                    <?php
                                    $sql_query = "SELECT * FROM CVOR ";
                                    $result = mysqli_query($con, $sql_query);
                                    $index = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr class='row body'>";
                                        echo "<td class='cell column1'>   <input name='CVOR[" . $index . "][ID]' type='number' placeholder='" . $row['ID'] . "' value='" . $row['ID'] . "' disabled></td>";
                                        echo "<td class='cell column2'> <input name='CVOR[" . $index . "][MAC]' type='text' placeholder='" . $row['MAC'] . "' value='" . $row['MAC'] . "' class='HEX' maxlength='17'></td>";
                                        echo "<td class='cell column3'> <select name='CVOR[" . $index . "][AKTIVNO]' value=" . $row['AKTIVNO'] . ">
                                                      <option value=0>neaktivan</option>
                                                      <option value=1>aktivan</option>
                                                      </select></td>";
                                        echo "</tr>";
                                        $index++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h1 class="title">TEMP_SENZOR</h1>
                    <div class="table TEMP_SENZOR">

                        <div class="table-head">

                            <table>
                                <thead>
                                    <tr class="row head">
                                        <th class="cell column1">ID</th>
                                        <th class="cell column2">ID_CVOR</th>
                                        <th class="cell column3">ADRESA</th>
                                        <th class="cell column4">TIP</th>
                                        <th class="cell column5">VRIJEDNOST</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="table-body js-pscroll">
                            <table>
                                <tbody>
                                    <?php
                                    $sql_query = "SELECT * FROM TEMP_SENZOR ";
                                    $result = mysqli_query($con, $sql_query);
                                    $index = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr class='row body'>";
                                        echo "";
                                        echo "<td class='cell column1'> <input name='TEMP_SENZOR[" . $index . "][ID]' type='number' placeholder='" . $row['ID'] . "' value='" . $row['ID'] . "' disabled></td>";
                                        echo "<td class='cell column2'> <input name='TEMP_SENZOR[" . $index . "][ID_CVOR]' type='number' placeholder='" . $row['ID_CVOR'] . "' value='" . $row['ID_CVOR'] . "'></td>";
                                        echo "<td class='cell column3'> <input name='TEMP_SENZOR[" . $index . "][ADRESA]' class='HEX' maxlength='23' type='text' placeholder='" . $row['ADRESA'] . "' value='" . $row['ADRESA'] . "'></td>";
                                        echo "<td class='cell column4'> <select name='TEMP_SENZOR[" . $index . "][TIP]' value=" . $row['TIP'] . ">
                                                              <option value=0>Sobna</option>
                                                              <option value=1>Radijator</option>
                                                              <option value=2>Klima</option>
                                                              <option value=100>Nije Definiran</option>
                                                              </select></td>";
                                        $temp_query = "SELECT VRIJEDNOST FROM TEMP WHERE ID_SENZOR=" . $row['ID'] . " ORDER BY VRIJEME DESC LIMIT 1";
                                        $temp_result = mysqli_query($con, $temp_query);
                                        $vrijednost = mysqli_fetch_array($temp_result)["VRIJEDNOST"];

                                        echo "<td class='cell column5'> <input type='number' value='" . $vrijednost . "' disabled></td>";
                                        echo "</tr>";
                                        $index++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h1 class="title">STATUSOBJEKT_SENZOR</h1>
                    <div class="table STATUSOBJEKT_SENZOR">

                        <div class="table-head">

                            <table>
                                <thead>
                                    <tr class="row head">
                                        <th class="cell column1">ID</th>
                                        <th class="cell column2">ID_CVOR</th>
                                        <th class="cell column3">PIN</th>
                                        <th class="cell column4">TIP</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="table-body js-pscroll">
                            <table>
                                <tbody>
                                    <?php
                                    $sql_query = "SELECT * FROM STATUSOBJEKT_SENZOR ";
                                    $result = mysqli_query($con, $sql_query);
                                    $index = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr class='row body'>";
                                        echo "";
                                        echo "<td class='cell column1'> <input name='STATUSOBJEKT_SENZOR[" . $index . "][ID]' type='number' placeholder='" . $row['ID'] . "' value='" . $row['ID'] . "' disabled></td>";
                                        echo "<td class='cell column2'> <input name='STATUSOBJEKT_SENZOR[" . $index . "][ID_CVOR]' type='number' placeholder='" . $row['ID_CVOR'] . "' value='" . $row['ID_CVOR'] . "'></td>";
                                        echo "<td class='cell column3'> <input name='STATUSOBJEKT_SENZOR[" . $index . "][PIN]' type='number' placeholder='" . $row['PIN'] . "' value='" . $row['PIN'] . "'></td>";
                                        echo "<td class='cell column4'> <select name='STATUSOBJEKT_SENZOR[" . $index . "][TIP]' value=" . $row['TIP'] . ">
                                                              <option value=1>Prozor</option>
                                                              <option value=100>Nije Definiran</option>
                                                              </select></td>";
                                        echo "</tr>";
                                        $index++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <h1 class="title">PROSTORIJA</h1>
                    <div class="table PROSTORIJA">

                        <div class="table-head">

                            <table>
                                <thead>
                                    <tr class="row head">
                                        <th class="cell column1">ID</th>
                                        <th class="cell column2">ID_CVOR</th>
                                        <th class="cell column3">NAZIV</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="table-body js-pscroll">
                            <table>
                                <tbody>
                                    <?php
                                    $sql_query = "SELECT * FROM PROSTORIJA ";
                                    $result = mysqli_query($con, $sql_query);
                                    $index = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr class='row body'>";
                                        echo "";
                                        echo "<td class='cell column1'> <input name='PROSTORIJA[" . $index . "][ID]' type='number' placeholder='" . $row['ID'] . "' value='" . $row['ID'] . "' disabled></td>";
                                        echo "<td class='cell column2'> <input name='PROSTORIJA[" . $index . "][ID_CVOR]' type='number' placeholder='" . $row['ID_CVOR'] . "' value='" . $row['ID_CVOR'] . "'></td>";
                                        echo "<td class='cell column3'> <input name='PROSTORIJA[" . $index . "][NAZIV]' type='text' placeholder='" . $row['NAZIV'] . "' value='" . $row['NAZIV'] . "'></td>";
                                        echo "</tr>";
                                        $index++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <input type="submit" value="SPREMI">
                </form>
            </div>
        </div>
    </div>
    <script>
        $("span.remover").click(function () {
            $(this).parent().parent().remove();
        });
    </script>
</body>

</html>