<?php
require_once('config.php');
require_once('core/controller.Class.php');
?>

<div class="box" ><!-- box Starts -->

<div class="box-header" ><!-- box-header Starts -->

<center>

<h1><b>Login to GoOutfit</b></h1>


</center>






</div><!-- box-header Ends -->

<form action="checkout.php" method="post" ><!--form Starts -->

<div class="form-group" ><!-- form-group Starts -->
<div class= "social-login">
          <center> <button style="list-style-type: none;  margin: 30px 0; padding: 0; 
           display: -webkit-box; display: -ms-flexbox; display: flex;
            -ms-flex-wrap: wrap; flex-wrap: wrap; -webkit-box-flex: 1;
            -ms-flex: 1 auto; flex: 1 auto;   background-color: #56385a;
            border-color: #56385a; display: -webkit-box; display: -ms-flexbox;
            display: flex; -webkit-box-pack: center; -ms-flex-pack: center;
            justify-content: right; -webkit-box-align: center; -ms-flex-align: center;
            align-items: center; width: 100%; height: 100%; padding: 20px; color: #e6e6e6; 
            font-weight: bold; text-decoration: none; -webkit-transition: background-color 0.3s;
            transition: background-color 0.3s; font-size: 15px; border-radius: 3px; cursor: pointer;  
            width: 20%; height: 30px; background-repeat: no-repeat; background-size: 30px; 
            margin-right: 5px;  margin-right: 10px;margin-left: 7px; align-content: center; 
            background-image: url('google.png');background-position: left; background-position-x: 18px;" 
            onclick="window.location = '<?php echo $login_url; ?>'" type="button" class="btn btn-danger">Login with Google</button></center>
            <div><center><h5>Or</h5></center></div><br>

<label>Email</label>

<input type="text" class="form-control" name="c_email" required >

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label>Password</label>

<input type="password" class="form-control" name="c_pass" required >

<h4 align="center">

<a href="forgot_pass.php"> Forgot Password </a>

</h4>

</div><!-- form-group Ends -->

<div class="text-center" ><!-- text-center Starts -->

<button name="login" value="Login" class="btn btn-primary" >

<i class="fa fa-sign-in" ></i> Log in


</button>

</div><!-- text-center Ends -->


</form><!--form Ends -->

<center><!-- center Starts -->

<a href="customer_register.php" >

<h3>New ? Sign Up Here</h3>

</a>


</center><!-- center Ends -->


</div><!-- box Ends -->

<?php

if(isset($_POST['login'])){

$customer_email = $_POST['c_email'];

$customer_pass = $_POST['c_pass'];

$select_customer = "select * from customers where customer_email='$customer_email' AND customer_pass='$customer_pass'";

$run_customer = mysqli_query($con,$select_customer);

$get_ip = getRealUserIp();

$check_customer = mysqli_num_rows($run_customer);

$select_cart = "select * from cart where ip_add='$get_ip'";

$run_cart = mysqli_query($con,$select_cart);

$check_cart = mysqli_num_rows($run_cart);

if($check_customer==0){

echo "<script>alert('password or email is wrong')</script>";

exit();

}

if($check_customer==1 AND $check_cart==0){

$_SESSION['customer_email']=$customer_email;

echo "<script>alert('You are Logged In')</script>";

echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";

}
else {

$_SESSION['customer_email']=$customer_email;

echo "<script>alert('You are Logged In')</script>";

echo "<script>window.open('checkout.php','_self')</script>";

} 


}

?>