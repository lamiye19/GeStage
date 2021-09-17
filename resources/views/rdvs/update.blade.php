@extends('layout.index')

@section('content')


<div class="row d-flex justify-content-center">
    <div class="card col-8">
        <div class="card-header">Confirmation de rendez-vous</div>
        <div class="card-body">
            <form method='post' action='{{route('rdv.update', ['rdv'=>$rdv->id])}}'>
                @csrf
                <input type='hidden' name='_method' value='put'>
                <p>
                    <input type='radio' name='confirmer' value='0' class="" 
                    onclick="document.getElementById('msg').hidden = false;"> Non Confirmer &nbsp;&nbsp;
                    <input type='radio' name='confirmer' value='1' class=""
                    onclick="document.getElementById('msg').hidden = true;"> Confirmer
                </p>
                <p>
                    <input type="text" name="message" id="msg" placeholder="Raison" class="form-control" hidden>
                </p>
    
                <button type='submit' class="btn btn-primary"> Envoyer la réponse </button>
            </form>
        </div>
        @if(session()->has("updateSuccess"))
        <div class="card-footer">
            <div class="alert alert-success text-center">
                {{Session()->get("updateSuccess")}}
            </div>
        </div>
        @endif
    </div>
</div>

@endsection