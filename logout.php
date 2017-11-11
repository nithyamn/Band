<?php
session_start();//if not done will throw undefined SESSION

//did the users brower send a cookie for that session
if(isset($_COOKIE[session_name()])){
    //empty the cookie also
    setcookie(session_name(),'',time()-86400,'/');//time()+(30*86400)) ths makes the cookie expire in 30 days(time in secs), / can be accesed anywer from the page /php only files within php
}
//clear all session variables
session_unset();
//$_SESSION['name']="" particular var unset;

//afterclearing it is important to destroy the session 
session_destroy();
//echo "Successfully logged out<br/>";

//print_r($_SESSION);
//echo "<p><a href='index.php'>Log back in</a></p>";
header("location:home.php");
?>
<!DOCTYPE html>

<html>

    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Address book</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        
        <!--Custom CSS-->
<!--        <link href="../style.css" type="text/css" rel="stylesheet">-->
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .container{
                border:solid 1px #333;
                width:500px;
                text-align:center;
                margin-top:30px;
            }
        </style>
    </head>
<body>
    <div class="container">
        <p class="lead">Logged out successfuly</p>
        <p>
            <a href="login.php" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-user"></span>Login!</a>
        </p>
    </div>
</body>