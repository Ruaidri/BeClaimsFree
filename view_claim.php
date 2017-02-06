<?php
include_once 'dbconfig.php';
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM user WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$user_claim = $userRow['payment_id'];
$stmt = $DB_con->prepare("SELECT * FROM claim WHERE licenceNo=:user_claim");
$stmt->execute(array(":user_claim"=>$user_claim));
$claimRow=$stmt->fetch(PDO::FETCH_ASSOC);

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
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>welcome - <?php print($userRow['user_name']); ?></title>
</head>

<body>

<div class="header">
    <div class="right">
        <label><a href="register_car.php"><i class="reister_car"></i> Register Car</a></label>
        <label><a href="logout.php?logout=true"><i class="glyphicon glyphicon-log-out"></i> logout</a></label>
        <label><a href="delete_confirm.php"><i class="delete"></i> Delete Account</a></label>
        <label><a href="claim_form.php"><i class="claim_form"></i> Make a claim</a></label>
        <label><a href="complete_user.php"><i class="complete_user"></i> Complete Profile</a></label>
        <label><a href="clamp_form.php"><i class="clamp"></i> Pay a Clamp</a></label>
        <label><a href="car.php"><i class="car"></i> Car</a></label>
    </div>
</div>
<div class="content">
    
     <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" style="width:40%">
            Submitted
        </div>
        <div class="progress-bar progress-bar-warning" role="progressbar" style="width:10%">
            Reviewed
        </div>
        <div class="progress-bar progress-bar-danger" role="progressbar" style="width:20%">
            Not happening m8
        </div>
    </div>
    
    
    
    <p>welcome : <?php print($userRow['user_name']); ?></p>
    <p>PPSN: <?php print($claimRow['ppsn']); ?></p>
    <p>Licence Number: <?php print($claimRow['licenceNo']); ?></p>
    <p>Date of Incedent: <?php print($claimRow['date']); ?></p>
    <p>VIN: <?php print($claimRow['vin']); ?></p>
    <p>Damage: <?php print($claimRow['damage']); ?></p>
    <p>Estimated Value: <?php print($claimRow['value']); ?></p>
    <p>Location of Incident: <?php print($claimRow['location']); ?></p>
    <p>3rd Party Involved: <?php print($claimRow['involve']); ?></p>
    <p>Other Driver name: <?php print($claimRow['name']); ?></p>
    <p>Claim made payable to: <?php print($claimRow['name_on_payment']); ?></p>

    
    
    
</div>
</body>
</html>