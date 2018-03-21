<?php
//error_reporting(0); // stops displaying warning from user end

    require_once 'Scripts/loginInfo.php';

    $cart_items = '';
    $total_price = 0;
    $total_weight = 0; 
    $conn = new mysqli($hn, $un, $pw, $db); //connects to db
    
    if (!$conn->connect_error){ //checks if connected succesfully 
        $sql = "select i.name, sum(c.amount) as amount, i.weight, i.price, i.CategoryName from cart c, items i where i.id = c.ItemID and c.userid =1 group by i.name";
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
    }
    else{
        $cart_items = "<h2>We are experiencing server error</h2>";
    }

    

    //@desc: generates html code to display a new row inside the cart table 
    function generateDiv($name, $amount, $weight, $price, $category){ //old img = item-10.jpg
        
        $total_price = $amount * $price;
        return '<tr class="table-row">
							<td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="images/'.$category.'/'.$name.'.jpg" alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2 adminLayout">'.$name.'</td>
							<td class="column-3">
                                <div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>

									<input class="size8 m-text18 t-center num-product" type="number" name="num-product1" value="'.$price.'">

									<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
                            </td>
							<td class="column-4">
								<div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>

									<input class="size8 m-text18 t-center num-product" type="number" name="num-product1" value="'.$amount.'">

									<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
							</td>
				            <td class="column-5">'."100".'</td>
						</tr>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cart</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
    
</head>
<body class="animsition">

	<!-- Header -->
	

	<!-- Cart -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div id="fullscreen_bg" class="fullscreen_bg"/>
 <form class="form-signin">
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
        <div class="panel panel-default">
        <div class="panel panel-primary">
        
            <h3 class="text-center">
                        Inventory</h3>
        
        <div class="panel-body">    
 
 
 <table class="table table-striped table-condensed">
                  <thead>
                  <tr>
                      <th>Name</th>
                      <th>Amount</th>
                      
                    
                      <th>Update</th>  
                      <th>Delete</th> 
                  </tr>
              </thead>   
              <tbody>
                <tr>
                    
                    <td>Apple</td>
                    <td><textarea style="resize:none; width:35px"; rows = "1"> 100 </textarea></td>
                    
                   
                    <td><a href="http://www.jquery2dotnet.com" class="btn btn-sm btn-primary btn-block" role="button">Update</a></td>
                    <td><a href="http://www.jquery2dotnet.com" class="btn btn-sm btn-primary btn-block" role="button">Delete</a></td>
                    </tr>
                <tr>
                    
                    <td>Banana</td>
                    <td><textarea style="resize:none; width:35px"; rows = "1"> 250 </textarea></td>
                    
           
                    <td><a href="http://www.jquery2dotnet.com" class="btn btn-sm btn-primary btn-block" role="button">Update</a></td>
                    <td><a href="http://www.jquery2dotnet.com" class="btn btn-sm btn-primary btn-block" role="button">Delete</a></td>
                </tr>
                <tr>
                    
                    <td>Orange</td>
                    <td><textarea style="resize:none; width:35px"; rows = "1"> 30 </textarea></td>
                    
            
                    <td><a href="http://www.jquery2dotnet.com" class="btn btn-sm btn-primary btn-block" role="button">Update</a></td>
                    <td><a href="http://www.jquery2dotnet.com" class="btn btn-sm btn-primary btn-block" role="button">Delete</a></td>
                </tr>   
              </tbody>
  </div>
       </div>
        </div>
    </div>
</div>
</form>

              
            


	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>



<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
    <script type="text/javascript" src="js/cart.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
</body>
</html>
