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
			<li><a href='cmedicine.php'><img src="records.png">Medicines</a></li>
			<li><a href='cpview.php'><img src="file.png">Patients</a></li>
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
			<?php
		$sql="SELECT * FROM prescription where cid='$uid' ORDER BY datep DESC ";
		$result=$conn->query($sql)  or die($conn->error);
		$num=$result->num_rows;
		$id=0;
		$did=1;
		$presp=1;
		$count=2;
		while($row = $result->fetch_assoc()){
			if($id!=$row['prespid']){
				if($count<2){
					echo '</ul>';
					echo '</div>';
				}
				$did=$row['did'];
				$pid=$row['pid'];
				$presp=$row['prespid'];
				$c=0;
				$sql="SELECT * FROM doctors WHERE uid='$did'";
				$result1=$conn->query($sql) or die($conn->error);
				$row1=$result1->fetch_assoc();
				$sql="SELECT * FROM patient WHERE uid='$pid'";
				$result2=$conn->query($sql) or die($conn->error);
				$row2=$result2->fetch_assoc();
				$count=$count-1;
				$id=$row['prespid'];
				echo '<div class="prescription">';
				echo '<ul>';
				echo '<li id="date">'.$row['datep'].'</li>';
				echo '<li id="disease"><span class="label">Doctor:  </span>'.$row1['fname'].' '.$row1['lname'].'</li>';
				echo '<li id="disease"><span class="label">Patient:  </span>'.$row2['fname'].' '.$row2['lname'].'</li>';
				echo '<li id="disease"><span class="label">Prescription ID:  </span>'.$row['disease'].'</li>';
				echo '<li id="presp"><span class="label">Prescription:</span></li>';
				$mid=$row['mid'];
				$sql="SELECT * FROM medicine WHERE mid='$mid'";
				$result2=$conn->query($sql) or die($conn->error);
				$row2=$result2->fetch_assoc();
				echo '<li class="medicine">'.$row2['mname'].'</li>';
			}
			else{
				$mid=$row['mid'];
				$sql="SELECT * FROM medicine WHERE mid='$mid'";
				$result2=$conn->query($sql) or die($conn->error);
				$row2=$result2->fetch_assoc();
				echo '<li class="medicine">'.$row2['mname'].'</li>';
			}

		}

		if($num>=1){
		echo '</ul>';
		echo '</div>';
		}
		?>
	</div>
</body>
</html>