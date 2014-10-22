<?php

include_once("../php_includes/check_login_status.php");

// Initialize any variables that the page might echo
$u = "";
$birthd = "";
$br = "";
$dg = "";
$dp = "";
$cl = "";
$ph = "";
$email = "";
$lg = "";

// Make sure the _SESSION username is set, and sanitize it
if(isset($_SESSION["username"])){
	$u=preg_replace('#[^a-z0-9]#i', '', $_SESSION['username']);
} else if(isset($_GET["u"])) {
	$u=$_GET["u"];
} else {
	header( "refresh:0;url=../?m=nl" );
	exit();
}

include_once("../php_includes/errors.php");

// Select the member from the users table
$sql = "SELECT * FROM members WHERE username='$u' AND activated='1' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
// Now make sure that user exists in the table
$numrows = mysqli_num_rows($user_query);
if($numrows < 1){
	header( "refresh:0;url=../?m=nu" );
    exit();	
}

// Check to see if the viewer is the account owner
$isOwner = "no";
if($u == $log_username && $user_ok == true){
	$isOwner = "yes";
} else {
	header( "refresh:0;url=../?m=nl" );
	exit();
}

// Fetch the user row from the query above
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
	$name = $row["name"];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>GIHT</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="../css/site.css">
<link rel="stylesheet" href="../css/bootstrap_alt.css">
<script src="../js/main.js"></script>
<script src="../js/ajax.js"></script>

<script>



function getTable() {

	var ajax = ajaxObj("POST", "ajax.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			_("status").innerHTML = ajax.responseText;
		}
	}
	ajax.send();
}



function addTable() {
	
	var table = _('addiht');
	var inc = table.rows.length;
	if (inc > 10) {
		_("statusbutton").style.visibility = "hidden";
	} else {
		var row = table.insertRow(-1);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		
		var ajax = ajaxObj("POST", "row.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				eval(ajax.responseText);
			}
		}
		ajax.send("i="+inc);
		
		cell2.innerHTML = "<select class='form-control'></select>";
		cell3.innerHTML = "<select class='form-control'></select>";
		cell4.innerHTML = "<select class='form-control'></select>";
		cell5.innerHTML = "<select class='form-control'></select>";
	}
}

function dateByExt(dt) {
	
	var date = new Date(dt);
	if (dt==""){
		_("tooltip").innerHTML = "<strong>Introduza uma data</strong>&nbsp&nbsp&nbsp<span class='glyphicon glyphicon-arrow-right'>&nbsp</span>"
	} else {
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		var w = date.getDay();
		if (d<10)
		d="0"+d

		var dayarray = new Array("Domingo","segunda-feira","terça-feira","quarta-feira","quinta-feira","sexta-feira","Sábado");
		var montharray = new Array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
		
		_("tooltip").innerHTML = "<strong>"+dayarray[w]+", "+d+" de "+montharray[m]+" de "+y+"</strong>";
	}
	
}

function loadDate() {
	
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth() + 1;
	var y = date.getFullYear();
	if (d <= 9){ d = "0"+d };
	if (m <= 9){ m = "0"+m };
	var cdate = y + "-" + m + "-" + d;
	_("date").value = cdate;
	dateByExt(cdate);
	
}

function insDB() {
	
	var date = _("date").value;
	var table = _('addiht');
	var rows = table.rows.length - 1;
	for (x = 0; x < rows; x++) {
		var select = _("sel"+x);
		if (select) {
			
		}
	}
	
}

</script>

</head> 
<body onload="loadDate(); getTable();">
<!-- ---------------- START NAVBAR ---------------- -->
<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
	<div class="container">
		<nav role="navigation">
		  <div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			 
			  <a class="navbar-brand" rel="home" href="../" title="Inicio"><img src="../img/logo-w.png" style="max-width:80px; margin-top: -7px;"></a>
			
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Mapa de Horas</a></li>
					<li><a href="../addiht/">Marcação de Horas</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Escalas&nbsp<b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Serviços</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Diárias</a></li>
						</ul>
					</li>
				</ul>
				<ul class="sr-only">
				<li role="presentation" class="divider sr-only"></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><?php echo $name; ?> <span class="glyphicon glyphicon glyphicon-user"></span></a></li>
					<li><a href="../php_includes/logout.php">Terminar Sessão <span class="glyphicon glyphicon glyphicon-remove-circle"></span></a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	</div>
</header>
<!-- ---------------- END   NAVBAR ---------------- -->
<!-- ---------------- START OF BODY ---------------- -->
<br /><br /><br />

<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
			<div class="col-md-4" align="center">
				<div class="input-group">
					<input type="date" id="date" class="form-control" onChange="dateByExt(this.value)" />
					<span id="tooltip" class="input-group-addon"></span>
				</div>
			</div>
		<div class="col-md-4" align="center"></div>
	</div>
	<br /><br />
</div>

<div class="container">
	<div class="row">
		<div class="col-md-6"">
			<p class="text-left">
				<button id="statusbutton" type="button" class="btn btn-primary" onClick="addTable()">Inserir Linha <span class="glyphicon glyphicon-plus"></span></button>
			</p>
		</div>
		<div class="col-md-6 push-right">
			<p class="text-right">
				<button type="button" class="btn btn-success" onClick="insDB()"><strong>Guardar</strong> <span class="glyphicon glyphicon-floppy-save	"></span></button>
			</p>
		</div>
	</div>
</div>	


<div class="container">
	<div class="row">
		<div class="col-xl-12" align="center">
			<div id="status_panel" class="panel panel-default" style="display: block">
				<div id="status" class="panel-body"></div>
				
			</div>
			
		</div>
	</div>
</div>
<!-- ---------------- SCRIPT LOADING ---------------- -->

	
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script src="../js/main.js"></script>


<!-- ---------------- END OF SCRIPT LOADING ---------------- -->
</body>
</html>