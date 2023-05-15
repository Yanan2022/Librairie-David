@extends('welcome')
@section('title', 'Commandes')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Liste des Commandes</h4>
                </div>
                <div class="card-body">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Numéro commande</th>
                                <th>Nom &amp; Prénom client</th>
                                <th>Téléphone</th>
                                <th>E-mail</th>
                                <th>Ville</th>
                                <th>Commune</th>
                                <th>Quartier</th>
                                <th>Adresse</th>
                                <th>Etat</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commandes as $commande)
                                <tr>
                                    <td>{{ $commande->code }}</td>
                                    <td>{{ "{$commande->nom} {$commande->prenoms}" }}</td>
                                    <td>{{ $commande->telephone }}</td>
                                    <td>{{ $commande->email }}</td>
                                    <td>{{ $commande->ville }}</td>
                                    <td>{{ $commande->commune }}</td>
                                    <td>{{ $commande->quartier }}</td>
                                    <td>{{ $commande->adresse }}</td>
                                    <td>{{ $commande->etat }}</td>
                                    <td>{{ $commande->created_at->isoFormat('DD MMM Y, HH:mm') }}</td>
                                    <td>
                                        <a href="{{ route('commandes.show', $commande) }}" class="btn btn-info"
                                            title="Voir la commande"><i class="la la-search-plus"></i></a>
                                        @if ($commande->etat == 'Soumis')
                                            <button data-commande='@json($commande)'
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

    <script>
        $(document).ready(function() {
            $('#example').DataTable();

            $(".valider-commande").click(function(e) {
                e.preventDefault();
                var commande = $(this).data("commande");
                $.post('{{ route('commandes.validate', '__id__') }}'.replaceAll('__id__', commande.id), {
                    commande_id: commande.id,
                    _token: '{{ csrf_token() }}',
                }).done(function(res) {
                    $.notify({
                        icon: 'la la-check',
                        title: 'Information',
                        message: 'La commande a bien été validée !',
                    }, {
                        type: 'success',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        time: 3000,
                    });
                    window.location = res.redirect;
                }).fail(function(err) {
                    $.notify({
                        icon: 'la la-times',
                        title: 'Erreur',
                        message: err.responseJSON?.message,
                    }, {
                        type: 'success',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        time: 3000,
                    });
                })
            })
        });
    </script>
@endsection
