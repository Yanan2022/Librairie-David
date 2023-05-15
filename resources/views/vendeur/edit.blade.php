@extends("welcome")
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $vendeur->nom }}</h4>
        </div>
        <div class="card-body">
            <form role="form" action="{{ route('vendeurs.update', $vendeur) }}" method="POST"
                enctype="multipart/form-data" class="container">
                @csrf
                @method("patch")
                <div class="form-group">
                    <label for="CodeArticle">Nom</label>
                    <input type="text" class="form-control form-control" id="nom" name="nom"
                        placeholder="Code article" value="{{ old('nom', $vendeur->nom) }}">
                </div>
                <div class="form-group">
                    <label for="LibelleArticle">Prénom</label>
                    <input type="text" class="form-control form-control" id="LibelleArticle" name="prenom"
                        placeholder="Prénom" value="{{ old('prenom', $vendeur->prenom) }}">
                </div>

                <div class="form-group">
                    <label for="PrixArticle">Contact</label>
                    <input type="text" class="form-control form-control" id="PrixArticle" name="contact"
                        placeholder="Prix article" value="{{ old('contact', $vendeur->contact) }}">
                </div>

                <div class="form-group">
                    <label for="PrixArticle">Email</label>
                    <input type="email" class="form-control form-control" id="email" name="email"
                        placeholder="Email" value="{{ old('email', $vendeur->email) }}">
                </div>

                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control form-control" id="photo" name="photo"
                        placeholder="Image article">
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="btn btn-wating" data-dismiss="modal">Fermer</a>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
@endsection
