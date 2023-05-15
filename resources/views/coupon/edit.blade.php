@extends("welcome")
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $coupon->nom }}</h4>
        </div>
        <div class="card-body">
            <form role="form" action="{{ route('coupons.update', $coupon) }}" method="POST"
                enctype="multipart/form-data" class="container">
                @csrf
                @method("patch")
                <div class="form-group">
                    <label for="CodeArticle">Code</label>
                    <input type="text" class="form-control form-control" id="code" name="code"
                        placeholder="Code" value="{{ old('code', $coupon->code) }}">
                </div>
                <div class="form-group">
                    <label for="LibelleArticle">Pourcentage</label>
                    <input type="text" class="form-control form-control" id="percent_off" name="percent_off"
                        placeholder="Pourcentage" value="{{ old('percent_off', $coupon->percent_off) }}">
                </div>

                <div class="form-group">
                    <label for="date_debut">Date début</label>
                    <input type="date" class="form-control form-control" id="date_debut" name="date_debut"
                        placeholder="Date début" value="{{ old('date_debut', $coupon->date_debut) }}">
                </div>
                <div class="form-group">
                    <label for="date_fin">Date fin</label>
                    <input type="date" class="form-control form-control" id="date_fin" name="date_fin"
                        placeholder="Date fin" value="{{ old('date_fin', $coupon->date_fin) }}">
                </div>

                <div>
                    <button type="button" class="btn btn-wating" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
@endsection
