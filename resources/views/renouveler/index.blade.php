@extends("layout.master")

@section("titre")
Liste des renouvellements
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
                <a class="nav-link font-weight-bold active" id="nouvelles-tab" data-toggle="pill" href="#nouvelles"
                    role="tab" aria-controls="nouvelles" aria-selected="true">
                    Nouvelles ({{ count($renews->whereNull('statut')) }}) <i class="fa fa-star text-dark"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" id="accept-tab" data-toggle="pill" href="#accept" role="tab"
                    aria-controls="accept" aria-selected="false">
                    Acceptée ({{ count($renews->where('statut', 1)) }}) <i class="fa fa-check-double text-success"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" id="refus-tab" data-toggle="pill" href="#refus" role="tab"
                    aria-controls="refus" aria-selected="false">
                    Refusée ({{ count($renews->where('statut', 0)) }}) <i class="fa fa-times text-danger"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane active" id="nouvelles" role="tabpanel" aria-labelledby="nouvelles-tab">
                <div class="table-hover table-responsive m-0">
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
                            @foreach ($renews->whereNull('statut') as $renew)

                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $renew->demande->stagiaire->nom }} {{ $renew->demande->stagiaire->prenom }}</td>
                                <td>{{ $renew->demande->specialite }}</td>
                                <td> {{ date('d/m/Y à h:m:s', strtotime($renew->created_at))}}</td>
                                <th>
                                    <a href="{{ route('consulter-demande', ['demande'=> $renew->demande->id]) }}"
                                        target="_blank">Consulter</a>

                                    <a href="#" class="text-danger"
                                        onclick="document.getElementById('refus-{{$renew->id}}').submit()">
                                        Refuser
                                    </a>
                                    <br>
                                    <a href="{{ route('accept-renew', ['renew'=>$renew->id]) }}"
                                        class="btn btn-success">
                                        Accepter
                                    </a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="tab-pane" id="accept" role="tabpanel" aria-labelledby="accept-tab">
                <div class="table-hover table-responsive m-0">
                    <table class="table table-striped table-borderless text-nowrap text-center">
                        <thead class="border-bottom">
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Spécialité</th>
                                <th>Date de demande</th>
                                <th>Date de reponse</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($renews->where('statut', 1) as $renew)

                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $renew->demande->stagiaire->nom }}
                                    {{ $renew->demande->stagiaire->prenom }}</td>
                                <td>{{ $renew->demande->specialite }}</td>
                                <td> {{ date('d/m/Y à h:m:s', strtotime($renew->created_at))}}</td>
                                <td> {{ date('d/m/Y à h:m:s', strtotime($renew->updated_at))}}</td>
                                <th>
                                    <a href="{{ route('consulter-demande', ['demande' => $renew->demande->id]) }}"
                                        target="_blank">Consulter</a>
                                    {{-- Formulaire de refus --}}
                                    <form id="refus-{{$renew->id}}"
                                        action="{{ route('renew.update', ['renew'=>$renew->id]) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="put">
                                    </form>
                                </th>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="refus" role="tabpanel" aria-labelledby="refus-tab">
                <div class="table-hover table-responsive m-0">
                    <table class="table table-striped table-borderless text-nowrap">
                        <thead class="border-bottom">
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Spécialité</th>
                                <th>Date de demande</th>
                                <th>Date de reponse</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($renews->where('statut', 0) as $renew)

                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $renew->demande->stagiaire->nom }}
                                    {{ $renew->demande->stagiaire->prenom }}</td>
                                <td>{{ $renew->demande->specialite }}</td>
                                <td> {{ date('d/m/Y à h:m:s', strtotime($renew->created_at))}}</td>
                                <td> {{ date('d/m/Y à h:m:s', strtotime($renew->updated_at))}}</td>
                                <th>
                                    <a href="{{ route('consulter-demande', ['demande'=>$renew->demande->id]) }}"
                                        target="_blank">Consulter</a>

                                    <a href="{{ route('accept-renew', ['renew'=>$renew->id]) }}"
                                        class="btn btn-success">
                                        Accepter
                                    </a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!-- /.card -->
</div>


<!-- /.card -->
@endsection