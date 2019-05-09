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
			<li><a href='cmedicine.php'><img src="records.png">Medicines</a></li>
			<li><a href='cpview.php'><img src="file.png">Patients</a></li>
			<li><a href='chemist.php'><img src="house.png">Home</a></li>
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
	$sql="SELECT * FROM chemist where uid='$uid'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc(); 
	?>
	<div id="body">
		<?php
		$fname=$_GET["name1"];
		$lname=$_GET["name2"];
		$sname=$_GET["sname"];
		$pass=$_GET["password1"];
		$address=$_GET["address"];
		$cname=$_GET["cname"];
		$snumber=$_GET["snumber"];
		$query=$conn->query("SELECT * FROM chemist WHERE sid='$snumber'");
		$num=$query->num_rows;
		if($num==0 or $snumber==$row['sid']){
			$sql="UPDATE chemist SET fname='$fname',lname='$lname',pass='$pass',sname='$sname',city='$cname',address='$address',sid='$snumber' WHERE uid='$uid' ";
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