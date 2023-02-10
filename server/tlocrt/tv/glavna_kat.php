<html lang="en">

<?php
include "../tlocrt.php";
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tlocrt TSČ-a</title>

    <link rel="stylesheet" href="tlocrt_tv.css">
</head>
<body>
    <div class="container">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1164.9565 822.1739">
            <g id="Back">
                <polygon points="911.957 191.957 990.217 191.957 990.217 368.478 990.217 484.652 1085.696 484.652 1163.957 484.652 1163.957 578.565 990.217 578.565 990.217 634.913 198.217 634.913 198.217 475.261 1 475.261 1 276.478 1 191.957 769.522 191.957 911.957 191.957" style="fill: #e6e6e6;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_21" data-name="21">
                <rect x="1" y="1" width="281.7391" height="190.9565" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_22" data-name="22">
                <rect x="282.7391" y="1" width="111.1304" height="190.9565" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_23" data-name="23">
                <rect x="393.8696" y="1" width="95.4783" height="190.9565" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_27" data-name="27">
                <rect x="489.3478" y="1" width="76.6957" height="190.9565" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_25" data-name="25">
                <rect x="566.0435" y="1" width="126.7826" height="190.9565" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_26" data-name="26">
                <rect x="692.8261" y="1" width="76.6957" height="190.9565" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="__1" data-name="_?1">
                <rect x="769.5217" y="1" width="71.2174" height="190.9565" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="__2" data-name="_?2">
                <rect x="840.7391" y="1" width="71.2174" height="190.9565" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_29" data-name="29">
                <rect x="911.9565" y="1" width="78.2609" height="190.9565" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_46" data-name="46">
                <rect x="96.4783" y="475.2609" width="101.7391" height="159.6522" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_45" data-name="45">
                <rect x="198.2174" y="634.913" width="234.7826" height="186.2609" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_44" data-name="44">
                <rect x="433" y="634.913" width="239.4783" height="186.2609" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_43" data-name="43">
                <rect x="672.4783" y="634.913" width="89.2174" height="109.5652" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_42" data-name="42">
                <rect x="761.6957" y="634.913" width="228.5217" height="186.2609" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_41" data-name="41">
                <rect x="990.2174" y="578.5652" width="95.4783" height="111.1304" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_30" data-name="30">
                <rect x="990.2174" y="368.4783" width="95.4783" height="116.1739" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
        </svg>

    </div>

</body>

<script type="text/javascript" src="/mikroklima/jquery/jquery.js"></script>
<script>
    var naziviAktivnihProstorija = <?php echo json_encode($nazivi_prostorija)?>;
    var temperatureProstorija = <?php echo json_encode($temperatura_prostorija)?>;
    var otvoreniProzori = <?php echo json_encode($otvoreni_prozori)?>;
    var greske = <?php echo json_encode($greske)?>;
</script>
<script type="text/javascript" src="tlocrt_tv.js"></script>
</html>