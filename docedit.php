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
			<li><a href='dprecord.php'><img src="records.png">Medical Records</a></li>
			<li><a href='prescription.php'><img src="file.png">Prescription</a></li>
			<li><a href='doctor.php'><img src="house.png">Home</a></li>
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
	$sql="SELECT * FROM doctors where uid='$uid'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc(); 
	?>
	<div id="body">
		<?php
		$fname1=$_GET["name1"];
		$lname1=$_GET["name2"];
		$pass1=$_GET["password1"];
		$hname1=$_GET["hname"];
		$cname1=$_GET["cname"];
		$license1=$_GET["license"];
		$special=$_GET["special"];
		$query=$conn->query("SELECT * FROM doctors WHERE lid='$license1'");
		$num=$query->num_rows;
		if($num==0 or $license1==$row['lid']){
			$sql="UPDATE doctors SET fname='$fname1',lname='$lname1',password='$pass1',hname='$hname1',city='$cname1',lid='$license1',special='$special' WHERE uid='$uid' ";
			$result=$conn->query($sql) or die($conn->error);
			echo "<img src='correct.png'>";
    		echo "<p>Profile Updated Successfully !</p>";
		}
		else{
			echo "<img src='warning.png'>";
			echo "<p>License ID Already Exists !</p>";
    		echo '<button onclick="'."document.location.href='dedit.php'".'">Go Back</button>';

		}
		?>
	</div>
</body>
</html>