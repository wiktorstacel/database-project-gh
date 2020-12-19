// JQUERY
//
//lista rozwijana przy ofertach
$(document).ready(function(){
    var ofertCount = 10;
    $(document).on("click", "#button_more_ofert", function(){
        ofertCount = ofertCount + 10;
        show_oferty(ofertCount); //podanie licznika metodą GET
    });
    $(document).on("click", "#button_show_ofert", function(){
        ofertCount = 10;
        show_oferty(ofertCount); //podanie licznika metodą GET
    });
    $(document).on("click", "#p1, #p2, #p3, #p6, #p7", function(){
        show_oferty(ofertCount); //podanie licznika metodą GET
    });
    $(document).on("keyup", "#p4, #p5", function(){
        show_oferty(ofertCount); //podanie licznika metodą GET
    });
});

//lista rozwijana przy transkacjach
$(document).ready(function(){
    var transCount = 10;
    $(document).on("click", "#button_more_trans", function(){
        transCount = transCount + 10;
        $("#ekran2").load("show_transakcje.php", {
            transSum: transCount //podanie licznika metodą POST
        });
    });
    $(document).on("click", "#button_show_trans", function(){
        transCount = 10;
        $("#ekran2").load("show_transakcje.php", {
            transSum: transCount //podanie licznika metodą POST
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