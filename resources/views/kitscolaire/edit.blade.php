@extends("welcome")
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $kitscolaire->LibelleKitscolaire }}</h4>
        </div>
        <div class="card-body">
            <form role="form" action="{{ route('kitscolaires.update', $kitscolaire) }}" method="POST"
                enctype="multipart/form-data" class="container">
                @csrf
                @method("patch")
                <div class="form-group">
                    <label for="CodeKitscolaire">Code</label>
                    <input type="text" class="form-control form-control" id="CodeKitscolaire" name="CodeKitscolaire"
                        placeholder="Code kit" value="{{ old('CodeKitscolaire', $kitscolaire->CodeKitscolaire) }}">
                </div>
                <div class="form-group">
                    <label for="LibelleKitscolaire">Libellé</label>
                    <input type="text" class="form-control form-control" id="LibelleKitscolaire" name="LibelleKitscolaire"
                        placeholder="Libellé article" value="{{ old('LibelleKitscolaire', $kitscolaire->LibelleKitscolaire) }}">
                </div>

                <div class="form-group">
                    <label for="PrixKitscolaire">Prix</label>
                    <input type="text" class="form-control form-control" id="PrixKit" name="PrixKitscolaire"
                        placeholder="Prix kit" value="{{ old('PrixKitscolaire', $kitscolaire->PrixKitscolaire) }}">
                </div>

                <div class="form-group">
                    <label for="quantite">Quantité</label>
                    <input type="text" class="form-control form-control" id="quantite" name="quantite"
                        placeholder="Prix kit" value="{{ old('quantite', $kitscolaire->quantite) }}">
                </div>

                <div class="form-group">
                    <label for="ImageKitscolaire">Image</label>
                    <input type="file" class="form-control form-control" id="ImageKitscolaire" name="ImageKitscolaire"
                        placeholder="Image kit">
                </div>

                <div class="form-group">
                    <label for="StatutKitscolaire">En stock</label>
                    <select class="form-control form-select" name="StatutKitscolaire" id="StatutKitscolaire">
                        @foreach (['En stock', 'Approvisionnement en cours', 'Stock épuisé'] as $etat)
                            <option value="{{ $etat }}" @if (old('StatutKitscolaire', $kitscolaire->StatutKitscolaire) == $etat) selected @endif>
                                {{ $etat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="IdTypeKitscolaire">Type</label>
                    <select class="form-control form-select" name="IdTypeKitscolaire" id="IdTypeKitscolaire">
                        @foreach (App\Models\typearticleModel::all() as $type)
                            <option value="{{ $type->id }}" @if (old('IdTypeKitscolaire', $kitscolaire->IdTypeKitscolaire) == $type->id) selected @endif>
                                {{ $type->LibCategorieArt }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="form-group">
                    <label for="Entreprise">Entreprise</label>
                    <select class="form-control form-select" name="entreprise_id" id="Entreprise">
                        @foreach (App\Models\EntrepriseModel::all() as $ent)
                            <option value="{{ $ent->id }}" @if (old('entreprise_id', $kitscolaire->entreprise_id) == $ent->id) selected @endif>
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
