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
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#rangmt">
                <h4>La liste des commandes</h4>
            </button>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nom client</th>
                                        <th>Prenom client</th>
                                        <th>Contact</th>
                                        <th>Longitude départ</th>
                                        <th>Latitude départ</th>
                                        <th>Longitude destination</th>
                                        <th>Latitude destination</th>
                                        <th>Description</th>
                                        <th>Montant Livraison</th>
                                        <th>Bouton action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($liv as $item)
                                        <tr>
                                            <td>{{ $item->nomclient }}</td>
                                            <td>{{ $item->prenomclient }}</td>
                                            <td>{{ $item->contactclient }}</td>
                                            <td>{{ $item->ville }}</td>
                                            <td>{{ $item->commune }}</td>
                                            <td>{{ $item->quartier }}</td>
                                            <td>{{ $item->etat }}</td>
                                            <td>{{ $item->user_id }}</td>

                                            <td>
                                                <a href="{{ route('livs.edit', $item->id) }}" class="btn btn-warning"><i
                                                        class="la la-edit"></i></a>
                                                <a href="{{ route("livs.show", $item->id) }}" class="btn btn-info"><i
                                                        class="la la-search-plus"></i></a>
                                                <button class="btn btn-danger delete-row"
                                                    data-uri="{{ route('livs.destroy', $item->id) }}"><i
                                                        class="la la-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
