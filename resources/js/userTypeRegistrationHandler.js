$(document).on('change',"#userType input",function () {
    console.log($('input[name=userType]:checked', '#userType').val()); 
    if($('input[name=userType]:checked', '#userType').val()=="kupac"){
        $("#userOPGBlock").attr("hidden",true);
    }
    else{
        $("#userOPGBlock").attr("hidden",false);
    }
 });