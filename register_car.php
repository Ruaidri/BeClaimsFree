<?php
require_once 'dbconfig.php';

$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM user WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$user_car = $userRow['car_id'];
if($user_car !="''"){
    $user->redirect('car.php');
}


if(isset($_POST['btn-register_car']))
{
   $make = trim($_POST['txt_make']);
   $model = trim($_POST['txt_model']);
   $reg = trim($_POST['txt_reg']);
   $engine = trim($_POST['txt_engine']);
   $color = trim($_POST['txt_color']);
   $value = trim($_POST['txt_value']);
   
 
   if($make=="") {
      $error[] = "provide make !"; 
   }
   else if($model=="") {
      $error[] = "provide model !"; 
   }
   else if($reg=="") {
      $error[] = "provide Reg Number !";
   }
    else if($engine==""){
      $error[] = "Provide an Engine size"; 
   }
    else if($color==""){
      $error[] = "Provide a Color"; 
   }
   else if($value==""){
      $error[] = "Provide value"; 
   }
    else if (licencePlate($reg)==false){
        $error[] = "Invalid Reg";
    }
    
    
        
   else
   {
      try
      {
         $stmt = $DB_con->prepare("SELECT reg FROM register_car WHERE reg=:reg");
         $stmt->execute(array(':reg'=>$reg));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
          
         if($row['reg']==$reg) {
            $error[] = "Car is already registered in ur database !";
         }
         else
         {
            if($user->register_car($make,$model,$reg,$engine,$color,$value)) 
            {
                $id = $_SESSION['user_session'];
                
                $user->user_car($id,$reg);
                
                
                $user->redirect('register_car.php?joined');
            }
         }
          
          
          
          
          
          
          
          
          
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  } 
}

function licencePlate($number)
    {
        //in_array is case sensitive, so use strtoupper...
        $plate = strtoupper($number);
        $regex = "/^(\d{2,3})[\ -]([A-Z][A-Z]?)[\ -]\d{1,6}$/";
        if (preg_match($regex, $plate, $matches)) {
            $mark = strtoupper($matches[2]);
            //check valid index mark
            $marks = array('C','CE','CN','CW','D','DL','G','KE','KK','KY','L',
                           'LD','LH','LK','LM','LS','MH','MN','MO','OY','RN',
                           'SO','TN','TS','W','WD','WH','WX','WW');
            if (in_array($mark, $marks)) {
                // The first component, if 3 digits in length can only end
                // with a '1' or a '2'.
                if (strlen($matches[1]) == 3) {
                    $end  = (int) substr($matches[1], 2, 1);
                    return ($end == 1) || ($end == 2);
                }
                return true;
            } else {
                return false;
            }
        } else {
            //two pre-1987 codes are still in use. ZZ and ZV.
            //format is ZZ nnnnn - 5 digits for ZZ code and as few as 4 for ZV
            $regex = "/^ZZ[\ -]\d{5}$/";
            if (preg_match($regex, $plate)) {
                return true;
            }
            $regex = "/^ZV[\ -]\d{4,5}$/";
            if (preg_match($regex, $plate)) {
                return true;
            }
            return false;
        }
    }




?>
<!DOCTYPE html>
<html>
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
    
<title>Register Car</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post">
            <h2>Register Car.</h2><hr />
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
                 <div class="container">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='home.php'>View HomePage</a> here
                 </div>
                 <?php
            }
            ?>
            
            
            
            
            <div class="form-group">
            <input type="text" class="form-control" name="txt_make" placeholder="Make" value="<?php if(isset($error)){echo $make;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_model" placeholder="Model" value="<?php if(isset($error)){echo $model;}?>" />
            </div>
            <div class="form-group">
             <input type="text" class="form-control" name="txt_reg" placeholder="Reg Number" value="<?php if(isset($error)){echo $reg;}?>" />
            </div>
            
            <div class="form-group">
             <input type="text" class="form-control" name="txt_engine" placeholder="Engine Size" value="<?php if(isset($error)){echo $engine;}?>" />
            </div>
            
            <div class="form-group">
             <input type="text" class="form-control" name="txt_color" placeholder="Color" value="<?php if(isset($error)){echo $color;}?>" />
            </div>
            <div class="form-group">
             <input type="text" class="form-control" name="txt_value" placeholder="Value" value="<?php if(isset($error)){echo $value;}?>" />
            </div>
            
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-register_car">
                 <i class="glyphicon glyphicon-open-file"></i>&nbsp;Register Car
                </button>
            </div>
            <br />
            <label>Leave it for another time <a href="home.php">Skip Step</a></label>
        </form>
       </div>
</div>

</body>
</html>




