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
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1455.0435 747.1739">
            <g id="_4" data-name="4">
                <rect x="1" y="95.4348" width="114.7826" height="226.4348" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_5" data-name="5">
                <rect x="115.7826" y="1" width="290.087" height="320.8696" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_6" data-name="6">
                <rect x="405.8696" y="1" width="284.3478" height="320.8696" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_7" data-name="7">
                <rect x="690.2174" y="95.4348" width="106.9565" height="226.4348" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_8" data-name="8">
                <rect x="797.1739" y="1" width="284.3478" height="320.8696" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_9" data-name="9">
                <rect x="1081.5217" y="95.4348" width="116.3478" height="226.4348" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_15" data-name="15">
                <rect x="1" y="416.3043" width="114.7826" height="225.3913" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_14" data-name="14">
                <rect x="115.7826" y="416.3043" width="290.087" height="329.8696" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_13" data-name="13">
                <rect x="405.8696" y="416.3043" width="284.3478" height="329.8696" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_12" data-name="12">
                <rect x="690.2174" y="416.3043" width="106.9565" height="225.3913" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_11" data-name="11">
                <rect x="797.1739" y="416.3043" width="284.3478" height="329.8696" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_10" data-name="10">
                <rect x="1081.5217" y="416.3043" width="116.3478" height="225.3913" style="fill: #bfbfbf;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="back">
                <polygon points="1 321.87 1197.87 321.87 1197.87 136.13 1454.043 136.13 1454.043 641.696 1197.87 641.696 1197.87 416.304 1 416.304 1 321.87" style="fill: #e6e6e6;stroke: #150000;stroke-miterlimit: 10;stroke-width: 2px"/>
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