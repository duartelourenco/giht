<?php

if(isset($_GET["m"])){
	switch ($_GET['m']) {
		case "missing":
			echo "<div class='alert alert-warning' align='center'><strong>Campos por preencher.</strong><br />Por favor, preencha todos os campos.";
			break;
		case "badpass":
			echo "<div class='alert alert-danger' align='center'><strong>Utilizador ou Password está errado.</strong><br />Tente novamente.</div>";
			break;
		case "lok":
			echo "<div class='alert alert-success' align='center'><strong>Terminou a sessão com sucesso.</strong></div>";
			break;	
	}
}

?>