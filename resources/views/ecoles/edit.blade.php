@extends("welcome")
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $ecole->libelle }}</h4>
        </div>
        <div class="card-body">
            <form role="form" action="{{ route('kitecoles.update', $ecole) }}" method="POST"
                enctype="multipart/form-data" class="container">
                @csrf
                @method("patch")
                <div class="form-group">
                    <label for="CodeArticle">Code</label>
                    <input type="text" class="form-control form-control" id="code" name="code"
                        placeholder="Code" value="{{ old('code', $ecole->code) }}">
                </div>
                <div class="form-group">
                    <label for="LibelleArticle">Libelle</label>
                    <input type="text" class="form-control form-control" id="LibelleArticle" name="libelle"
                        placeholder="Libelle" value="{{ old('libelle', $ecole->libelle) }}">
                </div>

                <div class="form-group">
                    <label for="PrixArticle">Contact</label>
                    <input type="text" class="form-control form-control" id="PrixArticle" name="contact"
                        placeholder="Prix article" value="{{ old('contact', $ecole->contact) }}">
                </div>

                <div class="form-group">
                    <label for="PrixArticle">Email</label>
                    <input type="email" class="form-control form-control" id="email" name="email"
                        placeholder="Email" value="{{ old('email', $ecole->email) }}">
                </div>

                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control form-control" id="image" name="image"
                        placeholder="Image ">
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="btn btn-wating" data-dismiss="modal">Fermer</a>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
@endsection
