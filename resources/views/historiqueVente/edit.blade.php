@extends('welcome')
@section('title', 'Livraison #' . $liv->id)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Livraison #{{ $liv->id }}</h4>
                </div>
                <div class="card-body">
                    <form role="form" action="{{ route('livs.update', $liv) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method("patch")
                        <div class="form-group">
                            <label for="nomclient">Nom du client</label>
                            <input type="text" class="form-control form-control" id="nomclient" name="nomclient"
                                value="{{ old('nomclient', $liv->nomclient) }}">
                        </div>
                        <div class="form-group">
                            <label for="prenomclient">Prénom du client</label>
                            <input type="text" class="form-control form-control" id="prenomclient" name="prenomclient"
                                value="{{ old('prenomclient', $liv->prenomclient) }}">
                        </div>

                        <div class="form-group">
                            <label for="contactclient">Contact du client</label>
                            <input type="text" class="form-control form-control" id="contactclient" name="contactclient"
                                value="{{ old('contactclient', $liv->contactclient) }}">
                        </div>

                        <div class="form-group">
                            <label for="long">Longitude point de départ</label>
                            <input type="text" class="form-control form-control" id="long" name="long"
                                value="{{ old('long', $liv->long) }}">
                        </div>
                        <div class="form-group">
                            <label for="lat">Latitude point de départ</label>
                            <input type="text" class="form-control form-control" id="lat" name="lat"
                                value="{{ old('lat', $liv->lat) }}">
                        </div>

                        <div class="form-group">
                            <label for="long_Arrive">Longitude point d'arrivée</label>
                            <input type="text" class="form-control form-control" id="long_Arrive" name="long_Arrive"
                                value="{{ old('long_Arrive', $liv->long_Arrive) }}">
                        </div>
                        <div class="form-group">
                            <label for="lat_Arrive">Latitude point d'arrivée</label>
                            <input type="text" class="form-control form-control" id="lat_Arrive" name="lat_Arrive"
                                value="{{ old('lat_Arrive', $liv->lat_Arrive) }}">
                        </div>

                        <div class="form-group">
                            <label for="idcolis">ID Colis</label>
                            <input type="text" class="form-control form-control" id="idcolis" name="idcolis"
                                value="{{ old('idcolis', $liv->idcolis) }}">
                        </div>

                        <div class="form-group">
                            <label for="description_colis">Description Colis</label>
                            <textarea class="form-control form-control-textarea" id="description_colis"
                                name="description_colis">{{ old('description_colis', $liv->description_colis) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="imagecolis">Image du Colis</label>
                            <input type="file" class="form-control form-control" id="imagecolis" name="imagecolis"
                                accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="coutLivraison">Coût de la livraison</label>
                            <input type="text" class="form-control form-control" id="coutLivraison" name="coutLivraison"
                                value="{{ old('coutLivraison', $liv->coutLivraison) }}">
                        </div>

                        <div class="form-group">
                            <label for="idEntreprise">Entreprise</label>
                            <select name="idEntreprise" id="idEntreprise" class="form-control form-select">
                                @foreach (App\Models\EntrepriseModel::all() as $ent)
                                    <option value="{{ $ent->id }}" @if ($liv->idEntreprise == $ent->id) selected @endif>
                                        {{ $ent->LibelleEntreprise }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="idArticle">Article</label>
                            <select name="idArticle" id="idArticle" class="form-control form-select">
                                @foreach (App\Models\Tb_articles::all() as $article)
                                    <option value="{{ $article->id }}" @if ($liv->idArticle == $article->id) selected @endif>
                                        {{ $article->LibelleArticle }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <a href="{{ url()->previous() }}" class="btn btn-wating">Fermer</a>
                            <button type="submit" class="btn btn-success">Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
