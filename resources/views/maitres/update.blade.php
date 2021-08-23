@extends("layout.master")

@section("titre")
Modifier un maitre de stage
@endsection

@section("contenu")
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
            <form method='post' action="{{route('maitre.update', ['maitre'=>$maitre->id])}}">
                @csrf
        
                <input type="hidden" name="_method" value="put">
        
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nom</label>
                        <input type="text" class="form-control" value="{{$maitre->nom}}" name="nom">
                    </div>
                    <div class="form-group">
                        <label for="">Prenom</label>
                        <input type="text" class="form-control" value="{{$maitre->prenom}}" name="prenom">
                    </div>
                    <div class="form-group">
                        <label for="">Sexe</label><br />
                        @if ($maitre->sexe == 'F')
                        <input type="radio" class="" name="sexe" value="F" checked> F
                        <input type="radio" class="" name="sexe" value="M"> M
                        @else
                        <input type="radio" class="" name="sexe" value="F"> F
                        <input type="radio" class="" name="sexe" value="M" checked> M
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Date de naissance</label>
                        <input type="date" class="form-control" value="{{$maitre->dateNais}}" name="dateNais">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" value="{{$maitre->email}}" name="email">
                    </div>
                    <div class="form-group">
                        <label for="">Telephone</label>
                        <input type="tel" class="form-control" value="{{$maitre->tel}}" name="tel">
                    </div>
                    <div class="form-group">
                        <label for="">Adresse</label>
                        <input type="text" class="form-control" value="{{$maitre->adr}}" name="adr" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Poste</label>
                        <input type="text" class="form-control" value="{{$maitre->poste}}" name="poste" placeholder="">
                    </div>
                    @csrf
                    <div class="text-center text-success">
                        @if (Session()->has("updateSuccess"))
                        {{Session()->get("updateSuccess")}}
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-center">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <button type="reset" class="btn btn-danger">Annuler</button>
                    </div>
                    <div class="mt-3">
                        <a type="reset" href="{{route('maitres')}}" class="mt-2">Retour à la liste des maitres de
                            stage</a>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
</div>
@endsection


{{-- 
  
--}}