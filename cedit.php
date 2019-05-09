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
			<li><a href='cmedicine.php'><img src="records.png">Medicines</a></li>
			<li><a href='cpview.php'><img src="file.png">Patients</a></li>
			<li><a href='chemist.php'><img src="house.png">Home</a></li>
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
	$sql="SELECT * FROM chemist where uid='$uid'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	?>
	<div id="body">
		<form name="form3" action="cdedit.php" method="get">
		<input type="text" name="name1" placeholder="First Name" class="i1" pattern="[A-Za-z]{1,}" required value="<?php echo $row['fname']?>">
		<input type="text" name="name2" placeholder="Last Name" class="i1" pattern="[A-Za-z]{1,}" required value="<?php echo $row['lname']?>"><br>
		<input type="password" name="password1" placeholder="Password" class="i1" required>
		<input type="password" name="password2" placeholder="Re-type Password" class="i1" required><br>
		<input type="text" name="sname" Placeholder="Shop name" required value="<?php echo $row['sname']?>"><br>
		<input type="text" name="cname" placeholder="City" pattern="[A-Za-z]{1,}" required value="<?php echo $row['city']?>"><br>
		<input type="text" name="address" placeholder="Shop Address" required value="<?php echo $row['address']?>"><br>
		<input type="text" name="snumber" placeholder="Shop Registeration Number" required value="<?php echo $row['sid']?>"><br>
		<input type="submit" value="Sign Up" onmouseover="validate1()" class="button">
	</form>
	</div>
</body>
</html>