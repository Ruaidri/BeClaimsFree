<!--

require_once 'dbconfig.php';

    $user_id = $_SESSION['user_session'];
    $stmt = $DB_con->prepare("SELECT * FROM user WHERE user_id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $user_mail = $userRow['user_email'];
    require_once('C:\xampp\htdocs\beClaimsFree\Stripe\Stripe\init.php');
    \Stripe\Stripe::setApiKey("sk_test_zCmKCeXfiBL4vpD6c2P5eeXZ");
    $mail = Stripe\Customer::retrieve($user_mail);
    if($user_mail == $mail){
        $user->redirect('home.php');
    }
?> 
-->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Subscribe</title>

    <!-- Bootstrap Core CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="styles/landingStyle.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="home.php">Be Claims Free</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#about">About</a>
                    </li>
                    <li>
                        <a href="#services">Services</a>
                    </li>
                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Header -->
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Sign Up today </h1>
                        <h3>Prior Preperation Prevents Problematic Payments</h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                           
                            <li>
                                <form action="create_subscription.php" method="POST">
                                      <script
                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                        data-key="pk_test_klJRFwoljnK57pINirDY3SL0"
                                        data-name="Be Claims Free"
                                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                        data-description="Subscription for the preemptive"
                                        data-amount="2000"
                                        data-currency="eur"
                                        data-panel-label = "Subscribe"
                                        data-label="Sign Me Up!">
                                      </script>
                                    </form>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->


    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#about">About</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#services">Services</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#contact">Contact</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; Your Company 2014. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>