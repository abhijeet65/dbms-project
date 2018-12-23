<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname ="test";
 
 $name = $_POST['name'];
 $domain = $_POST['domain'];
 $yoe = $_POST['yoe'];
 
 
 $conn = new mysqli($servername,$dbusername,$dbpassword,$dbname);
 
 if($conn->connect_error){
	 die("Connecion failed: " . $conn->connect_error);
	 
 }
 
 $sql = "update doctor set domain='$domain',yoe='$yoe' where name='$name'";
 
 if ($conn->query($sql) === TRUE) {
	 echo "<h1>Record Updated!</h1>";
 } else {
	 echo "Error: " , $sql . "<br>" . $conn->error;
	 
 }
 
 $conn->close();
 ?>