<html>
<?php
session_start();
$uid=$_SESSION['uid'];
$conn = new mysqli("localhost", "root", "","medical");
?>
<head>
	<title>Doctor</title>
	<link rel="stylesheet" type="text/css" href="presp.css">
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
			<li id="active"><a href='prescription.php'><img src="file.png">Prescription</a></li>
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
			<BUTTON name="editp"><img src="edit.png" onclick="document.location.href='dedit.php'">Edit</BUTTON><br>
			<BUTTON name="editp"><img src="edit.png" onclick="document.location.href='dview.php'">View</BUTTON>
		</div>
		<div id="right">
			<?php
			$pid=$_GET['pid'];
			$disease=$_GET['disease'];
			$d=date("Y-m-d");
			$query=$conn->query("SELECT * FROM patient where uid='$pid'");
			$num=$query->num_rows;
			if($num==1){
			$query =$conn->query("SELECT * FROM prescription ORDER BY prespid DESC");
			$number=$query->fetch_assoc();
			$result=$number['prespid']+1;
			foreach ($_GET['medicine'] as $s){
    			$sql="INSERT INTO prescription (did,pid,datep,prespid,disease,mid) VALUEs ('$uid','$pid','$d','$result','$disease','$s')";
    			$sr=$conn->query($sql) or die($conn->error);
    		}
    		echo "<img src='correct.png'>";
    		echo "<p>Prescription submitted Succesfully !</p>";
    		}
    		else{
    			echo "<img src='warning.png'>";
    		echo "<p>Incorrect Patient ID !</p>";
    		echo '<button onclick="'."document.location.href='prescription.php'".'">Go Back</button>';
    		}
			?>
		</div>
	</div>
</body>
</html>