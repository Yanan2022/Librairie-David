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
                    <h1 class="float-right">{{count($classe)}}</h1>
                </div>
                <div class="card-footer">
                    <h4>Classes <a class="btn btn-outline-dark btn-sm float-right" href="{{route('classes.index')}}">Voir+</a></h4>
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
            <div class="row" style="color: black;">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Numéro commande</th>
                                        <th>Nom &amp; Prénom client</th>
                                        <th>Téléphone</th>
                                        <th>Ville</th>
                                        <th>Commune</th>
                                        <th>Quartier</th>
                                        <th>Etat</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->code }}</td>
                                            <td>{{ "{$order->nom} {$order->prenoms}" }}</td>
                                            <td>{{ $order->telephone }}</td>
                                            <td>{{ $order->ville }}</td>
                                            <td>{{ $order->commune }}</td>
                                            <td>{{ $order->quartier }}</td>
                                            <td>{{ $order->etat }}</td>
                                            <td>{{ $order->created_at->isoFormat('DD MMM Y, HH:mm') }}</td>
                                            <td>
                                                <a href="{{ route('commandes.show', $order) }}" class="btn btn-info"
                                                    title="Voir la commande"><i class="la la-search-plus"></i></a>
                                                @if ($order->etat == 'Soumis')
                                                    <button data-commande='@json($order)'
                                                        class="btn btn-success valider-commande"><i class="la la-check"
                                                            title="Valider"></i></button>
                                                @endif
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
