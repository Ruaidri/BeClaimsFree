<?php
require_once 'dbconfig.php';


?>
<!DOCTYPE html>
<html>
    <head>
        
        <link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        
        <script type="text/javascript" src="stripe.js"></script>
        
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="styles/font-awesome.min.css">
        <link rel="stylesheet" href="cardstyle.css">

        
        
        
        
        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>

        <!-- using Stripe for payments -->
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        

<div class="container">
    <div class="row">

        <div class="col-xs-12 col-md-4">
        
        
            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Payment Details</h3>
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
                    <form role="form" id="payment-form" method="POST" action="javascript:void(0);">
                            <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="name">CARDHOLDER NAME</label>
                                    <input type="text" class="form-control" name="name" />
                                </div>
                            </div>                        
                        </div>
                            <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber">CARD NUMBER</label>
                                    <div class="input-group">
                                        <input 
                                            type="tel"
                                            class="form-control"
                                            name="cardNumber"
                                            placeholder="Valid Card Number"
                                            autocomplete="cc-number"
                                            required autofocus 
                                        />
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                    <input 
                                        type="tel" 
                                        class="form-control" 
                                        name="cardExpiry"
                                        placeholder="MM / YY"
                                        autocomplete="cc-exp"
                                        required 
                                    />
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">
                                    <label for="cardCVC">CV CODE</label>
                                    <input 
                                        type="tel" 
                                        class="form-control"
                                        name="cardCVC"
                                        placeholder="CVC"
                                        autocomplete="cc-csc"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="subscribe btn btn-success btn-lg btn-block" type="button" name="btn-make_payment">Start Subscription</button>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-xs-12">
                                <p class="payment-errors"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
            <!-- CREDIT CARD FORM ENDS HERE -->
            
            
        </div>            
        
        <div class="col-xs-12 col-md-8" style="font-size: 12pt; line-height: 2em;">
            <p><h1>Features:</h1>
                <ul>
                    <li>We offer a Service</li>
                    <li>We offer a Service</li>
                    <li>Graceful error feedback for declined card, etc</li>
                    <li>AJAX form submission w/ visual feedback</li>
                    <li>Creates a Stripe credit card token</li>
                </ul>
            </p>
            
            
            <p>Built upon: Bootstrap, jQuery, 
                <a href="http://jqueryvalidation.org/">jQuery Validation Plugin</a>, 
                <a href="https://github.com/stripe/jquery.payment">jQuery.payment library</a>,
                and <a href="https://stripe.com/docs/stripe.js">Stripe.js</a>
            </p>
        </div>
    </body>
</html>