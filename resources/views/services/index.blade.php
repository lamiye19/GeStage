@extends("layout.master")

@section("titre")
Liste des services
@endsection

@section("contenu")
<div class="row d-flex justify-content-end" style="font-size: 0.85em;">
  @if(session()->has("deleteSuccess"))
  <div class="card col-md-5">
      <div class="card-header d-flex justify-content-arround">
          <strong class="mr-auto text-danger">Suppression</strong>
          <small class="text-end"> {{ date('h:m:s') }} </small>
          <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
          </div>
      </div>
      <div class="card-body m-0">
          {{Session()->get("deleteSuccess")}}
      </div>
  </div>
  @endif
</div>
<div class="card">
  <div class="card-header">
    <div class="row justify-content-between d-flex">
      <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px;">
          <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

          <div class="input-group-append">
            <button type="submit" class="btn btn-default">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </div>
      <a href="{{route('ajouter-service')}}">
        <div class="btn btn-primary">Ajouter</div>
      </a>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-hover table-responsive p-0" style="height: 300px;">
    <table class="table table-head-fixed text-nowrap">
      <thead>
        <tr>
          <th>#</th>
          <th>Libellé</th>
          <th>Directeur</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($services as $service)
        <tr>
          <td>{{ $loop->index + 1 }}</td>
          <td>{{ $service->lib }}</td>
          <td>{{ $service->directeur }}</td>
          <th>
            <a href="{{ route('service.update', ['service'=>$service->id]) }} "><i class="far fa-edit"></i></a>
            <a href="" onclick="if(confirm('Voulez-vous vraiment supprimer ce service? Les informations liés aux stages seront supprimées avec.')){
              document.getElementById('form-{{$service->id}}').submit()}">
              <i class="far fa-trash-alt text-danger"></i>
            </a>
            <form id="form-{{$service->id}}" action="{{route('service.delete', ['service'=>$service->id])}}"
              method="post">
              @csrf
              <input type="hidden" name="_method" value="delete">
            </form>
          </th>
        </tr>
        @endforeach
      </tbody>

      {{ $services->links() }}
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection