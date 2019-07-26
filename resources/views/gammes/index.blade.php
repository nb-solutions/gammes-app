@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Liste des gammes</div>

                    <div class="card-body">
                        <div class="alert alert-info">
                            Choisissez une gamme pour ajouter / modifier les items
                        </div>
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <ul class="list-group list-group-flush mb-4">
                        @forelse ($gammes as $g)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ url('/gammes',$g->id) }}">{{ $g->nom }}</a>
                                <a class="btn btn-outline-light" href="{{ route('gammes.show-form',$g->id) }}">FORMULAIRE</a>

                            </li>
                        @empty
                            <li class="list-group-item">Aucune gamme existante</li>
                        @endforelse
                        </ul>

                        <a href="{{ route('gammes.create') }}" class="btn btn-primary">Créer une gamme</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
