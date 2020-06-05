@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    @include('Admin.flashMessage.flash')
    <div class="card">
        <div class="card-header">
            @yield('onTable')
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-sm table-striped responsive nowrap">
                <thead class="thead-dark">
                <tr>
                    @yield('thead')
                </tr>
                </thead>
                <tbody>
                @yield('tbody')
                </tbody>
            </table>
        </div>
    </div>
    @yield('other')
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                    "lengthMenu": [[15, 25, 50], [15, 25, 50]],
                    "language": {
                        "sEmptyTable": "Aucune donnée disponible dans le tableau",
                        "sInfo": " _START_ à _END_ sur _TOTAL_ éléments",
                        "sInfoEmpty": "Aucun élément",
                        "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ",",
                        "sLengthMenu": "Afficher au plus _MENU_ éléments",
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
                    }
                }
            );

            setTimeout(function () {
                $('button.close-alert').click();
            }, 3000);
        });
    </script>
@endsection