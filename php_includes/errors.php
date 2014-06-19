<?php

if(isset($_GET["err"])){
	switch ($_GET['err']) {
		case "missing":
			echo "<div class='alert alert-warning' align='center'><strong>Campos por preencher.</strong><br />Por favor, preencha todos os campos.";
			break;
		case "badpass":
			echo "<div class='alert alert-danger' align='center'><strong>Utilizador ou Password está errado.</strong><br />Tente novamente.</div>";
			break;
		case "notuser":
			echo "<script> makeNoty('<center><b>Este utilizador não existe.</b><br /> Volte a tentar.', 'warning', 2500); </script>";
			break;
		case "nologon":
			echo "<script> makeNoty('<center>Por favor, faça login primeiro.', 'information', 2800); </script>";
			break;
		case "logout":
			echo "<script> makeNoty('<center>Sessão finalizada com sucesso.', 'success', 2500); </script>";
			break;
		case "notadmin":
			echo "<script> makeNoty('<center>Só o Administrador tem acesso a esta página.', 'information', 2500); </script>";
			break;
	}
}

?>