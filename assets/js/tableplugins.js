$(document).ready(function () {
    var collapsedGroups = {};
    var table = $('#datatable').DataTable({
        /* scrollY: 500,
        paging: false, */ // pour mettre une scroll bar à la place
        "lengthMenu": [[5, 10, 20, 50, 100, 200, -1], [5, 10, 20, 50, 100, 200, "Tous"]],
        buttons: ['copy', {
            extend: 'excelHtml5',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7]
            }
        }, , {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            }, , 'colvis'],
        "language": { // traduction en français de la table
            buttons: {
                "copy": "Copier",
                "colvis": "Visibilité des colonnes",
                "testbutt": "Test Translated",
                "coldemo": "Collection Demo Translated"
            },
            "sEmptyTable": "Aucune donnée disponible dans le tableau",
            "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
            "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Afficher _MENU_ éléments",
            "sLoadingRecords": "Chargement...",
            "sProcessing": "Traitement...",
            "sSearch": "Rechercher :",
            "sZeroRecords": "Aucun élément correspondant trouvé",
            "oPaginate": {
                "sFirst": "Premier",
                "sLast": "Dernier",
                "sNext": "Suivant",
                "sPrevious": "Précédent"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            },
            "select": {
                "rows": {
                    "_": "%d lignes sélectionnées",
                    "0": "Aucune ligne sélectionnée",
                    "1": "1 ligne sélectionnée"
                }
            }
        },
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        columnDefs: [{
            className: 'control',
            orderable: false,
            targets: 0
        }]

    });

    table.buttons().container()
        .appendTo('#datatable_wrapper .col-md-6:eq(0)');

    $('#btn-show-all-doc').on('click', expandCollapseAll);

    function expandCollapseAll() {
        table.rows('.parent').nodes().to$().find('td:first-child').trigger('click').length ||
            table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click')
    }

    $('#datatable tbody').on('click', 'tr.group-start', function () {
        var name = $(this).data('name');
        collapsedGroups[name] = !collapsedGroups[name];
        table.draw(false);
    });

});
