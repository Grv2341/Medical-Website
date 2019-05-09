<?php
session_start();
$x=$_GET['uid'];
$y=$_SESSION['uid'];
echo $x;
echo $y;
?>