@extends("layout.master")

@section("titre")
Modifier un maitre de stage
@endsection

@section("contenu")
<div class="row d-flex justify-content-end" style="font-size: 0.85em;">
  @if(session()->has("updateSuccess"))
  <div class="card col-md-5">
      <div class="card-header d-flex justify-content-arround">
          <strong class="mr-auto text-warning">Modification</strong>
          <small class="text-end"> {{ date('h:m:s') }} </small>
          <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
          </div>
      </div>
      <div class="card-body m-0">
          {{Session()->get("updateSuccess")}}
      </div>
  </div>
  @endif
</div>
<div class="row d-flex justify-content-center">
        <div class="card col-md-8">
            <form method='post' action="{{route('maitre.update', ['maitre'=>$maitre->id])}}">
                @csrf

                <input type="hidden" name="_method" value="put">

                <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-6">
                      <label for="">Nom</label>
                        <input type="text" class="form-control" value="{{$maitre->nom}}" name="nom">
                    </div>
            
                    <div class="form-group col-md-6">
                      <label for="">Prenom</label>
                      <input type="text" class="form-control" value="{{$maitre->prenom}}" name="prenom">
                    </div>
                    <div class="form-group col-8">
                      <label for="">Date de naissance</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fas fa-calendar-alt"></i>
                          </span>
                        </div>
                        <input type="date" class="form-control" value="{{$maitre->dateNais}}" name="dateNais">
                      </div>
                    </div>
                    <div class="form-group col-4 text-center">
                      <label for="">Sexe</label><br />
                      @if ($maitre->sexe == 'F')
                        <input type="radio" class="" name="sexe" value="F" checked> F
                        <input type="radio" class="" name="sexe" value="M"> M
                    @else
                        <input type="radio" class="" name="sexe" value="F"> F
                        <input type="radio" class="" name="sexe" value="M" checked> M
                    @endif
                    </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="">Adresse Email</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                          </span>
                        </div>
                        <input type="email" class="form-control" value="{{$maitre->email}}" name="email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">Telephone</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fas fa-phone"></i>
                          </span>
                        </div>
                        <input type="tel" class="form-control" value="{{$maitre->tel}}" name="tel">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">Adresse physique</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fas fa-building"></i>
                          </span>
                        </div>
                        <input type="text" class="form-control" value="{{$maitre->adr}}" name="adr" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">Poste occupé</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fas fa-user-tag"></i>
                          </span>
                        </div>
                        <input type="text" class="form-control" value="{{$maitre->poste}}" name="poste" placeholder="">
                      </div>
                    </div>
                    @csrf
            
                  </div>

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
@endsection


{{-- 
  
--}}