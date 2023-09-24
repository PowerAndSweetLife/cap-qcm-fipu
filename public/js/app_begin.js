$(document).ready(function () {
    $("#profil-menu").hide();
    $(document.body).on('click', '#profil', function () {

        var etat = $(this).attr("etat");
        if (etat == "off") {
            $("#profil-menu").show(200);
            $(this).attr("etat", "on");
        }
        else if (etat == "on") {
            $("#profil-menu").hide(200);
            $(this).attr("etat", "off");
        }

    })

    $(document.body).on('click', '#contribute', function () {
        $("#profil-menu").hide(200);
        $('#profil').attr("etat", "off");
    })

    $(document.body).on('click','#modalProgressionGlobaleID',function() {
        $("#profil-menu").hide(200) ;
    })

    
});