<?php

	$con=mysqli_connect("localhost","root","","giht");
	
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
		
	echo "<div class='table-responsive'><table id='addiht' class='table table-hover table-condensed' align='center'><thead><th>Funcionário</th><th>Situação</th><th>IHT</th><th>Extra</th><th>Sub. Refeição</th></thead>"; 
		
	echo "<tbody class='table-hover'>";
	echo "<tr>";
	echo "<td><select class='form-control' /></td>";
	echo "<td><select class='form-control' /></td>";
	echo "<td><select class='form-control' /></td>";
	echo "<td><select class='form-control' /></td>";
	echo "<td><select class='form-control' /></td>";
	echo "</tr>";
	echo "</tbody>";
	echo "</table>";
	echo "</div>";

	
	echo "<button onClick='addTable()'>Push</button>";
	
	mysqli_close($con);

	exit();


?>