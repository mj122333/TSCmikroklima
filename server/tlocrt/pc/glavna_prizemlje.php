<html lang="en">

<?php
include "../tlocrt.php";
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tlocrt TSČ-a</title>
    <link rel="stylesheet" href="tlocrt_pc.css">

</head>
<body>
    <iframe id="graf" class="graf graf-off" src="/mikroklima/display/main-graph.php"></iframe>
    <div class="flex">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2227.22 859.74">
            <g id="back"><polygon points="1 249.87 1 783.61 260.83 783.61 260.83 630.22 1029.35 630.22 1029.35 597.35 2226.22 597.35 2226.22 536.3 1029.35 536.3 1029.35 15.09 941.7 15.09 941.7 93.35 747.61 93.35 747.61 249.87 1 249.87" style="fill:#e6e6e6;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="Knjiznica"><polygon points="747.61 249.87 260.83 249.87 260.83 93.35 345.35 93.35 345.35 1 747.61 1 747.61 249.87" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_19" data-name="19"><rect x="345.35" y="630.22" width="203.48" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_18" data-name="18"><rect x="548.83" y="630.22" width="198.78" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_17" data-name="17"><rect x="747.61" y="630.22" width="86.09" height="153.39" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_16" data-name="16"><rect x="833.7" y="630.22" width="195.65" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_1" data-name="1"><rect x="1" y="93.35" width="84.52" height="156.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_2" data-name="2"><rect x="85.52" y="93.35" width="175.3" height="156.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_20" data-name="20"><rect x="260.83" y="630.22" width="84.52" height="153.39" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_10" data-name="10"><rect x="2109.87" y="597.35" width="116.35" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_11" data-name="11"><rect x="1825.52" y="597.35" width="284.35" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_12" data-name="12"><rect x="1718.56" y="597.35" width="106.96" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_13" data-name="13"><rect x="1434.22" y="597.35" width="284.35" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_14" data-name="14"><rect x="1144.13" y="597.35" width="290.09" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_15" data-name="15"><rect x="1029.35" y="597.35" width="114.78" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_9" data-name="9"><rect x="2109.87" y="375.09" width="116.35" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_8" data-name="8"><rect x="1825.52" y="283.52" width="284.35" height="252.78" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_7" data-name="7"><rect x="1718.56" y="375.09" width="106.96" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_6" data-name="6"><rect x="1434.22" y="283.52" width="284.35" height="252.78" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_5" data-name="5"><rect x="1144.13" y="283.52" width="290.09" height="252.78" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_4" data-name="4"><rect x="1029.35" y="375.09" width="114.78" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
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
<script type="text/javascript" src="tlocrt_pc.js"></script>
</html>