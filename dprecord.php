<html>
<?php
session_start();
$uid=$_SESSION['uid'];
$conn = new mysqli("localhost", "root", "","medical");
?>
<head>
	<title>Doctor</title>
	<link rel="stylesheet" type="text/css" href="dprecord.css">
</head>
<body>
	<div id="title">
		<img src="wound.png">
		<span>Medical Records</span>
	</div>
	<div id="menu">
		<ul>
			<li><a href='logout.php'><img src="logout.png">Logout</a></li>
			<li id="active"><a href='#'><img src="records.png">Medical Records</a></li>
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
		<div id="left">
			<div id="person"><img src="person.png"></div>
			<div id="name"><?php echo $row['fname']." ".$row['lname']; ?></div>
			<div id="special"><?php echo $row['special']; ?></div>
			<ul>
				<li class=" label">Hospital</li>
				<li class=" value"><?php echo $row['hname']; ?></li>
				<li class=" label">City</li>
				<li class=" value"><?php echo $row['city']; ?></li>
				<li class=" label">License</li>
				<li class=" value"><?php echo $row['lid']; ?></li>
			</ul>
			<BUTTON name="editp" onclick="document.location.href='dedit.php'"><img src="edit.png">Edit</BUTTON><br>
			<BUTTON name="editp" onclick="document.location.href='dview.php'"><img src="edit.png">View</BUTTON>
		</div>
		<div id="right">
			<form action="dpview.php" method="get">
				<input type="text" name="pid" placeholder="Patient ID" class="i1" pattern="[0-9]{7}" required><br>
				<input type="submit" value="View Record" class="button" onmouseover="validate1()">
			</form>
		</div>
	</div>
</body>
</html>