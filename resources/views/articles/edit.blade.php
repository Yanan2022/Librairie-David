@extends("welcome")
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $article->LibelleArticle }}</h4>
        </div>
        <div class="card-body">
            <form role="form" action="{{ route('articles.update', $article) }}" method="POST"
                enctype="multipart/form-data" class="container">
                @csrf
                @method("patch")
                <div class="form-group">
                    <label for="CodeArticle">Code article</label>
                    <input type="text" class="form-control form-control" id="CodeArticle" name="CodeArticle"
                        placeholder="Code article" value="{{ old('CodeArticle', $article->CodeArticle) }}">
                </div>
                <div class="form-group">
                    <label for="LibelleArticle">Libellé article</label>
                    <input type="text" class="form-control form-control" id="LibelleArticle" name="LibelleArticle"
                        placeholder="Libellé article" value="{{ old('LibelleArticle', $article->LibelleArticle) }}">
                </div>

                <div class="form-group">
                    <label for="PrixArticle">Prix article</label>
                    <input type="text" class="form-control form-control" id="PrixArticle" name="PrixArticle"
                        placeholder="Prix article" value="{{ old('PrixArticle', $article->PrixArticle) }}">
                </div>

                <div class="form-group">
                    <label for="PrixArticle">Quantité</label>
                    <input type="text" class="form-control form-control" id="quantite" name="quantite"
                        placeholder="Quantité" value="{{ old('quantite', $article->quantite) }}">
                </div>

                <div class="form-group">
                    <label for="ImageArticle">Image article</label>
                    <input type="file" class="form-control form-control" id="ImageArticle" name="ImageArticle"
                        placeholder="Image article">
                </div>

                <div class="form-group">
                    <label for="classe">Classe</label>
                    <select class="form-control form-select" name="IdTypeArticle" id="IdTypeArticle">
                        @foreach (App\Models\Classe::all() as $type)
                            <option value="{{ $type->libelle }}" @if (old('IdTypeArticle', $article->IdTypeArticle) == $type->id) selected @endif>
                                {{ $type->libelle }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="StatutArticle">En stock</label>
                    <select class="form-control form-select" name="StatutArticle" id="StatutArticle">
                        @foreach (['En stock', 'Approvisionnement en cours', 'Stock épuisé'] as $etat)
                            <option value="{{ $etat }}" @if (old('StatutArticle', $article->StatutArticle) == $etat) selected @endif>
                                {{ $etat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="IdTypeArticle">Type article</label>
                    <select class="form-control form-select" name="IdTypeArticle" id="IdTypeArticle">
                        @foreach (App\Models\typearticleModel::all() as $type)
                            <option value="{{ $type->id }}" @if (old('IdTypeArticle', $article->IdTypeArticle) == $type->id) selected @endif>
                                {{ $type->LibCategorieArt }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="idkitscolaire">Kit scolaire</label>
                    <select class="form-control form-select" name="idkitscolaire" id="idkitscolaire">
                        @foreach (App\Models\Tb_kitscolaire::all() as $ent)
                            <option value="{{ $ent->id }}" @if (old('idkitscolaire', $article->idkitscolaire) == $type->id) selected @endif>{{ $ent->LibelleKitscolaire }}</option>
                        @endforeach
                    </select>
                </div>

                {{--<div class="form-group">
                    <label for="Entreprise">Entreprise</label>
                    <select class="form-control form-select" name="entreprise_id" id="Entreprise">
                        @foreach (App\Models\EntrepriseModel::all() as $ent)
                            <option value="{{ $ent->id }}" @if (old('entreprise_id', $article->entreprise_id) == $ent->id) selected @endif>
                                {{ $ent->LibelleEntreprise }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <div>
                    <a href="{{ url()->previous() }}" class="btn btn-wating" data-dismiss="modal">Fermer</a>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
@endsection
