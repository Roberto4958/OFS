<?php 
    $cart_items = '';
    $total_price = 0;
    $total_weight = 0; 
    $id = $_SESSION['id'];
    $conn = new mysqli($hn, $un, $pw, $db); //connects to db
    
    if (!$conn->connect_error){ //checks if connected succesfully 
        $sql = "select i.name, sum(c.amount) as amount, i.weight, i.price, i.CategoryName from cart c, items i where i.id = c.ItemID and c.userid =$id group by i.name";
        
        $result = $conn->query($sql);
        $rows = $result->num_rows;
        
        //loops through all the rows and saves the data from the columns 
        for($i=0; $i < $rows; $i++){
        
            $result->data_seek($i);
            $obj = $result->fetch_array(MYSQLI_ASSOC);
            $total_weight += $obj['amount'] * $obj['weight'];
            $total_price += $obj['amount'] * $obj['price'];
            $cart_items .= generateDiv($obj['name'], $obj['amount'], $obj['weight'], $obj['price'], $obj['CategoryName']); 
        }
        $result->close();
        $conn->close();
        
        $shippingCost = 2*(floor($total_weight/15)); //round down
        $total_price += $shippingCost;
        if($total_price == 0){
            header('Location: ../cart.php');
        }
    }
    else{
        $cart_items = "<h2>We are experiencing server error</h2>";
    }

    

    //@desc: generates html code to display a new row inside the cart table 
    function generateDiv($name, $amount, $weight, $price, $category){ //old img = item-10.jpg
        
        $total_price = $amount * $price;
        
        return '<div class="form-group">
                                <div class="col-sm-3 col-xs-3">
                                    <img class="img-responsive" src="images/'.$category.'/'.$name.'.jpg" />
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="col-xs-12"><h3 style="margin-top:0;">'.$name.'</h3></div>
                                    <div class="col-xs-12"><small>Quantity:<span> '.$amount.'</span></small></div>
                                    <div class="col-xs-12"><small>Total Weight:<span> '.($weight*$amount).' lb</span></small></div>                 
                                </div>
                                <div class="col-sm-3 col-xs-3 text-right">
                                    <h6><span>$</span>'.$total_price.'</h6>
                                </div>
                            </div>
                            <div class="form-group"><hr /></div>';
    }

?>

<form class="form-horizontal" method="POST" action="checkout.php">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Review Order <div class="pull-right"><small><a class="afix-1" href="#">Edit Cart</a></small></div>
                        </div>
                        <div class="panel-body">
                            <?php echo $cart_items;?>
                            
                             <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Total Weight</strong>
                                    <div class="pull-right"><span>$</span><span><?php echo $total_weight; ?></span></div>
                                </div>
                            </div>
                            
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Shipping cost</strong>
                                    <div class="pull-right"><span>$</span><span><?php echo $shippingCost; ?>.00</span></div>
                                </div>
                            </div>
                            
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Order Total</strong>
                                    <div class="pull-right"><span>$</span><span><?php echo $total_price?></span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button name="SubmitOrder" type="submit" value="Submit" class="btn btn-primary btn-submit-fix">Continue</button>
                                </div>
                            </div>
                            
                            
                        </div>
                        
                    </div>
    <!--REVIEW ORDER END-->
                </div>
</form>