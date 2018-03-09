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



