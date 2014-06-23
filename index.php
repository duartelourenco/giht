<?php
include_once("php_includes/check_login_status.php");

// If user is already logged in, header that weenis away
if($user_ok == true){
	header("location: user/?u=".$_SESSION["username"]);
    exit();
}



// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["user"])){
	// CONNECT TO THE DATABASE
	include_once("php_includes/db_conx.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
	$user = $_POST['user'];
	$p = $_POST['p'];
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// FORM DATA ERROR HANDLING
	if($user == "" || $p == ""){
		header( "refresh:0;url=?m=missing" );
        exit();
	} else {
	// END FORM DATA ERROR HANDLING
		$sql = "SELECT id, username, password FROM members WHERE username='".$user."' AND activated='1' LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
		$db_id = $row[0];
		$db_username = $row[1];
        $db_pass_str = $row[2];
		if($p != $db_pass_str){
			echo "badpass";
			exit();	
		} else {
			// CREATE THEIR SESSIONS AND COOKIES
			$_SESSION['id'] = $db_id;
			$_SESSION['username'] = $db_username;
			$_SESSION['password'] = $db_pass_str;
			setcookie("id", $db_id, strtotime( '+2 days' ), "/", "", "", TRUE);
			setcookie("username", $db_username, strtotime( '+2 days' ), "/", "", "", TRUE);
    		setcookie("password", $db_pass_str, strtotime( '+2 days' ), "/", "", "", TRUE); 
			// UPDATE THEIR "IP" AND "LASTLOGIN" FIELDS
			$sql = "UPDATE members SET ip='$ip', lastlogin=now() WHERE username='$db_username' LIMIT 1";
            $query = mysqli_query($db_conx, $sql);
			echo $db_username;
		    exit();
		}
	}
	exit();
}
?>
<!-- END OF PHP -->

<!-- START HTML -->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Log In</title>

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/signin.css">


</head>
<body>

<div class="container" id="body">
	<form class="form-signin" role="form" id="loginform" onsubmit="return false;">
		
		
		
		<img src="img/logo.png" class="img-thumbnail center-block" width="50%"><br /><br />
		<input type="text" class="form-control" id="user" placeholder="Utilizador" required autofocus />
		<input type="password" class="form-control" id="pass" placeholder="Password" required />
		<br />
		<button class="btn btn-lg btn-primary btn-block" id="loginbtn" onclick="login()">Continuar</button>
		<br />
		<?php include_once("php_includes/errors.php"); ?>
		
	</form>

</div>







<!--           SCRIPT LOADING TIME                   -->

<script src="js/main.js"></script>
<script src="js/ajax.js"></script>

<script>
function emptyElement(x){
	_(x).innerHTML = "";
}

function login(){
	var user = _("user").value;
	var p = _("pass").value;
	if(user == "" || p == ""){
		window.location = "?m=missing";
	} else {
		var ajax = ajaxObj("POST", "index.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            if(ajax.responseText.trim() == "login_failed"){
					_("loginbtn").style.display = "block";
				} else if (ajax.responseText == "badpass"){
					window.location = "?m="+ajax.responseText;
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

</body>
</html>