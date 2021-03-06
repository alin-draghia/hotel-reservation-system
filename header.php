<?php

require_once 'my_api.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["logout"])) {
        $val = $_GET["logout"];
        if ($val == 1) {
            logout();
        }
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Hotels Brasov</title>
		<link href="style.css" type="text/css" rel="stylesheet"/>
	</head>
	<body>

		<div id="wrap">
			<div id="header">
				<h1>Hotels in Brasov</h1>
			</div>
			<div id="nav">

				<ul>
					<li>
						<a href="index.php">[Home]</a>
					</li>
					<li>
						<a href="hotels.php">[Hotels]</a>
					</li>
					<li>
						<a href="reservations.php">[Reservations]</a>
					</li>
					<li>
						<a href="login.php">[Login]</a>
					</li>
					<li>
						<a href="contact.php">[Contact]</a>
					</li>
				</ul>

				<span style="float: right; display: inline;"> 
				    <a href="<?php echo $_SERVER['PHP_SELF'] . '?logout=1'; ?>"> 
				        <?php if(get_login_user()){echo "[logout ".get_login_user()."]";} ?>
				    </a> 
				</span>
				<div style="clear: both;"></div>
			</div>

			<div id="sidebar">
				<h2>Menu</h2>
		
				<ul>
					<li>
						<a href="index.php">[Home]</a>
					</li>
					<li>
						<a href="hotels.php">[Hotels]</a>
					</li>
					<li>
						<a href="reservations.php">[Reservations]</a>
					</li>
					<li>
						<a href="login.php">[Login]</a>
					</li>
					<li>
						<a href="contact.php">[Contact]</a>
					</li>
				</ul>

			</div>

			<div id="main">
