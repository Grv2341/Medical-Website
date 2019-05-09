<?php
session_start();
$uid=$_SESSION['uid'];
$conn = new mysqli("localhost", "root", "","medical");
$p=$_GET['pid'];
echo $p;
$sql="UPDATE prescription SET status=1,cid='$uid' where prespid='$p'";
$result=$conn->query($sql) or die($conn->error);
@include("cpview.php");
?>