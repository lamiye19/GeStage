@extends("layout.master")

@section("titre")
Ajouter un service
@endsection

@section("contenu")

<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <div class="card">
      <form method='post' action="{{route('service.create')}}">
        <div class="card-body">
          @if (Session()->has("createSuccess"))
          <div class="text-center alert-success my-3 h4">
            {{Session()->get("createSuccess")}}
          </div>
          @endif
          <div class="form-group">
            <label for="exampleInputEmail1">Libellé</label>
            <input type="text" class="form-control" id="" name="lib" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Directeur</label>
            <input type="text" class="form-control" id="" name="directeur" placeholder="" required>
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