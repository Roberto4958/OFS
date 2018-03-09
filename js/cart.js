$(document).ready(function(){
    
    $(".btn-num-product-down").click(function() {
        updateCart($(this));
    });
    //btn-num-product-up
    $(".btn-num-product-up").click(function() {
        updateCart($(this));
        
    });
}); 


//@desc: uses jQuery to travers the DOM to find all the values and update them
function updateCart(item){
    //handles cart row
    oldPrice =item.parent('div').parent('td').siblings('.column-5').html();
    oldPrice = parseFloat(oldPrice.substring(1, oldPrice.length));
    
    productPrice = item.parent('div').parent('td').siblings('.column-3').html();
    productPrice = parseFloat(productPrice.substring(1, productPrice.length));
    
    amount = parseFloat(item.siblings('input').val());
    newPrice =  productPrice * amount;
    item.parent('div').parent('td').siblings('.column-5').replaceWith('<td class="column-5">$'+newPrice.toFixed(2)+'</td>');
    
    //handle total price for check out
    
    oldTotalPrice = $('span.totalPrice').html(); 
    oldTotalPrice = parseFloat(oldTotalPrice.substring(1, oldTotalPrice.length));
    
    newTotalPrice = oldTotalPrice - oldPrice + newPrice;
    
    $('.totalPrice').replaceWith('<span class="totalPrice m-text21 w-size20 w-full-sm">$'+newTotalPrice.toFixed(2)+'</span>');
    $('.Subtotal').replaceWith('<span class="Subtotal m-text21 w-size20 w-full-sm">'+newTotalPrice.toFixed(2)+'</span>');
    
    //ToDo: handle updating weight

}

