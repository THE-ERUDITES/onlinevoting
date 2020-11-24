<!-- fullname => name
email id=> email
age  => age
username => uname 
voter id=> voter_id
password => password
flag => flag -->

<?php 
	session_start();
	$db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "onlinevoting";
    $conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
    if(!$conn)
    {
    die("Connection Failed");
    }
	$errors=array('name'=>'','email'=>'','age'=>'','uname'=>'','voter_id'=>'','password'=>'','cpassword'=>'','flag'=>'');

	if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $age = $_POST['age'];
		$uname=$_POST['uname'];
		$voter_id=$_POST['voter_id'];
		$password=$_POST['password'];
		$cpassword=$_POST['cpassword'];
        $flag = false;

		$valid=true;
		// if((strlen($name)!=4) or ($id[0]!='U') or !ctype_digit($id[1]) or !ctype_digit($id[2]) or !ctype_digit($id[3])){
		// 		$errors['name']='*InvalnameFormat, Format is UXXX, X is 0-9';
		// 		$valid=false;
		// }
		$sql="SELECT * FROM voter WHERE uname='$uname'";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0){
			$errors['uname']='*name already taken by another user';
			$valid=false;
        }
        $sql="SELECT * FROM govt_db WHERE voter_id='$voter_id'";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)==0){
			$errors['voter_id']='*voter id is not valid';
			$valid=false;
		}

		
			for($i=0;$i<strlen($name);$i++){
				if(!ctype_alpha($name[$i])){
                    if(!ctype_space($name[$i])){
                    $errors['name']='*Full Name can contain only alphabets';
					$valid=false;
					break;
                    }
				}
			}
            if($age <= 17)
            {
                $errors['age']='*age cannot be less than 18';
                $valid = false;
            }

			for($i=0;$i<strlen($uname);$i++) {
				if(!ctype_alpha($uname[$i])){
					$errors['uname']='*Username can contain only alphabets and no blank spaces';
					$valid=false;
					break;
				}
			}
		

		if(strlen($password)<8&&strlen($password)>50){
            
			$errors['password']='*Length must be greater than 8 and less than 50';
			$valid=false;
		}

		if($password!=$cpassword){
			$errors['cpassword']='*Passwords not matching';
			$valid=false;
		}
        
		if($valid){
			if($conn){
                $sql="INSERT INTO voter VALUES('$name','$email','$age','$uname','$voter_id','$password','$flag')";
                $res=mysqli_query($conn,$sql);
				if($res) {
					$_SESSION['name'] = $name;
					$_SESSION['age']=$age;
					$_SESSION['email']=$email;
					$_SESSION['uname']=$uname;
					$_SESSION['voter_id']=$voter_id;
                    $_SESSION['password']=$password;
                    $_SESSION['flag']=$flag;
					//setcookie("name",$name, time() + 60*60*24,'/');
					header("location: index.html");
				}
			}
			mysqli_close($conn);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- <link rel="stylesheet" href="style.css"> -->
    
</head>
<body>
	<h1><u>Sign Up</u></h1>

	<form action="signup.php" method="post">

		<label>Full Name:</label>
		<input type="text" name="name" placeholder="Full Name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>" required>
		<div style="color: red;"><?php echo $errors['name']; ?></div><br><br>

		<label>Age:</label>
		<input type="int" name="age" value="<?php echo isset($_POST["age"]) ? $_POST["age"] : ''; ?>" required>
		<div style="color: red;"><?php echo $errors['age']; ?></div><br><br>

		<label>Username:</label>
		<input type="text" name="uname" value="<?php echo isset($_POST["uname"]) ? $_POST["uname"] : ''; ?>" required>
		<div style="color: red;"><?php echo $errors['uname']; ?></div><br><br>

		<label>Email Id:</label>
		<input type="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" required>
		<br><br>

		<label>Voter ID:</label>
		<input type="int" name="voter_id" value="<?php echo isset($_POST["voter_id"]) ? $_POST["voter_id"] : ''; ?>" pattern="[0-9]{7}" required><br><br>
        <div style="color: red;"><?php echo $errors['voter_id']; ?></div><br><br>
		<label>Password:</label>
		<input type="password" name="password" placeholder="8-50 characters" required>
		<div style="color: red;"><?php echo $errors['password']; ?></div><br><br>

		<label>Confirm Password:</label>
		<input type="password" name="cpassword" required>
		<div style="color: red;"><?php echo $errors['cpassword']; ?></div><br><br>

		<input type="submit" name="submit" value="Submit">

	</form>
    <h3><a href="login.php">Already an user?Log in!</a></h3>
    
</body>
</html>