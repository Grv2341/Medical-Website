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
			<li><a href='pdsearch.php'><img src="records.png">Doctor</a></li>
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
			<?php
			$pid=$_GET['pid'];
			$disease=$_GET['disease'];
			$d=date("Y-m-d");
			$query=$conn->query("SELECT * FROM docotrs where uid='$pid'");
			$num=$query->num_rows;
			if($num==1){
			$query =$conn->query("SELECT * FROM prescription ORDER BY prespid DESC");
			$number=$query->fetch_assoc();
			$result=$number['prespid']+1;
			foreach ($_GET['medicine'] as $s){
    			$sql="INSERT INTO prescription (did,pid,datep,prespid,disease,mid) VALUEs ('$pid','$uid','$d','$result','$disease','$s')";
    			$sr=$conn->query($sql) or die($conn->error);
    		}
    		echo "<img src='correct.png'>";
    		echo "<p>Prescription added Succesfully !</p>";
    		}
    		else{
    			echo "<img src='warning.png'>";
    		echo "<p>Incorrect Doctor ID !</p>";
    		echo '<button onclick="'."document.location.href='medical.php'".'">Go Back</button>';
    		}
			?>
		</div>
	</div>
</body>
</html>