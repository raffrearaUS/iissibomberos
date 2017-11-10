$(document).ready(function(){
    $("#pass").on("keyup", function(){
        var password= $("#pass").val();
        if(password.length >= 8){
           $("#pass").css("border-color", "chartreuse");
           }else{
             $("#pass").css("border-color", "red"); 
           }
    });
});