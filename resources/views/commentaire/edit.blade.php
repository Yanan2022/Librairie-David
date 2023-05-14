@extends("welcome")
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $classe->libelle }}</h4>
        </div>
        <div class="card-body">
            <form role="form" action="{{ route('classes.update', $classe->id) }}" method="POST"
                enctype="multipart/form-data" class="container">
                @csrf
                @method("patch")
                <div class="form-group">
                    <label for="CodeArticle">Libelle Classe</label>
                    <input type="text" class="form-control form-control" id="libelle" name="libelle"
                        placeholder="Code article" value="{{ old('libelle', $classe->libelle) }}">
                </div>
                <div>
                    <a href="{{ url()->previous() }}" class="btn btn-wating" data-dismiss="modal">Fermer</a>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
@endsection
