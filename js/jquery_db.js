// JQUERY
//
//przycisk pokaż więcej przy ofertach
$(document).ready(function(){
    var ofertCount = 10;
    $(document).on("click", "#button_more_ofert", function(){
        ofertCount = ofertCount + 10;
        show_oferty(ofertCount);
    });
});

//przycisk pokaż więcej przy transkacjach
$(document).ready(function(){
    var transCount = 10;
    $(document).on("click", "#button_more_trans", function(){
        transCount = transCount + 10;
        $("#ekran2").load("show_transakcje.php", {
            transSum: transCount
        });
    });
});
//test
//If your HTML is added dynamically after the event handlers are installed, 
//then you need to use delegated event handling like this:
/*$(document).ready ( function () {
    $(document).on ("click", "#button_more_trans", function () {
        alert("hi");
    });
});*/

//test
/*$(document).ready(function(){
    
    $(document).on ("keyup", "#t3", function(){
        var name = $("#t3").val();
        $.post("suggest_miasto.php", {
            suggestion: name 
        }, function(data, status){
            $("#alert3").html(data);
        });
    });
    
});*/