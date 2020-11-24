<?php 
	session_start();
	$db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "onlinevoting";
    $conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);

	$error='';
	// if(isset($_COOKIE['logout'])){
	// 	echo "<h3>Good bye, ".$_COOKIE['logout']." !</h3>";
	// 	setcookie("name",'', time() - 60*60*24,'/');
	// 	setcookie("logout",'', time() - 60*60*24,'/');
	// }
	// if(isset($_COOKIE['delete'])){
	// 	echo "<h3>Account deleted!</h3>";
	// 	setcookie("delete",'', time() - 60*60*24,'/');
	// }
	if(isset($_POST['submit'])){
		$uname=$_POST['uname'];
		$password=$_POST['password'];

		if($conn){
			$sql="SELECT * FROM voter WHERE uname='$uname' AND password='$password'";
			$res=mysqli_query($conn,$sql);
			if(mysqli_num_rows($res)>0){
				$voters=mysqli_fetch_all($res,MYSQLI_ASSOC);
				$_SESSION['fname'] = $fname;
				// $_SESSION['fname']=$customers[0]['fname'];
				// $_SESSION['lname']=$customers[0]['lname'];
				// $_SESSION['email']=$customers[0]['email'];
				// $_SESSION['mob']=$customers[0]['mob'];
				$_SESSION['password']=$password;
				setcookie("name",$customers[0]['fname'], time() + 60*60*24,'/');
				header("location: index.html");
			}
			else{
				$error='*Incorrect id/password';
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

	<h1><u>Login</u></h1><br>

	<form action="login.php" method="post">
		
		<label>Username:</label>
		<input type="text" name="uname"><br><br>

		<label>Password:</label>
		<input type="password" name="password"><br><br>

		<h5 style="color: red;"><?php echo $error; ?></h5><br><br>

		<input type="submit" name="submit" value="Login">

	</form>

	<h3><a href="signup.php">New User?SignUp</a></h3>

</body>
</html>