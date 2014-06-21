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
	header( "refresh:0;url=http://localhost/tii/login.php?error=nologon" );
	exit();
}

include_once("../php_includes/errors.php");

// Select the member from the users table
$sql = "SELECT * FROM members WHERE username='$u' AND activated='1' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
// Now make sure that user exists in the table
$numrows = mysqli_num_rows($user_query);
if($numrows < 1){
	header( "refresh:0;url=http://localhost/tii/login.php?error=notuser" );	
    exit();	
}

// Check to see if the viewer is the account owner
$isOwner = "no";
if($u == $log_username && $user_ok == true){
	$isOwner = "yes";
} else {
	header( "refresh:0;url=http://localhost/tii/?error=nologon" );
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
</head>
<body>

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
			  <a class="navbar-brand" href="#">Gestão de I.H.T.</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Link1</a></li>
					<li><a href="#">Link2</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
							<li role="presentation" class="divider"></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
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
<div class="container">
<br />
<?php

$month = date("n");
$year = date("y");
echo "<h1>" . $name . " / " . strftime('%B', strtotime($year.".".$month.".1")) . "</h1>";

?>
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
<br />
a
<br />
</div>

<!-- ---------------- SCRIPT LOADING ---------------- -->

<script>
function emptyElement(x){
	_(x).innerHTML = "";
}

function login(){
	var user = _("user").value;
	var p = _("pass").value;
	if(user == "" || p == ""){
		window.location = "?err=missing";
	} else {
		var ajax = ajaxObj("POST", "index.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            if(ajax.responseText.trim() == "login_failed"){
					_("loginbtn").style.display = "block";
				} else if (ajax.responseText == "badpass"){
					window.location = "?err="+ajax.responseText;
				} else {
					window.location = "user/?u="+ajax.responseText;
				}
	        }
        }
        ajax.send("user="+user+"&p="+p);
	}
}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js">


<script src="../js/main.js"></script>
<script src="../js/ajax.js"></script>
<!-- ---------------- END OF SCRIPT LOADING ---------------- -->
</body>
</html>