$(document).ready(function () {
    var elemsToCheck = document.getElementsByClassName('check-question-results');
    var numElem = document.getElementsByClassName('numberOfElement');



    for (var i = 0; i < elemsToCheck.length; i++) {
        var textToCreate = '';
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



    $(document.body).on('click','#terminate-revision',function() {
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
            }
        }) ;
    })
})