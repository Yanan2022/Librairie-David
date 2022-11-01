@extends('welcome')
@section('title', $category->LibCategorie)
@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $category->LibCategorie }}</h4>
        </div>
        <div class="card-body">
            <form role="form" action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("patch")
                <div class="form-group">
                    <label for="largeInput">Désignation catégorie</label>
                    <input type="text" class="form-control form-control" id="LibCategorie" name="LibCategorie"
                        placeholder="Code article" value="{{ old('LibCategorie', $category->LibCategorie) }}">
                </div>

                <div>
                    <a href="{{ route('categories.index') }}" class="btn btn-wating">Fermer</a>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

@endsection
