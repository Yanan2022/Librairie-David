@extends('welcome')
@section('title', 'Livraison')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Liste des livraisons</h4>
                    <div class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <a class="btn btn-success" href="javascript:;" data-toggle="modal"
                            data-target="#exampleModalCenter"><i class="la la-folder-open"></i></a>
                    </div>

                </div>
                <div class="card-body">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nom client</th>
                                <th>Prenom client</th>
                                <th>Contact</th>
                                <th>Longitude départ</th>
                                <th>Latitude départ</th>
                                <th>Longitude destination</th>
                                <th>Latitude destination</th>
                                <th>Description</th>
                                <th>Montant Livraison</th>
                                <th>Bouton action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($liv as $item)
                                <tr>
                                    <td>{{ $item->nomclient }}</td>
                                    <td>{{ $item->prenomclient }}</td>
                                    <td>{{ $item->contactclient }}</td>
                                    <td>{{ $item->long }}</td>
                                    <td>{{ $item->lat }}</td>
                                    <td>{{ $item->long_Arrive }}</td>
                                    <td>{{ $item->lat_Arrive }}</td>
                                    <td>{{ $item->description_colis }}</td>
                                    <td>{{ $item->coutLivraison }}</td>

                                    <td>
                                        <a href="{{ route('livs.edit', $item->id) }}" class="btn btn-warning"><i
                                                class="la la-edit"></i></a>
                                        <a href="{{ route("livs.show", $item->id) }}" class="btn btn-info"><i
                                                class="la la-search-plus"></i></a>
                                        <button class="btn btn-danger delete-row"
                                            data-uri="{{ route('livs.destroy', $item->id) }}"><i
                                                class="la la-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="map" class="map" style="height: 450px;">
                <div id="popup"></div>
            </div>
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
                    <form role="form" action="{{ route('livs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nomclient">Nom du client</label>
                            <input type="text" class="form-control form-control" id="nomclient" name="nomclient"
                                value="{{ old('nomclient') }}">
                        </div>
                        <div class="form-group">
                            <label for="prenomclient">Prénom du client</label>
                            <input type="text" class="form-control form-control" id="prenomclient" name="prenomclient"
                                value="{{ old('prenomclient') }}">
                        </div>

                        <div class="form-group">
                            <label for="contactclient">Contact du client</label>
                            <input type="text" class="form-control form-control" id="contactclient" name="contactclient"
                                value="{{ old('contactclient') }}">
                        </div>

                        <div class="form-group">
                            <label for="long">Longitude point de départ</label>
                            <input type="text" class="form-control form-control" id="long" name="long"
                                value="{{ old('long') }}">
                        </div>
                        <div class="form-group">
                            <label for="lat">Latitude point de départ</label>
                            <input type="text" class="form-control form-control" id="lat" name="lat"
                                value="{{ old('lat') }}">
                        </div>

                        <div class="form-group">
                            <label for="long_Arrive">Longitude point d'arrivée</label>
                            <input type="text" class="form-control form-control" id="long_Arrive" name="long_Arrive"
                                value="{{ old('long_Arrive') }}">
                        </div>
                        <div class="form-group">
                            <label for="lat_Arrive">Latitude point d'arrivée</label>
                            <input type="text" class="form-control form-control" id="lat_Arrive" name="lat_Arrive"
                                value="{{ old('lat_Arrive') }}">
                        </div>

                        <div class="form-group">
                            <label for="idcolis">ID Colis</label>
                            <input type="text" class="form-control form-control" id="idcolis" name="idcolis"
                                value="{{ old('idcolis') }}">
                        </div>

                        <div class="form-group">
                            <label for="description_colis">Description Colis</label>
                            <textarea class="form-control form-control-textarea" id="description_colis"
                                name="description_colis">{{ old('description_colis') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="imagecolis">Image du Colis</label>
                            <input type="file" class="form-control form-control" id="imagecolis" name="imagecolis"
                                accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="coutLivraison">Coût de la livraison</label>
                            <input type="text" class="form-control form-control" id="coutLivraison" name="coutLivraison"
                                value="{{ old('coutLivraison') }}">
                        </div>

                        <div class="form-group">
                            <label for="idEntreprise">Entreprise</label>
                            <select name="idEntreprise" id="idEntreprise" class="form-control form-select">
                                @foreach (App\Models\EntrepriseModel::all() as $ent)
                                    <option value="{{ $ent->id }}">{{ $ent->LibelleEntreprise }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="idArticle">Article</label>
                            <select name="idArticle" id="idArticle" class="form-control form-select">
                                @foreach (App\Models\Tb_articles::all() as $article)
                                    <option value="{{ $article->id }}">{{ $article->LibelleArticle }}</option>
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


    <script>
        // var logoElement = document.createElement('a');
        // logoElement.href = 'https://www.osgeo.org/';
        // logoElement.target = '_blank';

        // var logoImage = document.createElement('img');
        // logoImage.src = 'https://www.osgeo.org/sites/all/themes/osgeo/logo.png';

        // logoElement.appendChild(logoImage);

        var map = L.map('map').setView([5.3203570, -4.0161070], 11);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.Routing.control({
            language: 'fr',
            formatter: new L.Routing.Formatter({
                language: 'fr'
            }),
            waypoints: [{
                    lng: {{ $liv[0]->long }},
                    lat: {{ $liv[0]->lat }}
                },
                {
                    lng: {{ $liv[0]->long_Arrive }},
                    lat: {{ $liv[0]->lat_Arrive }}
                }
            ],
            routeWhileDragging: true
        }).addTo(map);

        // var map = new ol.Map({
        //     layers: [
        //         new ol.layer.Tile({
        //             source: new ol.source.OSM()
        //         })
        //     ],
        //     target: 'map',
        //     view: new ol.View({
        //         center: {lng: 5.3614, lat: -4.1158},
        //         zoom: 11
        //     }),
        //     logo: logoElement
        // });
    </script>
@endsection
