<?php

if(isset($_GET["m"])){
	switch ($_GET['m']) {
		case "missing":
			echo "<div class='alert alert-warning' align='center'><strong>Campos por preencher.</strong><br />Por favor, preencha todos os campos.</div>";
			break;
		case "badpass":
			echo "<div class='alert alert-danger' align='center'><strong>Utilizador ou Password está errado.</strong><br />Tente novamente.</div>";
			break;
		case "lok":
			echo "<div class='alert alert-success' align='center'><strong>Terminou a sessão com sucesso.</strong></div>";
			break;
		case "nl":
			echo "<div class='alert alert-warning' align='center'><strong>Utilizador sem sessão inicializada.</strong></div>";
			break;
		case "nu":
			echo "<div class='alert alert-danger' align='center'><strong>Utilizador desconhecido.</strong></div>";
			break;	
	}
}

?>