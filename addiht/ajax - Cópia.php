<?php



	$con=mysqli_connect("localhost","root","","giht");
	
	$date = $_POST["d"];

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
		
	echo "<div class='table-responsive'><table class='table table-hover table-condensed' align='center'><thead><th>Name</th><th>Situação</th><th>IHT</th><th>Extra</th><th>Sub. Refeição</th></thead>"; 
		
	echo "<tbody class='table-hover'>";
	$result = mysqli_query($con, "SELECT id, name FROM members ORDER BY name ASC");
		
	while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
		if ($row[1]!="Administrator"){
			$iht_query = mysqli_query($con, "SELECT mem_id, tday, iht, extra_h1, extra_h2, extra_h3, extra_h4, extra_h5, subs_a, daystatus FROM work WHERE mem_id='". $row[0] ."' AND tday='".$date."'");
			$iht_result = mysqli_fetch_array($iht_query, MYSQLI_ASSOC);

// ---- Coluna dos Nomes ----

			echo "<tr><td>".$row[1]."</td>";
			
// ---- Coluna da Situação ----

			echo "<td><select class='form-control' id='".$row[0]."_status'>";
				for ($x=1; $x<=14; $x++){
					if($iht_result["daystatus"]==""){
						echo "<option value='nv'>Escolher</option>";
					} else if($iht_result["daystatus"]=="FF1493"){
						echo "<option value='FF1493'>Compensação</option>";
					} else if($iht_result["daystatus"]=="808080"){
						echo "<option value='808080'>Dispensa</option>";
					} else if($iht_result["daystatus"]=="DEB887"){
						echo "<option value='DEB887'>Deslocação</option>";
					} else if($iht_result["daystatus"]=="FF8C00"){
						echo "<option value='FF8C00'>Férias</option>";
					} else if($iht_result["daystatus"]=="9932CC"){
						echo "<option value='9932CC'>Imediata</option>";	
					} else if($iht_result["daystatus"]=="6495ED"){
						echo "<option value='6495ED'>Substituição</option>";	
					} else if($iht_result["daystatus"]=="556B2F"){
						echo "<option value='556B2F'>Domingo</option>";
					} else if($iht_result["daystatus"]=="FF69B4"){
						echo "<option value='FF69B4'>2.º Periodo</option>";		
					} else if($iht_result["daystatus"]=="00CED1"){
						echo "<option value='00CED1'>Tolerância/option>";		
					} else if($iht_result["daystatus"]=="FFD700"){
						echo "<option value='FFD700'>Meia-Compensação/option>";		
					} else if($iht_result["daystatus"]=="9ACD32"){
						echo "<option value='9ACD32'>Meia-Compensação/option>";		
					}
				}
			echo "</select></td>";
			
// ---- Coluna do IHT ----

			echo "<td><select class='form-control' id='".$row[0]."_iht'>
					<option value='nv'>Escolher</option>";
			for ($x=1; $x<=16; $x++){
				if($x==$iht_result["iht"]){
					echo "<option value='".$iht_result["iht"]."'>".$iht_result["iht"]."</option>";
				} else {
					echo "<option value='".$x."'>".$x."</option>";
				}
			}
			echo "</select></td>";
			echo "<td>x</td>";
			echo "<td>x</td>";
		}
		
	}		
	echo "</tr>";
	echo "</tbody>";
	echo "</table>";
	echo "</div>";
	
	mysqli_close($con);

	exit();


?>