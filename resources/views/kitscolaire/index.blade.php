@extends('welcome')
@section('title', 'Articles')
@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Liste des kits scolaires</h4>
            <div class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <a class="btn btn-success" href="javascript:;" data-toggle="modal" data-target="#exampleModalCenter"><i
                        class="la la-folder-open"></i></a>
            </div>

        </div>
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Désignation</th>
                        <th>Prix</th>
                        <th>Aperçu</th>
                        <th>Statut</th>
                        <th>Type article</th>
                        <th>Quantité</th>
                        <th>Bouton action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kitscolaire as $item)
                        <tr>
                            <td>{{ $item->CodeKitscolaire }}</td>
                            <td>{{ $item->LibelleKitscolaire }}</td>
                            <td>{{ $item->PrixKitscolaire }}</td>
                            <td><img src='images/{{ $item->ImageKitscolaire }}' style="height:30px;widght:30px;"></td>
                            <td>{{ $item->StatutKitscolaire }}</td>
                            <td>{{ $item->IdTypeKitscolaire}}</td>
                            <td>{{ $item->quantite}}</td>
                            <td>
                                <a href="{{ route('kitscolaires.edit', $item->id) }}" class="btn btn-warning"><i
                                        class="la la-edit"></i>
                                </a>
                                <a  href="{{ route('kitscolaires.show', $item->id) }}" class="btn btn-info">
                                    <i class="la la-search-plus"></i>
                                </a>
                                <button class="btn btn-danger delete-row"
                                    data-uri="{{ route('kitscolaires.destroy', $item->id) }}"><i
                                        class="la la-trash">
                                    </i>
                                </button>
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
                    <h6 class="modal-title"><i class="la la-folder-open"></i> Ajouter un nouveau kit scolaire</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form role="form" action="{{ route('kitscolaires.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="CodeKit">Code</label>
                            <input type="text" class="form-control form-control" id="CodeKitscolaire" name="CodeKitscolaire"
                                placeholder="Code Kit">
                        </div>
                        <div class="form-group">
                            <label for="LibelleKit">Libellé</label>
                            <input type="text" class="form-control form-control" id="LibelleKitscolaire" name="LibelleKitscolaire"
                                placeholder="Libellé kit">
                        </div>

                        <div class="form-group">
                            <label for="PrixKit">Prix</label>
                            <input type="text" class="form-control form-control" id="PrixKitscolaire" name="PrixKitscolaire"
                                placeholder="Prix Kit">
                        </div>

                        <div class="form-group">
                            <label for="quantite">Quantité</label>
                            <input type="text" class="form-control form-control" id="quantite" name="quantite"
                                placeholder="Quantité">
                        </div>

                        <div class="form-group">
                            <label for="ImageKit">Image</label>
                            <input type="file" class="form-control form-control" id="ImageKitscolaire" name="ImageKitscolaire"
                                placeholder="Image kit scolaire">
                        </div>

                        <div class="form-group">
                            <label for="StatutKit">En stock</label>
                            <select class="form-control form-select" name="StatutKitscolaire" id="v">
                                <option value="En stock">En stock</option>
                                <option value="Approvisionnement en cours">Approvisionnement en cours</option>
                                <option value="Stock épuisé">Stock épuisé</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="IdTypeKit">Type</label>
                            <select class="form-control form-select" name="IdTypeKitscolaire" id="IdTypeKit">
                                @foreach (App\Models\typearticleModel::all() as $type)
                                    <option value="{{ $type->id }}">{{ $type->LibCategorieArt }}</option>
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
            var table = $('#example').DataTable();

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
