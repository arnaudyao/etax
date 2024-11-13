$(function () {

    $('#id_secteur_activite').on('change', function (e) {
        var id_secteur_activite = e.target.value;
        telUpdate1(id_secteur_activite);
    });

    $('#id_ministere').on('change', function (e) {
        var id_ministere = e.target.value;
        telUpdate2(id_ministere);
    });

    function telUpdate1(id) {
        $.get('/soussecteurlist/' + id, function (data) {
            $('#id_sous_secteur').empty();
            var locale = JSON.parse("<?php echo GoogleTranslate::trans('-- Sous-secteur d\'activité --', app()->getLocale()); ?>");
            $('#id_sous_secteur').append('<option value=""> '+locale+'</option>');
            $.each(data, function (index, tels) {
                $('#id_sous_secteur').append($('<option>', {
                    value: tels.id_sous_secteur,
                    text: tels.libelle_sous_secteur.charAt(0).toUpperCase() + tels.libelle_sous_secteur.slice(1),
                }));
            });
            $.get('/ministereliste/' + id, function (data) {
                $('#id_ministere').empty();
                $('#id_ministere').append('<option value="">-- Ministère --</option>');
                $.each(data, function (index, tels1) {
                    $('#id_ministere').append($('<option>', {
                        value: tels1.id_ministere,
                        text: tels1.libelle_ministere,
                    }));

                    $.get('/structureliste/' + tels1.id_ministere, function (data) {
                        $('#id_structure').empty();
                        $('#id_structure').append('<option value="">-- Structure --</option>');
                        $.each(data, function (index, tels) {
                            $('#id_structure').append($('<option>', {
                                value: tels.id_structure,
                                text: tels.libelle_structure,
                            }));


                        });
                    });

                });
            });

        });
    }

    function telUpdate2(id2) {
        $.get('/structureliste/' + id2, function (data) {
            $('#id_structure').empty();
            $('#id_structure').append('<option value="">-- Structure --</option>');
            $.each(data, function (index, tels) {
                $('#id_structure').append($('<option>', {
                    value: tels.id_structure,
                    text: tels.libelle_structure,
                }));


            });
        });
        $.get('/saliste/' + id2, function (data) {
            $('#id_secteur_activite').empty();
            $('#id_secteur_activite').append('<option value="">-- Secteur d\'activité --</option>');
            $.each(data, function (index, tels) {
                $('#id_secteur_activite').append($('<option>', {
                    value: tels.id_secteur_activite,
                    text: tels.libelle_secteur_activite,
                }));


            });
        });
    }


});
