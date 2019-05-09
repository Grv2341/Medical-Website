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

			$presp=$_GET['pid'];
			$result=$conn->query("SELECT * FROM prescription where prespid='$presp'") or die($conn->error);
			$medicine=[];
			while($row = $result->fetch_assoc()){
				$medicine[]=$row['mid'];
			}
			$result=$conn->query("SELECT * FROM cmedicine order by cid") or die($conn->error);
			$id=0;
			$cid=0;
			$medicine2=[];
			while($row = $result->fetch_assoc()){
				if($cid!=$row['cid'] and $cid!=0){
					if($medicine==$medicine2){
						$id=$id+1;
						$result2=$conn->query("SELECT * from chemist where uid='$cid'") or die($conn->error);
						$row2=$result->fetch_assoc();
						echo "<div class='prescription'>";
						echo "<ul>";
						echo '<li id="patient">'.$row2['fname'].' '.$row2['lname'].'</li>';
						echo '<li id="pid">id: '.$row2['uid'].'</li>';
						echo '<li id="disease"><span class="label">Shop ID:  </span>'.$row2['sid'].'</li>';
						echo '<li id="disease"><span class="label">Shop Name:  </span>'.$row2['sname'].'</li>';
						echo '<li id="disease"><span class="label">Shop Address:  </span>'.$row2['address'].'</li>';
						echo '<li id="disease"><span class="label">City:  </span>'.$row2['city'].'</li>';
						echo '</ul></div>';
					}
					$medicine2=[];
					$cid=$row['cid'];
				}
				$cid=$row['cid'];
				$medicine2[]=$row['mid'];
			}
			if($medicine==$medicine2){
				$id=$id+1;
				$result2=$conn->query("SELECT * from chemist where uid='$cid'") or die($conn->error);
				$row2=$result2->fetch_assoc();
				$num=$result2->num_rows;
				echo "<div class='prescription'>";
				echo "<ul>";
				echo '<li id="patient">'.$row2['fname'].' '.$row2['lname'].'</li>';
				echo '<li id="pid">id: '.$row2['uid'].'</li>';
				echo '<li id="disease"><span class="label">Shop ID:  </span>'.$row2['sid'].'</li>';
				echo '<li id="disease"><span class="label">Shop Name:  </span>'.$row2['sname'].'</li>';
				echo '<li id="disease"><span class="label">Shop Address:  </span>'.$row2['address'].'</li>';
				echo '<li id="disease"><span class="label">City:  </span>'.$row2['city'].'</li>';
				echo '</ul></div>';
			}
			if($id==0){
				echo "<p class='label' style='color:#999999;font-size:17px;margin-top:20px;'>No chemist Found</p>";
			}
			?>
		</div>
	</div>
</body>