$(document).ready(function () {

    var counterH = 0;
    var counterM = 0;
    var counterS = 0;
    var type_temps = $("#timer").data("timer");
    if (type_temps == "chronometre") {
        counterH = 0;
        counterM = 0;
        counterS = 0;
    }
    else if (type_temps == "minuteur") {
        counterH = 1;
        counterM = 30;
        counterS = 0;
    }



    var anim = setInterval(function () {

        if (type_temps == "chronometre") {
            if (counterS == 59) {
                if (counterM == 59) {
                    counterH++;
                    counterM = 0;
                }
                else {
                    counterM++;
                }
                counterS = 0;
            }
            else {
                if (counterH == 1 && counterM == 30 && counterS == 0) {
                    clearInterval(anim);
                    $("#btn-terminate").click();
                }
                else {
                    counterS++;
                }

            }
        }
        else if (type_temps == "minuteur") {

            if (counterS == 0) {
                if (counterM == 0) {


                    // if (counterH == 0) {
                    //     counterH = 0;
                    // }
                    // else {

                    // }
                    if (counterH == 0 && counterM == 0 && counterS == 0) {
                        counterH = 0;
                        counterM = 0;
                        counterS = 0;
                        clearInterval(anim);
                        $("#btn-terminate").click();
                    }
                    else {
                        counterH--;
                        counterM = 59
                    }

                }
                else {
                    counterM--;
                    counterS = 59;

                }



            }
            else {

                // else {
                counterS--;
                // }

            }
        }


        showTimer(counterH, counterM, counterS);
    }, 1000);


    function showTimer(h, m, s) {

        $("#heure").text(h.toString().padStart(2, "0"));
        $("#minute").text(m.toString().padStart(2, "0"));
        $("#seconde").text(s.toString().padStart(2, "0"));
    }



    $(document.body).on('click', '#btn-terminate', function () {
        clearInterval(anim);
        var qst_all = document.getElementsByClassName('list-reform-checkbox');
        var qst_not_answered = 0;
        var qst_answsered = 0;
        var qst_right_answer = 0;
        var qst_wrong_answer = 0;
        for (let i = 0; i < qst_all.length; i++) {
            // console.log(qst_all[i].getAttribute('data-idreponse'));
            if (qst_all[i].getAttribute('data-idreponse') == "") {
                qst_not_answered++;
            }

            if (qst_all[i].getAttribute('data-idreponse') != "") {
                qst_answsered++;
            }

            if (qst_all[i].getAttribute('data-remarque') == "oui") {
                qst_right_answer++;
            }

            if (qst_all[i].getAttribute('data-remarque') == "non") {
                qst_wrong_answer++;
            }
        }

        $("#answered").text(qst_answsered);
        $("#notAnswered").text(qst_not_answered);
        $("#rightAnswer").text(qst_right_answer);
        $("#wrongAnswer").text(qst_wrong_answer);


        var isNote = $("#parametters").data("note");
        if (isNote == "oui") {
            // note exists
            var bonneReponse = $("#parametters").data("bonnereponse");
            var mauvaiseReponse = $("#parametters").data("mauvaisereponse");
            var absenceReponse = $("#parametters").data("absencereponse");

            qst_answsered = parseInt(qst_answsered);
            qst_not_answered = parseInt(qst_not_answered);
            qst_right_answer = parseInt(qst_right_answer);
            qst_wrong_answer = parseInt(qst_wrong_answer);

            $("#pointBonne").text(bonneReponse);
            $("#pointMauvais").text(mauvaiseReponse);
            $("#pointAbsence").text(absenceReponse);


            var total = 0;

            function isFloat(x) {
                return typeof x == "number" && !Number.isInteger(x);
            }

            if (isFloat(bonneReponse)) {
                if (isFloat(mauvaiseReponse)) {
                    if (isFloat(absenceReponse)) {
                        total = (parseFloat(bonneReponse) * qst_right_answer) + (parseFloat(mauvaiseReponse) * qst_wrong_answer) + (parseFloat(qst_not_answered) * absenceReponse);
                    }
                    else {
                        total = (parseFloat(bonneReponse) * qst_right_answer) + (parseFloat(mauvaiseReponse) * qst_wrong_answer) + (parseInt(qst_not_answered) * absenceReponse);
                    }
                }
                else {
                    total = (parseFloat(bonneReponse) * qst_right_answer) + (parseInt(mauvaiseReponse) * qst_wrong_answer) + (parseInt(qst_not_answered) * absenceReponse);
                }
            }
            else {
                if (isFloat(mauvaiseReponse)) {
                    if (isFloat(absenceReponse)) {
                        total = (parseInt(bonneReponse) * qst_right_answer) + (parseFloat(mauvaiseReponse) * qst_wrong_answer) + (parseFloat(qst_not_answered) * absenceReponse);
                    }
                    else {
                        total = (parseInt(bonneReponse) * qst_right_answer) + (parseFloat(mauvaiseReponse) * qst_wrong_answer) + (parseInt(qst_not_answered) * absenceReponse);
                    }
                }
                else {
                    total = (parseInt(bonneReponse) * qst_right_answer) + (parseInt(mauvaiseReponse) * qst_wrong_answer) + (parseInt(qst_not_answered) * absenceReponse);
                }
            }

            // total = (parseInt(bonneReponse) * qst_right_answer) + (parseInt(mauvaiseReponse) * qst_wrong_answer) + (parseInt(qst_not_answered) * absenceReponse);
            // $("#myNote").text(total) ;
            total = (total * 20) / 54
            if (total <= 5) {
                $("#showIfEliminatoire").removeClass('d-none');
            }
            else {
                $("#showIfEliminatoire").addClass('d-none');
            }

            if (isFloat(total)) {
                total = total.toFixed(2);
            }

            $("#the_note").text(total);

        }
        else {
            // note does not exist

            $(".isNoteHideShow").hide();
        }

    })


    $(document.body).on('click', '#fermerReponses', function () {
        $("#btn-terminate").click();
        textToCreate = '';
    })
    var textToCreate = '';
    $(document.body).on('click', '#getResults', function () {
        var elemsToCheck = document.getElementsByClassName('check-question-results');
        var numElem = document.getElementsByClassName('numberOfElement');



        for (var i = 0; i < elemsToCheck.length; i++) {

            var etatResults = elemsToCheck[i].getAttribute('data-remarque');
            var theUL = elemsToCheck[i].parentElement.parentElement;
            if (theUL.getAttribute('data-idreponse') != 0) {
                elemsToCheck[i].setAttribute('checked');
            }

            textToCreate += ')';

            if (etatResults != 'non') {
                elemsToCheck[i].nextElementSibling.nextElementSibling.innerText = ' ( Réponse juste )';
                elemsToCheck[i].nextElementSibling.setAttribute('class', 'text-success');
                // if (numElem.length < 3) {
                // var parent = elemsToCheck[i].parentElement;
                // elemsToCheck[i].nextElementSibling.style.color = 'green';
                // var newSpan = document.createElement('span');
                // newSpan.setAttribute('class', 'text-success');
                // newSpan.setAttribute('style', 'font-weight: bold ;');
                // var contentNewSpan = document.createTextNode(textToCreate);
                // newSpan.appendChild(contentNewSpan);
                // parent.appendChild(newSpan);
                // }

            }
        }
    })

    $(document.body).on('click', '#btn-terminate-initiator', function () {
        Swal.fire({
            title: 'Voulez-vous vraiment terminer la session ?',
            // text: "Voulez-vous vraiment terminer la session ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, terminer!',
            cancelButtonText: 'Annuler',
        }).then((result) => {



            if (result.isConfirmed) {
                $("#btn-terminate").click();
                $.ajax({
                    url: URL + 'AllControllers/saveHistory',
                    type: 'post',
                    data: {
                        'questionRepondue': $("#answered").text(),
                        'questionNonRepondue': $("#notAnswered").text(),
                        'reponseJuste': $("#rightAnswer").text(),
                        'reponseFausse': $("#wrongAnswer").text(),
                    }
                })
                    .done(function (data) {
                        if (data.trim() == "success") {
                            // $("#clickToFinish").click();
                            $.ajax({
                                url: URL + 'AllControllers/getHistory',
                                type: 'post',
                                dataType: 'json',
                            })
                                .done(function (data) {
                                    var total = parseInt(data[0]);
                                    var evolution = data[1];
                                    if (total == 0) {
                                        document.getElementById('the_evolution').innerText("Aucune évolution");
                                    }
                                    else {
                                        var elem_x = [];
                                        var elem_y1 = [];
                                        var elem_y2 = [];
                                        var elem_y3 = [];
                                        if (evolution.indexOf('#') > -1) {
                                            var data_evolution_tab = evolution.split("#");
                                            for (var i = 0; i < data_evolution_tab.length; i++) {
                                                var the_data = JSON.parse(data_evolution_tab[i]);
                                                elem_x.push(i + 1);
                                                elem_y1.push(the_data.reponseJuste);
                                                elem_y2.push(the_data.reponseFausse);
                                                elem_y3.push(the_data.questionNonRepondue);

                                            }
                                        }
                                        else {
                                            var data_evolution_tab = JSON.parse(evolution);
                                            elem_x.push(1);
                                            elem_y1.push(data_evolution_tab.reponseJuste);
                                            elem_y2.push(data_evolution_tab.reponseFausse);
                                            elem_y3.push(data_evolution_tab.questionNonRepondue);
                                        }

                                        var trace1 = {
                                            x: elem_x,
                                            y: elem_y1,
                                            type: 'scatter',
                                            name: 'Bonne réponse',
                                        };

                                        var trace2 = {
                                            x: elem_x,
                                            y: elem_y2,
                                            type: 'scatter',
                                            name: 'Mauvaise réponse',
                                        };

                                        var trace3 = {
                                            x: elem_x,
                                            y: elem_y3,
                                            type: 'scatter',
                                            name: 'Absence de réponse',
                                        };

                                        var data = [trace1, trace2, trace3];
                                        var layout = {
                                            title: 'Evolution',
                                            showLegend: true,
                                        }
                                        Plotly.newPlot('the_evolution', data, layout, { displayModeBar: false, staticPlot: true });
                                    }
                                })

                        }
                    })


            }
        })
    })

    $(document.body).on('click', '#code_session', function () {
        // var code;
        // code = Math.floor((1 + Math.random()) * 0x10000)
        //     .toString(16)
        //     .substring(1);

        var allData = document.getElementsByClassName("card-bringing-data");

        var dataToBring = [];

        for (var i = 0; i < allData.length; i++) {
            dataToBring.push(allData[i].getAttribute("data-question"));
        }
        var data_ok = JSON.stringify(dataToBring);
        $.ajax({
            url: URL + "AllControllers/save_code",
            type: "post",
            data: {
                "code_data": data_ok,
                // "code": code,
            },
            dataType: "json",
        })
            .done(function (data) {
                if (data.success) {
                    $("#code_session").attr("disabled", "true");
                    Swal.fire(
                        'Code',
                        'Votre code est: ' + data.code,
                        'success'
                    )
                }

            })
        // Swal.fire(
        //     'Code',
        //     'Votre code est: '+code,
        //     'success'
        // )

    })


    $(document.body).on('click', '#btnQuitter', function () {
        $("#clickToFinish").click();
        // $.ajax({
        //     url: URL + 'AllControllers/saveHistory',
        //     type: 'post',
        //     data: {
        //         'questionRepondue': $("#answered").text(),
        //         'questionNonRepondue': $("#notAnswered").text(),
        //         'reponseJuste': $("#rightAnswer").text(),
        //         'reponseFausse': $("#wrongAnswer").text(),
        //     }
        // })
        //     .done(function (data) {
        //         if (data.trim() == "success") {
        //             $("#clickToFinish").click();
        //         }
        //     })
    })

    $(document.body).on('click', '#fermerProgression', function () {
        $("#btn-terminate").click();
    })


    $(document.body).on('click', '.the_heart', function () {
        var idqst = $(this).data('idqst');
        var state = $(this).attr('class');
        if (state == "the_heart heartNotFull") {
            $(this).next().removeClass('d-none');
            $(this).addClass('d-none');
            // $(this).children('.heart').attr('class',');


            $.ajax({
                url: URL + 'AllControllers/addToFavorite',
                type: 'post',
                data: {
                    'id': idqst,
                },
            })
                .done(function (data) {
                    if (data.trim() == 'added') {
                        Swal.fire(
                            'Favoris',
                            'La question est ajoutée dans Favoris!',
                            'success'
                        )
                    }
                })
        }
        else {
            // console.log($(this))
            $(this).prev().removeClass('d-none');
            $(this).addClass('d-none');
            $.ajax({
                url: URL + 'AllControllers/removeToFavorite',
                type: 'post',
                data: {
                    'id': idqst,
                },
            })
                .done(function (data) {
                    if (data.trim() == 'removed') {
                        Swal.fire(
                            'Favoris',
                            'La question est suprimée de Favoris!',
                            'success'
                        )
                    }
                })
        }


    });





})