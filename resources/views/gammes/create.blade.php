@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Nouvelle gamme</div>

                    <div class="card-body">
                        <form action="{{ route('gammes.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="nom">Nom de la gamme</label>
                                <input id="nom" type="text" class="form-control" name="nom" placeholder="Nom de la gamme">

                            </div>

                            <div class="form-group">
                                <button class="btn btn-success">Sauvegarder</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
