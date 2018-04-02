$(document).ready(function(){
    
    //decrement buttton clicked
    $(".btn-num-product-down").click(function() {
        updateTotalWeightAndPrice();
    });
    
    //increment button clicked
    $(".btn-num-product-up").click(function() {
        updateTotalWeightAndPrice()
    });
    
    //trash icon clicked 
    $(".delete").click(function() {
        deleteItem($(this));
    });
    
    //updateCart
     $("#updateCart").click(function() {
         //alert(JSON.stringify(getItemsAndUpdateDB()));
     });
}); 

function updatecart(){
//    json = JSON.stringify(getItemsAndUpdateDB())
//    communicatToDatabase(json)
}

//@desc: gets json string of all items in cart
function getItems(){
    items = []
    $('tr.table-row').each(function () {
        amount = parseFloat($(this).find("td.column-4").find("div").find('input').val());
        itemID = parseFloat($(this).find("td.column-6").find("i").data("itemid"))
        items.push({itemID, amount})
    });
    return items;
}

//@desc: removes row from the html code and updates the total price and weight
function deleteItem(item){
    id = "#item" + item.data("itemid"); 
    $(id).replaceWith('');
    updateTotalWeightAndPrice();
}

//@desc: uses jQuery to travers the DOM to find all the values and update them
function updateTotalWeightAndPrice(){
    
    var totalWeight = 0; 
    var totalPrice = 0;
    $('tr.table-row').each(function () {
        
        //gets the price and weight in the formate of $2.99/1.00 lb
        priceWeight = $(this).find('td.column-3').html().split("/")
        
        //turns String into double 
        productPrice = priceWeight[0]
        productPrice = parseFloat(productPrice.substring(1, productPrice.length));
    
        productWight = priceWeight[1];
        productWight = parseFloat(productWight.substring(0, productWight.length-3));
    
        amount = parseFloat($(this).find("td.column-4").find("div").find('input').val());
        
        totalWeight += amount * productWight
        totalPrice += amount * productPrice
        
    });
    
    $('#totalPrice').replaceWith('<th id= "totalPrice" class="column-5" style="white-space: nowrap">$'+totalPrice.toFixed(2)+'</th>');    
    
    $('#totalWeight').replaceWith('<th id= "totalWeight" class="column-5" style="white-space: nowrap">'+totalWeight.toFixed(2)+' lb</th>');
    
    //@desc: calls the the addToCart php script to update the database. Passes vaibles by doing a POST request. 
function communicatToDatabase(items){
    $.ajax({
                url: "Scripts/updateCart.php",
                type: 'POST',
                data: { items: items},
                dataType: 'json',
                
                success: function (data) {
                    if(data){
                        if(data.success){
//                            swal(nameProduct, data.status, "success");
//                            updateNav(data.cart)
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
}





