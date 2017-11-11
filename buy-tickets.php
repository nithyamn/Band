<?php
session_start();
//check user has logged in or not
if(!$_SESSION['loggedInFanUser']){
    //send user to login page
    header("Location: login.php");
}
//connect to database
include_once('database/connection.php');

//include our custom function file
include_once('database/functions.php');
//setting error variables
$email=$_SESSION['loggedInFanUser'];
$venue=$date=$time=$price=$noOfTickets=$total="";
if(isset($_GET['id'])){
    $getid=$_GET['id'];
    $query="SELECT * FROM events WHERE id=$getid";
    $result=mysqli_query($conn,$query);
    if($result){
        if(mysqli_num_rows($result)>0){
            if(mysqli_num_rows($result)>1){
                 $loginError="<div class='alert alert-danger'>There is some issue in database.Please contact Admin for futher details.<a class='close' data-dismiss='alert'>&times</a></div>";
            }
            else{
                if($row=mysqli_fetch_assoc($result)){
                $venue=$row['venue'];
                $date=$row['date'];
                $time=$row['time'];
                $price=$row['price'];
                $noOfTickets=$row['noOfTickets'];
                }
                else{
                    //password dint verify
                    $loginError="<div class='alert alert-danger'>Error<a class='close' data-dismiss='alert'>&times</a></div>";
                }
            }
        }
    }
    else{
        $loginError="<div class='alert alert-danger'>No such user found in Database.Try again!<a class='close' data-dismiss='alert'>&times</a></div>";
    }

}
$ticketError="";
$ticket="";
if(isset($_POST['buy'])){
   //$name=$email=$phone=$address=$company=$notes="";
    
    //check for any blank inout whih are required
    if(!$_POST['tickets']){
        $ticketError="Please select number of Tickets needed!<br>";
    }
    else{
        $ticket=validateFormData($_POST['tickets']);
    }
    
    //checking if there was there or not
    if($ticket){
        $total=$ticket*$price;
    
        $changeCount = $noOfTickets - $ticket;
    
        $queryCount = "update events set noOfTickets = '$changeCount' where id='".$getid."'";
        //following are not required so we can directly take them as it is
        $resultCount = mysqli_query($conn,$queryCount);
        
        $query="insert into tickets(venue,date,time,price,ticketsBooked,email,total) values('$venue','$date','$time','$price','$ticket','$email','$total')";
        
        $result=mysqli_query($conn,$query);
        //check if query was succesful
        if($result){
            header("location:fan-page.php?ticket-buy=$total");
            //refresh client.php page with newdata and with query string
            //echo "<div class='alert alert-success'>Tickets Booked Successfully! Total Amount:".$total."</div>";
        }
        else{
            echo "error".$query."<br>".mysqli_error($conn);
        }
    }
}
mysqli_close($conn);
include_once('header/headerFan.php');

?>
<div class="container">
  <?php
    if($ticketError){
        ?>
        <div class="alert alert-danger">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
       <?php echo $ticketError;?>
   </div>
   <?php
    }
    ?>
    <h1>Buy Tickets</h1>
    <?php
    $getid=$_GET['id'];
    ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$getid";?>" method="POST">
        <div class="form-group col-md-6">
            <label for="venue">Venue</label>
            <input type="text" class="form-control input-lg" name="venue" value="<?php echo $venue;?>" disabled>
        </div>
        <div class="form-group col-md-6">
            <label for="date">Date</label>
            <input type="text" class="form-control input-lg" name="date" value="<?php echo $date;?>" disabled>
        </div>
        <div class="form-group col-md-6">
            <label for="time">Time</label>
            <input type="text" class="form-control input-lg" name="time" value="<?php echo $time;?>" disabled>
        </div>
        <div class="form-group col-md-6">
            <label for="price">Price</label>
            <input type="text" class="form-control input-lg" name="price" value="<?php echo $price;?>" disabled>
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="text" class="form-control input-lg" name="email" value="<?php echo $email;?>" disabled>
        </div>
        <div class="form-group col-md-6">
            <label for="tickets">No of Tickets Needed</label>
            <input type="number" class="form-control input-lg" name="tickets" min = 1 max="<?php echo $noOfTickets;?>">
        </div>
        <div class="form-group col-md-12">
            <a href="fan-page.php" type="button" class="btn btn-lg btn-warning">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success pull-right" name="buy">Buy</button>
        </div>
    </form>
</div>

