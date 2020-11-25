<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>NETTUTS > Sign up</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
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
          <a href="#" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
      </div>
    </nav>
    
    <center>

           
    <!--UI-->
    <div class="container" style="padding:100px;">
      <div class="row">
        <div class="col-sm-12" style="border:2px solid gray;">
          <center>
          <div class="page-header">
            <h2 class="specialHead">ACCOUNT VERIFICATION</h2><br>
            <img src="images/verified.png" alt="admin" width="150px" height="150px"><br><br>
            <div id="wrap">
            <!--php code-->
                    <?php
                    
                    $db_host = 'localhost';
                    $db_username = 'root';
                    $db_password = '';
                    $db_name = 'onlinevoting';
                    $conn = mysqli_connect($db_host,$db_username,$db_password,$db_name);
                        if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
                            // Verify data
                            $email = $_GET['email']; // Set email variable
                            $hash = $_GET['hash']; // Set hash variable
                            $sql = "SELECT email, hash, active FROM voter WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
                            $res = mysqli_query($conn,$sql);
                            $match  = mysqli_num_rows($res);  
                            echo $email; // Display how many matches have been found -> remove this when done with testing ;)
                            
                            if($match > 0){
                                // We have a match, activate the account
                                $sql = "UPDATE voter SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
                                $res = mysqli_query($conn,$sql);

                                echo '<div class="statusmsg normalFont">Your account has been activated, you can now Login to caste your vote! <br> Thankyou for Registering!</div>';
                            }else{
                                // No match -> invalid url or account has already been activated.
                                echo '<div class="statusmsg normalFont">The URL is either invalid or you already have activated your account.</div>';
                            }
                        }else{
                            // Invalid approach
                            echo '<div class="statusmsg normalFont">Invalid approach, please use the link that has been send to your email.</div>';
                        }   
                        
                    ?>
            
                </div>

                <br>
                <div class="statusmsg normalFont">You may close this tab and go to SIGN UP page of our website.</div>
          </center>
          </div>
        </div>
      </div>
    </div>
  
  </center>
</body>
</html>