<html>
<?php
session_start();
$uid=$_SESSION['uid'];
$conn = new mysqli("localhost", "root", "","medical");
?>
<head>
	<title>Doctor</title>
	<link rel="stylesheet" type="text/css" href="docedit.css">
</head>
<body>
	<div id="title">
		<img src="wound.png">
		<span>Medical Records</span>
	</div>
	<div id="menu">
		<ul>
			<li><a href='logout.php'><img src="logout.png">Logout</a></li>
			<li><a href='pdsearch.php'><img src="records.png">Doctor</a></li>
			<li><a href='medical.php'><img src="file.png">Medical Record</a></li>
			<li><a href='patient.php'><img src="house.png">Home</a></li>
		</ul>
	</div>
	<script>
		window.onscroll = function() {myFunction()};
		var navbar = document.getElementById("menu");
		var sticky = navbar.offsetTop;
		function myFunction() {
  			if (window.pageYOffset >= sticky) {
    			navbar.classList.add("sticky")
  			} else {
    			navbar.classList.remove("sticky");
  			}
		}
	</script>
	<?php
	$sql="SELECT * FROM patient where uid='$uid'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc(); 
	?>
	<div id="body">
		<?php
		$fname=$_GET["name1"];
		$lname=$_GET["name2"];
		$pass=$_GET["password1"];
		$aadhar=$_GET["aadhar"];
		$cname=$_GET["cname"];
		$blood=$_GET['blood'];
		$query=$conn->query("SELECT * FROM patient WHERE aadhar='$aadhar'");
		$num=$query->num_rows;
		if($num==0 or $aadhar==$row['aadhar']){
			$sql="UPDATE patient SET fname='$fname',lname='$lname',pass='$pass',aadhar='$aadhar',city='$cname',Blood='$blood' WHERE uid='$uid' ";
			$result=$conn->query($sql) or die($conn->error);
			echo "<img src='correct.png'>";
    		echo "<p>Profile Updated Successfully !</p>";
		}
		else{
			echo "<img src='warning.png'>";
			echo "<p>Aadhar ID Already Exists !</p>";
    		echo '<button onclick="'."document.location.href='pedit.php'".'">Go Back</button>';

		}
		?>
	</div>
</body>
</html>