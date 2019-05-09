<?php
session_start();
$uid=$_SESSION['uid'];
$conn = new mysqli("localhost", "root", "","medical");
$mid=$_GET['mid'];
$result=$conn->query("DELETE FROM cmedicine where mid='$mid' and cid='$uid'");
@include("cmedicine.php");
?>