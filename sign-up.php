<?php
require_once 'dbconfig.php';

if($user->is_loggedin()!="")
{
    $user->redirect('home.php');
}

if(isset($_POST['btn-signup']))
{
   $uname = trim($_POST['txt_uname']);
   $umail = trim($_POST['txt_umail']);
   $upass = trim($_POST['txt_upass']);
   $con_pass = trim($_POST['txt_con_pass']);
   $car_id = 0;    
 
   if($uname=="") {
      $error[] = "provide username !"; 
   }
   else if($umail=="") {
      $error[] = "provide email id !"; 
   }
   else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Please enter a valid email address !';
   }
   else if($upass=="") {
      $error[] = "provide password !";
   }
   else if(strlen($upass) < 6){
      $error[] = "Password must be atleast 6 characters"; 
   }
   else if($upass != $con_pass){
       $error[] = "Passwords do not match";
   }
   else
   {
      try
      {
         $stmt = $DB_con->prepare("SELECT user_name,user_email FROM user WHERE user_name=:uname OR user_email=:umail");
         $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['user_name']==$uname) {
            $error[] = "sorry username already taken !";
         }
         else if($row['user_email']==$umail) {
            $error[] = "sorry email id already taken !";
         }
         else
         {
            if($user->register($uname,$umail,$upass,$car_id)) 
            {
                $user->redirect('sign-up.php?joined');
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  } 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    
    
<title>Sign up : cleartuts</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post">
            <h2>Sign up.</h2><hr />
            <?php
            if(isset($error))
            {
               foreach($error as $error)
               {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
               }
            }
            else if(isset($_GET['joined']))
            {
                 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                 </div>
                 <?php
            }
            ?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail ID" value="<?php if(isset($error)){echo $umail;}?>" />
            </div>
            <div class="form-group">
             <input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
            </div>
            
            <div class="form-group">
             <input type="password" class="form-control" name="txt_con_pass" placeholder="Confirm Password" />
            </div>
            
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">
                 <i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br />
            <label>have an account ! <a href="index.php">Login</a></label>
        </form>
       </div>
</div>

</body>
</html>