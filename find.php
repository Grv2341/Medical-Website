<html>
<?php
session_start();
$uid=$_SESSION['uid'];
$conn = new mysqli("localhost", "root", "","medical");
?>
<head>
	<title>Doctor</title>
	<link rel="stylesheet" type="text/css" href="doctor1.css">
</head>
<body>
	<div id="title">
		<img src="wound.png">
		<span>Medical Records</span>
	</div>
	<div id="menu">
		<ul>
			<li><a href='logout.php'><img src="logout.png">Logout</a></li>
			<li><a href='#'><img src="records.png">Doctor</a></li>
			<li><a href='medical.php'><img src="file.png">Medical Record</a></li>
			<li id="active"><a href='#'><img src="house.png">Home</a></li>
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
		<div id="left">
			<div id="person"><img src="person.png"></div>
			<div id="name"><?php echo $row['fname']." ".$row['lname']; ?></div>
			<div id="special"><?php echo $row['city']; ?></div>
			<ul>
				<li class=" label">Aadhar Number</li>
				<li class=" value"><?php echo $row['aadhar']; ?></li>
				<li class=" label">Blood Group</li>
				<li class=" value"><?php echo $row['Blood']; ?></li>
			</ul>
			<BUTTON name="editp" onclick="document.location.href='pedit.php'"><img src="edit.png">Edit</BUTTON><br>
			<BUTTON name="editp" onclick="document.location.href='pview.php'"><img src="edit.png">View</BUTTON>
		</div>
		<div id="right">
			
		</div>
	</div>
</body>