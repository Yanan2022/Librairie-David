@extends("welcome")
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $kit->LibelleKit }}</h4>
        </div>
        <div class="card-body">
            <form role="form" action="{{ route('kits.update', $kit) }}" method="POST"
                enctype="multipart/form-data" class="container">
                @csrf
                @method("patch")
                <div class="form-group">
                    <label for="CodeArticle">Code Kit</label>
                    <input type="text" class="form-control form-control" id="CodeArticle" name="CodeArticle"
                        placeholder="Code kit" value="{{ old('CodeArticle', $kit->CodeKit) }}">
                </div>
                <div class="form-group">
                    <label for="LibelleArticle">Libellé Kit</label>
                    <input type="text" class="form-control form-control" id="LibelleArticle" name="LibelleArticle"
                        placeholder="Libellé article" value="{{ old('LibelleArticle', $kit->LibelleKit) }}">
                </div>

                <div class="form-group">
                    <label for="PrixArticle">Prix Kit</label>
                    <input type="text" class="form-control form-control" id="PrixKit" name="PrixKit"
                        placeholder="Prix kit" value="{{ old('PrixKit', $kit->PrixKit) }}">
                </div>

                <div class="form-group">
                    <label for="ImageKit">Image kit</label>
                    <input type="file" class="form-control form-control" id="ImageKit" name="ImageKit"
                        placeholder="Image kit">
                </div>

                <div class="form-group">
                    <label for="StatutKit">En stock</label>
                    <select class="form-control form-select" name="StatutKit" id="StatutKit">
                        @foreach (['En stock', 'Approvisionnement en cours', 'Stock épuisé'] as $etat)
                            <option value="{{ $etat }}" @if (old('StatutKit', $kit->StatutArticle) == $etat) selected @endif>
                                {{ $etat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="IdTypeArticle">Type article</label>
                    <select class="form-control form-select" name="IdTypeArticle" id="IdTypeArticle">
                        @foreach (App\Models\typearticleModel::all() as $type)
                            <option value="{{ $type->id }}" @if (old('IdTypeArticle', $kit->IdTypeArticle) == $type->id) selected @endif>
                                {{ $type->LibCategorieArt }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="Entreprise">Entreprise</label>
                    <select class="form-control form-select" name="entreprise_id" id="Entreprise">
                        @foreach (App\Models\EntrepriseModel::all() as $ent)
                            <option value="{{ $ent->id }}" @if (old('entreprise_id', $kit->entreprise_id) == $ent->id) selected @endif>
                                {{ $ent->LibelleEntreprise }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="btn btn-wating" data-dismiss="modal">Fermer</a>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
@endsection
