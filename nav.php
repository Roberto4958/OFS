<?php

//require_once 'Scripts/config.php';
require_once 'Scripts/helperScripts.php';
require_once 'Scripts/loginInfo.php';
$displayCart = "";

    if(SessionIsValid()){
        $items = '';
        $total_price = 0;
        $total_weight = 0; 
        $total_items = 0;
        $cart = '';
        $cartItems = '';
        $id = $_SESSION['id'];
        // Create connection
	   $conn = new mysqli($hn, $un, $pw, $db);


        if (!$conn->connect_error){
//    	   $conn->query("Use OFS");

            $sql = "select i.name, sum(c.amount) as amount, i.weight, i.price, i.CategoryName from Cart c, Items i where i.id = c.ItemID and c.userid =$id group by i.id";
            $result = $conn->query($sql);
            $total_items = $result->num_rows;
        
            for($i=0; $i < $total_items; $i++){
        
                $result->data_seek($i);
                $obj = $result->fetch_array(MYSQLI_ASSOC);
                $total_weight += $obj['amount'] * $obj['weight'];
                $total_price += $obj['amount'] * $obj['price'];
                $items .= generateCartItem($obj['name'], $obj['amount'], $obj['weight'], $obj['price'], $obj['CategoryName']);
                $cartItems .= mobileCartItem($obj['name'], $obj['amount'], $obj['weight'], $obj['price'], $obj['CategoryName']);
            }
            if($total_items > 0){
                $cart = generateCartHTML($items, $total_price, $total_items);
            }else{
                $cart = generateEmptyCartHTML();
            }
        
            $result->close();
            $conn->close();
        
        } else {
            $cart = generateEmptyCartHTML();
        }
        $displayCart = '<span class="linedivide1"></span>
                    <div class="header-wrapicon2 m-r-13">
						<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						
						'.$cart.'
					</div>';        
    }

    
    

    function generateCartHTML($items, $cost, $total_items){
        return '	<span id="icon-number" class="header-icons-noti">'.$total_items.'</span>
                    <div id="cart-desktop" class="header-cart header-dropdown">
							<ul id = "cart_list" class="header-cart-wrapitem">
                                '.$items.'
							</ul>

							<div class="header-cart-total">
								Total: '.$cost.'
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="checkout.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
						</div>';
    }

    function generateEmptyCartHTML(){
        return '<span id="icon-number" class="header-icons-noti">0</span>
                <div id="cart-desktop" class="header-cart header-dropdown">
							<ul id = "cart_list" class="header-cart-wrapitem">
                                No Items on cart
								
							</ul>

						</div>';
    }

    function generateCartItem($name, $amount, $weight, $price, $category){
        return '<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="images/'.$category.'/'.$name.'.jpg" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											'.$name.'
										</a>

										<span class="header-cart-item-info">
											'.$amount.' x '.$price.'
										</span>
									</div>
								</li>';
    }
    
    function mobileCartItem($name, $amount, $weight, $price, $category){
        return '<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="images/'.$category.'/'.$name.'.jpg" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											'.$name.'
										</a>

										<span class="header-cart-item-info">
											'.$amount.' x '.$price.'
										</span>
									</div>
								</li>';
    }
    
?>

<header class="header2">
		<!-- Header desktop -->
		<div class="container-menu-header-v2 p-t-26">
			<div class="topbar2">
				

				<!-- Logo2 -->
				<a href="index.php" class="logo2">
					<img src="images/icons/logo1.png" alt="IMG-LOGO">
				</a>

				<div class="topbar-child2">
					<ul class="nav">
								<?php if (isset($_SESSION['id'])) { ?>
								<li><a href="logout.php">Log Out</a></li>
								<?php } else { ?>
								<li><a href="signin.php">Login</a></li>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<li><a href="signup.php">Sign Up</a></li>
								<?php } ?>
							</ul>
					       <?php echo $displayCart;?>
				</div>
			</div>
			

			<div class="wrap_header">

				<!-- Menu -->
                <div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="index.php">Home</a>
							</li>

							<li>
								<a href="product.php">Shop</a>
							</li>
				
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">

				</div>
			</div>
		</div>
    <!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.php" class="logo-mobile">
				<img src="images/icons/logo1.png" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
						<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti">3</span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
                                <?php echo $cartItems;?>
							</ul>

							<div class="header-cart-total">
								Total: $75.00
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="checkout.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							Free shipping for orders less than 15 lb
						</span>
					</li>

					<li class="item-menu-mobile">
						<a href="index.php">Home</a>
					</li>
                    <hr style="margin:0;">
					<li class="item-menu-mobile">
						<a href="product.php">Shop</a>
					</li>
                    <hr style="margin:0;">
                    <li class="item-menu-mobile">
						<a href="logout.php">Log out</a>
					</li>

				</ul>
			</nav>
		</div>
	</header>