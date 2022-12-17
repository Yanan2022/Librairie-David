@extends('welcome')
@section('title', 'Commandes')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
</div>
<div class="container-fluid text-white">
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary">
                <div class="card-body">
                    <h1 class="float-left"><i class="la la-folder-o"></i></h1>
                    <h1 class="float-right">{{count($articles)}}</h1>
                </div>
                <div class="card-footer">
                    <h4>Articles <a class="btn btn-outline-dark btn-sm float-right " href="{{route('articles.index')}}">Voir+</a></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success">
                <div class="card-body">
                   <h1 class="float-left"><i class="la la-folder-o"></i></h1>
                    <h1 class="float-right">1{{--count($casiers)--}}</h1>
                </div>
                <div class="card-footer">
                    <h4>Casiers <a class="btn btn-outline-dark btn-sm float-right" href="{{--route('casiers.index')--}}">Voir+</a></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger">
                <div class="card-body">
                    <h1 class="float-left"><i class="la la-folder-o"></i></h1>
                    <h1 class="float-right">{{count($categories)}}</h1>
                </div>
                <div class="card-footer">
                    <h4>Categories <a class="btn btn-outline-dark btn-sm float-right" href="{{route('catArts.index')}}">Voir+</a></h4>
                </div>
            </div>
        </div>

         <div class="col-md-3">
            <div class="card bg-info">
                <div class="card-body">
                    <h1 class="float-left"><i class="la la-folder-o"></i></h1>
                    <h1 class="float-right">{{count($commandes)}}</h1>
                </div>
                <div class="card-footer">
                    <h4>Achats <a class="btn btn-outline-dark btn-sm float-right" href="{{route('commandes.index')}}">Voir+</a></h4>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#rangmt"><h4>Rangement</h4></button>
            <div id="rangmt" class="collapse card" >
                {{--@if(count($casiers) > 0) --}}
                    <div class="card-columns p-2">
                       {{-- @foreach($casiers as $casier) --}}
                            <div class="card bg-success">
                                <a class="card-link text-white" href="{{--contenuCasier/{{$casier->id}} --}}#">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><b>Casier 1{{--$casier->nom--}}</b></h5>
                                    </div>
                                </a>
                            </div>
                        {{--@endforeach --}}
                    </div>
                {{--@else --}}
                    <p>Aucun casier cree !!...</p>
                {{--@endif --}}
            </div>
        </div>
    </div>
</div>
@endsection
