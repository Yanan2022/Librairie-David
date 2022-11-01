@extends('welcome')
@section('title', $pay->NomPays)
@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $pay->NomPays }}</h4>
        </div>
        <div class="card-body">
            <form role="form" action="{{ route('pays.update', $pay) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("patch")
                <div class="form-group">
                    <label for="largeInput">Nom Pays</label>
                    <input type="text" class="form-control form-control" id="NomPays" name="NomPays" value="{{ old("NomPays", $pay->NomPays) }}" placeholder="Nom Pays">
                </div>
                <div class="form-group">
                    <label for="largeInput">Icon Pays</label>
                    <input type="text" class="form-control form-control" id="IconPays" name="IconPays" value="{{ old("IconPays", $pay->IconPays) }}"
                        placeholder="Icon Pays">
                </div>

                <div class="form-group">
                    <label for="largeInput">Devise Pays</label>
                    <input type="text" class="form-control form-control" id="DevisePays" name="DevisePays" value="{{ old("DevisePays", $pay->DevisePays) }}"
                        placeholder="Devise Pays">
                </div>

                <div>
                    <a href="{{ route("pays.update", $pay) }}" class="btn btn-wating">Fermer</a>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

@endsection
