<?php
//viewcomments
 //set all data variables to blank by default
    $venue=$date=$time=$price=$tickets=$success=$reply="";
    $venueError=$dateError=$timeError=$priceError=$ticketError=$replyError="";
    $flag=0;
session_start();
//checking for logged in admin 
if(!isset($_SESSION['loggedInAdminUser'])){
    //send them to login
    header("Location: login.php");
}

//connect to database and functions
include('database/connection.php');
include('database/functions.php');

//query and result
$getName= $_SESSION['loggedInAdminUser'];
$query="SELECT * FROM fanComments";
$resultComm=mysqli_query($conn,$query);

$alertMessage="";

if(isset($_GET['alert'])){
    if($_GET['alert']=='updated'){
        $alertMessage="<div class='alert alert-warning'>Client Info updated!<a class='close' data-dismiss='alert'>&times;</a></div>";
    }
}

//addevents

//setting error variables
if(isset($_POST['add'])){
    //check for any blank inout whih are required
    if(!$_POST['venue']){
        $venueError="Please enter Venue<br>";
    }
    else{
        $venue=validateFormData($_POST['venue']);
    }
    
    if(!$_POST['date']){
        $dateError="Please select Date<br>";
    }
    else{
        $date=validateFormData($_POST['date']);
    }
    
    if(!$_POST['time']){
        $timeError="Please select Time<br>";
    }
    else{
        $time=validateFormData($_POST['time']);
    }
    
    if(!$_POST['price']){
        $priceError="Please enter Price<br>";
    }
    else{
        $price=validateFormData($_POST['price']);
    }
    if(!$_POST['noOfTickets']){
        $ticketError="Please enter No of Tickets available<br>";
    }
    else{
        $tickets=validateFormData($_POST['noOfTickets']);
    }
    
    if($venue && $date && $time && $price){
        $query="INSERT INTO events(venue,date,time,price,noOfTickets) VALUES('$venue','$date','$time','$price','$tickets')";
        if(mysqli_query($conn,$query)){
            //refresh client.php page with newdata and with query string
            echo "<div class='alert alert-success'>Event added!</div>";
        }
        else{
            echo "error".$query."<br>".mysqli_error($conn);
        }
    }
}
//view booked tickets
$queryBooked="SELECT * FROM tickets";
$resultBooked=mysqli_query($conn,$queryBooked);


include_once('header/headerAdmin.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>    
  <title>Admin Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<!--  <link href="css/band.css" rel="stylesheet" type="text/css">-->
  <link href="css/style-internal.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container">
    <h2></h2>       
    <ul class="nav nav-tabs nav-justified">
    <li><a data-toggle="tab" href="#viewcomments" class="active">View Comments</a></li>
    <li><a data-toggle="tab" href="#addevents">Add Events</a></li>
    <li><a data-toggle="tab" href="#viewbookedtickets">View Booked Tickets</a></li>
    </ul>
    <div class="tab-content"><!--tab-content-->
        <!--View Comments-->
       <div id="viewcomments" class="tab-pane fade in active">
           <h3><center>Lets View and Reply to our Fabulous Fans!</center></h3>
        <?php
        if($alertMessage){
            echo $alertMessage;
        }
        ?>
        <table class="table table-striped table-bordered table-hover table-responsive">
            <tr>
                <th>Name</th>
                <th>Comments</th>
                <th>Text box</th>
                <th>Reply</th>
            </tr>
            <?php
            if(mysqli_num_rows($resultComm)>0){
                //fetching the comments from fancomments 
                while($row = mysqli_fetch_assoc($resultComm)){
                    echo "<form action = '' method = 'POST'>";
                    echo "<tr>";
                    echo "<td>".$row['name']."</td><td>".$row['comments']."
                    </td>";
                    $id=$row['id'];
                    echo "<input type='hidden' name='idComm' value='$id'>";//put the id of the comment here for indivdual reply processing 
                    echo "<td><input type='text' name='replyText'></td>";
                    //echo '<td><a href="admin-page.php?id='.$row['id'].'"type="button" class="btn btn-danger btn-sm" name="reply"><span class="glyphicon glyphicon-send"></span></a></td>';
                    echo '<td><input type = "submit" value= "comment" name = "reply"></td>';
                    echo "</tr>";
                    echo "</form>";
                }
                //replying to comment which will be stored in fancomments itself
                if(isset($_POST['reply'])){
                    if(!$_POST['replyText']){
                            echo "<p style='color:crimson;'>Enter your reply</p>";   
                    }
                    else{
                        $reply=validateFormData($_POST['replyText']);
                    }
                    if($reply){

                        $replyId=$_POST['idComm'];
                        $replyQuery="update fancomments set reply='$reply' where id=$replyId";
                        //$replyResult=mysqli_query($conn,$resultQuery);
                        if(mysqli_query($conn,$replyQuery)){
                            echo "<div class='alert alert-success'>Replyed Successfully!</div>";
                        }
                        else{
                            echo "<div class='alert alert-danger'>Error!".mysqli_error($conn)."</div>";
                        }
                    }
                }
            }
            else{
                    echo "<div class='alert alert-warning'>You have no Messages!</div>";
            }

            ?>

            </table>        
        </div><!--viewcomments-->
        <!--Add events-->
        <div id="addevents" class="tab-pane fade">

        <?php
        if($venueError || $dateError || $timeError || $priceError){
        ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>ERROR<br></strong><?php echo $venueError.$dateError.$timeError.$priceError;?>
            </div>
       <?php 
        }  
        ?>
                <h1>Add Events</h1>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

                        <label for="venue">Venue</label>
                        <input type="text" class="form-control input-lg" id="venue" name="venue">

                        <label for="date">Date</label>
                        <input type="date" class="form-control input-lg" id="date" name="date" min="<?php echo date("m-d-y");?>">

                        <label for="time">Time</label>
                        <input type="time" class="form-control input-lg" id="time" name="time">

                        <label for="price">Price</label>
                        <input type="text" class="form-control input-lg" id="price" name="price">

                        <label for="noOfTickets">No Of Tickets</label>
                        <input type="number" class="form-control input-lg" id="noOfTickets" name="noOfTickets">
                        <br>
                        <a href="admin-page.php" type="button" class="btn btn-lg btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-lg btn-danger pull-right" name="add">Add Event</button>
                </form>
            </div><!--addevents-->

            <!-- View booked tickets-->
            <div id="viewbookedtickets" class="tab-pane fade">
                <h3>Lets See Tickets Booked!</h3>
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
                        <th>No of Tickets Booked</th>
                        <th>Email</th>
                    </tr>
                    <?php
                    if(mysqli_num_rows($resultBooked)>0){
                        //gettings from tickets database
                        while($row = mysqli_fetch_assoc($resultBooked)){
                            echo "<tr>";
                            echo "<td>".$row['venue']."</td><td>".$row['date']."
                            </td><td>".$row['time']."</td><td>".$row['price']."</td><td>".$row['ticketsBooked']."</td><td>".$row['email']."</td>";
                            echo "</tr>";
                        }
                    }
                    else{
                            echo "<div class='alert alert-warning'>No events!</div>";
                        }
                    ?>
                </table>
        </div><!--booked tickets-->
    </div><!--tab-content-->
</div><!--container-->
