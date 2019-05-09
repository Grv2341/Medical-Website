<?php
	$conn = new mysqli("localhost", "root", "","medical");
	$uid=$_GET['uname'];
	$pass=$_GET['password'];
    if (isset($_GET['action1'])) {
        $sql="SELECT * FROM doctors WHERE uid='$uid' AND password='$pass'";
        $query=$conn->query($sql);
        $number=$query->num_rows;
        if($number==1){
        	session_start();
        	$_SESSION['uid']=$uid;
    		@include('doctor.php');
        }
       	else{
       		@include('home.html');
       	}
    }
    elseif (isset($_GET['action2'])) {
     	$sql="SELECT * FROM patient WHERE uid='$uid' and pass='$pass'";
        $query=$conn->query($sql);
        $number=$query->num_rows;
        if($number==1){
        	session_start();
        	$_SESSION['uid']=$uid;
    		@include('patient.php');
        }
       	else{
       		@include('home.html');
       	}   
    }
    elseif (isset($_GET['action3'])){
    	$sql="SELECT * FROM chemist WHERE uid='$uid' and pass='$pass'";
        $query=$conn->query($sql);
        $number=$query->num_rows;
        if($number==1){
        	session_start();
        	$_SESSION['uid']=$uid;
    		@include('chemist.php');
        }
       	else{
       		@include('home.html');
       	}
    }
    $conn->close();
?>