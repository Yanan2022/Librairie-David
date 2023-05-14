@extends("welcome")
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $encart->libelle }}</h4>
        </div>
        <div class="card-body">
            <form role="form" action="{{ route('encarts.update', $encart) }}" method="POST"
                enctype="multipart/form-data" class="container">
                @csrf
                @method("patch")
                <div class="form-group">
                    <label for="LibelleArticle">Libellé </label>
                    <input type="text" class="form-control form-control" id="LibelleArticle" name="libelle"
                        placeholder="Libellé article" value="{{ old('libelle', $encart->libelle) }}">
                </div>

                <div class="form-group">
                    <label for="ImageArticle">Image encart</label>
                    <input type="file" class="form-control form-control" id="image" name="image"
                        placeholder="Image encart">
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="btn btn-wating" data-dismiss="modal">Fermer</a>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
@endsection
