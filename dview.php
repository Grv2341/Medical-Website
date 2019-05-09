<html>
<?php
session_start();
$uid=$_SESSION['uid'];
$conn = new mysqli("localhost", "root", "","medical");
?>
<head>
	<title>Doctor</title>
	<link rel="stylesheet" type="text/css" href="dview.css">
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
			<li><a href='doctor.php'><img src="house.png">Home</a></li>
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
			<h1>Reviews & Comments</h1>
			<?php
			$sql="SELECT * FROM drating WHERE did='$uid'";
			$result=$conn->query($sql) or die($conn->error);
			$num=$result->num_rows;
			if($num==0){
				echo "<p id='rating'>No Review or Comments Found.</p>";
			}
			else{
				echo '<ul><li id="rating">Average Rating :';
				$pid=$uid;
				$result1=$conn->query("SELECT * FROM doctors where uid='$pid'") or die($conn->error);
				$row1=$result1->fetch_assoc();
				for ($i=$row['rating']; $i>0; $i--) { 
						echo '<img src="star.png">';
					}
				echo '</li>';
				$sql="SELECT * FROM drating WHERE did='$uid' and rating=1";
				$result1=$conn->query($sql) or die($conn->error);
				$num1=$result1->num_rows;
				echo '<li id="rating">One star :'.$num1.'</li>';
				$sql="SELECT * FROM drating WHERE did='$uid' and rating=2";
				$result1=$conn->query($sql) or die($conn->error);
				$num1=$result1->num_rows;
				echo '<li id="rating">Two star :'.$num1.'</li>';
				$sql="SELECT * FROM drating WHERE did='$uid' and rating=3";
				$result1=$conn->query($sql) or die($conn->error);
				$num1=$result1->num_rows;
				echo '<li id="rating">Three star :'.$num1.'</li>';
				$sql="SELECT * FROM drating WHERE did='$uid' and rating=4";
				$result1=$conn->query($sql) or die($conn->error);
				$num1=$result1->num_rows;
				echo '<li id="rating">Four star :'.$num1.'</li>';
				$sql="SELECT * FROM drating WHERE did='$uid' and rating=5";
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
					echo '<li id="name">'.$row1["fname"]." ".$row1["lname"].'</li>';
					echo '<li id="rating">Rating : ';
					for ($i=$row['rating']; $i>0; $i--) { 
						echo '<img src="star.png">';
					}
					echo '</li>';
					echo '<li id="comment">Comment :</li>';
					echo '<li>'.$row['comment']."'</li>";
					echo '</ul></div>';
				}
			}
			?>
		</div>
	</div>
</body>
</html>