@extends('welcome')
@section('title', $entreprise->LibelleEntreprise)
@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $entreprise->LibelleEntreprise }}</h4>
        </div>
        <div class="card-body">
            <form role="form" action="{{ route("entreprises.update", $entreprise) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("patch")
                <div class="form-group">
                    <label for="largeInput">Code Entreprise</label>
                    <input type="text" class="form-control form-control" id="CodeEntreprise" name="CodeEntreprise"
                        placeholder="Code article" value="{{ old("CodeEntreprise", $entreprise->CodeEntreprise) }}">
                </div>
                <div class="form-group">
                    <label for="largeInput">Libellé</label>
                    <input type="text" class="form-control form-control" id="LibelleEntreprise" name="LibelleEntreprise"
                        placeholder="Code article" value="{{ old("LibelleEntreprise", $entreprise->LibelleEntreprise) }}">
                </div>

                <div class="form-group">
                    <label for="largeInput">Contact</label>
                    <input type="text" class="form-control form-control" id="ContactEntreprise" name="ContactEntreprise"
                        placeholder="Prix article" value="{{ old("ContactEntreprise", $entreprise->ContactEntreprise) }}">
                </div>

                <div class="form-group">
                    <label for="largeInput">Adresse</label>
                    <input type="text" class="form-control form-control" id="AdresseEntreprise" name="AdresseEntreprise"
                        placeholder="Image article" value="{{ old("AdresseEntreprise", $entreprise->AdresseEntreprise) }}">
                </div>

                <div class="form-group">
                    <label for="largeInput">Mail</label>
                    <input type="text" class="form-control form-control" id="MailEntreprise" name="MailEntreprise"
                        placeholder="Image article" value="{{ old("MailEntreprise", $entreprise->MailEntreprise) }}">
                </div>

                <div class="form-group">
                    <label for="largeInput">Site</label>
                    <input type="text" class="form-control form-control" id="SiteEntreprise" name="SiteEntreprise"
                        placeholder="Image article" value="{{ old("SiteEntreprise", $entreprise->SiteEntreprise) }}">
                </div>

                <div class="form-group">
                    <label for="largeInput">Longitude</label>
                    <input type="text" class="form-control form-control" id="long" name="long" placeholder="Image article" value="{{ old("long", $entreprise->long) }}">
                </div>
                <div class="form-group">
                    <label for="largeInput">Latitude</label>
                    <input type="text" class="form-control form-control" id="lat" name="lat" placeholder="Image article" value="{{ old("lat", $entreprise->lat) }}">
                </div>
                <div class="form-group">
                    <label for="largeInput">Categorie</label>
                    <select name="Id_Catégorie" class="form-control form-select" id="Id_Catégorie">
                        @foreach (App\Models\CatEntreModel::all() as $cat)
                            <option value="{{ $cat->id }}" @if($cat->id == $entreprise->Id_Catégorie) selected @endif>{{ $cat->LibCategorie }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="Id_pays">Pays</label>
                    <select name="Id_pays" id="Id_pays" class="form-select form-control">
                        @foreach (App\Models\paysModel::all() as $pays)
                            <option value="{{ $pays->id }}" @if($pays->id == $entreprise->Id_pays) selected @endif>{{ $pays->NomPays }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" type="button" class="btn btn-wating" data-dismiss="modal">Fermer</a>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

@endsection
