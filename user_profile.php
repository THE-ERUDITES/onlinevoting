<?php 
	session_start();
	$db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "onlinevoting";
    $conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
    if (!$conn) {
    die("Connection failed!");
    }
    echo "<h1>Voter's Profile</h1>";
    echo('<table>
           <tr>                
                <th>Voter ID</th>
                <td>'.$_SESSION["voter_id"].'</td>
            </tr>
            <tr>                
                <th>Name</th>
                <td>'.$_SESSION["name"].'</td>
            </tr>
            <tr>                
                <th>Age</th>
                <td>'.$_SESSION["age"].'</td>
            </tr>
            <tr>                
                <th>Email ID</th>
                <td>'.$_SESSION["email"].'</td>
            </tr>
        </table>' );
        if(isset($_POST['castvote']))
        {
            $email = $_SESSION['email'];
            $sql="SELECT * FROM voter WHERE email = '$email' ";
            $result= mysqli_query($conn,$sql);
            $voter_info=mysqli_fetch_all($result,MYSQLI_ASSOC);
            $flag= $voter_info[0]['flag'];
            if($flag == 0)
            {
                header("location: vote.php");
            }
            else{
                echo "<script>alert('You have already voted once!');</script>";
            }          
        }
    
        
        if(isset($_POST['logout']))
        {
        session_unset();
        session_destroy();
        header("location: index.html");
        }    
        ?>
<!DOCTYPE html>
<html>
<head>
<title>Profile Page</title>
</head>
<body>
<form action="user_profile.php" method="POST">
<input type="submit" name="castvote" value="Continue to Voting">
</form>
<form action="user_profile.php" method="POST">
<input type="submit" name="logout" value="LOGOUT">
</form>
</body>
</html>

