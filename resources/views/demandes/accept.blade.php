@extends("layout.master")

@section("titre")
Informations du stage
@endsection

@section("contenu")
<div class="row">
  <div class="col-md-2">
      @foreach ($errors->all() as $err)
          {{ $err }} <br>
      @endforeach
  </div>
  <div class="col-md-8">
    <div class="card">
      <form method='post' action="{{route('stage.create')}}">
        <div class="card-body">
            @csrf
          <div class="text-center text-success">
            @if (Session()->has("createSuccess"))
            {{Session()->get("createSuccess")}}
            @endif
          </div>
          <div class="form-group">
            <label for="">Titre</label>
            <input type="text" class="form-control" id="" name="titreStage" value="{{ $demande->titre }}">
          </div>
          <div class="form-group">
            <label for="">Thème</label>
            <input type="text" class="form-control" id="" name="theme">
          </div>
          <div class="form-group">
            <label for="">Date de début</label>
            <input type="date" class="form-control" id="" name="debut">
          </div>
          <div class="form-group">
            <label for="">Date de fin</label>
            <input type="date" class="form-control" id="" name="fin">
          </div>
          <div class="form-group">
            <label for="">Maitre de Stage</label>
            <select class="form-control" id="" name="maitre_id">
              <option value=""></option>
              @foreach ($maitres as $maitre)
              <option value="{{$maitre->id}}">{{$maitre->nom}} {{$maitre->prenom}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">Service</label>
            <select class="form-control" id="" name="service_id">
              <option value=""></option>
              @foreach ($services as $sce)
              <option value="{{$sce->id}}">{{$sce->lib}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <input type="hidden" class="form-control" id="" name="demande_id" value="{{ $demande->id }}">
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer text-center">
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <button type="reset" class="btn btn-danger">Annuler</button>
          </div>
          <div class="mt-3">
            <a type="reset" href="{{route('demandes')}}" class="mt-2">Retour à la liste des demandes</a>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
</div>
</div>
@endsection
