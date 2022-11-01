@extends('welcome')
@section('title', "Véhicule #{$vehicule->id}")
@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ "Véhicule #{$vehicule->id}" }}</h4>

        </div>
        <div class="card-body">
            <form role="form" action="{{ route('vehicules.update', $vehicule) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("patch")
                <div class="form-group">
                    <label for="largeInput">Marque </label>
                    <input type="text" class="form-control form-control" id="marque" name="marque" value="{{ old("marque", $vehicule->marque) }}" placeholder="marque">
                </div>
                <div class="form-group">
                    <label for="largeInput">Couleur </label>
                    <input type="text" class="form-control form-control" id="couleur" name="couleur" value="{{ old("couleur", $vehicule->couleur) }}" placeholder="Couleur">
                </div>
                <div class="form-group">
                    <label for="largeInput">Capacité</label>
                    <input type="text" class="form-control form-control" id="capacite" name="capacite" value="{{ old("capacite", $vehicule->capacite) }}"
                        placeholder="Capacité">
                </div>
                <div class="form-group">
                    <label for="largeInput">Numéro carte grise </label>
                    <input type="text" class="form-control form-control" id="numerocarteGrise" name="numerocarteGrise" value="{{ old("numerocarteGrise", $vehicule->numerocarteGrise) }}"
                        placeholder="numerocarteGrise">
                </div>
                <div class="form-group">
                    <label for="largeInput">Nom proprietaire </label>
                    <input type="text" class="form-control form-control" id="nomproprietaire" name="nomproprietaire" value="{{ old("nomproprietaire", $vehicule->nomproprietaire) }}"
                        placeholder="Nom proprietaire">
                </div>
                <div class="form-group">
                    <label for="largeInput">Nom conducteur </label>
                    <input type="text" class="form-control form-control" id="nomconducteur" name="nomconducteur" value="{{ old("nomconducteur", $vehicule->nomconducteur) }}"
                        placeholder="Nom conducteur">
                </div>
                <div class="form-group">
                    <label for="largeInput">Type véhicule</label>
                    <select name="idTypeV" id="idTypeV" class="form-control form-select">
                        @foreach (App\Models\typevehiculeModel::all() as $type)
                            <option value="{{ $type->id }}" @if(old("idTypeV", $vehicule->idTypeV) == $type->id) selected @endif>{{ $type->LibelleType }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <a href="{{ route("vehicules.index") }}" class="btn btn-wating" >Fermer</a>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

@endsection
