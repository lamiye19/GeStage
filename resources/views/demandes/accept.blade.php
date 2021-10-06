@extends("layout.master")

@section("titre")
Informations du stage
@endsection

@section("contenu")
<div class="row d-flex justify-content-end" style="font-size: 0.85em;">
  @if (Session()->has("createSuccess"))
  <div class="card col-md-4">
    <div class="card-header d-flex justify-content-arround">
      <strong class="mr-auto text-success">Création</strong>
      <small class="text-end"> {{ date('H:m:s') }} </small>
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
    @isset($demande)
    <form method='post' action="{{route('stage.create')}}">
      @else
      <form method='post' action="{{route('stageRenew.create', ['renew' => $renew->id])}}">
        @endisset
        <div class="card-body">
          @csrf

          <div class="form-group">
            <label for="">Titre</label>
            <input type="text" class="form-control" required name="titreStage" value="{{ old('titreStage') }}">
          </div>
          <div class="form-group">
            <label for="">Thème</label>
            <input type="text" class="form-control" required name="theme" value="{{ old('theme') }}">
          </div>
          <div class="form-group">
            <label for="">Date de début</label>
            <input type="date" class="form-control @error('debut') is-invalid @enderror" required name="debut" value="{{ old('debut') }}">
            @error('debut')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="">Date de fin</label>
            <input type="date" class="form-control @error('fin') is-invalid @enderror" required name="fin" value="{{ old('fin') }}">
            @error('fin')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="">Maitre de Stage</label>
            <select class="form-control" required name="maitre_id" value="{{ old('maitre_id') }}">
              <option value=""></option>
              @foreach ($maitres as $maitre)
              <option value="{{$maitre->id}}">{{$maitre->nom}} {{$maitre->prenom}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">Service</label>
            <select class="form-control" required name="service_id" value="{{ old('service_id') }}">
              <option value=""></option>
              @foreach ($services as $sce)
              <option value="{{$sce->id}}">{{$sce->lib}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            @isset($demande)
            <input type="hidden" class="form-control" required name="demande_id" value="{{ $demande->id }}">
            @else
            <input type="hidden" class="form-control" required name="demande_id" value="{{ $renew->demande->id }}">
            @endisset
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer text-center">
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <button type="reset" class="btn btn-danger">Annuler</button>
          </div>
          <div class="mt-3">
            @isset($demande)
            <a type="reset" href="{{route('demandes')}}" class="mt-2">Retour à la liste des demandes</a>
            @else
            <a type="reset" href="{{route('renouvellement')}}" class="mt-2">Retour à la liste des renouvellements</a>
            @endisset
          </div>
        </div>
      </form>
      <!-- /.card -->
  </div>
</div>
</div>
@endsection