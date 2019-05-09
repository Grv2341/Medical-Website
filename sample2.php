<?php
session_start();
$x=$_SESSION['x'];
echo $x;
session_destroy();
?>