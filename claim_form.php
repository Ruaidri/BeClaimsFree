<?php
require_once 'dbconfig.php';


if(isset($_POST['btn-make_claim']))
{
   
   $ppsn = trim($_POST['txt_ppsn']);
   $licenceNo = trim($_POST['txt_licenceNo']);
   $date = trim($_POST['txt_date']);
   $vin = trim($_POST['txt_vin']);
   $damage = trim($_POST['txt_damage']);
   $value = trim($_POST['txt_value']);
    
   $location = trim($_POST['txt_location']);
   $involve = trim($_POST['txt_involve']);
   $name = trim($_POST['txt_name']);
   $second_vin = trim($_POST['txt_second_vin']);
   $name_on_payment = trim($_POST['txt_name_on_payment']); 
    
    
 
   if($ppsn=="") {
      $error[] = "provide ppsn !"; 
   }
   else if($licenceNo=="") {
      $error[] = "provide licenceNo !"; 
   }
   else if($date=="") {
      $error[] = "provide date Number !";
   }
   else if($damage==""){
      $error[] = "Provide damage"; 
   }
    
    else if($value==""){
      $error[] = "Provide a value"; 
   }
    
   else if($location=="") {
      $error[] = "provide location";
   }
   else if($involve==""){
      $error[] = "Provide involve"; 
   }
    
    else if($involve=="True" && $name==""){
      $error[] = "Provide a name"; 
   }
    else if($name_on_payment==""){
      $error[] = "Provide a name_on_payment"; 
   }
    
    
        
   else
   {
      try
      {
            if($user->claim($ppsn,$licenceNo,$vin,$damage,$value,$location,$involve,$name,$name_on_payment)) 
            {
                $id = $_SESSION['user_session'];
                
                $user->user_claim($id,$licenceNo);
                
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
    
    <script>
$(document).ready(function() {
  $('#descision').on('change.drop', function() {
    $("#descision").toggle($(this).val() == 'True');
  }).trigger('change.drop');
});
</script>
    
    
    
    
<title>Claim Form</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post">
            <h2>Make a Claim with us.</h2><hr />
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
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully made a claim <a href='home.php'>View HomePage</a> here
                 </div>
                 <?php
            }
            ?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_ppsn" placeholder="ppsn" value="<?php if(isset($error)){echo $ppsn;}?>" />
            
            <input type="text" class="form-control" name="txt_licenceNo" placeholder="licenceNo" value="<?php if(isset($error)){echo $licenceNo;}?>" />
            </div>
            <div class="form-group">
             <input type="text" class="form-control" name="txt_date" placeholder="date Number" value="<?php if(isset($error)){echo $date;}?>" />
            
             <input type="text" class="form-control" name="txt_vin" placeholder="vin" value="<?php if(isset($error)){echo $vin;}?>" />
                <small id="vinHelpInline" class="text-muted">
                    The Vehicle Identification Number can be found on the inside of the driver door.
                </small>
            </div>
            <div class="form-group">
             <input type="textarea" class="form-control" name="txt_damage" placeholder="damage" value="<?php if(isset($error)){echo $damage;}?>" />
            
             <input type="text" class="form-control" name="txt_value" placeholder="value" value="<?php if(isset($error)){echo $value;}?>" />
                
            
            <input type="text" class="form-control" name="txt_location" placeholder="location of accident" value="<?php if(isset($error)){echo $location;}?>" />    
            </div>
            
            <div class="form-group">
                Was another driver involved in the incident?
            <select class="form-control" id="decision" name="txt_involve" placeholder="Was another person involved" value="<?php if(isset($error)){echo $involve;}?>" >
                <option value="False">No</option>
                <option value="True">Yes</option>
                
            </select>
            
            <div id = "drop">
            <input type="text" class="form-control" name="txt_name" placeholder="Name of person involved" value="<?php if(isset($error)){echo $name;}?>" />
            <input type="text" class="form-control" name="txt_second_vin" placeholder="VIN of person involved" value="<?php if(isset($error)){echo $second_vin;}?>" />
            </div>
            </div>
            
            <div class="form-group">
            <input type="text" class="form-control" name="txt_name_on_payment" placeholder="Name on payment check" value="<?php if(isset($error)){echo $name_on_payment;}?>" />
            <div class="form-group">
                
                
                
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-make_claim">
                 <i class="glyphicon glyphicon-open-file"></i>&nbsp;File Claim.
                </button>
            </div>
            <br />
            <label>Need to get all your details? <a href="home.php">Go back for now</a></label>
        </form>
       </div>
</div>

</body>
</html>





