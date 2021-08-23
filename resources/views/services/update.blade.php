@extends("layout.master")

@section("titre")
Modifier un service
@endsection

@section("contenu")
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <div class="card">
      <form method='post' action="{{route('service.update', ['service'=>$service->id])}}">
        @csrf

        <input type="hidden" name="_method" value="put">

        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Libellé</label>
            <input type="text" class="form-control" id="" name="lib" value="{{ $service->lib }}" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Directeur</label>
            <input type="text" class="form-control" id="" name="directeur" value="{{ $service->directeur }}" required>
          </div>
          @csrf
          <div class="text-center text-success">
            @if (Session()->has("updateSuccess"))
            {{Session()->get("updateSuccess")}}
            @endif
          </div>
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