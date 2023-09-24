$(document).ready(function () {
    var infos_evolution = document.getElementById('data_evolution');
    var data_evolution = infos_evolution.getAttribute('data-datasession');
    var total_evolution = parseInt(infos_evolution.getAttribute('data-totalsession'));

    if (total_evolution == 0) {
        // document.getElementById(').innerHTML("Aucune évolution");
        $("#the_evolution_globale").html("<h3 class='text-center'>Aucune évolution</h3>") ;
    }
    else {
        var elem_x = [];
        var elem_y1 = [];
        var elem_y2 = [];
        var elem_y3 = [];
        if (data_evolution.indexOf('#') > -1) {
            var data_evolution_tab = data_evolution.split("#");
            for (var i = 0; i < data_evolution_tab.length; i++) {
                var the_data = JSON.parse(data_evolution_tab[i]);
                elem_x.push(i + 1);
                elem_y1.push(the_data.reponseJuste);
                elem_y2.push(the_data.reponseFausse);
                elem_y3.push(the_data.questionNonRepondue);

            }
        }
        else {
            var data_evolution_tab = JSON.parse(data_evolution);
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
            showLegend: true ,
        }

        Plotly.newPlot('the_evolution_globale', data, layout, {displayModeBar: false,staticPlot:true});
    }
})








