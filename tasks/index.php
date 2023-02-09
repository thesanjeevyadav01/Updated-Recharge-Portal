<?php
include_once 'connection.php';
?>

<?php
$selected= false;
$amount =false;
$value = 0;
$insert = false;
if(isset($_POST['mobilenumber'])){
    $server = "localhost";
    $username = "root";
    $password = "";


     $con = mysqli_connect($server, $username, $password);

     if (!$con){
      die ("connection to this database failed due to " . mysqli_connect_error());

     }
    

    $mobilenumber = $_POST['mobilenumber'];
    $Operators = $_POST['Operators'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO `recharge` . `recharge`(`mobilenumber`, `Operators`, `amount`, `date`) VALUES ('$mobilenumber', '$Operators', '$amount', current_timestamp());";

  

    if($con->query($sql) ==true){
    
      $insert = true;
    }
    else{
      echo "ERROR: $sql <br> $con->error";


    }
    $con->close();

  }
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recharge Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h3>Recharge Portal</h3>
        <p>Recharge or Pay Mobile Bill</p>
        <?php
        if($insert == true){
         echo "<p class='submitMsg' >Thankyou!! Recharge Done</p>";
         }
        ?>
        <form action="index.php" method="post">
            <input type="text" name="mobilenumber" id="mobilenumber" placeholder="Mobile Number">
                
            <select name="Operators" id="Operators" placeholder="Operators">
            <option value="" style="color: grey;">--Select your Operators--</option>
                <option value="JIO">JIO</option>
                <option value="Vodaphone">Vodaphone</option>
                <option value="Idea">Idea</option>
                <option value="Airtel">Airtel</option>
            </select>
               <br>

               <select name="amount" id="amount">
                <option value="" style="color: rgb(150, 140, 140);">--Enter your amount--</option>
                <option value="10">10</option>
                <option value="59">59</option>
                <option value="299">299</option>
                <option value="249">249</option>
             </select>

             <?php
                $selected =$amount ;
                $sql = "select * from info where amount = $selected;";
                $result = mysqli_query($conn, $sql);
                

                 
                     if ($amount) {
                    while($row = mysqli_fetch_assoc($result)){
                        echo $row['package']."<br>";
                    }
            
                }


                ?>
            

           
            <br>


            <button class="btn">Submit</button>
          
            
        </form>
    </div>
</body>
</html>