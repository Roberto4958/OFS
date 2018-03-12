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
