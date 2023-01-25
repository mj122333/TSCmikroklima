<html lang="en">

<?php
include "config.php";
$sql_query = "SELECT ADRESA FROM PROSTORIJA";
$result = mysqli_query($con, $sql_query);
$rows = array();
for ($i = 0; $row = mysqli_fetch_array($result); $i++){
    $rows[$i] = $row[0];
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tlocrt TSČ-a</title>

    <style>
        .flex {
            display: flex;
            height: 100%;
            width: 100%;
            flex-direction: row;
            justify-content: space-around;
            align-items: space-around;
            flex-wrap: wrap;
        }
        .flex > svg{
            height: 45%;
        }

        .ucionice-text{
            font: italic 30px sans-serif;
            color: red;
        }
    </style>

</head>
<body>
<div class="flex">
    <svg id="tlocrt-kat1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1164.96 822.17">
        <g id="_21" data-name="21"><rect x="1" y="1" width="281.74" height="190.96" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_22" data-name="22"><rect x="282.74" y="1" width="111.13" height="190.96" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_23" data-name="23"><rect x="393.87" y="1" width="95.48" height="190.96" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_27" data-name="27"><rect x="489.35" y="1" width="76.7" height="190.96" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_25" data-name="25"><rect x="566.04" y="1" width="126.78" height="190.96" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_26" data-name="26"><rect x="692.83" y="1" width="76.7" height="190.96" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_29" data-name="29"><rect x="911.96" y="1" width="78.26" height="190.96" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_46" data-name="46"><rect x="96.48" y="475.26" width="101.74" height="159.65" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_45" data-name="45"><rect x="198.22" y="634.91" width="234.78" height="186.26" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_44" data-name="44"><rect x="433" y="634.91" width="239.48" height="186.26" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_43" data-name="43"><rect x="672.48" y="634.91" width="89.22" height="109.57" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_42" data-name="42"><rect x="761.7" y="634.91" width="228.52" height="186.26" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_41" data-name="41"><rect x="990.22" y="578.57" width="95.48" height="111.13" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_30" data-name="30"><rect x="990.22" y="368.48" width="95.48" height="116.17" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g
        <g id="Back"><polygon points="1 191.96 769.52 191.96 769.52 1 911.96 1 911.96 191.96 990.22 191.96 990.22 368.48 990.22 484.65 1085.7 484.65 1163.96 484.65 1163.96 578.57 990.22 578.57 990.22 634.91 198.22 634.91 198.22 475.26 1 475.26 1 276.48 1 191.96" style="fill:#e6e6e6;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g></svg>
    <svg id="tlocrt-kat2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1659.57 931.74">
        <g id="_L31" data-name="31"><rect x="59.7" y="78.48" width="335.74" height="262.96" style="fill:#bfbfbf;stroke:#000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_L32" data-name="32"><rect x="395.43" y="78.48" width="342.78" height="262.96" style="fill:#bfbfbf;stroke:#000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_33" data-name="33"><rect x="738.22" y="188.83" width="136.17" height="152.61" style="fill:#bfbfbf;stroke:#000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_34" data-name="34"><rect x="874.39" y="78.48" width="342.78" height="262.96" style="fill:#bfbfbf;stroke:#000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_35" data-name="35"><rect x="1217.17" y="188.83" width="138.52" height="152.61" style="fill:#bfbfbf;stroke:#000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_36" data-name="36"><rect x="1217.17" y="447.09" width="138.52" height="157.3" style="fill:#bfbfbf;stroke:#000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_37" data-name="37"><rect x="874.39" y="447.09" width="342.78" height="267.65" style="fill:#bfbfbf;stroke:#000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_38" data-name="38"><rect x="738.22" y="447.09" width="136.17" height="157.3" style="fill:#bfbfbf;stroke:#000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_39" data-name="39"><rect x="395.43" y="447.09" width="342.78" height="267.65" style="fill:#bfbfbf;stroke:#000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="_40" data-name="40"><rect x="59.7" y="447.09" width="335.74" height="267.65" style="fill:#bfbfbf;stroke:#000;stroke-miterlimit:10;stroke-width:2px"/></g>
        <g id="back"><polygon points="59.7 341.44 59.7 1 1 1 1 930.74 59.7 930.74 59.7 447.09 1355.7 447.09 1355.7 604.39 1658.57 604.39 1658.57 188.83 1355.7 188.83 1355.7 341.44 59.7 341.44" style="fill:#e6e6e6;stroke:#000;stroke-miterlimit:10;stroke-width:2px"/></g></svg>
</div>

</body>

<script>
    var aktivneProstorije = <?php echo json_encode($rows)?>;
    aktivneProstorije.forEach(function (prost){
        var prostorijaSVG = document.getElementById("_" + prost).firstChild;
        prostorijaSVG.style.fill = "#0f0"
    })

    var sveProstorije = document.querySelectorAll('svg > g');
    sveProstorije.forEach(function (prost){
        var text = document.createElementNS('http://www.w3.org/2000/svg','text');
        text.setAttributeNS(null,"x",prost.firstChild.attributes.x.value + 20);
        text.setAttributeNS(null,"y",prost.firstChild.attributes.y.value + 20);
        text.setAttributeNS(null,"class","ucionice-text");
        text.appendChild(document.createTextNode(prost.id));

        prost.appendChild(text);
    });
</script>
</html>