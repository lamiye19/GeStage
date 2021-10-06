@extends('layout.master')

@section('titre')
Nos Rendez-vous
@endsection

@section('contenu')



<div class="card-header">
    <div class="row justify-content-between d-flex">
        <div class="card-tools">
            <b>Tout : {{ count($rdvs) }}</b> | <b>Confirmé : </b>{{ count($rdvs->where('confirmer', 1)) }} |
            <b>Aujourd'hui : </b>{{ count($rdvs->where('dateHeure', date('Y-m-d', strtotime(now())))) }}
            {{-- <div class="input-group input-group-sm" style="width: 150px;">
        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

        <div class="input-group-append">
          <button type="submit" class="btn btn-default">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div> --}}
        </div>
        {{-- <a href="{{route('ajouter-demande')}}">
        <div class="btn btn-primary">Ajouter</div>
        </a> --}}
    </div>
</div>

<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="font-size: 1em;">
            <li class="nav-item">
                <a class="nav-link font-weight-bold active" id="rdvs-tab" data-toggle="pill" href="#rdvs" role="tab"
                    aria-controls="rdvs" aria-selected="true">
                    Sans réponse ({{ count($rdvs->whereNull('confirmer')) }})
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" id="refus-tab" data-toggle="pill" href="#refus" role="tab"
                    aria-controls="refus" aria-selected="false">
                    Refusé ({{ count($rdvs->whereNotNull('confirmer')->where('confirmer', 0)) }}) <i class="fa fa-times text-danger"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" id="accept-tab" data-toggle="pill" href="#accept" role="tab"
                    aria-controls="accept" aria-selected="false">
                    Confirmé ({{ count($rdvs->where('confirmer', 1)) }}) <i class="fa fa-check-double text-success"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" id="calendrier-tab" data-toggle="pill" href="#calendrier" role="tab"
                    aria-controls="calendrier" aria-selected="false">
                    Calendrier <i class="fa fa-eye text-secondary"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane active" id="rdvs" role="tabpanel" aria-labelledby="rdvs-tab">
                <div class="table-hover table-responsive m-0">
                    <table class="table table-striped table-borderless text-nowrap align-middle text-center">
                        <thead class="border-bottom">
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Date</th>
                                <th>Heure</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rdvs->whereNull('confirmer') as $rdv)

                            <tr>
                                @php
                                $date = date('Ymd', strtotime($rdv->dateHeure)).'T'.date('hm',
                                strtotime($rdv->dateHeure)).'Z';
                                @endphp
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $rdv->demande->stagiaire->nom }} {{ $rdv->demande->stagiaire->prenom }}</td>
                                <td> {{ date('d/m/Y', strtotime($rdv->dateHeure))}}</td>
                                <td> {{ date('H:m', strtotime($rdv->dateHeure))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="tab-pane" id="refus" role="tabpanel" aria-labelledby="refus-tab">
                <div class="table-hover table-responsive m-0">
                    <table class="table table-striped table-borderless text-nowrap align-middle text-center">
                        <thead class="border-bottom">
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Raison</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rdvs->whereNotNull('confirmer')->where('confirmer', false) as $rdv)

                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $rdv->demande->stagiaire->nom }} {{ $rdv->demande->stagiaire->prenom }}</td>
                                <td> {{ date('d/m/Y', strtotime($rdv->dateHeure))}}</td>
                                <td> {{ date('H:m', strtotime($rdv->dateHeure))}}</td>
                                <td>{{ $rdv->message }}</td>
                                <th>
                                    <form id="rdv-{{$rdv->id}}"
                                        action="{{ route('rdv.reprise', ['rdv'=>$rdv->id]) }}"
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="put">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="datetime-local" name="dateHeure" value="{{now()}}" class=""
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-info">Redonner un RDV</button>
                                    </form>
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
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rdvs->where('confirmer', 1) as $rdv)
                            @php
                            $date = date('Ymd', strtotime($rdv->dateHeure)).'T'.date('hm',
                            strtotime($rdv->dateHeure)).'Z';
                            @endphp
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $rdv->demande->stagiaire->nom }}
                                    {{ $rdv->demande->stagiaire->prenom }}
                                </td>
                                <td> {{ date('d/m/Y', strtotime($rdv->dateHeure))}}</td>
                                <td> {{ date('H:m', strtotime($rdv->dateHeure))}}</td>
                                <th>
                                    <a href="https://calendar.google.com/calendar/u/0/r/eventedit?text=Entretien+:+{{$rdv->demande->stagiaire->nom}}+{{ $rdv->demande->stagiaire->prenom }}&dates={{$date}}/{{$date}}&ctz=Africa/Abidjan"
                                        class="btn btn-success">
                                        Ajouter au calendrier
                                    </a>
                                </th>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="calendrier" role="tabpanel" aria-labelledby="calendrier-tab">
                <iframe
                    src="https://calendar.google.com/calendar/embed?src=gestage.dev%40gmail.com&ctz=Africa%2FAbidjan&title=Programmes"
                    style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>

            </div>

        </div>
    </div>
    <!-- /.card -->
</div>


@endsection