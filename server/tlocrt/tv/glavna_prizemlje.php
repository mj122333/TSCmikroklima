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
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1179.0435 859.7391">
            <g id="back">
                <polygon points="1 249.87 1 783.609 260.826 783.609 260.826 630.217 1029.348 630.217 1029.348 597.348 1178.043 597.348 1178.043 536.304 1029.348 536.304 1029.348 15.087 941.696 15.087 941.696 93.348 747.609 93.348 747.609 249.87 1 249.87" style="fill: #e6e6e6;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_19" data-name="19">
                <rect x="345.3478" y="630.2174" width="203.4783" height="228.5217" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_18" data-name="18">
                <rect x="548.8261" y="630.2174" width="198.7826" height="228.5217" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_17" data-name="17">
                <rect x="747.6087" y="630.2174" width="86.087" height="153.3913" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_16" data-name="16">
                <rect x="833.6957" y="630.2174" width="195.6522" height="228.5217" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_15" data-name="15">
                <rect x="1029.3478" y="597.3478" width="84.5217" height="161.2174" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_4" data-name="4">
                <rect x="1029.3478" y="375.087" width="84.5217" height="161.2174" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_1" data-name="1">
                <rect x="1" y="93.3478" width="84.5217" height="156.5217" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_2" data-name="2">
                <rect x="85.5217" y="93.3478" width="175.3043" height="156.5217" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="Knjiznica">
                <polygon points="747.609 249.87 260.826 249.87 260.826 93.348 345.348 93.348 345.348 1 747.609 1 747.609 249.87" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_20" data-name="20">
                <rect x="260.8261" y="630.2174" width="84.5218" height="153.3913" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
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