@extends('welcome')
@section('title',$Tvehicule->$Tvehicule)
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ $Tvehicule->LibelleType }}</h4>
    </div>
    <div class="card-body">
        <form role="form" action="{{ route('Tvehicules.update', $Tvehicule) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method("patch")
             <div class="form-group">
                 <label for="largeInput">Désignation </label>
                 <input type="text" class="form-control form-control" id="LibelleType" name="LibelleType" value="{{ old("LibelleType", $Tvehicule->LibelleType) }}" placeholder="Libelle Type">
             </div>

             <div>
                 <a href="{{ url()->previous() }}" class="btn btn-wating">Fermer</a>
                 <button type="submit" class="btn btn-success">Sauvegarder</button>
             </div>
         </form>
    </div>
</div>

@endsection
