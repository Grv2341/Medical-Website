<?php
$fname=$_GET["name1"];
$lname=$_GET["name2"];
$sname=$_GET["sname"];
$pass=$_GET["password1"];
$address=$_GET["address"];
$cname=$_GET["cname"];
$snumber=$_GET["snumber"];
$conn = new mysqli("localhost", "root", "","medical");
$query =$conn->query("SELECT * FROM chemist");
$number=$query->num_rows;
$result=1000000+$number;
$result=$result+1;
$sql="INSERT INTO chemist (uid,sid,fname,lname,sname,address,pass,city) VALUES ('$result','$snumber','$fname','$lname','$sname','$address','$pass','$cname')";
if ($conn->query($sql) === TRUE) {
    echo "hello";
}
else{
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>