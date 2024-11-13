$(function () {

    $('#id_secteur_activite').on('change', function (e) {
        var id_secteur_activite = e.target.value;
        telUpdate1(id_secteur_activite);
    });

    function telUpdate1(id) {
        $.get('/soussecteurlist/' + id, function (data) {
            $('#id_sous_secteur').empty();
            $('#id_sous_secteur').append('<option value="">-- Sous-secteur d\'activité --</option>');
            $.each(data, function (index, tels) {
                $('#id_sous_secteur').append($('<option>', {
                    value: tels.id_sous_secteur,
                    text: tels.libelle_sous_secteur.charAt(0).toUpperCase() + tels.libelle_sous_secteur.slice(1),
                }));


            });

        });
    }


});
