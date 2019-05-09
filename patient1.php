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
		$sql="SELECT * FROM prescription where pid='$uid' ORDER BY datep DESC ";
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
					echo '<form action="pdview.php" method="get">';
					echo '<input type="hidden" name="pid" value="'.$did.'">';
					echo '<button class="visit" type="submit">Visit Profile</button>';
					echo '</form>';
					echo '<form action="drate.php" method="get">';
					echo '<input type="hidden" name="pid" value="'.$did.'">';
					echo '<button class="visit" type="submit">Rate Doctor</button>';
					echo '</form>';
					if($c==1){
						echo '<form action="pcview.php" method="get">';
						echo '<input type="hidden" name="pid" value="'.$presp.'">';
						echo '<button class="visit" type="submit">See Chemist</button>';
						echo '</form>';
					}
					echo '</div>';
				}
				$did=$row['did'];
				$presp=$row['prespid'];
				$c=0;
				$pid=$row['did'];
				$sql="SELECT * FROM doctors WHERE uid='$pid'";
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
				echo '<li id="disease"><span class="label">Status:  </span>';
				if($row['status']==1){
				echo 'Medication taken</li>';
				}
				else{
					echo 'Medication not taken</li>';
					$c=1;
				}
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
		echo '<form action="pdview.php" method="get">';
		echo '<input type="hidden" name="pid" value="'.$did.'">';
		echo '<button class="visit" type="submit">Visit Profile</button>';
		echo '</form>';
		echo '<form action="drate.php" method="get">';
		echo '<input type="hidden" name="pid" value="'.$did.'">';
		echo '<button class="visit" type="submit">Rate Doctor</button>';
		echo '</form>';
		if($c==1){
			echo '<form action="pcview.php" method="get">';
			echo '<input type="hidden" name="pid" value="'.$presp.'">';
			echo '<button class="visit" type="submit">See Chemist</button>';
			echo '</form>';
		}

		echo '</div>';
		}
		?>
		<div id="l" style="margin-top: 30px;margin-left: 300px;margin-bottom: 50px;">
		<button onclick="document.location.href='patient.php'" style="padding:10px 0 10px 0;width:200px;border:none;border-radius: 20px;background:rgb(246,141,45);color:white;font-size: 20px;"><img src="add.png" style="width:20px;height:20px;vertical-align:text-bottom;margin-right: 10px;">Show Less</button>
		</div>
		</div>
	</div>
</body>
</html>