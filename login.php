<?php
include('database/connection.php');
include('database/functions.php');
$loginError=$success=$formEmail=$formPass=$emailError=$passError="";
$flag=0;
if(isset($_POST['login'])){
    //checking for empty fields or email id and apssword
    if(!$_POST['loginEmail']){
        $flag=1;
        $emailError = "Enter a Email";
    }
    else{
        $formEmail = validateFormData($_POST['loginEmail']);
    }
    
    if(!$_POST['loginPass']){
        $flag=1;
        $passError="Enter password";
    }
    else{
         $formPass=validateFormData($_POST['loginPass']);
    }
    
    if($formEmail && $formPass){
        $query="select id,name,email,password,roles from fans where email='".$formEmail."'";
        $result = mysqli_query($conn,$query);
        $count= mysqli_num_rows($result);
        if($count == 1){
            session_start();
            $row=mysqli_fetch_assoc($result);
                $id=$row['id'];
                $userEmail=$row['email'];
                $pass=$row['password'];
                $roles=$row['roles'];
                $name=$row['name'];
                //checking if the logged in user is a Fan or Admin
                //session management is needed in many pages so we are storing imp info in sessions
                if($roles == "fan"){
                    $_SESSION['loggedInFanId']=$id;
                    $_SESSION['loggedInFanUser']=$userEmail;
                    $_SESSION['loggedInFanPass']=$pass;
                    $_SESSION['loggedInFanRoles']=$roles;
                    $_SESSION['loggedInFanName']=$name;
                    header("location: fan-page.php");
                }
                else{
                    $_SESSION['loggedInAdminId']=$id;
                    $_SESSION['loggedInAdminUser']=$userEmail;
                    $_SESSION['loggedInAdminPass']=$pass;
                    $_SESSION['loggedInAdminRoles']=$roles;
                    $_SESSION['loggedInAdminName']=$name;
                    header("location: admin-page.php");
                }
        }
        else{
            if($flag==0)
                $loginError="Wrong username or password";
        }   
    }
}
mysqli_close($conn);

?>

<!DOCTYPE html>

<html>

    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link href="css/band.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        
        <header>
            <nav>
                <div class="clearfix">
                    <ul id="head-li">
                       <li id="home"><a href="home.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li id="band-name">The Rock Band</li>
                        <li><a href="show.php">Show</a></li>
                        <li><a href="register.php">Register</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <footer class="fonts" id="login">
            <h2>Login</h2>          
 
            <div class="clearfix">
                
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <input type="text" name="loginEmail" placeholder="Email">
                    <small><?php echo $emailError;?></small>
                    <br><br>
                    <input type="password" name="loginPass" placeholder="Password">
                    <small><?php echo $passError;?></small>
                    <br><br>
                    <input type="submit" name="login" value="Login">
                </form>
            </div>
            <p>Want to register?<a href="register.php">Register</a></p>
            <center><h3><?php echo $loginError;?></h3></center> 
            <center><h3><?php echo $success;?></h3></center>
        </footer>
    </body>
</html>