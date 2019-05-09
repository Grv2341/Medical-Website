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
			<li><a href='pdsearch.php'><img src="records.png">Doctor</a></li>
			<li><a href='medical.php'><img src="file.png">Medical Record</a></li>
			<li><a href='patient.php'><img src="house.png">Home</a></li>
		</ul>
	</div>
	<script>
		function validate1(){
  	var x1 = document.forms["form2"]["password1"].value;
  	var x2= document.forms["form2"]["password2"].value;
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
	$sql="SELECT * FROM patient where uid='$uid'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc(); 
	?>
	<div id="body">
		<form name="form2" action="pedit1.php" method="get">
		<input type="text" name="name1" placeholder="First Name" class="i1" pattern="[A-Za-z]{1,}" required value="<?php echo $row['fname']?>">
		<input type="text" name="name2" placeholder="Last Name" class="i1" pattern="[A-Za-z]{1,}" required value="<?php echo $row['lname']?>"><br>
		<input type="password" name="password1" placeholder="Password" required><br>
		<input type="password" name="password2" placeholder="Re-type Password" required><br>
		<select name="blood" value="<?php echo $row['special']?>">
      			<option>A+</option>
      			<option>A-</option>
     			<option>B+</option>
      			<option>B-</option>
      			<option>AB+</option>
      			<option>AB-</option>
      			<option>O+</option>
      			<option>O-</option>
    		</select><br>
		<input type="text" name="aadhar" Placeholder="Aadhar Number" pattern="[0-9]{12}" required value="<?php echo $row['aadhar']?>"><br>
		<input type="text" name="cname" placeholder="City" pattern="[A-Za-z]{1,}" required value="<?php echo $row['city']?>"><br>
		<input type="submit" value="Save Changes" class="button" onmouseover="validate1()">
	</div>
</body>
</html>