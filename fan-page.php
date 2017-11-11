<!--This page will allow the fan to comment and book tickets-->
<?php
include('database/connection.php');
include('database/functions.php');
session_start();
//checks if the fan is logged in
if(!isset($_SESSION['loggedInFanUser'])){
    //send them to login
    header("Location: login.php");
}
if(isset($_GET["ticket-buy"])){
    $total = $_GET["ticket-buy"];
    echo "<div class='alert alert-success'>Tickets Booked Successfully! Total Amount:".$total."</div>";
}
$getFanId=$_SESSION['loggedInFanId'];
$fname=$email=$message=$idQuery="";
$fnameError=$emailError=$messageError="";

//for the comment section
if(isset($_POST['send']))
{
    $email = $_SESSION['loggedInFanUser'];
    $fname = $_SESSION['loggedInFanName'];
    if(!$_POST['msg']){;
        $messageError="Enter a message";
    }
    else{
        $message=validateFormData($_POST['msg']);
    }
    if($fname && $email && $message){
        $query="insert into fanComments (id,name,email,comments) values ('$getFanId','$fname','$email','$message')";
        if(mysqli_query($conn,$query))
            echo   "<div class='alert alert-success'>Thankyou for your message!</div>";
        else
            echo "<div class='alert alert-danger'>Some error has occured!".mysqli_error($conn)."</div>";
    }
        
}

//buy tickets


//query and result for the events
$getName= $_SESSION['loggedInFanUser'];
$query="SELECT * FROM events";
$resultEvents=mysqli_query($conn,$query);

$alertMessage="";

//checking for replies and displaying it in fan page
$checkReply="select reply from fancomments where id='".$_SESSION['loggedInFanId']."'";
$checkReplyResult=mysqli_query($conn,$checkReply);
if(mysqli_num_rows($checkReplyResult)==1){
    while($row = mysqli_fetch_assoc($checkReplyResult)){
        if($row['reply']==null)
            echo "";
        else
            echo "<div class='alert alert-success'>You Got a Reply: ".$row['reply']."<a class='close' data-dismiss='alert'>&times;</a></div>";
    }
}

include('header/headerFan.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Fan Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<!--  <link href="css/band.css" rel="stylesheet" type="text/css">-->
  <link href="css/style-internal.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container"><!--Main container-->
   
   <h2 style="text-align:center; text-transform:uppercase;">Welcome <?php echo $_SESSION['loggedInFanName'];?>!</h2>
    <div id="fan-page">
     <!--nav-tabs is a bootstarp element which allaows to have multiple tabs on a page. Active indicates the tab
     which will have focus on reload-->
      <ul class="nav nav-tabs nav-justified">
        <li><a data-toggle="tab" href="#comment" class="active">Comment</a></li>
        <li><a data-toggle="tab" href="#booktickets">Book Tickets</a></li>
      </ul>

      <div class="tab-content"><!--this sets the content of the tabs-->
       <!--Comment Section-->
        <div id="comment" class="tab-pane fade in active"><!--ye id'comment' dala hai thats why the nav-tab will go to the specified tab-->

         <footer class="fonts" id="contact">
                <h2>Contact</h2>
                <p>Fan? Drop a note!</p>

                <div class="clearfix">
                    <ul id="left-float">
                        <li>Mumbai,INDIA</li>
                        <li>Phone:+91 951515638</li>
                        <li>Email: rockband@mail.com</li>
                    </ul>

                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="float-right">
                       <!--The fields have beeen disbaled bcoz we dont want any other person 
                       other than the logged in fan to comment-->
                        <input type="text" placeholder="Name" name="fname" id="name"
                        value="<?php echo $_SESSION['loggedInFanName'];?>" disabled>
                        <small><?php echo $fnameError;?></small>
                        <br><br>
                        <input type="text" placeholder="Email" name="email" id="email" value="<?php echo $_SESSION['loggedInFanUser'];?>" disabled>
                        <small><?php echo $emailError;?></small>
                        <br/>
                        <input type="text" placeholder="Message" id="msg" name="msg">
                        <small><?php echo $messageError;?></small>
                        <br/>
                        <input type="submit" value="Send" id="send" name="send">

                    </form>
                </div>
            </footer>
        </div><!--comment section closed-->

         <!--Book Tickets-->
        <div id="booktickets" class="tab-pane fade"><!--next tab for booking tickets-->
            <h3><center>Want to Buy Tickets?</center></h3>
        <?php
        if($alertMessage){
            echo $alertMessage;
        }
        ?>
        <table class="table table-striped table-bordered table-hover table-responsive">
            <tr>
                <th>Venue</th>
                <th>Date</th>
                <th>Time</th>
                <th>Price</th>
                <th>No of Tickets Available</th>
                <th>Buy</th>
            </tr>
            <!--getting ticket info from the events table-->
            <?php
            if(mysqli_num_rows($resultEvents)>0){
                while($row = mysqli_fetch_assoc($resultEvents)){
                    echo "<tr>";
                    echo "<td>".$row['venue']."</td><td>".$row['date']."
                    </td><td>".$row['time']."</td><td>".$row['price']."</td><td>".$row['noOfTickets']."</td>";
                    //diverting to buytickets page with the id of fan
                    echo '<td><a href="buy-tickets.php?id='.$row['id'].'"type="button" class="btn btn-primary btn-sm">Buy</a></td>';
                    echo "</tr>";
                }
            }
            else{
                    echo "<div class='alert alert-warning'>No events!</div>";
                }
            ?>
        </table>
        </div><!--book tickets closed-->
      </div><!--tab-content closed-->
    </div><!--fan-page closed-->

</div><!--container closed-->

</body>
</html>
