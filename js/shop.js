$(document).ready(function(){
     $("#All").click(function() {
        showAll();
    });
    
    $("#Fruits").click(function() {
        hideFruits();
    });
    
    $("#Vegetables").click(function() {
        hideVegetables();
    })
    
    $("#Dairy").click(function(){
        hideDairy();
    })
    
    $("#Grains").click(function(){
        hideGrains();
    })
    
}); 

function showAll(){
    
    $(".foodCard").hide();
        $(".foodCard").each(function(){
            $(this).show();
    });
}

function hideFruits(){
    
    $(".foodCard").hide();
        $(".foodCard").each(function(){
            if($(this).data("category") == 'Fruits') {
                $(this).show();
            }
    });
}

function hideVegetables(){
    
    $(".foodCard").hide();
        $(".foodCard").each(function(){
            if($(this).data("category") == 'Vegetables') {
                $(this).show();
            }
    });
}
                            
function hideDairy(){
    
    $(".foodCard").hide();
        $(".foodCard").each(function(){
            if($(this).data("category") == 'Dairy') {
                $(this).show();
            }
    });
}

function hideGrains(){
    
    $(".foodCard").hide();
        $(".foodCard").each(function(){
            if($(this).data("category") == 'Grains') {
                $(this).show();
            }
    });
}

function updateNav(items){
    HTML_cart_items = ''
    total_price = 0
    total_weight = 0
    total_items = 0
    for(i=0; i < items.length; i++){
        total_weight += items[i]['amount'] * items[i]['weight']
        total_price += items[i]['amount'] * items[i]['price']
        HTML_cart_items += generateCartItem(items[i]['name'], items[i]['amount'], items[i]['weight'], items[i]['price'], items[i]['CategoryName'])
    }
    
    cart = generateCartHTML(HTML_cart_items, total_price)
    $('#icon-number').replaceWith('<span id="icon-number" class="header-icons-noti">'+items.length+'</span>')
    $('#cart-desktop').replaceWith(cart)
    
}

function generateCartHTML(items, cost){
        return '<div id="cart-desktop" class="header-cart header-dropdown">'
							+'<ul id = "cart_list" class="header-cart-wrapitem">'
                                +items
							+'</ul>'

							+'<div class="header-cart-total">'
								+"Total: " +cost.toFixed(2)
							+"</div>"

							+'<div class="header-cart-buttons">'
								+'<div class="header-cart-wrapbtn">'
    
									+'<a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">View Cart</a>'									
								+"</div>"
								+'<div class="header-cart-wrapbtn">'
									+'<a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">Check Out</a>'
								+"</div>"
							+"</div>"
						+"</div>";
    }

function generateCartItem(name, amount, weight, price, category){
        return '<li class="header-cart-item">'
									+'<div class="header-cart-item-img">'
										+'<img src="images/' + category + '/'+ name + '.jpg" alt="IMG">'
									+'</div>'

									+'<div class="header-cart-item-txt">'
										+'<a href="#" class="header-cart-item-name">'
											+ name 
										+'</a>'

										+'<span class="header-cart-item-info">'
											+ amount + 'x' + price
										+'</span>'
									+'</div>'
								+'</li>';
}
    


//@desc: add to cart buttion clicked listiner. Gets items info and calls a php script to update cart
$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            var itemID =  $(this).parent().parent().parent().find('.block2-name').data('itemid')
            var userID =  1;
            var countyID = $(this).parent().parent().parent().find('.block2-name').data('countyid')
    
			$(this).on('click', function(){
                communicatToDatabase(nameProduct, itemID, userID, countyID);
			});
		});


//@desc: calls the the addToCart php script to update the database. Passes vaibles by doing a POST request. 
function communicatToDatabase(nameProduct, itemID, userID, countyID){
    $.ajax({
                url: "Scripts/addToCart.php",
                type: 'POST',
                data: { itemid: itemID, userid: userID, countyid: countyID},
                dataType: 'json',
                
                success: function (data) {
                    if(data){
                        if(data.success){
                            swal(nameProduct, data.status, "success");
                            updateNav(data.cart)
                        }
                        else {
                            swal({ title: "Error", text: "Please try again later", icon: "error"});
                        }
                    }
                    else swal({ title: "Error", text: "Please try again later", icon: "error"});
                    
                    },
                error: function (jqXHR, exception) {
                    swal({ title: "Error", text: "Please try again later", icon: "error"});
                }
            });
}
