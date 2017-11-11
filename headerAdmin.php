
<!DOCTYPE html>

<html>

    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>The Rock Band</title>

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
    </head>
    
    <body style="padding-top:60px;" id="layout">
            
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
<!--        <div class="container   ">-->
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class ="navbar-brand" href="admin-page.php"><strong>Admin Page</strong></a>
                </div>
                
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <?php
                    if(isset($_SESSION['loggedInAdminUser'])){
                        ?>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <p class="navbar-text">Hello,<?php echo $_SESSION['loggedInAdminUser'];?></p>
                        <li><a href="logout.php">Log out</a></li>
                    </ul>
                    <?php
                    }
                    else{
                    ?>
                    <ul class="nav navbar navbar-nav navbar-right">
                    <li><a href="login.php">Log in</a></li>
                    </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </nav>
