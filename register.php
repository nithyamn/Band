<?php
// define variables and set to empty values
include('database/connection.php');
include('database/functions.php');
$nameError = $emailError = $passwordError = $ageError = $phoneError="";
$name = $email = $password = $age = $phone=$roles=$success="";
//validation for registeration
if(isset($_POST['register']))
    {
        if(!$_POST['name']){
            $nameError = "Enter a Name";
        }
        else{
            $name = validateFormData($_POST['name']);
                if(preg_match("/[\d\W]/",$name))
                $nameError="Name should have letters only";
        }
        if(!$_POST['email']){
            $emailError = "Enter a Email";
        }
        else{
             $email = validateFormData($_POST['email']);
             if(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
                 $emailError="Email format invalid";
        }
        
        if(!$_POST['password']){
            $passwordError="Enter Password";
        }
        else{
            $password=validateFormData($_POST['password']);
        }
        
        if(!$_POST['age']){
            $ageError = "Enter Age";
        }
        else{
            $age = validateFormData($_POST['age']);
            if(!preg_match('/\d/', $age))
                $ageError="Age should have only digits";
        }
        if(!$_POST['phn']){
            $phoneError = "Enter Phn number";
        }
        else{
            if(strlen($_POST['phn'])!=10)
                $phoneError="10 digits phone number";
            else
                $phone = validateFormData($_POST['phn']);
        }
        $roles=$_POST['roles'];
        
        if($name && $email && $password && $age && $phone && $roles){
            //checkQuery is used so that not more than one same entry is registered
            $checkQuery="select name,email from fans where email='".$email."'";
            $checkResult=mysqli_query($conn,$checkQuery);
            if(mysqli_num_rows($checkResult)>0){
                $success="This Entry already exists! Try with a new name and email!";
            }
            else{
                $query="insert into fans (name,email,password,age,phone,roles) values('$name','$email','$password','$age','$phone','$roles')";

                if(mysqli_query($conn,$query))
                    $success="Registered Successfully";
                else
                    $success= "Error in registering!".mysqli_error($conn);      
            }
        }
}//isset closed
?>
    
<!DOCTYPE html>

<html>

    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Register</title>

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
        <footer class="fonts" id="reg">
            <div class="clearfix">
                <h2>Register</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                 <input type="text" name="name" placeholder="Name" id="name">
                    <small><?php echo $nameError;?></small>
                    <br/><br/>
                    <input type="text" name="email" placeholder="Email" id="email">
                    <small><?php echo $emailError;?></small>
                    <br/><br/>
                    <input type="text" name="password" placeholder="Password" id="password">
                    <small><?php echo $passwordError;?></small>
                    <br/><br/>
                    <input type="text" name="age" placeholder="Age" id="age">
                    <small><?php echo $ageError;?></small>
                    <br/><br/>
                    <input type="text" name="phn" placeholder="Phone number" id="phn">
                    <small><?php echo $phoneError;?></small>
                    <br/><br/>
                    <input type="hidden" name="roles" id="roles" value="fan">
                    <input type="submit" name="register" value="Sign Up">
            </form>
             <p>Already registered?<a href="login.php">Login</a></p>
            </div>
            <h3><center><?php echo $success; ?></center></h3>
        </footer>
    </body>
</html>