@extends("layout.master")

@section("titre")
Liste des stages
@endsection

@section("contenu")
<div class="row d-flex justify-content-end" style="font-size: 0.85em;">
  @if(session()->has("updateSuccess"))
  <div class="card col-md-5">
      <div class="card-header d-flex justify-content-arround">
          <strong class="mr-auto text-warning">Modification</strong>
          <small class="text-end"> {{ date('h:m:s') }} </small>
          <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
          </div>
      </div>
      <div class="card-body m-0">
          {{Session()->get("updateSuccess")}}
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
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-hover table-responsive p-0" style="height: 300px;">
    <table class="table table-head-fixed text-nowrap text-center">
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
          <th>Service</th>
          <th>Observation</th>
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
          <td>{{ date('d/m/Y', strtotime($stage->debut ))}}</td>
          <td>{{ date('d/m/Y', strtotime($stage->fin ))}}</td>
          @if (Auth::user()->is_admin)
          <td>{{ $stage->maitre->nom }} {{ $stage->maitre->prenom }}</td>
          @endif
          <td>{{ $stage->service->lib }} </td>
          <td>
            @if ($stage->observation == null)
              @if (!Auth::user()->is_admin && $stage->etat)
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
          <td>
            @if ($stage->etat)
              <i class="fa fa-check text-teal"></i>
            @elseif ($stage->etat=0)
              <i class="fa fa-time text-red"></i>
            @else
              <pre class="text-warning">En cours</pre>
            @endif
          </td>
          <th>
            <a href="{{ route('consulter-demande', ['demande'=>$stage->demande->id]) }}" target="_blank">CV</a>

            @if ($stage->renduDoc)
            &nbsp;/&nbsp;
            <a href="/storage/{{ $stage->renduDoc }}">
              <i class="fa fa-file-pdf text-danger"></i>
            </a>
            @endif
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