@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-body text-center">
                        <h3>
                            {{ $gamme->nom }}
                        </h3>
                        <p class="text-light">
                            Remplissez le formulaire de la gamme
                        </p>
                        <form action="{{ route('gammes.submit-form',$gamme->id) }}" method="post">
                            @csrf
                            <ul class="list-group list-group-flush">
                            @forelse ($gamme->items as $i)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>
                                        {{ $i->nom }}
                                        <input type="hidden" name="item_id[]" value="{{ $i->id }}">
                                    </span>

                                    <select class="form-control-sm" name="value[]">
                                        <option value="BIEN">BIEN</option>
                                        <option value="PAS BIEN">PAS BIEN</option>
                                    </select>
                                </li>
                            @empty
                                <li class="list-group-item">Il n'ya aucun item dans cette gamme</li>
                            @endforelse
                            </ul>
                            <div class="form-group">
                                <button class="btn btn-success">Soumettre</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
