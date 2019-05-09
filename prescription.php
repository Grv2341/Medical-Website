<html>
<?php
session_start();
$uid=$_SESSION['uid'];
$conn = new mysqli("localhost", "root", "","medical");
?>
<head>
	<title>Doctor</title>
	<link rel="stylesheet" type="text/css" href="prescription.css">
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
			<li id="active"><a href='#'><img src="file.png">Prescription</a></li>
			<li ><a href='doctor.php'><img src="house.png">Home</a></li>
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
			<div class="prescription">
				<span id="date">
					<?php
					echo date("Y-m-d");
					?>
				</span>
				<form action="presp.php" method="get">
					<input type="text" name="pid" placeholder="Patient ID" pattern="[0-9]{1,}" required></li><br>
					<input type="text" name="disease" placeholder="Disease" required></li><br>
					<p id="label"> Medicine:</p>
						<?php
						$sql="SELECT * FROM medicine ORDER BY mid";
						$result=$conn->query($sql) or die($conn->error);
						echo "<select name='medicine[]' multiple required>";
						while($row = $result->fetch_assoc()){
							echo "<option value='".$row['mid']."'>".$row['mname']."</option>";
						}
						echo "</select>"
						?><br>
						<input type="submit" value="Prescribe" id="submit">
				</form>
			</div>
		</div>
	</div>
</body>
</html>