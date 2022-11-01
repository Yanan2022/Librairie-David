@extends('welcome')
@section('title', 'Type véhicule')
@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Liste des catégories</h4>
            <div class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <a class="btn btn-success" href="javascript:;" data-toggle="modal" data-target="#exampleModalCenter"><i
                        class="la la-folder-open"></i></a>
            </div>

        </div>
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Marque</th>
                        <th>couleur</th>
                        <th>capacite</th>
                        <th>numero carte Grise</th>
                        <th>nom proprietaire</th>
                        <th>nom conducteur</th>
                        <th>Type véhicule</th>

                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehic as $item)
                        <tr>
                            <td>{{ $item->marque }}</td>
                            <td>{{ $item->couleur }}</td>
                            <td>{{ $item->capacite }}</td>
                            <td>{{ $item->numerocarteGrise }}</td>
                            <td>{{ $item->nomproprietaire }}</td>
                            <td>{{ $item->nomconducteur }}</td>
                            <td>@if($item->type) {{ $item->type->LibelleType  }} @else - @endif</td>

                            <td>
                                <a href="{{ route('vehicules.edit', $item->id) }}" class="btn btn-warning"><i
                                        class="la la-edit"></i></a>
                                <button class="btn btn-info"><i class="la la-search-plus"></i></button>
                                <button class="btn btn-danger delete-row"
                                    data-uri="{{ route('vehicules.destroy', $item->id) }}"><i
                                        class="la la-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h6 class="modal-title"><i class="la la-folder-open"></i> Ajout d'un catégorie</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form role="form" action="{{ route('vehicules.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="largeInput">Marque </label>
                            <input type="text" class="form-control form-control" id="marque" name="marque"
                                placeholder="marque">
                        </div>
                        <div class="form-group">
                            <label for="largeInput">Couleur </label>
                            <input type="text" class="form-control form-control" id="couleur" name="couleur"
                                placeholder="Couleur">
                        </div>
                        <div class="form-group">
                            <label for="largeInput">Capacité</label>
                            <input type="text" class="form-control form-control" id="capacite" name="capacite"
                                placeholder="Capacité">
                        </div>
                        <div class="form-group">
                            <label for="largeInput">Numéro carte grise </label>
                            <input type="text" class="form-control form-control" id="numerocarteGrise"
                                name="numerocarteGrise" placeholder="numerocarteGrise">
                        </div>
                        <div class="form-group">
                            <label for="largeInput">Nom proprietaire </label>
                            <input type="text" class="form-control form-control" id="nomproprietaire" name="nomproprietaire"
                                placeholder="Nom proprietaire">
                        </div>
                        <div class="form-group">
                            <label for="largeInput">Nom conducteur </label>
                            <input type="text" class="form-control form-control" id="nomconducteur" name="nomconducteur"
                                placeholder="Nom conducteur">
                        </div>
                        <div class="form-group">
                            <label for="largeInput">Type véhicule</label>
                            <select name="idTypeV" id="idTypeV" class="form-control form-select">
                                @foreach (App\Models\typevehiculeModel::all() as $type)
                                    <option value="{{ $type->id }}">{{ $type->LibelleType }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="button" class="btn btn-wating" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-success">Sauvegarder</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();

            $(".delete-row").click(function(e) {
                e.preventDefault();
                if (confirm("Voulez-vous vraiment supprimer cet élément ?")) {
                    $.post($(this).data("uri"), {
                            _method: "delete",
                            _token: "{{ csrf_token() }}"
                        })
                        .done(function(res) {
                            $.notify({
                                icon: 'la la-check',
                                title: 'Information',
                                message: res.message,
                            }, {
                                type: 'success',
                                placement: {
                                    from: "bottom",
                                    align: "right"
                                },
                                time: 3000,
                            });
                            window.location.reload();
                        })
                        .fail(function(err) {
                            $.notify({
                                icon: 'la la-times',
                                title: 'Erreur',
                                message: err.responseJSON?.message,
                            }, {
                                type: 'error',
                                placement: {
                                    from: "bottom",
                                    align: "right"
                                },
                                time: 3000,
                            });
                        });
                }
            })
        });
    </script>

@endsection
