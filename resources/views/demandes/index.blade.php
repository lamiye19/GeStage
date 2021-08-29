@extends("layout.master")

@section("titre")
Liste des demandes
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

<div class="card card-primary card-outline card-outline-tabs">
  <div class="card-header p-0 border-bottom-0">
    <ul class="nav nav-tabs" id="myTab" role="tablist" style="font-size: 1em;">
      <li class="nav-item">
        <a class="nav-link font-weight-bold active" id="nouvelles-tab" data-toggle="pill" href="#nouvelles" role="tab"
          aria-controls="nouvelles" aria-selected="true">
          Nouvelles ({{ count($demandes->whereNull('statut')) }}) <i class="fa fa-star text-dark"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold" id="traitees-tab" data-toggle="pill" href="#traitees" role="tab"
          aria-controls="traitees" aria-selected="false">
          Traitées ({{ count($demandes->whereNotNull('statut')) }}) <i class="fa fa-star text-warning"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold" id="accept-tab" data-toggle="pill" href="#accept" role="tab"
          aria-controls="accept" aria-selected="false">
          Accepté ({{ count($demandes->where('statut', 'accept')) }}) <i class="fa fa-check-double text-success"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bold" id="renew-tab" data-toggle="pill" href="#renew" role="tab"
          aria-controls="renew" aria-selected="false">
          Renouvellées ({{ count($demandes->where('statut', 'accept')) }}) <i class="fa fa-camera-retro text-success"></i>
        </a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="nouvelles" role="tabpanel" aria-labelledby="nouvelles-tab">
        <div class="table-hover table-responsive p-0">
          <table class="table table-striped table-borderless text-nowrap">
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
              @php
              $i = 0;
              @endphp
              @foreach ($demandes->whereNull('statut') as $demande)
              
              @php
              $i++;
              @endphp
              <tr>
                <td>{{ $loop->index +1 }}</td>
                <td>{{ $demande->stagiaire->nom }} {{ $demande->stagiaire->prenom }}</td>
                <td>{{ $demande->specialite }}</td>
                <td>{{ $demande->created_at }}</td>
                <th>
                  <a href="{{ route('consulter-demande', ['demande'=>$demande->id]) }}" target="_blank">Consulter</a>
                  /
                  @include('demandes.responseLink')
                </th>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="tab-pane fade" id="traitees" role="tabpanel" aria-labelledby="traitees-tab">
        <div class="table-hover table-responsive m-0">
          <table class="table table-striped table-borderless text-nowrap">
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
              @foreach ($demandes->whereNotNull('statut') as $demande)
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
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="tab-pane" id="accept" role="tabpanel" aria-labelledby="accept-tab">
        <div class="table-hover table-responsive m-0">
          <table class="table table-striped table-borderless text-nowrap">
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
              @foreach ($demandes->where('statut', 'accept') as $demande)

              <tr>
                <td>{{ $loop->index +1 }}</td>
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

      <div class="tab-pane" id="renew" role="tabpanel" aria-labelledby="renew-tab">
        @include('renouveller.index')
      </div>
    </div>
  </div>
  <!-- /.card -->
</div>
<!-- /.card -->
@endsection