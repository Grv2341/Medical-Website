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
			<li><a href='dprecord.php'><img src="records.png">Medical Records</a></li>
			<li><a href='prescription.php'><img src="file.png">Prescription</a></li>
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
		<?php
		$sql="SELECT * FROM prescription where did='$uid' ORDER BY datep DESC ";
		$result=$conn->query($sql)  or die($conn->error);
		$id=0;
		$num=$result->num_rows;
		$count=5;
		while($row = $result->fetch_assoc()){
			if($id!=$row['prespid']){
				if($count<5){
					echo '</ul>';
					echo '<form action="dpview.php" method="get">';
					echo '<input type="hidden" name="pid" value="'.$pid.'">';
					echo '<button class="visit" type="submit">Visit Profile</button>';
					echo '</form>';
					echo '</div>';
				}
				$pid=$row['pid'];
				$sql="SELECT * FROM patient WHERE uid='$pid'";
				$result1=$conn->query($sql) or die($conn->error);
				$row1=$result1->fetch_assoc();
				$count=$count-1;
				$id=$row['prespid'];
				echo '<div class="prescription">';
				echo '<ul>';
				echo '<li id="date">'.$row['datep'].'</li>';
				echo '<li id="patient">'.$row1['fname'].' '.$row1['lname'].'</li>';
				echo '<li id="pid">id: '.$row1['uid'].'</li>';
				echo '<li id="disease"><span class="label">Disease:  </span>'.$row['disease'].'</li>';
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
		if($num>0){
		echo '</ul>';
		echo '<form action="dpview.php" method="get">';
		echo '<input type="hidden" name="pid" value="'.$pid.'">';
		echo '<button class="visit" type="submit">Visit Profile</button>';
		echo '</form>';
		echo '</div>';
	}
		?>
		<div id="l" style="margin-top: 30px;margin-left: 300px;margin-bottom: 50px;">
		<button onclick="document.location.href='doctor.php'" style="padding:10px 0 10px 0;width:200px;border:none;border-radius: 20px;background:rgb(246,141,45);color:white;font-size: 20px;"><img src="add.png" style="width:20px;height:20px;vertical-align:text-bottom;margin-right: 10px;">Show Less</button>
		</div>
		</div>
	</div>
</body>
</html>