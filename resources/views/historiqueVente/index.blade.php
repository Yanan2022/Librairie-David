@extends('welcome')
@section('title', 'Historique vente')
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Liste des historiques de vente</h4>
        <div class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <a class="btn btn-success" href="javascript:;" data-toggle="modal" data-target="#exampleModalCenter"><i
                    class="la la-folder-open"></i></a>
        </div>

    </div>
    <div class="card-body">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nom & Prenom client</th>
                    <th>Nom & Prenom vendeur</th>
                    <th>Contact client</th>
                    {{-- <th>Lieu livraison</th> --}}
                    <th>Montant Commande</th>
                    {{-- <th>Montant Livraison</th> --}}
                    <th>Status Commande</th>
                    {{-- <th>Date Livraison</th> --}}
                    <th>Bouton action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($livraisons as $item)
                    <tr>
                        <td style="width:15%">
                            {{ $item->nomclient.' '.$item->prenomclient }}
                        </td>
                        <td style="width:15%">
                            {{ $item->nomlivreur.' '.$item->prenomlivreur }}
                        </td>
                        <td style="width:10%">
                            {{ $item->contactclient }}
                        </td>
                        {{-- <td style="width: 20%">
                            {{ $item->ville.' '.$item->commune.' '.$item->quartier }}
                        </td> --}}
                        <td>{{ $item->commande_montant }}</td>
                        {{-- <td>1500.0</td> --}}
                        <td>{{ $item->etat }}</td>
                        {{-- <td>{{ $item->created_at->isoFormat('DD MMM Y, HH:mm') }}</td> --}}
                        <td>
                            <a href="{{ route('livs.edit', $item->id) }}" class="btn btn-warning"><i
                                    class="la la-edit"></i></a>
                            <a href="{{ route('livs.show', $item->id) }}" class="btn btn-info">
                                <i class="la la-search-plus"></i>
                            </a>
                            <button class="btn btn-danger delete-row"
                                data-uri="{{ route('livs.destroy', $item->id) }}"><i
                                    class="la la-trash"></i>
                            </button>
                            @if ($item->etat == "Accepté")
                                <a href="{{ route('commandeEmporte', $item->id) }}" class="btn btn-success valider-commande">
                                    Emporté
                                </a>
                             @elseif ($item->etat == "Emporté")
                                <a href="{{ route('commandeLivre', $item->id) }}" class="btn btn-success valider-commande">
                                    Livré
                                </a>
                            @endif
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
                <h6 class="modal-title"><i class="la la-folder-open"></i> Ajouter un nouveau article</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form role="form" action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="CodeArticle">Code article</label>
                        <input type="text" class="form-control form-control" id="CodeArticle" name="CodeArticle"
                            placeholder="Code article">
                    </div>
                    <div class="form-group">
                        <label for="LibelleArticle">Libellé article</label>
                        <input type="text" class="form-control form-control" id="LibelleArticle" name="LibelleArticle"
                            placeholder="Libellé article">
                    </div>

                    <div class="form-group">
                        <label for="PrixArticle">Prix article</label>
                        <input type="text" class="form-control form-control" id="PrixArticle" name="PrixArticle"
                            placeholder="Prix article">
                    </div>

                    <div class="form-group">
                        <label for="PrixArticle">Quantité</label>
                        <input type="text" class="form-control form-control" id="PrixArticle" name="quantite"
                            placeholder="Quantité">
                    </div>

                    <div class="form-group">
                        <label for="ImageArticle">Image article</label>
                        <input type="file" class="form-control form-control" id="ImageArticle" name="ImageArticle"
                            placeholder="Image article">
                    </div>

                    <div class="form-group">
                        <label for="classe">Classe</label>
                        <select class="form-control form-select" name="classe" id="classe">
                            <option value="cp1">CP1</option>
                            <option value="cp2">CP2</option>
                            <option value="ce1">CE1</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="StatutArticle">En stock</label>
                        <select class="form-control form-select" name="StatutArticle" id="StatutArticle">
                            <option value="En stock">En stock</option>
                            <option value="Approvisionnement en cours">Approvisionnement en cours</option>
                            <option value="Stock épuisé">Stock épuisé</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="IdTypeArticle">Type article</label>
                        <select class="form-control form-select" name="IdTypeArticle" id="IdTypeArticle">
                            @foreach (App\Models\typearticleModel::all() as $type)
                                <option value="{{ $type->id }}">{{ $type->LibCategorieArt }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="idkitscolaire">Kit scolaire</label>
                        <select class="form-control form-select" name="idkitscolaire" id="idkitscolaire">
                            @foreach (App\Models\Tb_kitscolaire::all() as $ent)
                                <option value="{{ $ent->id }}">{{ $ent->LibelleKitscolaire }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{--<div class="form-group">
                        <label for="Entreprise">Entreprise</label>
                        <select class="form-control form-select" name="entreprise_id" id="Entreprise">
                            @foreach (App\Models\EntrepriseModel::all() as $ent)
                                <option value="{{ $ent->id }}">{{ $ent->LibelleEntreprise }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <input type="text" name="entreprise_id" value="1" hidden="hidden">
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
