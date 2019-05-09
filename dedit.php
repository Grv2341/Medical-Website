<html>
<?php
session_start();
$uid=$_SESSION['uid'];
$conn = new mysqli("localhost", "root", "","medical");
?>
<head>
	<title>Doctor</title>
	<link rel="stylesheet" type="text/css" href="dedit.css">
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
		function validate1(){
  	var x1 = document.forms["form1"]["password1"].value;
  	var x2= document.forms["form1"]["password2"].value;
  	if(x1!=x2){
  		alert("Passwords dont match !");
  	}
  }
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
		<form action="docedit.php" method="get" name="form1">
			<input type="text" name="name1" placeholder="First Name" class="i1" pattern="[A-Za-z]{1,}" required value="<?php echo $row['fname']?>">
			<input type="text" name="name2" placeholder="Last Name" class="i1" pattern="[A-Za-z]{1,}.{0,}" required value="<?php echo $row['lname']?>"><br>
			<input type="password" name="password1" placeholder="Password" class="i1" required>
			<input type="password" name="password2" placeholder="Re-type Password" class="i1" required><br>
    		<select name="special" value="<?php echo $row['special']?>">
      			<option>Pediatrician</option>
      			<option>Obstetrician/Gynecologist</option>
     			<option>Surgeon</option>
      			<option>Psychiatrist</option>
      			<option>Cardiologist</option>
      			<option>Dermatologist</option>
      			<option>Endocrinologist</option>
      			<option>Anesthesiologist</option>
    		</select><br>
			<input type="text" name="hname" placeholder="Hospital Name" required value="<?php echo $row['hname']?>"><br>
			<input type="text" name="cname" placeholder="City" pattern="[A-Za-z]{1,}" required value="<?php echo $row['city']?>"><br>
			<input type="text" name="license" placeholder="License Number" pattern="[A-Za-z0-9]{1,}" required value="<?php echo $row['lid']?>"><br>
			<input type="submit" value="Save Changes" class="button" onmouseover="validate1()">
		</form>
	</div>
</body>
</html>