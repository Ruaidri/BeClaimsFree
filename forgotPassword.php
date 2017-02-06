<?php
require './PHPMailer-master/PHPMailerAutoload.php';
include "connection.php"; //connects to the database
if (isset($_POST['user_name'])){
	$user_name = $_POST['user_name'];
    
	$query="SELECT * FROM `user` WHERE user_name='$user_name'";
	$result   = mysqli_query($connection, $query) or die(mysqli_error($connection));
	$count=mysqli_num_rows($result);

	if($count==1)
	{
		$rows=mysqli_fetch_array($result);
		$pass  =  $rows['user_pass'];//FETCHING PASS
		//echo "your pass is ::".($pass)."";
		$to = $rows['user_email'];
		//echo "your email is ::".$email;
		//Details for sending E-mail
		$from = "BE CLAIMS FREE";
		$url = "http://www.beClaimsFree.ie/";
		$body  =  "Be Claims Free password Recovery
		-----------------------------------------------
		Url : $url;
		email Details is : $to;
		Here is your password  : $pass;
		Sincerely,
		Be Claims Free team";
		$from = "ruaidriog@gmail.com";
		$subject = "Personal Password recovered";
		$headers1 = "From: $from\n";
		$headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
		$headers1 .= "X-Priority: 1\r\n";
		$headers1 .= "X-MSMail-Priority: High\r\n";
		$headers1 .= "X-Mailer: Just My Server\r\n";
		$sentmail = mail ( $to, $subject, $body, $headers1 );
	} else {
	if ($_POST ['user_email'] != "") {
	    $fmsg = "Not found your email in our database";
		}
		}
	//If the message is sent successfully, display sucess message otherwise display an error message.
	if($sentmail==1)
	{
		$smsg = "Your Password Has Been Sent To Your Email Address.";
	}
		else
		{
		if($_POST['user_email']!="")
		$nmsg = "Cannot send password to your e-mail address.Problem with sending mail...";
	}
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="styles/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'> <!--Jumbo text-->
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>  <!--jumbo box-->
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> <!-- Navbar Text -->
    
<title>New Password</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
     <div class="form-container">
<form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Forgot Password</h2>
        <div class="input-group">
	  <span class="input-group-addon" id="basic-addon1">username</span>
	  <input type="text" name="user_name" class="form-control" placeholder="user_name" required>
	</div>
	<br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Forgot Password</button>
        <a class="btn btn-lg btn-primary btn-block" href="index.php">Login</a>
</form>
    </div>
    </body>
</html>