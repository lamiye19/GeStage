<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{mix("css/app.css")}}">
    @livewireStyles

</head>

<body>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row justify-content-between m-2">
                <h1 class="font-weight-bold">CV Générique</h1>
                <div class="h-0 m-2">
                    @if ($demande->statut == "refus")
                      <a href="" class="btn btn-info" onclick="document.getElementById('attente-{{$demande->id}}').submit()">
                        Donner un RDV
                      </a>
                      <form id="attente-{{$demande->id}}" action="{{ route('demande.update', ['demande'=>$demande->id, 'status'=>'attente']) }}"
                        method="post">
                        @csrf
                        <input type="hidden" name="_method" value="put">
                      </form> 
                    @elseif ($demande->statut == "attente")
                      <div class="row">
                        <a href="" class="btn btn-danger" onclick="document.getElementById('refus-{{$demande->id}}').submit()">
                            Refuser
                        </a>&nbsp;
                          <form id="refus-{{$demande->id}}" action="{{ route('demande.update', ['demande'=>$demande->id, 'status'=>'refus']) }}"
                            method="post">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                          </form> 
                        <a href="" class="btn btn-success" onclick="document.getElementById('accept-{{$demande->id}}').submit()">
                            Accepter
                        </a>
                          <form id="accept-{{$demande->id}}" action="{{ route('demande.update', ['demande'=>$demande->id, 'status'=>'accept']) }}"
                            method="post">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                          </form> 
                      </div>
                    @else
                      
                    @endif
                    <div class="">
                        <a type="reset" href="{{route('demandes')}}" class="mt-2">Retour à la liste des demandes</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if ($demande->stagiaire->sexe == 'F')
                                <img class="profile-user-img img-fluid img-circle"
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSgt6f1CX8Jqr5I10S1k6-Sl3_9xUqrfzg3w&usqp=CAU"
                                    alt="Icone">
                                @else
                                <img class="profile-user-img img-fluid img-circle"
                                    src="data:image/jpeg;base64,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"
                                    alt="Icone">
                                @endif

                            </div>

                            <h3 class="profile-username text-center">{{$demande->stagiaire->nom}} {{$demande->stagiaire->prenom}}</h3>

                            <p class="text-muted text-center">{{$demande->specialite}}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">A propos</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="">
                                <strong><i class="fas fa-birthday-cake mr-1"></i></strong>  {{ date('d - m- Y', strtotime($demande->stagiaire->dateNais))}}
                            </p>
                            <p class="">
                                <strong><i class="fas fa-phone mr-1"></i></strong> <a href="">{{$demande->stagiaire->tel}}</a>
                            </p>
                            <p class="">
                                <strong><i class="far fa-envelope mr-1"></i></strong> <a href="">{{$demande->stagiaire->email}}</a>
                            </p>
                            <hr>

                            <strong><i class="fas fa-university mr-1"></i> Centre de formation</strong>
                            <p class="text-muted">{{$demande->stagiaire->ecole}}</p>
                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Adresse</strong>
                            <p class="text-muted">{{$demande->stagiaire->adr}}</p>
                            <hr>

                            <strong><i class="fas fa-language mr-1"></i> Langues</strong>
                            <p class="text-muted">{{$demande->langues}}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-gradient-success">
                                        <i class="fas fa-briefcase mr-2"></i> Expériences professionnelle
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                                @for ($i = 1; $i < 4; $i++)
                                    <!-- timeline item -->
                                    <div>
                                        @php
                                        $a="expDate".$i;
                                        $b="expTitre".$i;
                                        $c="exp".$i;
                                        @endphp
                                        <i class="fas border-secondary"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header"><a href="">{{$demande->$a}}</a>
                                                {{$demande->$b}}</h3>
                                            <div class="timeline-body">
                                                {{$demande->$c}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                @endfor
                            </div>

                            <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-fuchsia">
                                        <i class="fas fa-book mr-1"></i> Formations et Etudes
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                                
                                @for ($i = 1; $i < 4; $i++)
                                <!-- timeline item -->
                                <div>
                                    @php
                                    $a="pDate".$i;
                                    $b="pTitre".$i;
                                    $c="p".$i;
                                    @endphp
                                    <i class="fas border-secondary"></i>

                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">{{$demande->$a}}</a> {{$demande->$b}}</h3>

                                        <div class="timeline-body">
                                            {{$demande->$c}}
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                            <!-- END timeline item -->

                            <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-gradient-info">
                                        <i class="fas fa-pencil-ruler mr-2"></i> Compétences
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas border-secondary"></i>
                                    <div class="timeline-item">
                                        <div class="timeline-body">
                                            <p class="text-muted">
                                                {{$demande->competences}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-gradient-secondary">
                                        <i class="fas fa-heartbeat mr-2"></i> Centre d'intérêt
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas border-secondary"></i>
                                    <div class="timeline-item">
                                        <div class="timeline-body">
                                            <p>{{$demande->hobbies}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                        </div><!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <div class="card-footer text-center">
        
    </div>
    <script src="{{mix('js/app.js')}}"></script>

</body>

</html>

{{-- @extends("layout.master")

@section("contenu")
  <livewire:counter/>
@endsection --}}