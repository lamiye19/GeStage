@extends("layout.master")

@section("titre")
Liste des demandes
@endsection

@section("contenu")
<div class="card-header">
  {{-- <div class="row justify-content-between d-flex">
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
    <a href="{{route('ajouter-demande')}}">
  <div class="btn btn-primary">Ajouter</div>
  </a>
</div> --}}
</div>
<!-- /.card-header -->
@if(session()->has("deleteSuccess"))
<div class="text-center alert-success my-3 h4">
  {{Session()->get("deleteSuccess")}}
</div>
@endif

    @if (Session()->has("updateSuccess"))
    <div class="text-center alert-success my-3 h4">
      {{Session()->get("updateSuccess")}}
    </div>
    @endif

<!-- /.card-body -->
<div class="card card-primary card-outline card-outline-tabs">
  <div class="card-header p-0 border-bottom-0">
    <ul class="nav nav-tabs" id="myTab" role="tablist" style="font-size: 1em;">
      <li class="nav-item">
        <a class="nav-link font-weight-bold active" id="nouvelles-tab" data-toggle="pill" href="#nouvelles" role="tab"
          aria-controls="nouvelles" aria-selected="true">
          Nouvelles <i class="fa fa-star text-dark"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold" id="traitees-tab" data-toggle="pill" href="#traitees" role="tab"
          aria-controls="traitees" aria-selected="false">
          Traitées <i class="fa fa-star text-warning"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold" id="accept-tab" data-toggle="pill" href="#accept" role="tab"
          aria-controls="accept" aria-selected="false">
          Accepté <i class="fa fa-check-double text-success"></i>
        </a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="nouvelles" role="tabpanel" aria-labelledby="nouvelles-tab">
        <div class="table-hover table-responsive p-0">
          <table class="table table-striped table-borderless">
            <thead class="border-bottom">
              <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Spécialité</th>
                <th>Date de demande</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($demandes as $demande)
              @php
              $i = 0;
              @endphp
              @if ($demande->statut == null)
              @php
              $i++;
              @endphp
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $demande->stagiaire->nom }} {{ $demande->stagiaire->prenom }}</td>
                <td>{{ $demande->specialite }}</td>
                <td>{{ $demande->created_at }}</td>
                <th>
                  <a href="{{ route('consulter-demande', ['demande'=>$demande->id]) }}" target="_blank">Consulter</a>
                  /
                  @include('demandes.responseLink')
                </th>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="tab-pane fade" id="traitees" role="tabpanel" aria-labelledby="traitees-tab">
        <div class="table-hover table-responsive m-0">
          <table class="table table-striped table-borderless">
            <thead class="border-bottom">
              <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Spécialité</th>
                <th>Date de demande</th>
                <th>Date de modification</th>
                <th>Statut</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($demandes as $demande)
              @if ($demande->statut != null)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $demande->stagiaire->nom }} {{ $demande->stagiaire->prenom }}</td>
                <td>{{ $demande->specialite }}</td>
                <td>{{ $demande->created_at }}</td>
                <td>{{ $demande->updated_at }}</td>
                <td class="text-center">
                  @if ($demande->statut == "accept")
                  <i class="fa fa-check-circle text-success"></i>
                  @elseif ($demande->statut == "refus")
                  <i class="fa fa-times text-danger"></i>
                  @else
                  <i class="fa fa-clock text-warning"></i>
                  @endif
                </td>
                <th>
                  <a href="{{ route('consulter-demande', ['demande'=>$demande->id]) }}" target="_blank">Consulter</a>

                  @include('demandes.responseLink')
                </th>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="tab-pane" id="accept" role="tabpanel" aria-labelledby="accept-tab">
        <div class="table-hover table-responsive m-0">
          <table class="table table-striped table-borderless">
            <thead class="border-bottom">
              <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Spécialité</th>
                <th>Statut</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($demandes as $demande)
              @php
              $i = 0;
              @endphp
              @if ($demande->statut == "accept")
              @php
              $i++;
              @endphp
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $demande->stagiaire->nom }} {{ $demande->stagiaire->prenom }}</td>
                <td>{{ $demande->specialite }}</td>
                <td class="text-center">
                  @if ($demande->statut == "accept")
                  <i class="fa fa-check-circle text-success"></i>
                  @elseif ($demande->statut == "refus")
                  <i class="fa fa-times text-danger"></i>
                  @else
                  <i class="fa fa-clock text-warning"></i>
                  @endif
                </td>
                <th>
                  <a href="{{ route('consulter-demande', ['demande'=>$demande->id]) }}" target="_blank">Consulter</a>
                </th>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="text-center text-success">
          @if (Session()->has("deleteSuccess"))
          {{Session()->get("deleteSuccess")}}
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- /.card -->
</div>
<!-- /.card -->
@endsection