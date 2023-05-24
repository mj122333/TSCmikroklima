<?php
include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,250,0,0" />

</head>

<body>

    <header></header>
    <div class="naslovnica">
        <div class="container">
            <div>
                <h1>MIKROKLIMA - IoTŠČ</h1>
            </div>
            <div>
                <div class="line"></div>
            </div>
            <div>
                <p>Neki tekst</p>
            </div>
        </div>
    </div>
    <div class="main-container">




        <div class="content r2c4">
            <div class="header">
                <h2>Prikaz temperatura na prvom katu Tehničke Škole Čakovec</h2>
            </div>
            <iframe src="../tlocrt/pc/glavna_kat.php?display-only=1" class="prvi-kat"></iframe>
        </div>

        <div class="content r2c2">
            <div class="header">
                <h2>Pojašnjenje prikaza</h2>
            </div>

        </div>



        <div class="content r1c2 color-separator">
            <div class="container">
                <div class="name">Primljeni paketi</div>
                <div class="desc">od početka dana</div>
            </div>
            <div class="number">
                <?php
                $sql_query = "SELECT COUNT(DISTINCT VRIJEME) AS row_count FROM TEMP WHERE VRIJEME >= CURDATE();";
                $result = mysqli_query($con, $sql_query);

                echo number_format(mysqli_fetch_array($result)['row_count'], 0, '', ' ');
                ?>
            </div>
        </div>


        <div class="content r1c2 color-separator">

            <div class="container">
                <div class="name">Primljeni podatci</div>
                <div class="desc">od početka dana</div>
            </div>
            <div class="number">
                <?php
                $sql_query = "SELECT COUNT(*) AS row_count FROM TEMP WHERE VRIJEME >= CURDATE();";
                $result = mysqli_query($con, $sql_query);

                $temp = mysqli_fetch_array($result)['row_count'];

                $sql_query = "SELECT COUNT(*) AS row_count FROM STATUSOBJEKT WHERE VRIJEME >= CURDATE();";
                $result = mysqli_query($con, $sql_query);
                echo number_format($temp + mysqli_fetch_array($result)['row_count'], 0, '', ' ');
                ?>
            </div>

        </div>

        <div class="content r1c2b color-separator">

            <div class="container">
                <div class="name">Primljeni podatci</div>
                <div class="desc">od početka projekta</div>
            </div>
            <div class="number">
                <?php
                $sql_query = "SELECT COUNT(*) AS row_count FROM TEMP;";
                $result = mysqli_query($con, $sql_query);

                $temp = mysqli_fetch_array($result)['row_count'];

                $sql_query = "SELECT COUNT(*) AS row_count FROM STATUSOBJEKT ;";
                $result = mysqli_query($con, $sql_query);
                echo number_format($temp + mysqli_fetch_array($result)['row_count'], 0, '', ' ');
                ?>
            </div>

        </div>




        <div class="content r2c1 empty">

        </div>
        <div class="content r2c3">
            <div class="header">
                <select id="dropdown">
                    <?php
                    $sql_query = "SELECT * FROM PROSTORIJA ";
                    $result = mysqli_query($con, $sql_query);
                    $index = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=" . $row["NAZIV"] . ">" . $row["NAZIV"] . "</option>";
                    }
                    ?>
                </select>
                <div style="float:right">
                    <label for="timeInput">Pocetak:</label>
                    <input type="datetime-local" id="time-pocetak" name="timeInput">
                    <label for="timeInput">Kraj:</label>
                    <input type="datetime-local" id="time-kraj" name="timeInput">

            </div>
        </div>
        <iframe id="graf"></iframe>
    </div>

    <div class="content r1c1">
        <div class="header">
            <h2>Broj aktivnih uređaja</h2>
        </div>


        <div class="green-circle">
            <div>
                <?php
                $sql_query = "SELECT * FROM CVOR where AKTIVNO=1";
                $result = mysqli_query($con, $sql_query);
                echo $result->num_rows;
                ?>
            </div>
        </div>
    </div>

    <div class="content r2c1 empty">

    </div>

    <div class="content r1c1">
        <div class="header">
            <h2>Najnovija temperatura</h2>
        </div>
        <h1 style="padding-top: 30px;">
            <?php
            $sql_query = "SELECT * FROM TEMP ORDER BY ID DESC LIMIT 1";
            $result = mysqli_query($con, $sql_query);
            $result = mysqli_fetch_array($result);
            echo $result['VRIJEDNOST'] . "°C\n";
            ?>
        </h1>
        <h2 style="text-align:center;font-size:1.5rem">
            <?php
            $sql_query = "SELECT * FROM TEMP_SENZOR WHERE ID=" . $result["ID_SENZOR"];
            $result = mysqli_query($con, $sql_query);
            switch (mysqli_fetch_array($result)['TIP']) {
                case '0':
                    echo "Sobna";
                    break;
                case '1':
                    echo "Radijator";
                    break;
                case '2':
                    echo "Klima";
                    break;
                default:
                    echo "";
                    break;
            }
            ?>
        </h2>
        <div class="background-image">
            <span class="material-symbols-outlined">
                device_thermostat
            </span>
        </div>
    </div>

    <div class="footer"></div>
    </div>
    <script src="index.js"></script>
</body>

</html>