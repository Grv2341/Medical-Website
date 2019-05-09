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
			<li><a href='cmedicine.php'><img src="records.png">Medicines</a></li>
			<li id="active"><a href='#'><img src="file.png">Patients</a></li>
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
		<div id="right" style="text-align: center;">
			<?php
			$mid=$_GET['pid'];
			$result=$conn->query("SELECT * FROM medicine where mid='$mid'") or die($conn->error);
			$num=$result->num_rows;
			$c=0;
			$d=0;
			if($num==0){
				echo "<p>Invalid Medicine ID</p>";
				$c=1;
				echo "<button class='button' style='border:none;padding:10px;border-radius:17px;' onclick='".'document.location.href="cmedicine.php"'."'>Go Back</button>";
			}
			$result=$conn->query("SELECT * FROM cmedicine where mid='$mid' and cid='$uid'") or die($conn->error);
			$num=$result->num_rows;
			if($num>0){
				echo "<p>Medicine Already In Stock</p>";
				$d=1;
				echo "<button class='button' style='border:none;padding:10px;border-radius:17px;' onclick='".'document.location.href="cmedicine.php"'."'>Go Back</button>";
			}
			if($c==0 and $d==0){
				$result=$conn->query("INSERT INTO cmedicine (cid,mid) values ('$uid','$mid')") or die($conn->error);
				header("LOCATION: cmedicine.php");
			}
			?>
		</div>
	</div>
</body>
</html>
