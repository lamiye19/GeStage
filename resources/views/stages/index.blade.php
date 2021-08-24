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
  @if (Session()->has("updateSuccess"))
  <div class="text-center alert-success py-1 h5">
    {{Session()->get("updateSuccess")}}
  </div>
  @endif
  @if(session()->has("deleteSuccess"))
  <div class="text-center alert-success py-1 h4">
    {{Session()->get("deleteSuccess")}}
  </div>
  @endif
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
          @if (Auth::user()->is_admin)
          <th>Maitre de stage</th>
          @endif
          <th>Observation</th>
          <th>Rapport</th>
          <th>Statut</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @foreach ($stages as $stage)
        <tr>
          <td>{{ $loop->index + 1 }}</td>
          <td>{{ $stage->demande->stagiaire->nom }} {{ $stage->demande->stagiaire->prenom }}</td>
          <td>{{ $stage->titreStage }}</td>
          <td>{{ $stage->theme }}</td>
          <td>{{ $stage->debut }}</td>
          <td>{{ $stage->fin }}</td>
          @if (Auth::user()->is_admin)
          <td>{{ $stage->maitre->nom }} {{ $stage->maitre->prenom }}</td>
          @endif
          <td>
            @if ($stage->observation == null)
            @if (!Auth::user()->is_admin)
            <a href="#" onclick="document.getElementById('noter').hidden = false; ">Noter</a><br>

            <form action="{{route('stage.update', ['stage'=>$stage->id])}}" method="post" id="noter" hidden>
              @csrf
              <input type="hidden" name="_method" value="put">
              <div class="d-flex">
                <select name="observation" id="observation" class="form-control">
                  <option value="Concluant">Concluant</option>
                  <option value="Non oncluant">Non oncluant</option>
                </select>
                <button type="submit"><i class="fas fa-check"></i></button>
              </div>
            </form>
            @else
            -

            @endif
            @else
            {{ $stage->observation }}
            @endif
          </td>
          <td>{{ $stage->renduDoc }}</td>
          <td>{{ $stage->etat }}</td>
          <th>
            <a href="{{ route('consulter-demande', ['demande'=>$stage->demande->id]) }}" target="_blank">CV</a>

          </th>
        </tr>
        @endforeach
      </tbody>

    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection