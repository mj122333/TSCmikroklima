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
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600.8696 638.2609">
            <g id="back">
                <polygon points="1 263.957 1297 263.957 1297 111.348 1599.87 111.348 1599.87 526.913 1297 526.913 1297 369.609 1 369.609 1 263.957" style="fill: #e6e6e6;stroke: #000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_L31" data-name="31">
                <rect x="1" y="1" width="335.7391" height="262.9565" style="fill: #bfbfbf;stroke: #000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_L32" data-name="32">
                <rect x="336.7391" y="1" width="342.7826" height="262.9565" style="fill: #bfbfbf;stroke: #000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_33" data-name="33">
                <rect x="679.5217" y="111.3478" width="136.1739" height="152.6087" style="fill: #bfbfbf;stroke: #000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_34" data-name="34">
                <rect x="815.6957" y="1" width="342.7826" height="262.9565" style="fill: #bfbfbf;stroke: #000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_35" data-name="35">
                <rect x="1158.4783" y="111.3478" width="138.5217" height="152.6087" style="fill: #bfbfbf;stroke: #000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_36" data-name="36">
                <rect x="1158.4783" y="369.6087" width="138.5217" height="157.3043" style="fill: #bfbfbf;stroke: #000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_37" data-name="37">
                <rect x="815.6957" y="369.6087" width="342.7826" height="267.6522" style="fill: #bfbfbf;stroke: #000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_38" data-name="38">
                <rect x="679.5217" y="369.6087" width="136.1739" height="157.3043" style="fill: #bfbfbf;stroke: #000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_39" data-name="39">
                <rect x="336.7391" y="369.6087" width="342.7826" height="267.6522" style="fill: #bfbfbf;stroke: #000;stroke-miterlimit: 10;stroke-width: 2px"/>
            </g>
            <g id="_40" data-name="40">
                <rect x="1" y="369.6087" width="335.7391" height="267.6522" style="fill: #bfbfbf;stroke: #000;stroke-miterlimit: 10;stroke-width: 2px"/>
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