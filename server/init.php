<?php
include "config.php";
  
$sql_query = "insert into cvor (mac, aktivno) values 'AABBCCDDEE', 1";
$result = mysqli_query($con, $sql_query);

?>
