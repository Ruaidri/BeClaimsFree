<?php
require_once 'dbconfig.php';


if(isset($_POST['btn-confirm']))
{
   
   $noticeNo = trim($_POST['txt_noticeNo']);
   $licenceNo = trim($_POST['txt_licenceNo']);
   $value = trim($_POST['txt_value']);

 
   if($noticeNo=="") {
      $error[] = "provide noticeNo !"; 
   }
   else if($licenceNo=="") {
      $error[] = "provide licenceNo !"; 
   }
   else if($value=="") {
      $error[] = "provide value Number !";
   }
    
    
        
   else
   {
      try
      {
            if($user->clamp($noticeNo,$licenceNo,$value)) 
            {
                $user->redirect('claim_form.php?joined');
            }
         }
     
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
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
    
<title>Help pay my clamp fee</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post">
            
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
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully made payment to your account. <a href='home.php'>View HomePage</a> here
                 </div>
                 <?php
            }
            ?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_noticeNo" placeholder="noticeNo" value="<?php if(isset($error)){echo $noticeNo;}?>" />
                <h7>What is this? <a href = "https://www.dsps.ie/payment/ticket.htm" target = "_blank">Check here</a></h7><hr />
            
            <input type="text" class="form-control" name="txt_licenceNo" placeholder="licenceNo" value="<?php if(isset($error)){echo $licenceNo;}?>" />
            </div>
            <div class="form-group">
             <select class="form-control" name="txt_value" placeholder="value Number" value="<?php if(isset($error)){echo $value;}?>" >
                <option value="20">€20</option>
                <option value="40">€40</option>
                <option value="60">€60</option>
                <option value="80">€80</option>
            </select>
            
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-confirm">
                 <i class="glyphicon glyphicon-open-file"></i>&nbsp;Confirm
                </button>
            </div>
            <br />
            <label>Need to get all your details? <a href="home.php">Go back for now</a></label>
        </form>
       </div>
</div>

</body>
</html>





