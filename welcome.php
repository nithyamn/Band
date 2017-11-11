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

?>

<html>
    <head>
        <title>Welcome</title>
        <style>
            body{
                background:black;
                color:white;
                
            }
            h1{
                text-align: center;
                font-size: 60px;
            }
            p{
                font-size: 26px;
            }
            div{
                width:800;
                margin:0 auto;
            }
        </style>
    </head>
    <body>
        <div>
            <h1>Welcome Fan!</h1>
            <p>Music:
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem perspiciatis vitae harum quos in, illo, neque repellat tempore commodi praesentium corrupti et similique, dolorum ab iusto quas ullam repudiandae ut?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt magni, ullam accusamus animi optio enim, non doloremque cupiditate at. Nam quidem libero placeat earum architecto inventore aspernatur magni omnis saepe.lorem
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat adipisci consectetur, fuga eaque commodi, voluptatum similique modi, veritatis suscipit odit voluptate explicabo repudiandae necessitatibus reprehenderit ut rem voluptates possimus quis?</p>
        </div>
        <a href="login.php">Logout</a>
    </body>
</html>