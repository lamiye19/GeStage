@extends("layout.master")

@section("titre")
Ajouter un service
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
      <form method='post' action="{{route('service.create')}}">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Libellé</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-tag"></i>
                </span>
              </div>
            <input type="text" class="form-control" id="" name="lib" placeholder="" required>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Directeur</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-user-tie"></i>
                </span>
              </div>
            <input type="text" class="form-control" id="" name="directeur" placeholder="" required>
            </div>
          </div>
          @csrf
        </div>
        <div class="card-footer text-center">
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <button type="reset" class="btn btn-danger">Annuler</button>
          </div>
          <div class="mt-3">
            <a type="reset" href="{{route('services')}}" class="">Retour à la liste des services</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection