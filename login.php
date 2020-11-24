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
				$_SESSION['name'] = $name;
				// $_SESSION['fname']=$customers[0]['fname'];
				// $_SESSION['lname']=$customers[0]['lname'];
				// $_SESSION['email']=$customers[0]['email'];
				// $_SESSION['mob']=$customers[0]['mob'];
				$_SESSION['password']=$password;
				//setcookie("name",$customers[0]['fname'], time() + 60*60*24,'/');
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <style>
      .headerFont{
        font-family: 'Ubuntu', sans-serif;
        font-size: 24px;
      }

      .subFont{
        font-family: 'Raleway', sans-serif;
        font-size: 14px;
        
      }
      
      .specialHead{
        font-family: 'Oswald', sans-serif;
      }

      .normalFont{
        font-family: 'Roboto Condensed', sans-serif;
      }
    </style>
</head>
<body>
<div class="container">
  	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
        <div class="navbar-header">
          <a href="index.html" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
      </div>
    </nav>

    
    <div class="container" style="padding-top:150px;">
    	<div class="row">
    		<div class="col-sm-4"></div>
    		<div class="col-sm-4" style="border:2px solid gray;padding:50px;">
    			
    			<div class="page-header">
    				<h2 class="specialHead">Log In</h2>
                </div>
                
          <form action="login.php" method="POST">
      			<div class="form-group">
                      
                    <label>Username:</label>
                    <input type="text" name="uname" class="form-control" required><br><br>

                    <label>Password:</label>
                    <input type="password" name="password" class="form-control" required><br><br>

                    <h5 style="color: red;"><?php echo $error; ?></h5>

      				<button type="submit" name="submit" class="btn btn-block span btn-primary "><span class="glyphicon glyphicon-user"></span> Log In</button>
                    <br><a href="signup.php" class="form-control">New User? SignUp</a>
      			</div>

          </form>
          <br>

    		</div>
    		<div class="col-sm-4"></div>
    	</div>
    </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>