getCounties() 
function getCounties(){
    /*var counties = '{"counties":[{"entityType":1,"ID":1,"name":"ZAGREBA\u010cKA"},{"entityType":1,"ID":2,"name":"KRAPINSKO-ZAGORSKA"},{"entityType":1,"ID":3,"name":"SISA\u010cKO-MOSLAVA\u010cKA"},{"entityType":1,"ID":4,"name":"KARLOVA\u010cKA"},{"entityType":1,"ID":5,"name":"VARA\u017dDINSKA"},{"entityType":1,"ID":6,"name":"KOPRIVNI\u010cKO-KRI\u017dEVA\u010cKA"},{"entityType":1,"ID":7,"name":"BJELOVARSKO-BILOGORSKA"},{"entityType":1,"ID":8,"name":"PRIMORSKO-GORANSKA"},{"entityType":1,"ID":9,"name":"LI\u010cKO-SENJSKA"},{"entityType":1,"ID":10,"name":"VIROVITI\u010cKO-PODRAVSKA"},{"entityType":1,"ID":11,"name":"PO\u017dE\u0160KO-SLAVONSKA"},{"entityType":1,"ID":12,"name":"BRODSKO-POSAVSKA"},{"entityType":1,"ID":13,"name":"ZADARSKA"},{"entityType":1,"ID":14,"name":"OSJE\u010cKO-BARANJSKA"},{"entityType":1,"ID":15,"name":"\u0160IBENSKO-KNINSKA"},{"entityType":1,"ID":16,"name":"VUKOVARSKO-SRIJEMSKA"},{"entityType":1,"ID":17,"name":"SPLITSKO-DALMATINSKA"},{"entityType":1,"ID":18,"name":"ISTARSKA"},{"entityType":1,"ID":19,"name":"DUBROVA\u010cKO-NERETVANSKA"},{"entityType":1,"ID":20,"name":"ME\u0110IMURSKA"},{"entityType":1,"ID":21,"name":"GRAD ZAGREB"}]}'
    var countiesJSON = JSON.parse(counties)
    for(var i in countiesJSON){
        for(var j in countiesJSON[i]){
            $("#zupanija").append("<option data-tokens='ketchup mustard'>"+countiesJSON[i][j].name+"</option>")
        }
    } */
    $.ajax({
        method: "GET",
        dataType: "json",
        url: "https://tehcon.com.hr/api/CroatiaTownAPI/list.php?v=1&entityType=1",
        data: {},
        success: function (result) {
            for(var i in result){
                for(var j in result[i]){
                    $("#zupanija").append("<option data-tokens='ketchup mustard' value='"+result[i][j].name+"'>"+result[i][j].name+"</option>")
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("error")
            console.log(xhr.status);
            console.log(thrownError);
        }
    }); 
}