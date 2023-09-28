<?php
	include '../lib/session.php';
	self::init();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/format.php'; ?>
<?php 
	$db= new Database();
	$fm= new format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$username = $fm->validation($_POST['username']);
				$password = $fm->validation($_POST['password']);

				$hashedPassword = md5($password);

				$username = mysqli_real_escape_string($db->link, $username);
				$hashedPassword = mysqli_real_escape_string($db->link, $hashedPassword);


				$query = "SELECT * FROM tbl_use WHERE username='$username' AND password = '$hashedPassword'";
				$result = $db->select($query);
				$result = $db->select($query);

    			if ($result) {
       			 // User found, set session variables
        		$user = mysqli_fetch_assoc($result);
        		Session::set("login", true);
        		Session::set("username", $user['username']);
        		Session::set("userid", $user['userid']);
						header("location:index.php");
						
					}else{
						echo"Username or Password not matched!!";
					}
				}
				
		?>
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>