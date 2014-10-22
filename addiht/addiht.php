<?php

if(isset($_POST["i"])){

	$i = $_POST["i"];

	$con=mysqli_connect("localhost","root","","giht");
		
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
		
	$result = mysqli_query($con, "SELECT id, name FROM members ORDER BY name ASC");
	
	echo "cell1.innerHTML = \"<select id='sel".$i."' class='form-control'>";
	
	while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
		if ($row[1]!="Administrator"){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
	}
	
	echo "</select>\"";
	
	mysqli_close($con);

	exit();
}
?>