<?php
$fname=$_GET["name1"];
$lname=$_GET["name2"];
$pass=$_GET["password1"];
$aadhar=$_GET["aadhar"];
$cname=$_GET["cname"];
$conn = new mysqli("localhost", "root", "","medical");
$query =$conn->query("SELECT * FROM patient");
$number=$query->num_rows;
$result=1000000+$number;
$result=$result+1;
echo $aadhar;
$sql="INSERT INTO patient (uid,fname,lname,pass,city,aadhar) VALUES ('$result','$fname','$lname','$pass','$cname','$aadhar')";
if ($conn->query($sql) === TRUE) {
    echo "hello";
}
else{
	@include("home.html");
}

$conn->close();
?>