@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Gamme N° {{$gamme->id}}</div>

                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <h4>{{ $gamme->nom }}</h4>
                        <h6 class="text-muted">{{ $gamme->items->count() }} Items</h6>

                        <div class="row border-bottom border-top">
                            <div class="col-md-6">
                                <h5 class="text-center mt-3">Liste des items</h5>
                                <ul class="list-unstyled">
                                @forelse($gamme->items as $i)
                                        <li class="list-group-item-action">{{ $i->nom }}</li>
                                @empty
                                    <li class="list-group-item-action">Aucun item</li>
                                @endforelse
                                </ul>
                            </div>
                            <div class="col-md-6 border-left">
                                <h5 class="text-center mt-3">Ajouter item</h5>
                                <form action="{{ route('gammes.add-item',$gamme->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nom">Nom</label>
                                        <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom de l'action a effectuer">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success">Ajouter item</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-md-12">
                                <h5 class="text-center mt-3">Soumissions</h5>
                            </div>
                            <table class="table table-sm">
                                <thead>
                                <tr class="text-center">
                                    <th>Item</th>
                                    <th>Valeur</th>
                                    <th>Effectué par</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($submissions as $s)
                                    <tr>
                                        <td>{{ $s->item->nom }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $s->value == 'BIEN' ? 'badge-success' : 'badge-danger' }}">{{ $s->value }}</span>
                                        </td>
                                        <td class="text-center">{{ $s->auteur->name }}</td>
                                        <td class="text-center">{{ $s->created_at->format('d-m-Y H:i') }} ( {{ $s->created_at->diffForHumans() }} )</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Aucune soumission</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                            <div class="row border-bottom">
                                <div class="col-md-12">
                                    <h5 class="text-center mt-3">Graphiques ( cadeau pour Badrellagi )</h5>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="chart1"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="chart2"></canvas>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('chart1').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! $data->pluck('label') !!},
                datasets: [{
                    label : 'Soumissions',
                    data: {!! $data->pluck('data') !!},
                    backgroundColor: [
                        'rgba(83,235,48,0.2)',
                        'rgba(255,130,58,0.2)',
                    ],
                    borderColor: [
                        'rgb(90,235,84)',
                        'rgb(255,91,81)',
                    ],
                    borderWidth: 1
                }],

            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        var ctx2 = document.getElementById('chart2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: {!! $data->pluck('label') !!},
                datasets: [{
                    label : 'Soumissions',
                    data: {!! $data->pluck('data') !!},
                    backgroundColor: [
                        'rgba(83,235,48,0.2)',
                        'rgba(255,130,58,0.2)',
                    ],
                    borderColor: [
                        'rgb(90,235,84)',
                        'rgb(255,91,81)',
                    ],
                    borderWidth: 1
                }],

            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
