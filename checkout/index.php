<?php 

//possible forms "order.php", "address.php",  "card.php"
$page = "order.php";
$onOrder = '';
$onAddress = '';

if(isset($_POST['SubmitOrder'])){
    $page = "address.php";
    $onOrder = 'step_complete';
}
if(isset($_POST['submiteAdress'])){
    $page = "card.php";
    $onOrder = 'step_complete';
    $onAddress = 'step_complete';
}

$processBar = '<span class="step '.$onOrder.'"> <a href="#" class="check-bc">Cart</a><span class="step_line '.$onOrder.'">                     </span><span class="step_line backline"></span></span>
                <span class="step '.$onAddress.'"> <a href="#" class="check-bc">Checkout</a> <span class="step_line "></span><span class="step_line '.$onAddress.'"></span></span>
                <span class="step_thankyou step_complete" check-bc">Card</span>';

?>


<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="style.css" >

<!------ Include the above in your HEAD tag ---------->
<div class="container wrapper">
            <div class="row cart-head">
                <div class="container">
                <div class="row">
                    <p></p>
                </div>
                <div class="row">
                    <div style="display: table; margin: auto;">
                        <?php echo $processBar?>
                    </div>
                </div>
                <div class="row">
                    <p></p>
                </div>
                </div>
            </div>    
            <div class="row cart-body">
<!--                <form class="form-horizontal" method="post" action="">-->
                    <!-- old location of order-->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <!--SHIPPING METHOD-->
                    <?php 
                        require_once $page;
                    ?>
                </div>
                
<!--                </form>-->
            </div>
            <div class="row cart-footer">
        
            </div>
    </div>