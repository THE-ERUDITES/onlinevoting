<?php
 session_start();
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "onlinevoting";
    $conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
    if (!$conn) {
    die("Connection failed.");
    }

    if(isset($_POST['submitVote']))
    {
        $party = $_POST('Vparty');
        $sql= "UPDATE candidate SET count+=1 WHERE party='$party' ";
        if (mysqli_query($conn, $sql)) {
            header("location: saveVote.php");
        }
        else
        {
            echo "Error: " . $sql . ":-" . mysqli_error($conn);
        }
    }

    $sql= "SELECT * FROM candidate ";
    $result= mysqli_query($conn, $sql);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voting page</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        table,th,td{
            text-align: left;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row row-content">
            <div class= "col-12">
               <h3>Cast your vote wisely!</h3>
            </div>
        </div>
        <div class = "row row-content">
               <form><table style = "width: 50%;border-collapse: collapse; border=1px" >
               <tr>
                 <th>Party</th>
                 <th>Name</th>
                 <th>Photo</th>
                </tr>
               <?php while($row = mysqli_fetch_assoc($result)) { ?>
               <tr>
               <td>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="Vparty" id='<?php $row["party"] ?>' value="option1">
                  <label class="form-check-label" for='<?php $row["party"] ?>' >Bhartiya Janta Party</label>
                </div></td>
                <td><?php echo $row["cname"]; ?></td>
                <td><?php echo $row["cphoto"]; ?></td>
                </tr>
                <?php } ?>
                </table>
                <div class="form-group-row">
                <input type="submit" class="btn btn-primary" name="submitVote" value="SUBMIT VOTE">
                </div>
                </form>
        </div>
    </div>  
</body> 
</html>      
    
