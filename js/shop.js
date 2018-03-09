$(document).ready(function(){
    
    $("#category").click(function() {
        hideFruits();
    });
}); 

function hideFruits(){
    
    $(".foodCard").hide();
        $(".foodCard").each(function(){
            if($(this).data("category") == 'Fruits') {
                $(this).show();
            }
    });
}
