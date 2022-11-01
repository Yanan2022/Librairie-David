@extends('welcome')
@section('title', 'Entreprise')
@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Liste des entrepises</h4>
            <div class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <a class="btn btn-success" href="javascript:;" data-toggle="modal" data-target="#exampleModalCenter"><i
                        class="la la-folder-open"></i></a>
            </div>

        </div>
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Code Entreprise</th>
                        <th>Libellé Entreprise</th>
                        <th>Contact</th>
                        <th>Adresse</th>
                        <th>Mail</th>
                        <th>Site web</th>
                        <th>Bouton action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ent as $item)
                        <tr>
                            <td>{{ $item->CodeEntreprise }}</td>
                            <td>{{ $item->LibelleEntreprise }}</td>
                            <td>{{ $item->ContactEntreprise }}</td>
                            <td>{{ $item->AdresseEntreprise }}</td>
                            <td>{{ $item->MailEntreprise }}</td>
                            <td>{{ $item->SiteEntreprise }}</td>
                            <td>
                                <a href="{{ route('entreprises.edit', $item->id) }}" class="btn btn-warning"><i
                                        class="la la-edit"></i></a>
                                <button class="btn btn-info"><i class="la la-search-plus"></i></button>
                                <button class="btn btn-danger delete-row"
                                    data-uri="{{ route('entreprises.destroy', $item->id) }}"><i
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
                    <h6 class="modal-title"><i class="la la-folder-open"></i> Ajout</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form role="form" action="{{ route('entreprises.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="largeInput">Code Entreprise</label>
                            <input type="text" class="form-control form-control" id="CodeEntreprise" name="CodeEntreprise"
                                placeholder="Code article">
                        </div>
                        <div class="form-group">
                            <label for="largeInput">Libellé</label>
                            <input type="text" class="form-control form-control" id="LibelleEntreprise"
                                name="LibelleEntreprise" placeholder="Code article">
                        </div>

                        <div class="form-group">
                            <label for="largeInput">Contact</label>
                            <input type="text" class="form-control form-control" id="ContactEntreprise"
                                name="ContactEntreprise" placeholder="Prix article">
                        </div>

                        <div class="form-group">
                            <label for="largeInput">Adresse</label>
                            <input type="text" class="form-control form-control" id="AdresseEntreprise"
                                name="AdresseEntreprise" placeholder="Image article">
                        </div>

                        <div class="form-group">
                            <label for="largeInput">Mail</label>
                            <input type="text" class="form-control form-control" id="MailEntreprise" name="MailEntreprise"
                                placeholder="Image article">
                        </div>

                        <div class="form-group">
                            <label for="largeInput">Site</label>
                            <input type="text" class="form-control form-control" id="SiteEntreprise" name="SiteEntreprise"
                                placeholder="Image article">
                        </div>

                        <div class="form-group">
                            <label for="largeInput">Longitude</label>
                            <input type="text" class="form-control form-control" id="long" name="long"
                                placeholder="Image article">
                        </div>
                        <div class="form-group">
                            <label for="largeInput">Latitude</label>
                            <input type="text" class="form-control form-control" id="lat" name="lat"
                                placeholder="Image article">
                        </div>
                        <div class="form-group">
                            <label for="largeInput">Categorie</label>
                            <select name="Id_Catégorie" class="form-control form-select" id="Id_Catégorie">
                                @foreach (App\Models\CatEntreModel::all() as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->LibCategorie }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="largeInput">Pays</label>
                            <select name="Id_pays" id="Id_pays" class="form-select form-control">
                                @foreach (App\Models\paysModel::all() as $pays)
                                    <option value="{{ $pays->id }}">{{ $pays->NomPays }}</option>
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

    <script>
        function maPosition(position) {
            console.log(position);
            var infopos = "Position déterminée :\n";
            infopos += "Latitude : " + position.coords.latitude + "\n";
            infopos += "Longitude: " + position.coords.longitude + "\n";
            infopos += "Altitude : " + position.coords.altitude + "\n";
            //   document.getElementById("infoposition").innerHTML = infopos;
            document.getElementById("long").value = position.coords.longitude;
            document.getElementById("lat").value = position.coords.latitude;
        }

        if (navigator.geolocation)
            navigator.geolocation.getCurrentPosition(maPosition);
    </script>
@endsection
