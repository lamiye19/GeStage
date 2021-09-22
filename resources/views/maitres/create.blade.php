@extends("layout.master")

@section("titre")
Ajouter un maitre de stage
@endsection

@section("contenu")
<div class="row d-flex justify-content-end" style="font-size: 0.85em;">
  @if (Session()->has("createSuccess"))
  <div class="card col-md-4">
    <div class="card-header d-flex justify-content-arround">
      <strong class="mr-auto text-success">Création</strong>
      <small class="text-end"> {{ date('h:m:s') }} </small>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body m-0">
      {{Session()->get("createSuccess")}}
    </div>
  </div>
  @endif
</div>
<div class="row d-flex justify-content-center">
  <div class="card col-md-8">
    <form method='post' action="{{route('maitre.create')}}">
      <div class="card-body">
        <div class="row">
          <div class="form-group col-md-6">
            <label for="">Nom</label>
            <input type="text" class="form-control" required name="nom" value="{{ old('nom') }}">
          </div>

          <div class="form-group col-md-6">
            <label for="">Prenom</label>
            <input type="text" class="form-control" required name="prenom" value="{{ old('prenom') }}">
          </div>
          <div class="form-group col-8">
            <label for="">Date de naissance</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-calendar-alt"></i>
                </span>
              </div>
              <input type="date" class="form-control" required max="{{ date('Y',strtotime(now()))-25 }}-12-31"
                name="dateNais" value="{{ old('dateNais') }}">
            </div>
          </div>
          <div class="form-group col-4 text-center">
            <label for="">Sexe</label><br />
            <input type="radio" class="" id="" name="sexe" value="F"> F
            <input type="radio" class="" id="" name="sexe" value="M"> M
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
            <input type="email" class="form-control @error('email') is-invalid @enderror" required name="email"
              pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ex: test@gmail.com" value="{{ old('email') }}">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label for="">Téléphone</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fas fa-phone"></i>
              </span>
            </div>
            <input type="tel" class="form-control" required name="tel" placeholder="Ex:90064578"
              pattern="[79]{1}[01236789]{1}[0-9]{6}" title="Veuillez entrer un numéro de téléphone valide"
              value="{{ old('tel') }}">
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
            <input type="text" class="form-control" id="" name="adr" value="{{ old('adr') }}">
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
            <input type="text" class="form-control" id="" name="poste" value="{{ old('poste') }}">
          </div>
        </div>

        @csrf


      </div>
      <!-- /.card-body -->

      <div class="card-footer text-center">
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Ajouter</button>
          <button type="reset" class="btn btn-danger">Annuler</button>
        </div>
        <div class="mt-3">
          <a type="reset" href="{{route('maitres')}}" class="mt-2">Retour à la liste des maitres de stage</a>
        </div>
      </div>
    </form>
  </div>
  <!-- /.card -->
</div>
</div>
@endsection


{{-- 
  @foreach ($services as $service)
                  @if($service->id == $maitre->service_id)
                    <option value="{{$service->id}}" selected>{{$service->lib}}</option>
@else
<option value="{{$service->id}}">{{$service->lib}}</option>
@endforeach
--}}