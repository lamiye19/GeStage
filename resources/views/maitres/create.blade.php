@extends("layout.master")

@section("titre")
Ajouter un maitre de stage
@endsection

@section("contenu")
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <div class="card">
      @if (Session()->has("createSuccess"))
      <div class="text-center alert-success my-3 h4">
        {{Session()->get("createSuccess")}}
      </div>
      @endif
      <form method='post' action="{{route('maitre.create')}}">
        <div class="card-body">
          <div class="form-group">
            <label for="">Nom</label>
            <input type="text" class="form-control" id="" name="nom">
          </div>
          <div class="form-group">
            <label for="">Prenom</label>
            <input type="text" class="form-control" id="" name="prenom">
          </div>
          <div class="form-group">
            <label for="">Sexe</label><br />
            <input type="radio" class="" id="" name="sexe" value="F"> F
            <input type="radio" class="" id="" name="sexe" value="M"> M
          </div>
          <div class="form-group">
            <label for="">Date de naissance</label>
            <input type="date" class="form-control" id="" name="dateNais">
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" id="" name="email">
          </div>
          <div class="form-group">
            <label for="">Telephone</label>
            <input type="tel" class="form-control" id="" name="tel">
          </div>
          <div class="form-group">
            <label for="">Adresse</label>
            <input type="text" class="form-control" id="" name="adr" placeholder="">
          </div>
          <div class="form-group">
            <label for="">Poste</label>
            <input type="text" class="form-control" id="" name="poste" placeholder="">
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