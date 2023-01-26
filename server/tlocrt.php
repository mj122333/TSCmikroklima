<html lang="en">

<?php
include "config.php";
$sql_query = "SELECT NAZIV FROM PROSTORIJA";
$result = mysqli_query($con, $sql_query);
$aktivne_prostorije = array();
$i = 0;
while ($row = mysqli_fetch_array($result)){
    $aktivne_prostorije[$i] = $row;
    $i++;
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tlocrt TSČ-a</title>
    <link rel="stylesheet" href="css/tlocrt.css">

</head>
<body>
    <iframe id="graf" class="graf graf-off" src="display/main-graph.php"></iframe>
    <div class="flex">
        <svg id="tlocrt-prizemlje1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1179.04 859.74">
            <g id="_19" data-name="19"><rect x="345.35" y="630.22" width="203.48" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_18" data-name="18"><rect x="548.83" y="630.22" width="198.78" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_17" data-name="17"><rect x="747.61" y="630.22" width="86.09" height="153.39" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_16" data-name="16"><rect x="833.7" y="630.22" width="195.65" height="228.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_15" data-name="15"><rect x="1029.35" y="597.35" width="84.52" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_4" data-name="4"><rect x="1029.35" y="375.09" width="84.52" height="161.22" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_1" data-name="1"><rect x="1" y="93.35" width="84.52" height="156.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_2" data-name="2"><rect x="85.52" y="93.35" width="175.3" height="156.52" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="Knjiznica"><polygon points="747.61 249.87 260.83 249.87 260.83 93.35 345.35 93.35 345.35 1 747.61 1 747.61 249.87" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_20" data-name="20"><rect x="260.83" y="630.22" width="84.52" height="153.39" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="back"><polygon points="1 249.87 1 783.61 260.83 783.61 260.83 630.22 1029.35 630.22 1029.35 597.35 1178.04 597.35 1178.04 536.3 1029.35 536.3 1029.35 15.09 941.7 15.09 941.7 93.35 747.61 93.35 747.61 249.87 1 249.87" style="fill:#e6e6e6;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g></svg>

        <svg id="tlocrt-prizemlje2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1510.87 858.17">
            <g id="_4" data-name="4"><rect x="56.83" y="159.09" width="114.78" height="226.43" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_5" data-name="5"><rect x="171.61" y="64.65" width="290.09" height="320.87" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_6" data-name="6"><rect x="461.7" y="64.65" width="284.35" height="320.87" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_7" data-name="7"><rect x="746.04" y="159.09" width="106.96" height="226.43" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_8" data-name="8"><rect x="853" y="64.65" width="284.35" height="320.87" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_9" data-name="9"><rect x="1137.35" y="159.09" width="116.35" height="226.43" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_15" data-name="15"><rect x="56.83" y="479.96" width="114.78" height="225.39" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_14" data-name="14"><rect x="171.61" y="479.96" width="290.09" height="329.87" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_13" data-name="13"><rect x="461.7" y="479.96" width="284.35" height="329.87" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_12" data-name="12"><rect x="746.04" y="479.96" width="106.96" height="225.39" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_11" data-name="11"><rect x="853" y="479.96" width="284.35" height="329.87" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="_10" data-name="10"><rect x="1137.35" y="479.96" width="116.35" height="225.39" style="fill:#bfbfbf;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g>
            <g id="back"><polygon points="56.83 385.52 56.83 1 1 1 1 857.17 56.83 857.17 56.83 479.96 1253.7 479.96 1253.7 705.35 1509.87 705.35 1509.87 199.78 1253.7 199.78 1253.7 385.52 56.83 385.52" style="fill:#e6e6e6;stroke:#150000;stroke-miterlimit:10;stroke-width:2px"/></g></svg>

        </div>

</body>

<script type="text/javascript" src="jquery/jquery.js"></script>
<script>
    var aktivneProstorije = <?php echo json_encode($aktivne_prostorije)?>;
</script>
<script type="text/javascript" src="tlocrt.js"></script>
</html>