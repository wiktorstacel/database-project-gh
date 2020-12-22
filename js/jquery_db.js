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
    $(document).on("change", "#p1, #p2, #p3, #p6, #p7", function(){
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

//edycja oferty - załadowanie danych do formularza 'Wprowadź'
$(document).ready(function(){
    
    $(document).on("change", "#edycja_oferty", function(){
        var id = $("#edycja_oferty").val();
        alert(id);
        if(id != 0)
        {
            $.ajax({
                url: "insert_oferta.php",
                method: "POST",
                data: {id:id},
                dataType: "JSON",
                success: function(data){                                  
                    console.log(data);
                    $("#wp0").val(data.nazwa);
                    $("#wp1").val(data.rodzaj_id);
                    $("#wp2").val(data.wojewodztwo_id);
                    $('#wp3').val(data.miejscowosc_id);
                    //$('#wp4').text(data.nazwa);//nowa miejscowość - nigdy nie będzie używane
                    $("#wp5").val(data.ulica);
                    $("#wp6").val(data.powierzchnia);
                    $("#wp7").val(data.cena);
                    $("#wp8").val(data.opis);
                }
            })
        }
        else
        {
            alert("wybierz ofertę do edycji");
        }
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