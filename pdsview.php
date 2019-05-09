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
			<li id="active"><a href='#'><img src="records.png">Doctor</a></li>
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
			<?php
			$city=$_GET['city'];
			$special=$_GET['special'];
			$result=$conn->query("SELECT * FROM doctors where city='$city' and special='$special'") or die($conn->error);
			while($row = $result->fetch_assoc()){
				echo '<div class="prescription">';
				echo '<ul>';
				echo '<li id="patient">'.$row['fname'].' '.$row['lname'].'</li>';
				echo '<li id="pid">id: '.$row['uid'].'</li>';
				echo '<li id="disease"><span class="label">Special:  </span>'.$row['special'].'</li>';
				echo '<li id="disease"><span class="label">Hospital:  </span>'.$row['hname'].'</li>';
				echo '<li id="disease"><span class="label">License ID:  </span>'.$row['lid'].'</li>';
				echo '<li id="disease"><span class="label">Average Rating:  </span>';
				for ($i=$row['rating']; $i>0; $i--) { 
						echo '<img src="star.png" style="width:20px;height:20px">';
					}
				echo "</li>";
				echo '</ul>';
				echo '<form action="pdview.php" method="get">';
				echo '<input type="hidden" name="pid" value="'.$row['uid'].'">';
				echo '<button class="visit" type="submit">Visit Profile</button>';
				echo '</form></div>';
			}
			?>
		</div>
	</div>
</body>
</html>