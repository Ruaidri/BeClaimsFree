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

$user_car = $userRow['car_id'];
$stmt = $DB_con->prepare("SELECT * FROM register_car WHERE reg=:user_car");
$stmt->execute(array(":user_car"=>$user_car));
$carRow=$stmt->fetch(PDO::FETCH_ASSOC);

if($user_car =="''" || $user_car== "" || $user_car== null){     // if user removes car. Either null or blank is put in its place
    $user->redirect('register_car.php');                        
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>Your Car</title>
</head>

<body>

<div class="header">
 <div class="left">
     <label><a href="home.php">Be Claims Free</a></label>
    </div>
    <div class="right">

        <label><a href="logout.php?logout=true"><i class="glyphicon glyphicon-log-out"></i> logout</a></label>

    </div>
</div>
<div class="content">
    <h4>make - <?php print($carRow['make']); ?></h4>
    <h4>Model - <?php print($carRow['model']); ?></h4>
    <h4>Reg - <?php print($carRow['reg']); ?></h4>
    <h4>Colour - <?php print($carRow['color']); ?></h4>
    <h4>Value - €<?php print($carRow['value']); ?></h4>
</div>
</body>
</html>