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
			<li  id="active"><a href='#'><img src="records.png">Medicines</a></li>
			<li><a href='#'><img src="file.png">Patients</a></li>
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
		<div id="left">
			<div id="person"><img src="person.png"></div>
			<div id="name"><?php echo $row['fname']." ".$row['lname']; ?></div>
			<div id="special"><?php echo $row['sid']; ?></div>
			<ul>
				<li class=" label">Shop Name</li>
				<li class=" value"><?php echo $row['sname']; ?></li>
				<li class=" label">City</li>
				<li class=" value"><?php echo $row['city']; ?></li>
			</ul>
			<BUTTON name="editp" onclick="document.location.href='cedit.php'"><img src="edit.png">Edit</BUTTON><br>
		</div>
		<div id="right">
			<form action="cadd.php" method="get">
				<input type="text" name="pid" placeholder="Medicine ID" class="i1" pattern="[0-9]{7}" required><br>
				<input type="submit" value="Add to Stock" class="button">
			</form>
			<p style="color:#999999;font-size: 20px;font-weight: bolder;margin-top: 20px;">In Stock Medicines</p>
			<?php
			$result=$conn->query("SELECT * FROM cmedicine where cid='$uid'") or die($conn->error);
			$num=$result->num_rows;
			if($num==0){
				echo '<p style="color:#999999;font-size: 20px;font-weight: bolder;margin-top: 20px;">No Medicines in Stock.</p>';
			}
			else{
				echo "<table style='width:500px;'>";
				while($row = $result->fetch_assoc()){
					$mid=$row['mid'];
					$result1=$conn->query("SELECT * FROM medicine where mid='$mid'");
					$row1=$result1->fetch_assoc();
					echo '<tr>';
					echo '<td>'.$row1["mname"].'</td>';
					echo '<td><form method="get" action="mdelete.php" style="display:inline;"><input type="hidden" name="mid" value="'.$mid.'"><input type="submit" class="button" value="Delete"></form></td></tr>';
				}
			}
			?>
		</div>
	</div>
</body>
</html>