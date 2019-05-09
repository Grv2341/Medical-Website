<html>
<?php
session_start();
$uid=$_SESSION['uid'];
$conn = new mysqli("localhost", "root", "","medical");
?>
<head>
	<title>Doctor</title>
	<link rel="stylesheet" type="text/css" href="dpview.css">
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
			$pid=$_GET['pid'];
			$result=$conn->query("SELECT * FROM doctors where uid='$pid'") or die($conn->error);
			$num=$result->num_rows;
			if($num==0){
				@include("dprecord.php");
			}
			else{
				$row=$result->fetch_assoc();
				echo '<ul>';
				echo '<li id="patient">'.$row['fname'].' '.$row['lname'].'</li>';
				echo '<li id="pid"> Patient id : '.$pid.'</li>';
				echo '<li class="label">City<hr></li>';
				echo '<li class="value">'.$row['city'].'</li>';
				echo '<li class="label">Specialization<hr></li>';
				echo '<li class="value">'.$row['special'].'</li>';
				echo '<li class="label">License ID<hr></li>';
				echo '<li class="value">'.$row['lid'].'</li>';
				echo '<li class="label">Hospital<hr></li>';
				echo '<li class="value">'.$row['hname'].'</li>';
			}
			?>
			<h1>Reviews & Comments</h1>
			<?php
			$sql="SELECT * FROM drating WHERE did='$pid'";
			$result=$conn->query($sql) or die($conn->error);
			$num=$result->num_rows;
			if($num==0){
				echo "<p id='rating'>No Review or Comments Found.</p>";
			}
			else{
				echo '<ul><li id="rating">Average Rating :';
				$result1=$conn->query("SELECT * FROM doctors where uid='$pid'") or die($conn->error);
				$row1=$result1->fetch_assoc();
				for ($i=$row['rating']; $i>0; $i--) { 
						echo '<img src="star.png" style="width:20px;height:20px;">';
					}
				echo '</li>';
				$sql="SELECT * FROM drating WHERE did='$pid' and rating=1";
				$result1=$conn->query($sql) or die($conn->error);
				$num1=$result1->num_rows;
				echo '<li id="rating">One star :'.$num1.'</li>';
				$sql="SELECT * FROM drating WHERE did='$pid' and rating=2";
				$result1=$conn->query($sql) or die($conn->error);
				$num1=$result1->num_rows;
				echo '<li id="rating">Two star :'.$num1.'</li>';
				$sql="SELECT * FROM drating WHERE did='$pid' and rating=3";
				$result1=$conn->query($sql) or die($conn->error);
				$num1=$result1->num_rows;
				echo '<li id="rating">Three star :'.$num1.'</li>';
				$sql="SELECT * FROM drating WHERE did='$pid' and rating=4";
				$result1=$conn->query($sql) or die($conn->error);
				$num1=$result1->num_rows;
				echo '<li id="rating">Four star :'.$num1.'</li>';
				$sql="SELECT * FROM drating WHERE did='$pid' and rating=5";
				$result1=$conn->query($sql) or die($conn->error);
				$num1=$result1->num_rows;
				echo '<li id="rating">Five star :'.$num1.'</li>';
				echo '</ul>';
				while($row = $result->fetch_assoc()){
					$pid=$row['pid'];
					$result1=$conn->query("SELECT * FROM patient where uid='$pid'") or die($conn->error);
					$row1=$result1->fetch_assoc();
					echo '<div class="prescription">';
					echo '<ul>';
					echo '<li id="name" style="font-size:20px;">'.$row1["fname"]." ".$row1["lname"].'</li>';
					echo '<li id="rating" style="margin-top:10px;">Rating : ';
					for ($i=$row['rating']; $i>0; $i--) { 
						echo '<img src="star.png" style="width:20px;height:20px;">';
					}
					echo '</li>';
					echo '<li id="comment" style="margin-top:10px;">Comment :</li>';
					echo '<li style="margin-top:10px;">'.$row['comment']."'</li>";
					echo '</ul></div>';
				}
			}
			?>
		</div>
	</div>
</body>
</html>