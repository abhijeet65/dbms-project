<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname ="test";
 
 
 
 $domain = $_POST['domain'];
 $yoe = $_POST['yoe'];
 $hname= $_POST['hname'];
 $loc= $_POST['loc'];
 $hrating= $_POST['hrating'];
 $drating=$_POST['drating'];

 
 $conn = new mysqli($servername,$dbusername,$dbpassword,$dbname);
 
 if($conn->connect_error){
	 die("Connecion failed: " . $conn->connect_error);
 }
 //doctors in a particular domain with a particular minimum years of experience
 if($hname==''&&$loc==''&&$hrating==''&&$drating==''){
$result = $conn->query("select * from doctor where domain='$domain' and yoe='$yoe'");	
 if($result->num_rows !=0){
	 echo "<h3><table><tr><td><b>DoctorName\t</td><td><b>Gender</td><td><b>Domain\t</td><td><b>Years Of Experience\t</td></tr></h3>";
	 while($rows = $result->fetch_assoc()){
		 $dname=$rows['name'];
		 $dgender=$rows['gender'];
		 $ddomain = $rows['domain'];
		 $dyoe = $rows['yoe'];
		 
		 echo "<tr><td>$dname\t</td><td>$dgender\t</td><td>$ddomain\t</td><td>$dyoe</td></tr>";
	 }
	 echo "</table>";
	 
 }
else{
	 echo "No results";
 } 
 }
 //list of doctors who have a particular minimum years of experience and hospitals that have a minimum rating
 else if ($hname==''&&$loc==''&&$hrating!=''&&$yoe!=''&&$drating==''){
 $result = $conn->query("select * from hospital join doctor on hospital.hos_id=doctor.hid where hrating>='$hrating' and yoe>='$yoe'");
 if($result->num_rows !=0){
	 echo "<h3><table><tr><td><b>DoctorName\t</td><td><b>Hospital name</td><td><b>Hospital rating\t</td><td><b>Hospital Location\t</td></tr></h3>";
	 while($rows = $result->fetch_assoc()){
		 $doc=$rows['name'];
		 $hname=$rows['hname'];
		 $hrating = $rows['hrating'];
		 $loc = $rows['location'];
		 
		 echo "<tr><td>$doc\t</td><td>$hname\t</td><td>$hrating\t</td><td>$loc</td></tr>";
	 }
	 echo "</table>";
	 
 }
 else{
	 echo "No results";
 }
 }
 //list of doctors who work for a particular hospital
  else if ($hname!=''&&$loc==''&&$hrating==''&&$yoe==''&&$drating==''){
 $result = $conn->query("select * from hospital join doctor on hospital.hos_id=doctor.hid where hname='$hname'");
 if($result->num_rows !=0){
	 echo "<h3><table><tr><td><b>DoctorName\t</td><td><b>Hospital name</td><td><b>Hospital rating\t</td><td><b>Hospital Location\t</td></tr></h3>";
	 while($rows = $result->fetch_assoc()){
		 $doc=$rows['name'];
		 $hname=$rows['hname'];
		 $hrating = $rows['hrating'];
		 $loc = $rows['location'];
		 
		 echo "<tr><td>$doc\t</td><td>$hname\t</td><td>$hrating\t</td><td>$loc</td></tr>";
	 }
	 echo "</table>";
	 
 }
 else{
	 echo "No results";
 }
 }
 //list of hospitals in a particular area
 else if($hname==''&&$loc!=''&&$hrating==''&&$yoe==''&&$drating==''){
	 $result = $conn->query("select * from hospital where location='$loc'");	
 if($result->num_rows !=0){
	 echo "<h3><table><tr><td><b>Hospital Name</td><td><b>hospital Location\t</td><td><b>Hospital Rating\t</td></tr></h3>";
	 while($rows = $result->fetch_assoc()){
		 $hname=$rows['hname'];
		 $hrating = $rows['hrating'];
		 $loc = $rows['location'];
		 
		 echo "<tr><td>$hname\t</td><td>$hrating\t</td><td>$loc</td></tr>";
	 }
	 echo "</table>";
	 
 }
else{
	 echo "No results";
 } 
 }
  //to search for doctors with a particular minimum rating
 else if($hname==''&&$loc==''&&$hrating==''&&$yoe==''&&$drating!=''){
	 $result = $conn->query("select * from patients join doctor on patients.doc_id=doctor.doc_id where doc_rating>='$drating'");	
 if($result->num_rows !=0){
	 echo "<h3><table><tr><td><b>Doctor Name</td><td><b>Gender\t</td><td><b>Domain\t</td><td><b>Doctor Rating\t</td><td><b>Years of experience\t</td><td><b>Patient Name\t</td></tr></h3>";
	 while($rows = $result->fetch_assoc()){
		$dname=$rows['name'];
		 $dgender=$rows['gender'];
		$ddomain = $rows['domain'];
		 $dyoe = $rows['yoe'];
		$doc_rating=$rows['doc_rating'];
		$pname=$rows['pname']; 
		 echo "<tr><td>$dname\t</td><td>$dgender\t</td><td>$ddomain\t</td><td>$doc_rating\t</td><td>$dyoe\t</td><td>$pname\t</td></tr>";
	 }
	 echo "</table>";
	 
 }
else{
	 echo "No results";
 } 
 }
 
 
 else{
	 echo "No results";
 }
 
 $conn->close();
 ?>