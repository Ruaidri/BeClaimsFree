<?php
require_once 'dbconfig.php';


if(isset($_POST['btn-register_car']))
{
   $user_id = $_SESSION['user_session'];
    
    echo $user_id;
    
   $title = trim($_POST['txt_title']);
   $first_name = trim($_POST['txt_first_name']);
   $last_name = trim($_POST['txt_last_name']);
   $occupation = trim($_POST['txt_occupation']);
   $date_of_birth = trim($_POST['txt_date_of_birth']);
   $phone_no = trim($_POST['txt_phone_no']);
   $address1 = trim($_POST['txt_address1']);
   $address2 = trim($_POST['txt_address2']);
   $address3 = trim($_POST['txt_address3']);
   $county = trim($_POST['txt_county']); 
 
   if($title=="") {
      $error[] = "provide title !"; 
   }
   else if($first_name=="") {
      $error[] = "provide first_name !"; 
   }
   else if($last_name=="") {
      $error[] = "provide surname !";
   }
   else if($occupation==""){
      $error[] = "Provide occupation"; 
   }
    
   else if($date_of_birth==""){
      $error[] = "Provide a date_of_birth"; 
   }
    else if($phone_no==""){
      $error[] = "Provide a phone_no"; 
   }
    else if($address1==""){
      $error[] = "Provide address"; 
   }
    else if($address2==""){
      $error[] = "Provide address"; 
   }
    else if($county==""){
      $error[] = "Provide a county"; 
   }
    else if(!isItValidDate($date_of_birth))
 {
 $error[] = "Provide a valid date_of_birth";
 }
        
   else
   {
      try
      {
            if($user->complete_user($title,$first_name,$last_name,$date_of_birth,$occupation,$phone_no,$address1,$address2,$address3,$county,$user_id)) 
            {
                $user->redirect('complete_user.php?joined');
            }
         }
     
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  } 
}


function isItValidDate($date_of_birth) {
  if(preg_match("/^(\d{2})\/(\d{2})\/(\d{4})$/", $date_of_birth, $matches))
   {
    if(checkdate($matches[2], $matches[1], $matches[3]))
      {
       return true; 
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
    
        <script src="validate.js"></script>
    
<title>Complete your Profile</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post" name = "complete_user">
            <h2>Complete Profile.</h2><hr />
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
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Congratulations! Account Complete <a href='home.php'>View HomePage</a> here
                 </div>
                 <?php
            }
            ?>
            <div class="form-group">
                <label>Title</label>
            <select class="form-control" name="txt_title" placeholder="Title" value="<?php if(isset($error)){echo $title;}?>" >
                <option value="Mr">Mr.</option>
                <option value="Mrs">Mrs.</option>
                <option value="Miss">Miss</option>
                <option value="Dr">Dr.</option>
            </select>
            
                <label>First Name</label>
            <input type="text" class="form-control" name="txt_first_name" placeholder="first_name" value="<?php if(isset($error)){echo $first_name;}?>" />
                <label>Last Name</label>
             <input type="text" class="form-control" name="txt_last_name" placeholder="Last_name" value="<?php if(isset($error)){echo $last_name;}?>" />
            
            </div>
            <div class="form-group">
                <label>Current Occupation</label>
             <input type="text" class="form-control" name="txt_occupation" placeholder="occupation" value="<?php if(isset($error)){echo $occupation;}?>" />
            
                <label>Date of Birth</label>
             <input type="text" class="form-control" name="txt_date_of_birth" placeholder="date_of_birth" value="<?php if(isset($error)){echo $date_of_birth;}?>" />
            </div>
            
            <div class="form-group">
                <label>Mobile Phone Number</label>
             <input type="text" class="form-control" name="txt_phone_no" placeholder="Phone Number" value="<?php if(isset($error)){echo $phone_no;}?>" />
            
                <label>Current Address</label>
             <input type="text" class="form-control" name="txt_address1" placeholder="address1" value="<?php if(isset($error)){echo $address1;}?>" />
                
                <input type="text" class="form-control" name="txt_address2" placeholder="address2" value="<?php if(isset($error)){echo $address2;}?>" />
                <input type="text" class="form-control" name="txt_address3" placeholder="address3" value="<?php if(isset($error)){echo $address3;}?>" />
                
                <select class="form-control" name="txt_county" placeholder="County" value="<?php if(isset($error)){echo $county;}?>">
                       <option value="antrim">Antrim</option>
                        <option value="armagh">Armagh</option>
                        <option value="carlow">Carlow</option>
                        <option value="cavan">Cavan</option>
                        <option value="clare">Clare</option>
                        <option value="cork">Cork</option>
                        <option value="derry">Derry</option>
                        <option value="donegal">Donegal</option>
                        <option value="down">Down</option>
                        <option value="dublin">Dublin</option>
                        <option value="fermanagh">Fermanagh</option>
                        <option value="galway">Galway</option>
                        <option value="kerry">Kerry</option>
                        <option value="kildare">Kildare</option>
                        <option value="kilkenny">Kilkenny</option>
                        <option value="laois">Laois</option>
                        <option value="leitrim">Leitrim</option>
                        <option value="limerick">Limerick</option>
                        <option value="longford">Longford</option>
                        <option value="louth">Louth</option>
                        <option value="mayo">Mayo</option>
                        <option value="meath">Meath</option>
                        <option value="monaghan">Monaghan</option>
                        <option value="offaly">Offaly</option>
                        <option value="roscommon">Roscommon</option>
                        <option value="sligo">Sligo</option>
                        <option value="tipperary">Tipperary</option>
                        <option value="tyrone">Tyrone</option>
                        <option value="waterford">Waterford</option>
                        <option value="westmeath">Westmeath</option>
                        <option value="wexford">Wexford</option>
                        <option value="wicklow">Wicklow</option>
                    </select>
                
            </div>
            
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-register_car">
                 <i class="glyphicon glyphicon-open-file"></i>&nbsp;Update Profile.
                </button>
            </div>
            <br />
            <label>Need to get all your details? <a href="home.php">Go back for now</a></label>
        </form>
       </div>
</div>

</body>
</html>





