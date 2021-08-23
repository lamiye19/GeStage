@extends("layout.master")

@section("titre")
Liste des stages
@endsection

@section("contenu")
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
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-hover table-responsive p-0" style="height: 300px;">
    <table class="table table-head-fixed text-nowrap">
      <thead>
        <tr>
          <th>#</th>
          <th>Stagiaire</th>
          <th>Poste</th>
          <th>Thème</th>
          <th>Date de debut</th>
          <th>Date de fin</th>
          <th>Maitre de stage</th>
          <th>Observation</th>
          <th>Rapport</th>
          <th>Statut</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($stages as $stage)
        <tr>
          <td>{{ $loop->index + 1 }}</td>
          <td>{{ $stage->demande->stagiaire->nom }} {{ $stage->demande->stagiaire->prenom }}</td>
          <td>{{ $stage->titreStage }}</td>
          <td>{{ $stage->theme }}</td>
          <td>{{ $stage->debut }}</td>
          <td>{{ $stage->fin }}</td>
          <td>{{ $stage->maitre->nom }} {{ $stage->maitre->prenom }}</td>
          <td>{{ $stage->observation }}</td>
          <td>{{ $stage->renduDoc }}</td>
          <td>{{ $stage->etat }}</td>
          <th>
            <a href="{{ route('consulter-demande', ['demande'=>$stage->demande->id]) }}" target="_blank">CV</a>
          </th>
        </tr>
        @endforeach
      </tbody>

    </table>
    <div class="text-center text-success">
      @if (Session()->has("deleteSuccess"))
      {{Session()->get("deleteSuccess")}}
      @endif
    </div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection