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
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>Are you sure you want to delete account? - <a href="delete_account.php?delete=true"><i class="delete"></i> Delete Account</a></title>
</head>

<body>

<div class="header">
 <div class="left">
     <label><a href="index.php">Be Claims Free</a></label>
    </div>
    <div class="right">
        <label><a href="register_car.php"><i class="reister_car"></i> Register Car</a></label>
        <label><a href="logout.php?logout=true"><i class="glyphicon glyphicon-log-out"></i> logout</a></label>
        <label><a href="delete_account.php?delete=true"><i class="delete"></i> Delete Account</a></label>
        <label><a href="claim_form.php"><i class="claim_form"></i> Make a claim</a></label>
        <label><a href="complete_user.php"><i class="complete_user"></i> Complete Profile</a></label>
    </div>
</div>
<div class="content">
<label>Are you sure you want to delete?<a href="delete_account.php?delete=true"><i class="delete"></i> Ye</a></label>
</div>
</body>
</html>