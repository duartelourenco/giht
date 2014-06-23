<?php

if(isset($_POST["m"])){

	$mes = $_POST["m"];
	
	$numodays = cal_days_in_month(CAL_GREGORIAN, $mes, 2014);

	$con=mysqli_connect("localhost","root","","giht");
	
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	echo "<div class='table-responsive'><table class='table table-bordered'>
	<thead>
	<th class='text-center'>Name</th>"; 
	for ($x = 1; $x <= $numodays; $x++){ 
		echo "<th class='text-center'>" . $x ."</th>";
	}
	echo "</thead><tbody>";
	
	if ($result = mysqli_query($con, "SELECT id FROM members")) {

		$row_cnt = mysqli_num_rows($result); 
			
		for ($x = 2; $x <= $row_cnt; $x++){ 
			$query = mysqli_query($con, "SELECT mem_username, tday, iht FROM work WHERE mem_id=".$x." ORDER BY tday ASC");
			$results = mysqli_num_rows($query);
			if ($results != ""){
				$data = mysqli_fetch_array($query);
				$name_query = mysqli_query($con, "SELECT username FROM members WHERE id=".$x);
				$name = mysqli_fetch_array($name_query);
				echo "<tr><td class='text-left' width='120px'>".$name['0']."</td>";
				for ($day = 1; $day <= $numodays; $day++){
					$query = mysqli_query($con, "SELECT mem_username, tday, iht FROM work WHERE mem_id=".$x." AND tday='2014-".$mes."-".$day."'");
					$anyday = mysqli_num_rows($query);
					$iht = mysqli_fetch_array($query);
					if ($anyday == "0"){
						echo "<td class='text-center' width='40px'>&nbsp</td>";
					} elseif ($iht["iht"] == "0") {
						echo "<td class='text-center' width='40px'>&nbsp</td>";
					} else {
						echo "<td class='text-center' width='40px'>".$iht['iht']."</td>";
					}
				}
			}
				
		}
		
	}

	echo "</tr>";
	echo "</table></div>";

	mysqli_close($con);

	exit();
}
?>*/