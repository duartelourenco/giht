<?php

	$con=mysqli_connect("localhost","root","","giht");
		
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
		
	$result = mysqli_query($con, "SELECT id, name FROM members ORDER BY name ASC");
	echo "<script>";
	echo "function addTable(){";
	echo "	var table = document.getElementById('addiht');";
	echo "	var row = table.insertRow(-1);";
	echo "	var cell1 = row.insertCell(0);";
	echo "	var cell2 = row.insertCell(1);";
	echo "	var cell3 = row.insertCell(2);";
	echo "	var cell4 = row.insertCell(3);";
	echo "	var cell5 = row.insertCell(4);";
	echo "	cell1.innerHTML = '<select class='form-control'>';";
	echo "                     		<option>1</option>";
	echo "                     		<option>2</option>";
	echo "                     		<option>3</option>";
	echo "                     		<option>4</option>";
	echo "                     		<option>5</option>";
	echo "                     </select>";
	echo "	cell2.innerHTML = '<select class='form-control'></select>';";
	echo "	cell3.innerHTML = '<select class='form-control'></select>';";
	echo "	cell4.innerHTML = '<select class='form-control'></select>';";
	echo "	cell5.innerHTML = '<select class='form-control'></select>';";
	echo "}  ";
	echo "</script>";
	
?>