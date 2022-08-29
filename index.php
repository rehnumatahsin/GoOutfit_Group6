<?php
require_once('config.php');
require_once('core/controller.Class.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to GoOutfit</title>
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php if(isset($_COOKIE['id']) && isset($_COOKIE['sess'])){
            $Controller = new Controller;
            if($Controller -> checkUserStatus($_COOKIE['id'], $_COOKIE['sess'])){
                echo $Controller -> printData(intval($_COOKIE['id']));
                echo '<a href="logout.php">Log Out</a>';
            }
            
        }else{ ?>
        <img src="img/logo.png" alt="logo" style="max-width: 150px; margin: 0 auto; display: table;" />
        <div class="main-container">
        <div class="form-container">

            <div class="form-body">
            <h3 class="title"><b>Log in with</b></h3><br><br>
                <form action='' method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label><br>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label><br>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Login</button>
            <br><div><h5>Or</h5></div>
            <div class="social-login">
            <button onclick="window.location = '<?php echo $login_url; ?>'" type="button" class="btn btn-danger">Login with Google</button>
                </div>
            </form>
        <?php } ?>
        <div class="form-footer">
                <div>
                    <span>Don't have an account?</span> <b><a href="index.html">Sign Up</a></b>
                </div>
            </div>
    </div>
    </div>
        </div>
    </div>
</body>
</html>