<?php
$fname1=$_GET["name1"];
$lname1=$_GET["name2"];
$pass1=$_GET["password1"];
$hname1=$_GET["hname"];
$cname1=$_GET["cname"];
$license1=$_GET["license"];
$special=$_GET["special"];
$conn = new mysqli("localhost", "root", "","medical");
$query =$conn->query("SELECT * FROM doctors");
$number=$query->num_rows;
$result=1000000+$number;
$result=$result+1;
$sql="INSERT INTO doctors (fname, lname, password,hname,uid,city,lid,special) VALUES ('$fname1','$lname1','$pass1','$hname1','$result','$cname1','$license1','$special')";
if ($conn->query($sql) === TRUE) {
    session_start();
    $_SESSION['uid']=$result;
    @include('doctor.php');
}
else{
	@include('home.html');
}

$conn->close();
?>