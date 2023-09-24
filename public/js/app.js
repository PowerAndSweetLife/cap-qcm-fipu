const URL = "https://fipu.cap-qcm.com/";
$(document).ready(function () {

    $(document.body).on("click", "#bars-menu", function () {
        $("#menu-slide").css({
            "display": "block",
        });
        $("#bars-menu").css({
            "display": "none",
        })
        $("#bars-menu-icon").css({
            "display": "none",
        })
        $("#bars-menu-close").css({
            "display": "inline-block",
        })
        $("#bars-menu-close-icon").css({
            "display": "inline-block",
        })
    })

    $(document.body).on("click", "#bars-menu-close", function () {
        $("#bars-menu-close").css({
            "display": "none",
        })
        $("#bars-menu-close-icon").css({
            "display": "none",
        })
        $("#bars-menu").css({
            "display": "inline-block",
        })
        $("#bars-menu-icon").css({
            "display": "inline-block",
        })
        $("#menu-slide").css({
            "display": "none",
        });
    })




    var qst_id = 0;
    $(document.body).on('click', '.noteReponse', function () {
        if ($(this).val() == 'oui') {
            $(".toHide").slideDown(200);
        }
        else {
            $(".toHide").slideUp(200);
        }
    })


    $(".code").hide();

    $(document.body).on('change', '#categorie', function () {

        if ($(this).val() == 'c-fipu') {
            $("#revision").attr("href", URL + "AllControllers/revision/c-fipu");


            // Swal.fire(
            //     'Section en cours de développement',
            //     'Cet accès sera bientôt disponible',
            //     'warning'
            // )

            // $("#revision").hide();
            // $("#btnContinuer").hide();
        }
        else {
            $("#revision").attr("href", URL + "AllControllers/revision/agent-fipu");
            // $("#btnContinuer").show();
            // $("#revision").show();
        }
    });
    $(document.body).on('change', '#mode', function () {
        $("#code").val("");
        if ($(this).val() == 'contribuer') {
            $("#contribute").click();
            $(".code").hide(200);
            $("#btnContinuer").addClass('d-none');
            $("#revision").addClass("d-none");
            $("#verify_code").addClass("d-none");

        }
        else if ($(this).val() == 'revision') {
            $("#verify_code").addClass("d-none");
            $(".code").hide(200);
            $("#revision").removeClass("d-none");
            $("#btnContinuer").addClass("d-none");
        }
        else if ($(this).val() == 'code') {
            $(".code").show(200);
            $("#btnContinuer").addClass("d-none");
            $("#verify_code").removeClass("d-none");
            $("#revision").addClass("d-none");
        }
        else {
            $("#verify_code").addClass("d-none");
            $(".code").hide(200);
            $("#btnContinuer").removeClass('d-none');
            $("#revision").addClass("d-none");
        }
    });

    $(document.body).on("click", "#verify_code", function () {
        if ($("#code").val() == "") {
            Swal.fire(
                'Attention !',
                "Remplir le champ pour le code",
                'warning'
            )
        }
        else {
            $.ajax({
                url: URL + 'AllControllers/getSession',
                type: 'post',
                data: {
                    'code': $("#code").val(),
                }
            })
                .done(function (data) {
                    if (data.trim() == "exists") {
                        $("#verify_code").addClass("d-none");
                        $("#btnContinuer").removeClass("d-none");
                        $("#btnContinuer").click();
                    }
                    else {

                        Swal.fire(
                            'Attention !',
                            "Ce code n'existe pas",
                            'warning'
                        )
                        // $("#modalParamettres").removeClass("show") ;
                    }
                })
        }

    })


    $(document.body).on('click', '.page-prec', function () {
        var id = $(this).data('id');
        var totale = $(this).data('totale');
        var tracer = $(this).data('tracer');
        if (id > 0) {
            $(".card-questions" + "[data-tracer='" + tracer + "']").addClass('d-none');
            $(".qst-" + id + "[data-tracer='" + tracer + "']").removeClass('d-none');
        }
        else {
            $(".section-menu-anchor").removeClass('activated');
            $(".header-jumper-section").addClass('d-none');
            $(".qst_list").addClass('d-none');
            switch (tracer) {
                case "Français":
                    $(".section-menu-anchor[data-section='" + "Logique" + "']").addClass('activated');
                    $(".header-jumper-section[data-section='" + "Logique" + "']").removeClass('d-none')
                    $(".qst_list[data-section='" + "Logique" + "']").removeClass('d-none');
                    break;
                case "Culture générale":
                    $(".section-menu-anchor[data-section='" + "Français" + "']").addClass('activated');
                    $(".header-jumper-section[data-section='" + "Français" + "']").removeClass('d-none')
                    $(".qst_list[data-section='" + "Français" + "']").removeClass('d-none');
                    break;
                case "Mathématiques":
                    $(".section-menu-anchor[data-section='" + "Culture générale" + "']").addClass('activated');
                    $(".header-jumper-section[data-section='" + "Culture générale" + "']").removeClass('d-none')
                    $(".qst_list[data-section='" + "Culture générale" + "']").removeClass('d-none');
                    break;
                case "Logique":
                    $(".section-menu-anchor[data-section='" + "Mathématiques" + "']").addClass('activated');
                    $(".header-jumper-section[data-section='" + "Mathématiques" + "']").removeClass('d-none')
                    $(".qst_list[data-section='" + "Mathématiques" + "']").removeClass('d-none');
                    break;
            }
        }
    })


    $(document.body).on('click', '.shortcut-qst', function (e) {
        e.stopImmediatePropagation();
        var idQST = $(this).data("id");
        var tracer = $(this).data('tracer');
        $(".header-jumper-section").addClass('d-none');
        $(".header-jumper-section" + "[data-section='" + tracer + "']").removeClass('d-none');
        $(".card-questions" + "[data-tracer='" + tracer + "']").addClass('d-none');
        $(".qst-ID-" + idQST + "[data-tracer='" + tracer + "']").removeClass('d-none');
    })


    $(document.body).on('click', '.page-suiv', function () {
        var id = $(this).data('id');
        var totale = $(this).data('totale');
        var tracer = $(this).data('tracer');
        if (id <= totale) {
            $(".card-questions" + "[data-tracer='" + tracer + "']").addClass('d-none');
            $(".qst-" + id + "[data-tracer='" + tracer + "']").removeClass('d-none');
        }
        else {
            $(".section-menu-anchor").removeClass('activated');
            $(".header-jumper-section").addClass('d-none');
            $(".qst_list").addClass('d-none');
            switch (tracer) {
                case "Français":
                    $(".section-menu-anchor[data-section='" + "Culture générale" + "']").addClass('activated');
                    $(".header-jumper-section[data-section='" + "Culture générale" + "']").removeClass('d-none')
                    $(".qst_list[data-section='" + "Culture générale" + "']").removeClass('d-none');
                    break;
                case "Culture générale":
                    $(".section-menu-anchor[data-section='" + "Mathématiques" + "']").addClass('activated');
                    $(".header-jumper-section[data-section='" + "Mathématiques" + "']").removeClass('d-none')
                    $(".qst_list[data-section='" + "Mathématiques" + "']").removeClass('d-none');
                    break;
                case "Mathématiques":
                    $(".section-menu-anchor[data-section='" + "Logique" + "']").addClass('activated');
                    $(".header-jumper-section[data-section='" + "Logique" + "']").removeClass('d-none')
                    $(".qst_list[data-section='" + "Logique" + "']").removeClass('d-none');
                    break;
                case "Logique":
                    $(".section-menu-anchor[data-section='" + "Français" + "']").addClass('activated');
                    $(".header-jumper-section[data-section='" + "Français" + "']").removeClass('d-none')
                    $(".qst_list[data-section='" + "Français" + "']").removeClass('d-none');
                    break;
            }
        }
    })


    $(document.body).on('click', '.section-menu-anchor', function () {
        $(".section-menu-anchor").removeClass('activated');
        $(this).addClass('activated');
        var section = $(this).data('section');
        $(".header-jumper-section").addClass('d-none');
        $(".header-jumper-section[data-section='" + section + "']").removeClass('d-none');
        $(".qst_list").addClass('d-none');
        $(".qst_list[data-section='" + section + "']").removeClass('d-none');
    })


    $(document.body).on('click', '.section-menu-categorie-anchor', function () {
        $(".section-menu-categorie-anchor").removeClass('activated');
        $(this).addClass('activated');
    })


    $(document.body).on('click', '.check-question', function (a) {
        a.stopImmediatePropagation();
        var remarque = $(this).data('remarque');
        var idreponse = $(this).data('idreponse');
        var qstID = $(this).data('question');
        // console.log(a.target.checked) ;

        // if ($(".check-question-" + qstID).is(':checked') == true) {
        if (a.target.checked == true) {
            $(".check-question-" + qstID).attr('data-etat', 'off');
            $(".check-question-" + qstID + "[data-idreponse='" + idreponse + "']").attr("data-etat", 'on');
            $(".check-question-" + qstID).prop("checked", false);
            $(".check-question-" + qstID + "[data-idreponse='" + idreponse + "']").prop("checked", true);


            var allElems = $(".check-question-" + qstID + "[data-idreponse='" + idreponse + "']").next().text();
            if (allElems.includes('O - Omission')) {
                $(this).parent().parent().attr('data-remarque', "");
                $(this).parent().parent().attr('data-idreponse', "");
            }
            else {
                $(this).parent().parent().attr('data-remarque', remarque);
                $(this).parent().parent().attr('data-idreponse', idreponse);
            }

        }
        else {
            $(".check-question-" + qstID).attr('data-etat', 'off');
            $(".check-question-" + qstID + "[data-idreponse='" + idreponse + "']").attr("data-etat", 'off');
            $(".check-question-" + qstID).prop("checked", false);
            $(".check-question-" + qstID + "[data-idreponse='" + idreponse + "']").prop("checked", false);
            $(this).parent().parent().attr('data-remarque', "");
            $(this).parent().parent().attr('data-idreponse', "");

            // var allElems = $(".check-question-" + qstID + "[data-idreponse='" + idreponse + "']").next().text() ;

        }
    })



});