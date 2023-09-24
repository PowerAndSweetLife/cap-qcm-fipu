$(document).ready(function () {
    $(document.body).on('click', '#compris-ok', function () {
        $("#design-disclaimer").addClass("d-none");
    })

    $(document.body).on('click', '#inscription_btn', function () {
        $("#design-disclaimer").removeClass("d-none");
    })

    // $(document.body).on('click', '#free_access', function () {

    //     Swal.fire({
    //         title: 'Commencer la session de qcm la plus récente',
    //         // text: "Vous allez être rediriger vers la l'annale 2023",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Oui commencer',
    //         cancelButtonText: 'Annuler',
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $("#click_for_free_access").click() ;
    //         }
    //     })

    // });

    $(document.body).on('click', '#free_access', function () {

        Swal.fire({
            title: 'Choisir une catégorie',
            // text: "Vous allez être rediriger vers la l'annale 2023",
            icon: 'info',
            showCancelButton: false,
            showConfirmButton: false,
            html: `
                <a href="#" id="go_cat_b" class="btn btn-outline-success">Catégorie B</a>
                <a href="#" id="go_cat_a" class="btn btn-outline-primary">Catégorie C</a>
            ` ,
        })

    });


    $(document.body).on('click', '#go_cat_a', function () {
        $("#click_for_free_access").click();
    })

    $(document.body).on('click', '#go_cat_b', function () {
        // Swal.fire(
        //     'Section en cours de développement',
        //     'Cet accès sera bientôt disponible',
        //     'warning'
        // )
        $("#click_for_free_access_c").click();
    })
});