@extends('welcome')
@section('title', $catArt->LibCategorieArt)
@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $catArt->LibCategorieArt }}</h4>
        </div>
        <div class="card-body">
            <form role="form" action="{{ route('catArts.update', $catArt) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("patch")
                <div class="form-group">
                    <label for="largeInput">Désignation catégorie</label>
                    <input type="text" class="form-control form-control" id="LibCategorieArt" name="LibCategorieArt"
                        value="{{ old('LibCategorieArt', $catArt->LibCategorieArt) }}" placeholder="Code article">
                </div>
                <div class="form-group">
                    <label for="type_parent">Type parent</label>
                    <select name="type_parent_id" id="type_parent" class="form-control form-select">
                        <option value="" selected>Pas de type parent</option>
                        @foreach (App\Models\typearticleModel::where('id', '!=', $catArt->id)->where('type_parent_id', null) as $type)
                            <option value="{{ $type->id }}" @if ($type->id == $catArt->type_parent_id) selected @endif>
                                {{ $type->LibCategorieArt }} </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <a href="{{ route('catArts.index') }}" class="btn btn-wating">Fermer</a>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

@endsection
