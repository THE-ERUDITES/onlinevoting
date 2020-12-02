<?php
session_start();
include 'config.php';
    #$db_host = 'localhost';
    #$db_username = 'root';
    #$db_password = '';
    #$db_name = 'onlinevoting';
    $conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);

    if(!$conn){
        die("Connection Failed.");
    }
    else{
        echo "Connected Successfully!<br><br>";
    }
    $sql = "Select * from candidate";
    $result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control Panel</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <style>
        table,th,td{
            text-align:center;
            padding: 10px;
        }

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
  	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse
    " role="navigation">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-header">
          <a href="#" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
        </div>

        <div class="collapse navbar-collapse" id="example-nav-collapse">
          <ul class="nav navbar-nav">
          <li><a href="adminlanding.php"><span class="subFont"><strong>Admin Info</strong></span></a></li>
             <li><a href="candidates.php"><span class="subFont"><strong>Candidates List</strong></span></a></li>
            <li><a href="statistics.php"><span class="subFont"><strong>Statistics</strong></span></a></li>     
          </ul>
          

          <span class="normalFont"><a href="index.html" class="btn btn-success navbar-right navbar-btn"><strong>Sign Out</strong></a></span></button>
        </div>

      </div> 
    </nav>  
  <!-- end of container -->

    <!--candidate list -->
    <div class="container" style="padding:100px 30px 20px 30px ;">
      <div class="row">
        <div class="col-sm-12" style="border:2px solid gray;">
        <center>
          <div class="page-header">
            <h2 class="specialHead" ></span>CANDIDATE LIST</h2><br>
            
            <!--table-->
            <table style = "width:90%;border-collapse: collapse;" border="3px">
                <tr>
                <th>candidate ID</th>
                <th>candidate name</th>
                <th>Update Photo</th>
                <th>Political Party</th>
                <th>Constituency</th>
                <th>Description</th>
                <th>Update Data</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                    <td><?php echo $row["cid"]; ?></td>
                    <td><?php echo $row["cname"]; ?></td>
                    
                    <td>
                      <img src="<?php echo ('images/'.$row["cphoto"]); ?>" alt="img not found!" width="60px" height="60px" >
                        <a href='cupdatephoto.php?cid=<?php echo $row["cid"]; ?>' class='pull-right photo'><span class="glyphicon glyphicon-edit"></span></a>
                    </td>
                    
                    <td><?php echo $row["party"]; ?></td>
                    <td><?php echo $row["const"]; ?></td>
                    <td><?php echo $row["body"]; ?></td>
                    
                    <td>               
                          <button type="button" name="update" class="btn btn-info"><a href="cupdatedata.php?cid=<?php echo $row["cid"]; ?>">update</button>
                      </form>
                    </td>
                    </tr>
                <?php } ?>
            </table>
          </div>
      </div>
    </div>
  </div>
  </center>

    <!--tools-->
    <!--tools-->
    <div class="container" style="padding:20px 30px 30px 30px;">
            <!--display button--> 
            <center>
            <button type="button" name="display" class="btn btn-info"><a href="candidates.php"><span class="glyphicon glyphicon-step-backward"></span>DISPLAY LIST</button>
          </center>
    </div>
      


